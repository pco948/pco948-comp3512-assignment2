<?php
?>
    
	<div id="map" style="height: 400px;width: 100%;"></div>
	<script>
	     function initMap() {
	       var longitude = parseFloat("<?php echo $row['Longitude']; ?>");
	       var latitude = parseFloat("<?php echo $row['Latitude']; ?>");
	       var uluru = {lat: latitude, lng: longitude};
	       var map = new google.maps.Map(document.getElementById('map'), {
	         zoom: 15,
	         center: uluru
	       });
	       var marker = new google.maps.Marker({
	         position: uluru,
	         map: map
	       });
	     }
	</script> 
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDI4Ta_AFOe0pKFPQ6_FSFw_CVCd_SWBtY&callback=initMap">
	</script>