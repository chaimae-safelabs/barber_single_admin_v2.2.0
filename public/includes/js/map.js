$(document).ready(function (){
    setTimeout(() => {
        if(document.getElementById("location_map"))
        {
            $lat = $('.form #lat').val();
            $long = $('.form #long').val();
    
            var latlng = new google.maps.LatLng($lat, $long);
            var mapOptions = {
            zoom: 10,
            center: latlng
            }
    
            location_map = new google.maps.Map(document.getElementById('location_map'), mapOptions);
    
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng($lat, $long),
                map: location_map,
                draggable: true
            });
    
            google.maps.event.addListener(marker, 'dragend', function(evt){
                $('.form #lat').val(evt.latLng.lat());
                $('.form #long').val(evt.latLng.lng());
            });
        }
    }, 3000);
});