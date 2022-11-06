@extends('layouts.app')

@section('style')
<style>
.error{
  color:red;
}
</style>
@endsection

@section('content')
<link href="{{ asset('css/multi_step.css') }}" rel="stylesheet">
@if(count($errors))

	<div class="alert alert-danger">

		<strong>Whoops!</strong> There were some problems with your input.

		<br/>

		<ul>

			@foreach($errors->all() as $error)

			<li>{{ $error }}</li>

			@endforeach

		</ul>

	</div>

@endif
<div class="multisteps-form">
  <!--progress bar-->
  <div class="row">
    <div class="col-12 col-lg-8 ml-auto mr-auto mb-4">
      <div class="multisteps-form__progress">
        <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">Drone Details</button>
        <button class="multisteps-form__progress-btn" type="button" title="Address">Location Remarks</button>
      </div>
    </div>
  </div>
  <!--form panels-->
  <div class="row">
    <div class="col-12 col-lg-8 m-auto">
      <form class="multisteps-form__form" method="POST" action="{{ route('drones.store') }}" id="form">
      @csrf
        <!--single form panel-->
        <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="scaleIn">
          <div class="multisteps-form__content">
      
  
  <div class="form-row">
  <div class="form-group col-md-4">
    <label for="district">District</label> 
    <div>
      <select id="district" name="district" class="custom-select">
        <option value="">Select District</option>
      </select>
    </div>
  </div>
  <div class="form-group col-md-4">
    <label for="ps">Police Station</label> 
    <div>
      <select id="ps" name="ps" class="custom-select">
        <option value="">Select PS</option>
      </select>
    </div>
  </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-3">
    <label for="ps">BOP</label> 
   <div>
      <select id="bop_rec" name="bop_rec" class="custom-select">
        <option value="">Select BOP</option>
      </select>
    </div>
  </div>
  <div class="form-group col-md-3">
    <label for="vill">Village</label> 
   <div>
      <input id="vill" name="vill" type="text" class="form-control">
    </div>
  </div>
</div>
  <div class="form-row">
  <div class="form-group col-md-4">
  
    <label for="location">Location of sight</label>
     
    <input id="location" name="location" type="text" class="form-control">
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-4">
  
    <label for="lat">Latitude</label>
     
    <input id="lat" name="lat" type="text" class="form-control">
    </div>
    <div class="form-group col-md-4">
  
    <label for="long">Longitude</label>
     
    <input id="long" name="long" type="text" class="form-control">
    </div>
  </div>
  <div class="form-row">
        <div class="col-sm-4">
        <label>Date and Time of Sight</label> 
            <div class="form-group">
                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                    <input type="text" name="time_seen" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script>
</div>
  <div class="form-row">
    <label>Duration of flying within Indian territory</label> 
    <div class="col-sm-2">
    <input id="hours" name="hours" type="number" class="form-control" placeholder="Hours">
    </div>
    <div class="col-sm-2">
    <input id="minutes" name="minutes" type="number" class="form-control" placeholder="Min">
    </div>
    <div class="col-sm-2">
    <input id="seconds" name="seconds" type="number" class="form-control" placeholder="Sec">
    </div>
  </div>
  <br>
  <div class="form-row">
  <label for="dist_pen">Distance Penetrated into Indian territory</label> 
  <div class="col-sm-2">
    <input id="dist_pen" name="dist_pen" type="number" class="form-control">
  </div>
  <div class="col-sm-2">
    <select name="unit_dis"  class="form-control"><option value="">unit</option><option value="km">km</option><option value="m">m</option></select>
  </div>
  </div>
  <div style="display:none" class="form-group">
    <label for="textarea">Action Taken</label> 
    <textarea id="textarea" name="action" cols="40" rows="5" class="form-control"></textarea>
  </div> 
<br>
 <div class="form-row">
  <label for="cons_dropped">Consignment Dropped</label>
      <div class="col-md-6">  
 <div class="form-check form-check-inline">
   <input class="form-check-input" type="radio" name="cons_dropped" value="Yes">
   <label class="form-check-label">
   Yes
   </label>
</div>
<div class="form-check form-check-inline">
   <input class="form-check-input" type="radio" name="cons_dropped" value="No" checked>
   <label class="form-check-label">
   No
   </label>
</div>
  </div>
