@extends('layouts.app')
@section('style')
<style>


#map_wrapper {
    height: 600px;
    position:relative;
    top:0px;
}

#map_canvas {
    width: 100%;
    height: 100%;
}

</style>
@endsection

@section('content')
<div id="map_wrapper">
    <div id="map_canvas" class="mapping"></div>
</div>

@endsection

@section('scripts')

        
        <script>

jQuery(function($) {
    // Asynchronously Load the map API 
    var script = document.createElement('script');
    script.src = "https://maps.googleapis.com/maps/api/js?callback=initialize";
    document.body.appendChild(script);
});

function initialize() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        center: new google.maps.LatLng(10,75),
        zoom: 1,
        mapTypeId: 'terrain'
     // mapTypeId: 'satellite'
        // mapTypeId: 'roadmap'
      // mapTypeId: 'terrain'
    };
                    
    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    map.setTilt(45);
      
    // Multiple Markers
    var markers = [];
    var infoWindowContent = [];
    const recovery=@json($recovery);
    const consignments=@json($consignments);
    const arrest_per=@json($arrest_per);
    const ind_susp=@json($ind_susp);
    let rec_item;
   let info_content;
    @foreach($drones as $drone)
     info_content='';
  markers.push(['{{$drone->location}}',{{$drone->lat}},{{$drone->long}}]);
  rec_item = recovery.filter(val => val.drone_id == parseInt({{$drone->id}}));
  consments = consignments.filter(val => val.drone_id == parseInt({{$drone->id}}));
  arrest = arrest_per.filter(val => val.drone_id == parseInt({{$drone->id}}));
   susp = ind_susp.filter(val => val.drone_id == parseInt({{$drone->id}}));
  //console.log(consments);
  
  info_content+='<div class="info_content">' +'<h4>Basic Details</h4>' +
        '<p>{{$drone->district}}</p>' +
         '<p>{{$drone->ps}}</p>'+
         '<p>{{$drone->bop}}</p>'+
         '<p>{{$drone->location}}</p>'+
         '<p>{{$drone->time_seen}}</p>'+
         '<p>{{$drone->fly_dur}}</p>';
         if(consments.length>0)
         { info_content+='<h4>Consignments Details</h4>';
for(var i in consments){
    //console.log(consments[i]['item'];
       
       info_content+= '<p>'+consments[i]['item']+'</p>' +
         '<p>'+consments[i]['type']+'</p>'+
         '<p>'+consments[i]['qty']+'</p>';  
  }
}
  if(Object.keys(rec_item).length){
    info_content+='<h4>Recovery Details</h4>' +
        '<p>'+rec_item[0]['dor']+'</p>' +
         '<p>'+rec_item[0]['rec_agency']+'</p>'+
         '<p>'+rec_item[0]['type_drone']+'</p>'+
         '<p>'+rec_item[0]['model']+'</p>';    
          }
          if(arrest.length>0)
         { info_content+='<h4>Arrest Details</h4>';
for(var i in arrest){
    //console.log(consments[i]['item'];
       
       info_content+= '<p>'+arrest[i]['name']+'</p>' +
         '<p>'+arrest[i]['father']+'</p>'+
         '<p>'+arrest[i]['address']+'</p>'+
         '<p>'+arrest[i]['district']+'</p>';  
  }
}
 if(susp.length>0)
         { info_content+='<h4>Suspect Details</h4>';
for(var i in susp){
    //console.log(consments[i]['item'];
       
       info_content+= '<p>'+susp[i]['name']+'</p>' +
         '<p>'+susp[i]['father']+'</p>'+
         '<p>'+susp[i]['address']+'</p>'+
         '<p>'+susp[i]['district']+'</p>';  
  }
}
  infoWindowContent.push([info_content]);
    @endforeach  
    
    //const recovery=@json($recovery);
    //var recovery=JSON.parse(recovery.replace(/&quot;/g,'"'));
   //console.log(recovery);

    // Info Window Content
   
        
    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Loop through our array of markers & place each one on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0]
        });
        
        // Allow each marker to have an info window    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);

    }

    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(7);
        google.maps.event.removeListener(boundsListener);
    });
   
}
</script>
        <!-- DataTables -->
        
    
@endsection

