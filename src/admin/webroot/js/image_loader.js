var ImageLoader = {
	trigger:	'#fileTrigger',
	button:		'#fileButton',
	container:	'#fileContainer',
	form:		'#fileupload',
	
	previewWidth:	180,
	previewHeight:	120,
	
	fileList:	[],

	init: function(){
		jq(ImageLoader.trigger).click(function(){
			jq(ImageLoader.button).click();
		});

		jq(ImageLoader.container).bind({
			dragenter: function(){
				jq(ImageLoader.container).addClass('highlite')
				return false;
			},
			dragover: function(){
				return false;
			},
			dragleave: function(){
				jq(ImageLoader.container).removeClass('highlite')
				return false;
			},
			drop: function(e){
				var dt = e.originalEvent.dataTransfer;
				jq(ImageLoader.container).removeClass('highlite')
				jq.each(dt.files, function(i, file){
					ImageLoader.addFile(file);
				});
				return false;
			}
		});
		
		jq(ImageLoader.form).fileupload({
			url:	'/property/image',
			
			progress: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				jq('.uploadFile .bar').css(
					'width',
					progress + '%'
				);
			},
			add: function (e, data) {
				jq.each(data.files, function(i, file){
					if (file.type.match(/^image.*/)) {
						ImageLoader.addFile(file);
					}
				});
			}
		});

	},

	addFile: function(file){
		file.id = ImageLoader.fileList.length;
		ImageLoader.fileList[file.id] = file;
		
		window.loadImage(
			file,
			function (img) {
				var div = jq(tmpl('tmplUpload', {'file': file})).appendTo(ImageLoader.container)
				jq('.preview', div)
					.css({
						'padding': ''
							+ parseInt((ImageLoader.previewHeight - img.height) / 2) + ' '
							+ parseInt((ImageLoader.previewWidth - img.width) / 2)
					})
					.html(img);
				jq('.drop', div).click(function(){
					ImageLoader.fileList = jq.grep(ImageLoader.fileList, function(_file){
						return _file.id != file.id;
					});
					div.remove();
					ImageLoader.updateContainer();
				});
				jq('IMG', div).click(function(){
					jq('DIV.file :checkbox').removeAttr('checked');
					jq('DIV.file').removeClass('main');
					
					jq(':checkbox', div).attr('checked', 'checked');
					div.addClass('main');
				});
				
				if (jq('DIV.file :checked').size() == 0)
					jq('IMG', div).click();
				
				ImageLoader.updateContainer();
			},
			{
				maxWidth:	ImageLoader.previewWidth,
				maxHeight:	ImageLoader.previewHeight
			}
		);
	},

	updateContainer: function(){
		if (jq(ImageLoader.fileList).size() > 3) {
			jq('#fileContainer').height(420);
			
			if (jq(ImageLoader.fileList).size() > 6) {
				jq('#fileContainer').css('overflow-y', 'scroll');
			} else {
				jq('#fileContainer').css('overflow', 'hidden');
			}
		} else {
			jq('#fileContainer').animate({height: 220});
		}
	},
	
	uploadFiles: function(data, callback){
		jq(ImageLoader.form).fileupload('send', {
			files		: ImageLoader.fileList,
			formData	: data,
			success		: callback
		})
	}
//	
//	uploadFile: function(){
//		
//	}
}


jq(document).ready(function(){
	ImageLoader.init();
});
