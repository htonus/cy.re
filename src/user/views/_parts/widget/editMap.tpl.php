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

jq(document).ready(function(){
	jq('#setLocation').click(function(){
		var rectangleOpts = {
				editable		: true
			,	clickable		: true
			,	draggable		: true
			,	fillColor		: '#0C0'
			,	fillOpacity		: 0.2
			,	strokeColor		: '#090'
			,	strokeOpacity	: 0.5
			,	strokeWeight	: 2
			};
		var circleOpts = {
				clickable		: true
			,	editable		: true
			,	draggable		: true
			,	fillColor		: '#0C0'
			,	fillOpacity		: 0.2
			,	strokeOpacity	: 0.5
			,	strokeWeight	: 2
		}
		var mapOptions = {
				mapTypeId	: google.maps.MapTypeId.ROADMAP
		};
		var center = cyprus;

		jq('#locationModal')
			.modal('show')
			.on('hidden', function(){
				jq('#googleMap').html('');
				circle = rectangle = null;
			})
			.on('shown', function(){

			var map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
			map.panTo(center);
			map.setZoom(mapZoom);

			var drawingManager = new google.maps.drawing.DrawingManager({
				drawingMode: null //google.maps.drawing.OverlayType.MARKER,
			,	circleOptions: circleOpts
			,	rectangleOptions: rectangleOpts
			,	drawingControl: true
			,	drawingControlOptions: {
					position: google.maps.ControlPosition.TOP_CENTER,
					drawingModes: [
						google.maps.drawing.OverlayType.CIRCLE
					,	google.maps.drawing.OverlayType.RECTANGLE
					]
				}
			});

			drawingManager.setMap(map);
			
			var setCircleEvents = function()
			{
				google.maps.event.addListener(circle, 'center_changed', function(){
					storeLocation(map, google.maps.drawing.OverlayType.CIRCLE);
				});
				google.maps.event.addListener(circle, 'radius_changed', function(){
					storeLocation(map, google.maps.drawing.OverlayType.CIRCLE);
				});
				google.maps.event.addListener(circle, 'dragstart', function(){
					google.maps.event.clearListeners(circle, 'center_changed');
				});
				google.maps.event.addListener(circle, 'dragend', function(){
					storeLocation(map, google.maps.drawing.OverlayType.CIRCLE);
					google.maps.event.addListener(circle, 'center_changed', function(){
						storeLocation(map, google.maps.drawing.OverlayType.CIRCLE);
					});
				});
			}
			var setRectangleEvents = function()
			{
				google.maps.event.addListener(rectangle, 'bounds_changed', function(){
					storeLocation(map, google.maps.drawing.OverlayType.RECTANGLE);
				});
				google.maps.event.addListener(rectangle, 'dragstart', function(){
					google.maps.event.clearListeners(rectangle, 'bounds_changed');
				});
				google.maps.event.addListener(rectangle, 'dragend', function(){
					storeLocation(map, google.maps.drawing.OverlayType.RECTANGLE);
					google.maps.event.addListener(rectangle, 'bounds_changed', function(){
						storeLocation(map, google.maps.drawing.OverlayType.RECTANGLE);
					});
				});
			}
			
			var circlecomplete = function(newCircle){
				drawingManager.setDrawingMode(null);

				if (rectangle) {
					rectangle.setMap(null);
					delete rectangle;
				}

				if (circle) {
					circle.setMap(null);
				}

				circle = newCircle;
				setCircleEvents();
				storeLocation(map, google.maps.drawing.OverlayType.CIRCLE);

				map.panTo(circle.getCenter());
				map.setZoom(getZoomByBounds(map, circle.getBounds()));
				jq('#setLocation SPAN').removeClass('icon-stop').addClass('icon-play-circle');
			};

			var rectanglecomplete = function(newRectangle) {
				drawingManager.setDrawingMode(null);

				if (circle) {
					circle.setMap(null);
					delete circle;
				}

				if (rectangle)
					rectangle.setMap(null);

				rectangle = newRectangle;
				setRectangleEvents();
				storeLocation(map, google.maps.drawing.OverlayType.RECTANGLE);

				map.panTo(rectangle.getBounds().getCenter());
				map.setZoom(getZoomByBounds(map, rectangle.getBounds()));
				jq('#setLocation SPAN').removeClass('icon-play-circle').addClass('icon-stop');
			}

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
						map.setZoom(getZoomByBounds(map, circle.getBounds()));
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
						map.setZoom(getZoomByBounds(map, bounds));
						setRectangleEvents();
						break;
				}
			}
			
			// Marker drawing finished
			google.maps.event.addListener(drawingManager, 'circlecomplete', circlecomplete);

			// Polygon drawing finished
			google.maps.event.addListener(drawingManager, 'rectanglecomplete', rectanglecomplete);

		});
	});
});

var clearMap = function () {
	jq('#input_location').val('');
	jq('#setLocation SPAN').removeClass('icon-stop').removeClass('icon-play-circle');
	
	if (circle)
		circle.setMap(null);
	if (rectangle)
		rectangle.setMap(null);
	
	delete circle;
	delete rectangle;
}
function getZoomByBounds (map, bounds) {
	var
		MAX_ZOOM = map.mapTypes.get( map.getMapTypeId() ).maxZoom || 21,
		MIN_ZOOM = map.mapTypes.get( map.getMapTypeId() ).minZoom || 0,
		ne = map.getProjection().fromLatLngToPoint(bounds.getNorthEast()),
		sw = map.getProjection().fromLatLngToPoint(bounds.getSouthWest()),
		worldCoordWidth = Math.abs(ne.x - sw.x),
		worldCoordHeight = Math.abs(ne.y - sw.y),
		mapWidth = jq(map.getDiv()).width(),
		mapHeight = jq(map.getDiv()).height();
		FIT_PAD = 40;	//Fit padding in pixels

	for (var zoom = MAX_ZOOM; zoom >= MIN_ZOOM; --zoom) {
		if (
			worldCoordWidth * (1 << zoom) + 2 * FIT_PAD < mapWidth
			&& worldCoordHeight * (1 << zoom) + 2 * FIT_PAD < mapHeight
		)
			return zoom;
	}
	return 0;
}
function storeLocation(map, type)
{
	var object = rectangle || circle;

	switch(type) {
		case google.maps.drawing.OverlayType.RECTANGLE:
			var bounds = rectangle.getBounds();

			jq('#input_location').val(JSON.stringify({
				type	: google.maps.drawing.OverlayType.RECTANGLE
			,	left	: [bounds.getSouthWest().lat(), bounds.getSouthWest().lng()]
			,	right	: [bounds.getNorthEast().lat(), bounds.getNorthEast().lng()]
			}).replace(/\"/g, "'"));
			break;
		case google.maps.drawing.OverlayType.CIRCLE:
			jq('#input_location').val(JSON.stringify({
				type	: google.maps.drawing.OverlayType.CIRCLE
			,	center	: [circle.getCenter().lat(), circle.getCenter().lng()]
			,	radius	: circle.getRadius()
			}).replace(/\"/g, "'"));
			break;
		default:
			jq('#input_location').val('');
			break;
	}

	map.setZoom(getZoomByBounds(map, object.getBounds()));
	map.panTo(object.getBounds().getCenter());
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