</div>
<br>
<div id="cons_container" style="display:none">

  <div class="form-row">
  <div class="form-group col-md-4">
  
    <label for="indian_vill">Consignment Type</label>
    <div class="input-group mb-3">
   <select id="cons_type" name="cons_type[]" class="custom-select">
        <option value="">Select Type</option>
      </select>
    </div>
    </div>
    
  <div class="form-group col-md-2">
  
    <label for="cons_item">Item</label> 
    <div>
    <select id="cons_item" name="cons_item[]" class="custom-select">
      <option value="">Select Item</option>
    </select>
  </div>
    </div>
  <div class="form-group col-md-2">
  
    <label for="cons_qty">Quantity</label> 
    <div class="input-group mb-3">
    <input name="cons_qty[]" type="number" class="form-control">
    <div class="input-group-append">
    <button type="button" id="cons_add" class="btn btn-primary">Add</button>
    </div>
    </div>
  </div>
  </div>
    <div class="drone_cons-wrap">
      </div>
  </div>

 <div class="form-row">
  <label for="rec_radio">Drone Recovery</label>
      <div class="col-md-6">  
 <div class="form-check form-check-inline">
   <input class="form-check-input" type="radio" name="rec_radio" value="Yes">
   <label class="form-check-label">
   Yes
   </label>
</div>
<div class="form-check form-check-inline">
   <input class="form-check-input" type="radio" name="rec_radio" value="No" checked>
   <label class="form-check-label">
   No
   </label>
</div>
  </div>
</div>
<br>
<div id="recovery_made" style="display:none;">
<div class="form-row">
  <div class="form-group col-md-2">
    <label for="date_rec">Date of Recovery</label> 
    <div>
       <input id="date_rec" name="date_rec" type="date" class="form-control">
    </div>
  </div>


   <div class="form-group col-md-3">
    <label for="agency_rec">Recovery Agency</label> 
   <div>
      <select id="agency_rec" name="agency_rec" class="custom-select">
        <option value="">Select Agency</option>
        <option value="NCB">NCB</option>
        <option value="BSF">BSF</option>
        <option value="Punjab Police">Punjab Police</option>
      </select>
    </div>
  </div>
  </div>



  

<br>
 <div class="form-row">
  <label for="forensic_radio">Drone Forensics Done</label>
      <div class="col-md-6">  
 <div class="form-check form-check-inline">
   <input class="form-check-input" type="radio" name="forensic_radio" value="Yes">
   <label class="form-check-label">
   Yes
   </label>
</div>
<div class="form-check form-check-inline">
   <input class="form-check-input" type="radio" name="forensic_radio" value="No" checked>
   <label class="form-check-label">
   No
   </label>
</div>
  </div>
</div>
<br>
<div id="forensic_container" style="display:none">
<div class="form-row">
  <div class="form-group col-md-3">
    <label for="type_drone">Type of Drone</label> 
   <div>
      <select id="type_drone" name="type_drone" class="custom-select">
        <option value="">Select Drone Type</option>
        <option value="Hexa">Hexa</option>
        <option value="Quad">Quad</option>
        <option value="Tetra">Tetra</option>
      </select>
    </div>
  </div>

   <div class="form-group col-md-3">
    <label for="model_drone">Model</label> 
   <div>
      <select id="model_drone" name="model_drone" class="custom-select">
        <option value="">Select Drone Model</option>
        <option value="DJI Inspire 2">DJI Inspire 2</option>
        <option value="DJI Matrice 600 Pro">DJI Matrice 600 Pro</option>
        <option value="DJI Phantom 4 Pro">DJI Phantom 4 Pro</option>
        <option value="DJI Phantom 4">DJI Phantom 4</option>
      </select>
    </div>
  </div>
  </div>
<br>
<div class="form-row">
  <label for="payload">Payload Capacity</label> 
  <div class="col-sm-2">
    <input id="payload" name="payload" type="number" class="form-control">
  </div>
  <div class="col-sm-2">
    <select name="unit_payload"  class="form-control"><option value="">unit</option><option value="kg">kg</option><option value="gm">gm</option></select>
  </div>
  </div>
<br>
<div class="form-row">
  <label for="max_speed">Maximum Speed</label> 
  <div class="col-sm-2">
    <input id="max_speed" name="max_speed" type="number" class="form-control">
  </div>
  <div class="col-sm-2">
    <select name="unit_speed"  class="form-control"><option value="">unit</option><option value="km/hr">km/hr</option><option value="miles/hr">miles/hr</option></select>
  </div>
  </div>
<br>
<div class="form-row">
  <label for="flight_time">Flight Time</label> 
  <div class="col-sm-2">
    <input id="flight_time" name="flight_time" type="number" class="form-control">
  </div>
  <div class="col-sm-2">
    <select name="unit_ft"  class="form-control"><option value="">unit</option><option value="min">min</option><option value="hr">hr</option></select>
  </div>
  </div>
  <br>
