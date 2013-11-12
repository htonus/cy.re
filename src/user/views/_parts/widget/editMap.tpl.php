					<div class="row-fluid">
						<div class="span12">
							<div class="control-group">
								<div class="controls">
									<input type="hidden" id="input_location" name="location" value="<?= empty($location) ? null : $location ?>" />
									<button type="button" id="setLocation" class="btn input-block-level"><span class=""></span> Choose area on map</button>
								</div>
							</div>
						</div>
					</div>


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&libraries=drawing"></script>
<script type="text/javascript">
var mapZoom = 8;
var cyprus = new google.maps.LatLng(35.106428, 33.305054);
var rectangle= null;
var circle = null;

var rectangleOpts = {
		editable: true
	,	fillColor: '#0C0'
	,	fillOpacity: 0.2
	,	strokeColor: '#090'
	,	strokeOpacity: 0.5
	,	strokeWeight: 2
	};
var circleOpts = {
		fillColor: '#0C0'
	,	fillOpacity: 0.2
	,	strokeWeight: 2
	,	clickable: false
	,	editable: true
	,	zIndex: 10
}
var mapOptions = {
		mapTypeId	: google.maps.MapTypeId.ROADMAP
};

jq(document).ready(function(){
	jq('#setLocation').click(function(){
		var center = cyprus;

		jq('#locationModal')
			.modal('show')
			.on('hidden', function(){
				jq('#googleMap').html('');
			})
			.on('shown', function(){

			var map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
			map.panTo(center);
			map.setZoom(mapZoom);

			var drawingManager = new google.maps.drawing.DrawingManager({
				drawingMode: null //google.maps.drawing.OverlayType.MARKER,
			,	drawingControl: true
			,	drawingControlOptions: {
					position: google.maps.ControlPosition.TOP_CENTER,
					drawingModes: [
						google.maps.drawing.OverlayType.CIRCLE
					,	google.maps.drawing.OverlayType.RECTANGLE
					]
				}
			,	circleOptions: circleOpts
			,	rectangleOptions: rectangleOpts
			});

			drawingManager.setMap(map);

			if (jq('#input_location').val().length > 0) {
				var shape = JSON.parse(jq('#input_location').val().replace(/\'/g, '"'));

				switch(shape.type) {
					case google.maps.drawing.OverlayType.CIRCLE:
						center = new google.maps.LatLng(shape.center[0], shape.center[1]);
						circle = new google.maps.Circle(circleOpts);
						circle.setCenter(center);
						circle.setRadius(shape.radius);
						circle.setMap(map);
						map.panTo(center);
						break;
					case google.maps.drawing.OverlayType.RECTANGLE:
						var bounds = new google.maps.LatLngBounds(
							new google.maps.LatLng(shape.left[0], shape.left[1]),
							new google.maps.LatLng(shape.right[0], shape.right[1])
						);
						rectangle = new google.maps.Rectangle(rectangleOpts);
						rectangle.setBounds(bounds);
						rectangle.setMap(map);
						map.panTo(bounds.getCenter());
						break;
				}
			}


			var circlecomplete = function(newCircle){
				drawingManager.setDrawingMode(null);

				if (circle) {
					circle.setMap(null);
				}

				circle = newCircle;
				map.panTo(circle.getCenter());
				jq('#input_location').val(JSON.stringify({
					type	: google.maps.drawing.OverlayType.CIRCLE
				,	center	: [circle.getCenter().lat(), circle.getCenter().lng()]
				,	radius	: circle.getRadius()
				}).replace(/\"/g, "'"));
				
				google.maps.event.addListener(circle, 'click', function(e) {
					alert(1);
					circle.setMap(null);
					circle = null;
				});
				
				jq('#setLocation SPAN').removeClass('icon-stop').addClass('icon-play-circle');
			};
			var rectanglecomplete = function(newRectangle) {
				drawingManager.setDrawingMode(null);

				if (rectangle) {
					rectangle.setMap(null);
				}

				rectangle = newRectangle;
				var bounds = rectangle.getBounds();
				map.panTo(bounds.getCenter());
				jq('#input_location').val(JSON.stringify({
					type	: google.maps.drawing.OverlayType.RECTANGLE
				,	left	: [bounds.getSouthWest().lat(), bounds.getSouthWest().lng()]
				,	right	: [bounds.getNorthEast().lat(), bounds.getNorthEast().lng()]
				}).replace(/\"/g, "'"));

				jq('#setLocation SPAN').removeClass('icon-play-circle').addClass('icon-stop');
			}

			// Marker drawing finished
			google.maps.event.addListener(drawingManager, 'circlecomplete', circlecomplete);

			// Polygon drawing finished
			google.maps.event.addListener(drawingManager, 'rectanglecomplete', rectanglecomplete);
		});
	});
});

function clearMap()
{
	if (circle)
		circle.setMap(null);
	if (rectangle)
		rectangle.setMap(null);

	jq('#setLocation SPAN').removeClass('icon-stop').removeClass('icon-play-circle');
	jq('#input_location').val('');
}
</script>


<div class="modal hide fade" id="locationModal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Modal header</h3>
	</div>
	<div class="modal-body">
		<div id="googleMap" style="width: 100%; height: 400px;"></div>
	</div>
	<div class="modal-footer">
		<a href="#" onclick="clearMap()" class="btn btn-danger">Clear map</a>
		<a href="#" data-dismiss="modal" data-dismiss="modal" class="btn">Close</a>
	</div>
</div>