
let map;
let geocoder;
let marker;

function initMap() {
  map = new google.maps.Map(document.getElementById('mapa'), {
    center: { lat: -12.0451147, lng: -77.0457363 },
    zoom: 15
  });

  geocoder = new google.maps.Geocoder();

  const input = document.getElementById('autocomplete');
  const autocomplete = new google.maps.places.Autocomplete(input);

  autocomplete.addListener('place_changed', function () {
    const place = autocomplete.getPlace();
    if (!place.geometry) {
      console.error("Place details not found for the input: '" + place.name + "'");
      return;
    }

    document.getElementById('sitemap_lat').value = place.geometry.location.lat();
    document.getElementById('sitemap_lng').value = place.geometry.location.lng();

    // Remove existing marker if present
    if (marker) {
      marker.setMap(null);
    }

    marker = new google.maps.Marker({
      position: place.geometry.location,
      draggable: true,
      map: map
    });

    showLocationOnMap(place.geometry.location);
  });

  // Add marker on the map when the page loads at default coordinates
  const defaultLocation = new google.maps.LatLng(-12.0451147, -77.0457363);
  marker = new google.maps.Marker({
    position: defaultLocation,
    draggable: true,
    map: map
  });
  showLocationOnMap(defaultLocation);

  // Set default coordinates in the input fields
  document.getElementById('sitemap_lat').value = defaultLocation.lat();
  document.getElementById('sitemap_lng').value = defaultLocation.lng();

  marker.addListener('dragend', function(e){
    document.getElementById('sitemap_lat').value = this.getPosition().lat();
    document.getElementById('sitemap_lng').value = this.getPosition().lng();
  });
}

function showLocationOnMap(location) {
  map.setCenter(location);
}