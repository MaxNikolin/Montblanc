		//set up markers 
		var myMarkers = {"markers": [
				{"latitude": "53.902052", "longitude":"27.549225", "icon": "img/map-marker.png"}
			]
		};

		//set up map options
		$("#map_contact").mapmarker({
			zoom	: 14,
			center	: 'Metropol Shopping Mall, Ulitsa Nemiga 5, Minsk',
			markers	: myMarkers
		});