<div class="form-row">
  <label for="onewaydis">One Way Distance</label> 
  <div class="col-sm-2">
    <input id="onewaydis" name="onewaydis" type="number" class="form-control">
  </div>
  <div class="col-sm-2">
    <select name="unit_onewaydis"  class="form-control"><option value="">unit</option><option value="km">km</option><option value="m">m</option></select>
  </div>
  </div>

  <br>
  </div>
</div>
        </div>
      </div>
        <!--single form panel-->
        <!--single form panel-->
       
        <!--single form panel-->
        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
       <!--   <h3 class="multisteps-form__title">Additional Comments</h3> -->
          <div class="multisteps-form__content">
         
          <div class="form-row">
  <div class="form-group col-md-4">
  
    <label for="bsf_drone">BSF Posts near drone area</label>
    <div class="input-group mb-3">
    <input name="bsf_drone[]" type="text" class="form-control">
    <div class="input-group-append">
    <button type="button" id="bsf_add" class="btn btn-primary">Add</button>
    </div>
    </div>
    <div class="bsf-wrap">
      </div>
    </div>
  </div>

  <div class="form-row">
  <div class="form-group col-md-4">
  
    <label for="indian_bops">Nearby Indian BOP's</label>
    <div class="input-group mb-3">
    <input name="indian_bops[]" type="text" class="form-control">
    <div class="input-group-append">
    <button type="button" id="ind_bop" class="btn btn-primary">Add</button>
    </div>
    </div>
    <div class="ind_bop-wrap">
      </div>
    </div>
  </div>

  <div class="form-row">
  <div class="form-group col-md-4">
  
    <label for="pak_bops">Opposite Pak BOP's</label>
    <div class="input-group mb-3">
    <input name="pak_bops[]" type="text" class="form-control">
    <div class="input-group-append">
    <button type="button" id="pak_bop" class="btn btn-primary">Add</button>
    </div>
    </div>
    <div class="pak_bop-wrap">
      </div>
    </div>
  </div>

  <div class="form-row">
  <div class="form-group col-md-4">
  
    <label for="indian_vill">Indian villages nearby IB</label>
    <div class="input-group mb-3">
    <input name="indian_vill[]" type="text" class="form-control">
    </div>
    </div>
    
  <div class="form-group col-md-2">
  
    <label for="indianvill_dist">Distance from IB</label>
    <div class="input-group mb-3">
    <input name="indianvill_dist[]" type="number" class="form-control">
    </div>
    </div>
  
    <div class="form-group col-md-2">
  
  <label for="indianvill_unit">Unit</label>
  <div class="input-group mb-3">
  <select name="indianvill_unit[]" class="custom-select"><option value="km">km</option><option value="m">m</option></select>
  <div class="input-group-append">
    <button type="button" id="ind_vill" class="btn btn-primary">Add</button>
    </div>
  </div>
  
  </div>
  </div>
    <div class="ind_vill-wrap">
      </div>
   

   
  <div class="form-row">
  <div class="form-group col-md-4">
  
    <label for="pak_vill">Pakistan villages nearby IB</label>
    <div class="input-group mb-3">
    <input name="pak_vill[]" type="text" class="form-control">
    </div>
    </div>
    
  <div class="form-group col-md-2">
  
    <label for="pakvill_dist">Distance from IB</label>
    <div class="input-group mb-3">
    <input name="pakvill_dist[]" type="number" class="form-control">
    </div>
    </div>
  
    <div class="form-group col-md-2">
  
  <label for="pakvill_unit">Unit</label>
  <div class="input-group mb-3">
  <select name="pakvill_unit[]" class="custom-select"><option value="km">km</option><option value="m">m</option></select>
  <div class="input-group-append">
    <button type="button" id="pak_vill" class="btn btn-primary">Add</button>
    </div>
  </div>
  
  </div>
  </div>
    <div class="pak_vill-wrap">
      </div>

      <h4><strong>Persons Arrested near Drone Location</strong></h4>
      <div class="form-row">
  <div class="form-group col-md-2">
  
    <label for="perarr_name">Name</label>
    <div class="input-group mb-3">
    <input name="perarr_name[]" type="text" class="form-control" placeholder="Name">
    </div>
    </div>
    
  <div class="form-group col-md-2">
  
    <label for="perarr_so">S/O</label>
    <div class="input-group mb-3">
    <input name="perarr_so[]" type="text" class="form-control">
    </div>
    </div>
  
    <div class="form-group col-md-3">
  
  <label for="perarr_ro">R/O</label>
  <div class="input-group mb-3">
  <input name="perarr_ro[]" type="text" class="form-control">
  </div>
  
  </div>

     <div class="form-group col-md-2">
