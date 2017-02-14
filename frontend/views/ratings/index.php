<?php
/* @var $this yii\web\View */
$this->registerCss('#map {
            width: 500px;
            height: 400px;
        }');
?>

<!-- -1.946863, 30.056957-->
<div id="map"></div>
<script>
    function initMap() {
        var mapDiv = document.getElementById('map');
        var map = new google.maps.Map(mapDiv, {
            center: {lat:  -1.946863, lng: 30.056957},
            zoom: 13
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>

