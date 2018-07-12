const googleMaps = (function() {
  'use strict';
  let _this = {
    connect: connect,
    init: init,
    stylize: stylize
  }

  function connect(client_id) {
    document.body.appendChild(JSX.createElement(
      JSX.html('script', {
        type: 'text/javascript', defer: 'true', async: 'true',
        src:`https://maps.googleapis.com/maps/api/js?key=${ client_id }&callback=googleMaps.init`
      })
    ));
    return listenFor(whether =>{ return awake == true });
  }

  let awake = false;
  function init() {
    for (var prop in google.maps) {
      _this[prop] = google.maps[prop];
    }
    awake = true;
  }

  function stylize() {
    return styles;
  }

  let styles =[
    {
        "featureType": "administrative",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#444444"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [
            {
                "color": "#f2f2f2"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 45
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffd400"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "hue": "#ff0000"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "color": "#c2c4c4"
            },
            {
                "visibility": "on"
            }
        ]
    }
]

  return _this;

}());

export { googleMaps };