<label for="perarr_dis">District</label> 
    <div>
      <select name="perarr_dis[]" class="custom-select">
        <option value="">Select District</option>
      </select>
    </div>
  </div>
  <div class="form-group col-md-2">
  
  <label for="perarr_age">Age</label>
  <div class="input-group mb-2">
  <input name="perarr_age[]" type="number" class="form-control">
  <div class="input-group-append">
    <button type="button" id="perarrb" class="btn btn-primary">Add</button>
    </div>
  </div>
  
  </div>
  </div>
  
  </div>
    <div class="perarr-wrap">
      </div>


<h4><strong>Indian Suspects near Drone Location</strong></h4>
      <div class="form-row">
  <div class="form-group col-md-2">
  
    <label for="indiansusp">Suspect Name</label>
    <div class="input-group mb-3">
    <input name="indiansusp[]" type="text" class="form-control" placeholder="Name">
    </div>
    </div>
    
  <div class="form-group col-md-2">
  
    <label for="indiansusp_so">S/O</label>
    <div class="input-group mb-3">
    <input name="indiansusp_so[]" type="text" class="form-control">
    </div>
    </div>
  
    <div class="form-group col-md-3">
  
  <label for="indiansusp_ro">R/O</label>
  <div class="input-group mb-3">
  <input name="indiansusp_ro[]" type="text" class="form-control">
  </div>
  
  </div>

     <div class="form-group col-md-2">
<label for="indiansusp_dis">District</label> 
    <div>
      <select name="indiansusp_dis[]" class="custom-select">
        <option value="">Select District</option>
      </select>
    </div>
  </div>
  <div class="form-group col-md-2">
  
  <label for="indiansusp_age">Age</label>
  <div class="input-group mb-2">
  <input name="indiansusp_age[]" type="number" class="form-control">
  <div class="input-group-append">
    <button type="button" id="indian_susb" class="btn btn-primary">Add</button>
    </div>
  </div>
  
  </div>
  </div>
  <div class="indian_susp-wrap">
      </div>


      <div class="form-row">
  <div class="form-group col-md-4">
  
    <label for="roads_drone">Roads connectivity nearby</label>
    <div class="input-group mb-3">
    <input name="roads_drone[]" type="text" class="form-control">
    <div class="input-group-append">
    <button type="button" id="road_add" class="btn btn-primary">Add</button>
    </div>
    </div>
    <div class="road-wrap">
      </div>
    </div>
  </div>
    <div class="button-row d-flex mt-4">
              <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
              <button class="btn btn-success ml-auto" type="submit" title="Send">Send</button>
            </div>
  </div>
    

          
          </div>
        </div>
      </form>
     </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
  $("input[name='forensic_radio']").click(function() {
        var test = $(this).val();
        if(test=='Yes'){
            $("#forensic_container").show();
        }
        else{
            $("#forensic_container").hide();
        }
  
    });
   $("input[name='rec_radio']").click(function() {
        var test = $(this).val();
        if(test=='Yes'){
            $("#recovery_made").show();
        }
        else{
            $("#recovery_made").hide();
        }
  
    });
   $("input[name='cons_dropped']").click(function() {
        var test = $(this).val();
        if(test=='Yes'){
            $("#cons_container").show();
        }
        else{
            $("#cons_container").hide();
        }
  
    });
jQuery.validator.addMethod("noSpace", function(value, element) { 
      return value.trim().length != 0;   
    }, "This field is required");

