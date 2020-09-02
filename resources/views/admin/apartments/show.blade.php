@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Dettagli appartamento</h1>
        </div>
        <div class="col-md-12">
        <p class="indirizzoprova">{{$apartment->address}}</p>
        <div id="map-example-container"></div>
<input type="search" id="input-map" class="form-control" placeholder="Where are we going?" />

<style>
  #map-example-container {height: 300px};
</style>

<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
<script>
(function() {
    var latlng = {
    lat: 41.8948,
    lng: 12.4853
  };

  var placesAutocomplete = places({
    appId: 'plQJ0AF39XJK',
    apiKey: '5c9f0d58aab1f0a7cb9f847a8786b412',
    container: document.querySelector('#input-map')
  }).configure({
    aroundLatLng: latlng.lat + ',' + latlng.lng, // Paris latitude longitude
    aroundRadius: 10 * 1000, // 10km radius
    type: 'address'
  });

  var map = L.map('map-example-container', {
    scrollWheelZoom: false,
    zoomControl: false
  });

  var osmLayer = new L.TileLayer(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      minZoom: 1,
      maxZoom: 13,
      attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
    }
  );

  var markers = [];

  map.setView(new L.LatLng(0, 0), 1);
  map.addLayer(osmLayer);

  placesAutocomplete.on('suggestions', handleOnSuggestions);
  placesAutocomplete.on('cursorchanged', handleOnCursorchanged);
  placesAutocomplete.on('change', handleOnChange);
  placesAutocomplete.on('clear', handleOnClear);

  function handleOnSuggestions(e) {
    markers.forEach(removeMarker);
    markers = [];

    if (e.suggestions.length === 0) {
      map.setView(new L.LatLng(0, 0), 1);
      return;
    }

    e.suggestions.forEach(addMarker);
    findBestZoom();
  }

  function handleOnChange(e) {
    markers
      .forEach(function(marker, markerIndex) {
        if (markerIndex === e.suggestionIndex) {
          markers = [marker];
          marker.setOpacity(1);
          findBestZoom();
        } else {
          removeMarker(marker);
        }
      });
  }

  function handleOnClear() {
    map.setView(new L.LatLng(0, 0), 1);
    markers.forEach(removeMarker);
  }

  function handleOnCursorchanged(e) {
    markers
      .forEach(function(marker, markerIndex) {
        if (markerIndex === e.suggestionIndex) {
          marker.setOpacity(1);
          marker.setZIndexOffset(1000);
        } else {
          marker.setZIndexOffset(0);
          marker.setOpacity(0.5);
        }
      });
  }

  function addMarker(suggestion) {
    var marker = L.marker(suggestion.latlng, {opacity: .4});
    marker.addTo(map);
    markers.push(marker);
  }

  function removeMarker(marker) {
    map.removeLayer(marker);
  }

  function findBestZoom() {
    var featureGroup = L.featureGroup(markers);
    map.fitBounds(featureGroup.getBounds().pad(0.5), {animate: false});
  }
})();
</script>
        </div>
    </div>
</div>
@endsection
