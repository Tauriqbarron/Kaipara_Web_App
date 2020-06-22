function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -35.85020513860356, lng: 173.98469879531248},
        zoom: 10
    });

    var marker = new google.maps.Marker({
        map: map,
        position: map.center

    });
}