$('#form').validate({ // initialize the plugin

rules: {
    location: {
        noSpace: true
    },
    district: {
      required: true
    },
    ps: {
      required: true
    },
    lat: {
      noSpace: true
    },
    long: {
      noSpace: true
    },
    time_seen:{
      required: true
    },
    "bsf_drone[]": {
      required: true
    }

},
invalidHandler: function(event, validator) {
    // 'this' refers to the form
    var errors = validator.numberOfInvalids();
    if (errors) {
      alert('You have errors in ' + errors + ' fields. They have been highlighted');
    } else {
     
    }
  }
});
var drone_types = ["Single-Rotor Drones","Multi-Rotor Drones","Fixed-Wing Drones","Fixed-Wing Hybrid Drones","Small Drones","Micro Drones","Tactical Drones","Reconnaissance Drones","Large Combat Drones","Non-Combat Large Drones","Target and Decoy Drones","GPS Drones","Photography Drones","Racing Drones"];
 var drone_opt="<option value=''>Select Type</option>";
 for(drone_type of drone_types)
 {
  drone_opt+= "<option value='"+drone_type+"'>"+ drone_type + "</option>";
 }
 $("#uav_type").html(drone_opt);
 
 var bopArr={"Tarn Taran":{" Khalra ":["Khalra Barrier","Baba Peer","Dall "," Rajoke "," Karma "," Mangli "," K.S.Wala "," Dharm "," Singh Pura "," Wan Tara Singh "],"Khemkaran ":[" Noorwala "," Kalas "," Rattoke"],"Sarai Amanat Khan":[" Havellian "," Naushera Dhalla "],"Valtoha ":[" Thathi Jaimal Singh "," Kalia "],"Patti Sadar ":[" BOP Kulwant 116 BN. BSF FZR "]},"ASR Rural ":{" Gharinda ":["Mohawa","Rattan Khurd"," Gulgarh "," Pul Moran "," Bharobhal "," Dauke "," Rajatal "," Udhar "," Roranwala "," Kahangarh ","88 Bn. of BSF Amritsar Sector "," Bhanuchak "]," Ramdass ":[" Chhana Pattan "," Panjgraiyan "," Dhramparkash "," Kassowal "," Singhoke "," Chandigarh "," Kotrazda "," Saharan "],"Ajnala":[" Kalam Dogar"," New Sundergarh"," Bhainian "," Dhian Singh Pura "," Old SunderGarh"," Shahpur"], "Lopoke": ["Kakkar Rear "," Ranian "," Gulgarh "," Mullekot "," Raja Mohtam "," Udhar Dhariwal "],"Bhindi Saidan": ["Ghogga "," Burj "," Sherpur "," Gulgarh "]},"Batala":{"Dera baba Nanak":[" DBN Road "," Metla "," Sadanwali "," Abad "," Khassowal Forward "," Boharwadala "]}," Gurdaspur ":{"Dera baba Nanak":[" Chountra "," Aadian "," Thakurpur "],"Kalanaur":[" Rose "," Chandu Wadala "," Kamaljit "," Momenpur "]," Dina Nagar ":[" Chakri "]}," Pathankot":{" Narot Jaimal Singh ":[" Dhinda Forward "," Jaitpur "," Dhinda "," Old Tent Post Bamial "," Paharipur "," Kanshi Barhwan "]}," Ferozepur ":{"Sadar Ferozepur":[" Hussain wala "," H.K Tower "],"Mamdot":[" Mabbo Ke "]," Lakhoke Behram ":[" J.R. Hithar "," Raja Mohatan "," S.S Wala "]," Arifke ":[" Basti Ram Lal "]},"Fazilka":{" Sadar Fazilka ":[" Jhangar "," Lakha Asli "," Khokherin "," Moujam "," GG-2"]," Sadar Jalalabad ":[" Gatti Yaru "," Jodhanwali Bhaini "]}}
  var distArr = {
                    "Amritsar-City" : ["PS Div. A","PS Div. B","PS Div. C","PS Div. D","PS Div. E","PS Civil Lines","PS Sadar","PS Islamabad","PS Chheharta","PS Sultanwind","PS Gate Hakiman","PS Cantonment","PS Maqboolpura","PS Women","PS NRI","PS Airport","PS Verka","PS Majitha Road","PS Mohkampura","PS Ranjit Avenue","PS State Spl. Operation Cell"],
                    "Amritsar-Rural" : ["PS Ajnala","PS Beas","PS Bhindi Saidan","PS Chattiwind","PS Gharinda","PS Jandiala","PS Jhander","PS Kambo","PS Kathunangal","PS Khilchian","PS Lopoke","PS Majitha","PS Mattewal","PS Mehta","PS Rajasansi","PS Ramdas","PS Tarsikka"],
                    "Fazilka" : ["PS Sadar","PS City","PS City Jalalabad","PS Sadar Abohar","PS City-1 Abohar","PS City-2 Abohar","PS Bahav Wala","PS Sadar Jalalabad","PS Arni Wala","PS Khuian Sarwar","PS Khui Khera","PS Vario"],
                    "Ferozepur" : ["PS City","PS Sadar","PS Cantt.","PS Makhu","PS Zira","PS Zira City","PS Mallanwala","PS Kulgari","PS Ghall Khurad","PS Mamdot","PS Guru Har Sahai","PS Lakhoke Behram","PS Amir Khas","PS Women Cell","PS Talwandi Bhai","PS Arif Ke","PS NRI"],
                    "Gurdaspur": ["PS City","PS Sadar","PS Dhariwal","PS Kahnuwan","PS Purana Shalla","PS Dorangla","PS Dinanagar","PS Kalanaur","PS Tibber","PS Ghuman Kalan","PS Bhaini Mian Khan","PS Behrampur","PS NRI"],
                    "Jalandhar-Rural": ["PS Adampur","PS Bhogpur","PS Lambra","PS Kartarpur","PS Maqsudan","PS Nakodar","PS City Nakodar","PS Mehatpur","PS Shahkot","PS Lohian","PS Phillaur","PS Bilga","PS Nurmahal","PS Goraya","PS Patara","PS NRI"],
                    "Kapurthala": ["PS City","PS Kotwali","PS Sadar","PS Sultanpur Lodhi","PS Talwandi Choudhrian","PS Bholath","PS Dhilwan","PS Subhanpur","PS City Phagwara","PS Sadar Phagwara","PS Kabirpur","PS Begowal","PS Rawalpindi","PS Fattudhinga","PS Satnampura","PS NRI"],
                    "Pathankot": ["PS Div.No.1","PS Div.No.2","PS Sadar","PS Shahpur Kandi","PS Sujanpur","PS Nangal Bhoor","PS Taragarh","PS Narot Jaimal Singh","PS Dhar Kalan"],

  };
  var distopt="<option value=''>Select District</option>";
                for(var key in bopArr){
                  distopt+= "<option value='"+key+"'>"+ key + "</option>";
                }
                $("#district").html(distopt);
                $('[name="indiansusp_dis[]"]').html(distopt);
                $('[name="perarr_dis[]"]').html(distopt);
                $("#district").change(function(){
        var selectedDistrict = $("#district option:selected").val();
        var psopt="<option value=''>Select PS</option>";
        if(selectedDistrict !== ''){
          dict_ps = bopArr[selectedDistrict];
         // console.log(dict_ps);
        for(var value in dict_ps){
            psopt+="<option value='"+value+"'>"+ value + "</option>";
        }
        //console.log(psopt);
        $("#ps").html(psopt);
    } 
 
    });
    $("#ps").change(function(){
    var selectedPS = $("#ps option:selected").val();
    var bopopt="<option value=''>Select BOP</option>";
    if(selectedPS !== ''){
          //dict_ps = dict_ps[selectedPS];
         console.log(dict_ps[selectedPS]);
        for(var value of dict_ps[selectedPS]){
            bopopt+="<option value='"+value+"'>"+ value + "</option>";
        }
        //console.log(psopt);
        $("#bop_rec").html(bopopt);
    }
    });


    var itemArr = {"Fire Arms":["Pistol","Revolver","AK-47 Rifle","Other Rifle","Short Range Cartridges","Long Range Cartridges","Long Range Magazines","Long Range Magazines"],"Explosive":["RDX ","TeTn","Nitroglycrine","Black Powder","Trintro Components"],"Narcotics":["Heroin","Opium","Poppy Husk","Charas","Intoxicant tablets","Tromadol","Morphine","Codeine"],"IEDs":["Detonators","Wire","Timer Switches","IED","Codex pieces"," Electronic Detonators","Steel Containers","Batteries","Tiffin Bomb"],"Communication Devices":["Pakistani Phone"," Pakistani SIM","Satellite Phone","Dongle"],"FICN":[],"Hand grenades":[]
}
  var typeopt="<option value=''>Select Type</option>";
                for(var key in itemArr){
                  typeopt+= "<option value='"+key+"'>"+ key + "</option>";
                }
                $("#cons_type").html(typeopt);
              //  $('[name="cons_type[]"]').html(typeopt);
               

 $(document).on('change', 'select[name="cons_type[]"]', function(){
    var selectedtype = $(this).val();
      //alert(selectedtype);
    var item="<option value=''>Select Item</option>";
        if(selectedtype !== ''){
          dict_item = itemArr[selectedtype];
         //console.log(dict_item);
        for(var value of dict_item){
            item+="<option value='"+value+"'>"+ value + "</option>";
          }
    $(this).closest('.col-md-4').next().find('select[name="cons_item[]"]').html(item);
  }
});

