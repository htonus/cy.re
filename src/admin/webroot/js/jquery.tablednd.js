var hasTouch='ontouchstart'in document.documentElement,startEvent=hasTouch?'touchstart':'mousedown',moveEvent=hasTouch?'touchmove':'mousemove',endEvent=hasTouch?'touchend':'mouseup';if(hasTouch){$.each("touchstart touchmove touchend".split(" "),function(i,name){jQuery.event.fixHooks[name]=jQuery.event.mouseHooks});alert("has Touch")}jQuery.tableDnD={currentTable:null,dragObject:null,mouseOffset:null,oldY:0,build:function(options){this.each(function(){this.tableDnDConfig=jQuery.extend({onDragStyle:null,onDropStyle:null,onDragClass:"tDnD_whileDrag",onDrop:null,onDragStart:null,scrollAmount:5,serializeRegexp:/[^\-]*$/,serializeParamName:null,dragHandle:null},options||{});jQuery.tableDnD.makeDraggable(this)});return this},makeDraggable:function(table){var config=table.tableDnDConfig;if(config.dragHandle){var cells=jQuery(table.tableDnDConfig.dragHandle,table);cells.each(function(){jQuery(this).bind(startEvent,function(ev){jQuery.tableDnD.initialiseDrag(jQuery(this).parents('tr')[0],table,this,ev,config);return false})})}else{var rows=jQuery("tr",table);rows.each(function(){var row=jQuery(this);if(!row.hasClass("nodrag")){row.bind(startEvent,function(ev){if(ev.target.tagName=="TD"){jQuery.tableDnD.initialiseDrag(this,table,this,ev,config);return false}}).css("cursor","move")}})}},initialiseDrag:function(dragObject,table,target,evnt,config){jQuery.tableDnD.dragObject=dragObject;jQuery.tableDnD.currentTable=table;jQuery.tableDnD.mouseOffset=jQuery.tableDnD.getMouseOffset(target,evnt);jQuery.tableDnD.originalOrder=jQuery.tableDnD.serialize();jQuery(document).bind(moveEvent,jQuery.tableDnD.mousemove).bind(endEvent,jQuery.tableDnD.mouseup);if(config.onDragStart){config.onDragStart(table,target)}},updateTables:function(){this.each(function(){if(this.tableDnDConfig){jQuery.tableDnD.makeDraggable(this)}})},mouseCoords:function(ev){if(ev.pageX||ev.pageY){return{x:ev.pageX,y:ev.pageY}}return{x:ev.clientX+document.body.scrollLeft-document.body.clientLeft,y:ev.clientY+document.body.scrollTop-document.body.clientTop}},getMouseOffset:function(target,ev){ev=ev||window.event;var docPos=this.getPosition(target);var mousePos=this.mouseCoords(ev);return{x:mousePos.x-docPos.x,y:mousePos.y-docPos.y}},getPosition:function(e){var left=0;var top=0;if(e.offsetHeight==0){e=e.firstChild}while(e.offsetParent){left+=e.offsetLeft;top+=e.offsetTop;e=e.offsetParent}left+=e.offsetLeft;top+=e.offsetTop;return{x:left,y:top}},mousemove:function(ev){if(jQuery.tableDnD.dragObject==null){return}if(ev.type=='touchmove'){event.preventDefault()}var dragObj=jQuery(jQuery.tableDnD.dragObject);var config=jQuery.tableDnD.currentTable.tableDnDConfig;var mousePos=jQuery.tableDnD.mouseCoords(ev);var y=mousePos.y-jQuery.tableDnD.mouseOffset.y;var yOffset=window.pageYOffset;if(document.all){if(typeof document.compatMode!='undefined'&&document.compatMode!='BackCompat'){yOffset=document.documentElement.scrollTop}else if(typeof document.body!='undefined'){yOffset=document.body.scrollTop}}if(mousePos.y-yOffset<config.scrollAmount){window.scrollBy(0,-config.scrollAmount)}else{var windowHeight=window.innerHeight?window.innerHeight:document.documentElement.clientHeight?document.documentElement.clientHeight:document.body.clientHeight;if(windowHeight-(mousePos.y-yOffset)<config.scrollAmount){window.scrollBy(0,config.scrollAmount)}}if(y!=jQuery.tableDnD.oldY){var movingDown=y>jQuery.tableDnD.oldY;jQuery.tableDnD.oldY=y;if(config.onDragClass){dragObj.addClass(config.onDragClass)}else{dragObj.css(config.onDragStyle)}var currentRow=jQuery.tableDnD.findDropTargetRow(dragObj,y);if(currentRow){if(movingDown&&jQuery.tableDnD.dragObject!=currentRow){jQuery.tableDnD.dragObject.parentNode.insertBefore(jQuery.tableDnD.dragObject,currentRow.nextSibling)}else if(!movingDown&&jQuery.tableDnD.dragObject!=currentRow){jQuery.tableDnD.dragObject.parentNode.insertBefore(jQuery.tableDnD.dragObject,currentRow)}}}return false},findDropTargetRow:function(draggedRow,y){var rows=jQuery.tableDnD.currentTable.rows;for(var i=0;i<rows.length;i++){var row=rows[i];var rowY=this.getPosition(row).y;var rowHeight=parseInt(row.offsetHeight)/2;if(row.offsetHeight==0){rowY=this.getPosition(row.firstChild).y;rowHeight=parseInt(row.firstChild.offsetHeight)/2}if((y>rowY-rowHeight)&&(y<(rowY+rowHeight))){if(row==draggedRow){return null}var config=jQuery.tableDnD.currentTable.tableDnDConfig;if(config.onAllowDrop){if(config.onAllowDrop(draggedRow,row)){return row}else{return null}}else{var nodrop=jQuery(row).hasClass("nodrop");if(!nodrop){return row}else{return null}}return row}}return null},mouseup:function(e){if(jQuery.tableDnD.currentTable&&jQuery.tableDnD.dragObject){jQuery(document).unbind(moveEvent,jQuery.tableDnD.mousemove).unbind(endEvent,jQuery.tableDnD.mouseup);var droppedRow=jQuery.tableDnD.dragObject;var config=jQuery.tableDnD.currentTable.tableDnDConfig;if(config.onDragClass){jQuery(droppedRow).removeClass(config.onDragClass)}else{jQuery(droppedRow).css(config.onDropStyle)}jQuery.tableDnD.dragObject=null;var newOrder=jQuery.tableDnD.serialize();if(config.onDrop&&(jQuery.tableDnD.originalOrder!=newOrder)){config.onDrop(jQuery.tableDnD.currentTable,droppedRow)}jQuery.tableDnD.currentTable=null}},serialize:function(){if(jQuery.tableDnD.currentTable){return jQuery.tableDnD.serializeTable(jQuery.tableDnD.currentTable)}else{return"Error: No Table id set, you need to set an id on your table and every row"}},serializeTable:function(table){var result="";var tableId=table.id;var rows=table.rows;for(var i=0;i<rows.length;i++){if(result.length>0)result+="&";var rowId=rows[i].id;if(rowId&&rowId&&table.tableDnDConfig&&table.tableDnDConfig.serializeRegexp){rowId=rowId.match(table.tableDnDConfig.serializeRegexp)[0]}result+=tableId+'[]='+rowId}return result},serializeTables:function(){var result="";this.each(function(){result+=jQuery.tableDnD.serializeTable(this)});return result}};jQuery.fn.extend({tableDnD:jQuery.tableDnD.build,tableDnDUpdate:jQuery.tableDnD.updateTables,tableDnDSerialize:jQuery.tableDnD.serializeTables});
