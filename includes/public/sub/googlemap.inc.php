<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDCNEmhVBqcD83ivAW5Yol485UGOP3f-9o"></script>
<script>
function initialize()
{
    var name = '<?php echo $row['name']; ?>';
    var myLatlng = new google.maps.LatLng(<?php echo $lat; ?>,<?php echo $lng ?>);
    var mapOptions =
    {
        center: myLatlng,
        zoom:15,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
    var marker = new google.maps.Marker(
    {
        position: myLatlng,
        map: map,
        title: name
    });
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
<div id="googleMap" style="width:40em;height:40em;"></div>