var road_add = $("#road_add"); //Add button ID
var x = 1; //initlal text box count
$(road_add).click(function(e){ //on add input button click
e.preventDefault();
if(x < 15){ //max input box allowed
x++; //text box increment
$(".road-wrap").append('<input name="roads_drone[]" type="text" class="form-control">');
}
});

var perarrb = $("#perarrb"); //Add button ID
var x = 1; //initlal text box count
$(perarrb).click(function(e){ //on add input button click
e.preventDefault();
if(x < 15){ //max input box allowed
x++; //text box increment
$(".perarr-wrap").append('<div class="form-row"><div class="col-md-2">  <input name="perarr_name[]" type="text" class="form-control" placeholder="Name"></div><div class="col-md-2"><input name="perarr_so[]" type="text" class="form-control"></div><div class="col-md-3"><input name="perarr_ro[]" type="text" class="form-control"></div><div class="col-md-2"><select name="perarr_dis[]" class="custom-select"></select></div><div class="col-md-1"><input name="perarr_age[]" type="number" class="form-control"></div></div>');
 $('.perarr-wrap select').last().html(distopt); //add input box
}
});


var indian_susb = $("#indian_susb"); //Add button ID
var x = 1; //initlal text box count
$(indian_susb).click(function(e){ //on add input button click
e.preventDefault();
if(x < 15){ //max input box allowed
x++; //text box increment
$(".indian_susp-wrap").append('<div class="form-row"><div class="col-md-2">  <input name="indiansusp[]" type="text" class="form-control" placeholder="Name"></div><div class="col-md-2"><input name="indiansusp_so[]" type="text" class="form-control"></div><div class="col-md-3"><input name="indiansusp_ro[]" type="text" class="form-control"></div><div class="col-md-2"><select name="indiansusp_dis[]" class="custom-select"></select></div><div class="col-md-1"><input name="indiansusp_age[]" type="number" class="form-control"></div></div>');
 $('.indian_susp-wrap select').last().html(distopt); //add input box
}
});

var pak_vill = $("#pak_vill"); //Add button ID
var x = 1; //initlal text box count
$(pak_vill).click(function(e){ //on add input button click
e.preventDefault();
if(x < 15){ //max input box allowed
x++; //text box increment
$(".pak_vill-wrap").append('<div class="form-row"><div class="col-md-4"> <input name="pak_vill[]" type="text" class="form-control"></div><div class="col-md-2"><input name="pakvill_dist[]" type="number" class="form-control"></div><div class="col-md-2"><select name="pakvill_unit[]" class="custom-select"><option value="km">km</option><option value="m">m</option></select></div></div>'); //add input box
}
});

var ind_vill = $("#ind_vill"); //Add button ID
var x = 1; //initlal text box count
$(ind_vill).click(function(e){ //on add input button click
e.preventDefault();
if(x < 15){ //max input box allowed
x++; //text box increment
$(".ind_vill-wrap").append('<div class="form-row"><div class="col-md-4"><input name="indian_vill[]" type="text" placeholder="Village" class="form-control"></div><div class="col-md-2"><input name="indianvill_dist[]" type="number" placeholder="Distance" class="form-control"></div><div class="col-md-2"> <select name="indianvill_unit[]" class="custom-select"><option value="km">km</option><option value="m">m</option></select></div></div>'); //add input box
}
});


var cons_add = $("#cons_add"); //Add button ID
var x = 1; //initlal text box count
$(cons_add).click(function(e){ //on add input button click
e.preventDefault();
if(x < 15){ //max input box allowed
x++; //text box increment
$(".drone_cons-wrap").append('<div class="form-row"><div class="col-md-4"><select name="cons_type[]" class="custom-select"><option value="">Select Type</option><option value="Firearms">Firearms</option></select></div><div class="col-md-2"><select name="cons_item[]" class="custom-select"><option value="">Select Item</option><option value="AK-47">AK-47</option></select></div><div class="col-md-2"> <input type="text" name="cons_qty[]" class="form-control"/></div></div><br>'); //add input box
}
 $('.drone_cons-wrap select').eq(-2).html(typeopt);
});


var bsf_add = $("#bsf_add"); //Add button ID
var x = 1; //initlal text box count
$(bsf_add).click(function(e){ //on add input button click
e.preventDefault();
if(x < 15){ //max input box allowed
x++; //text box increment
$(".bsf-wrap").append('<input name="bsf_drone[]" type="text" class="form-control">'); //add input box
}
});

var ind_bop = $("#ind_bop"); //Add button ID
var x = 1; //initlal text box count
$(ind_bop).click(function(e){ //on add input button click
e.preventDefault();
if(x < 15){ //max input box allowed
x++; //text box increment
$(".ind_bop-wrap").append('<input name="indian_bops[]" type="text" class="form-control">'); //add input box
}
});


var pak_bop = $("#pak_bop"); //Add button ID
var x = 1; //initlal text box count
$(pak_bop).click(function(e){ //on add input button click
e.preventDefault();
if(x < 15){ //max input box allowed
x++; //text box increment
$(".pak_bop-wrap").append(' <input name="pak_bops[]" type="text" class="form-control">'); //add input box
}
});
const DOMstrings = {
  stepsBtnClass: 'multisteps-form__progress-btn',
  stepsBtns: document.querySelectorAll(`.multisteps-form__progress-btn`),
  stepsBar: document.querySelector('.multisteps-form__progress'),
  stepsForm: document.querySelector('.multisteps-form__form'),
  stepsFormTextareas: document.querySelectorAll('.multisteps-form__textarea'),
  stepFormPanelClass: 'multisteps-form__panel',
  stepFormPanels: document.querySelectorAll('.multisteps-form__panel'),
  stepPrevBtnClass: 'js-btn-prev',
  stepNextBtnClass: 'js-btn-next' };


//remove class from a set of items
const removeClasses = (elemSet, className) => {

  elemSet.forEach(elem => {

    elem.classList.remove(className);

  });

};

//return exect parent node of the element
const findParent = (elem, parentClass) => {

  let currentNode = elem;

  while (!currentNode.classList.contains(parentClass)) {
    currentNode = currentNode.parentNode;
  }

  return currentNode;

};

//get active button step number
const getActiveStep = elem => {
  return Array.from(DOMstrings.stepsBtns).indexOf(elem);
};

//set all steps before clicked (and clicked too) to active
const setActiveStep = activeStepNum => {

  //remove active state from all the state
  removeClasses(DOMstrings.stepsBtns, 'js-active');

  //set picked items to active
  DOMstrings.stepsBtns.forEach((elem, index) => {

    if (index <= activeStepNum) {
      elem.classList.add('js-active');
    }

  });
};

//get active panel
const getActivePanel = () => {

  let activePanel;

  DOMstrings.stepFormPanels.forEach(elem => {

    if (elem.classList.contains('js-active')) {

      activePanel = elem;

    }

  });

  return activePanel;

};

//open active panel (and close unactive panels)
const setActivePanel = activePanelNum => {

  //remove active class from all the panels
  removeClasses(DOMstrings.stepFormPanels, 'js-active');

  //show active panel
  DOMstrings.stepFormPanels.forEach((elem, index) => {
    if (index === activePanelNum) {

      elem.classList.add('js-active');

      setFormHeight(elem);

    }
  });

};

//set form height equal to current panel height
const formHeight = activePanel => {

  const activePanelHeight = activePanel.offsetHeight;

  DOMstrings.stepsForm.style.height = `${activePanelHeight}px`;

};

const setFormHeight = () => {
  const activePanel = getActivePanel();

  formHeight(activePanel);
};

//STEPS BAR CLICK FUNCTION
DOMstrings.stepsBar.addEventListener('click', e => {

  //check if click target is a step button
  const eventTarget = e.target;

  if (!eventTarget.classList.contains(`${DOMstrings.stepsBtnClass}`)) {
    return;
  }

  //get active button step number
  const activeStep = getActiveStep(eventTarget);

  //set all steps before clicked (and clicked too) to active
  setActiveStep(activeStep);

  //open active panel
  setActivePanel(activeStep);
});

//PREV/NEXT BTNS CLICK
DOMstrings.stepsForm.addEventListener('click', e => {

  const eventTarget = e.target;

  //check if we clicked on `PREV` or NEXT` buttons
  if (!(eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`) || eventTarget.classList.contains(`${DOMstrings.stepNextBtnClass}`)))
  {
    return;
  }

  //find active panel
  const activePanel = findParent(eventTarget, `${DOMstrings.stepFormPanelClass}`);

  let activePanelNum = Array.from(DOMstrings.stepFormPanels).indexOf(activePanel);

  //set active step and active panel onclick
  if (eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`)) {
    activePanelNum--;

  } else {

    activePanelNum++;

  }

  setActiveStep(activePanelNum);
  setActivePanel(activePanelNum);

});

//SETTING PROPER FORM HEIGHT ONLOAD
window.addEventListener('load', setFormHeight, false);

//SETTING PROPER FORM HEIGHT ONRESIZE
window.addEventListener('resize', setFormHeight, false);
</script>
@endsection


