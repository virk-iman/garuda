@extends('layouts.app')

@section('content')
<link href="{{ asset('css/multi_step.css') }}" rel="stylesheet">
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
      <form class="multisteps-form__form" method="POST" action="{{ route('drones.update',$drone) }}">
      @csrf
      @method('PUT')
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
  <div class="form-group col-md-4">
    <label for="bop_rec">BOP</label> 
    <div>
      <select id="bop_rec" name="bop_rec" class="custom-select">
        <option value="">Select BOP</option>
      </select>
    </div>
  </div>
  <div class="form-group col-md-4">
    <label for="vill">Village</label> 
    <div>
      <input id="vill" name="vill" type="text" class="form-control" value="{{ $drone->vill }}">
    </div>
  </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-4">
  
    <label for="location">Location of sight</label>
     
    <input id="location" name="location" type="text" class="form-control" value="{{ $drone->location }}">
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-4">
  
    <label for="lat">Latitude</label>
     
    <input id="lat" name="lat" type="text" class="form-control" value="{{ $drone->lat }}">
    </div>
    <div class="form-group col-md-4">
  
    <label for="long">Longitude</label>
     
    <input id="long" name="long" type="text" class="form-control" value="{{ $drone->long }}">
    </div>
  </div>
  <div class="form-row">
        <div class="col-sm-4">
        <label>Date and Time of Sight</label> 
            <div class="form-group">
                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                    <input type="text" name="time_seen" class="form-control datetimepicker-input" value="{{ $drone->time_seen }}" data-target="#datetimepicker1"/>
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
<?php
 $fly_dur=$drone->fly_dur;
 if($fly_dur!='')
 {
 $split_fly=explode(":",$fly_dur);
 $hrs=$split_fly[0];
 $min=$split_fly[1];
 $sec=$split_fly[2];
}
else{
  $hrs='';
 $min='';
 $sec='';
}
 $pen_dist=$drone->pen_dist;
 if($pos=strpos($pen_dist,"k"))
 { 
   # $pos=strpos($pen_dist,"k");
    $dis_pen = substr($pen_dist, 0, $pos);
$dispen_unit = substr($pen_dist, $pos);
 }
 else if($pos=strpos($pen_dist,"m"))
 {
    #$pos=strpos($pen_dist,"m");
    $dis_pen = substr($pen_dist, 0, $pos);
    $dispen_unit = substr($pen_dist, $pos);
 }
 else{
    $dis_pen = $pen_dist;
    $dispen_unit= '';
 }

?>
  <div class="form-row">
    <label>Duration of flying within Indian territory</label> 
    <div class="col-sm-2">
    <input id="hours" name="hours" type="number" class="form-control" placeholder="Hours" value="{{ $hrs }}">
    </div>
    <div class="col-sm-2">
    <input id="minutes" name="minutes" type="number" class="form-control" placeholder="Min" value="{{ $min }}">
    </div>
    <div class="col-sm-2">
    <input id="seconds" name="seconds" type="number" class="form-control" placeholder="Sec" value="{{ $sec }}">
    </div>
  </div>
  <br>
  <div class="form-row">
  <label for="dist_pen">Distance Penetrated into Indian territory</label> 
  <div class="col-sm-2">
    <input id="dist_pen" name="dist_pen" type="number" class="form-control" value="{{ $dis_pen }}">
  </div>
  <div class="col-sm-2">
    <select name="unit_dis" id="unit_dis" class="form-control"><option value="">unit</option><option value="km">km</option><option value="m">m</option></select>
  </div>
  </div>
  <div style="display:none" class="form-group">
    <label for="textarea">Action Taken</label> 
    <textarea id="textarea" name="action" cols="40" rows="5" class="form-control"></textarea>
  </div> 
  <br>
  <div class="form-row">
  <div class="form-group col-md-2">
    <label for="fir_no">FIR No.</label> 
   <div>
      <input id="fir_no" name="fir_no" type="text" class="form-control">
    </div>
  </div>

  <div class="form-group col-md-2">
    <label for="fir_date">FIR Date</label> 
    <div>
       <input id="fir_date" name="fir_date" type="date" class="form-control">
    </div>
  </div>

   <div class="form-group col-md-2">
    <label for="under_sec">U/S</label> 
    <div>
       <input id="under_sec" name="under_sec" type="text" class="form-control">
    </div>
  </div>

  <div class="form-group col-md-2">
    <label for="fir_act">Act</label> 
    <div>
       <input id="fir_act" name="fir_act" type="text" class="form-control">
    </div>
  </div>
  <div class="form-group col-md-2">
    <label for="fir_ps">PS</label> 
    <div>
       <input id="fir_ps" name="fir_ps" type="text" class="form-control">
    </div>
  </div>
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
      @foreach ($consignments as $cons)
      <div class="form-row">
    <input name="cons_dron_id[]" type="hidden" class="form-control" value="{{ $cons->id }}">
    <div class="col-md-3">
    <input name="cons_dron_type[]" type="text" class="form-control" value="{{ $cons->type }}">
  </div>
  <div class="col-md-3">
    <input name="cons_dron_item[]" type="text" class="form-control" value="{{ $cons->item }}">
  </div>
    <div class="col-md-2">
    <input name="cons_dron_qty[]" type="text" class="form-control" value="{{ $cons->qty }}">
  </div>
  </div>
    @endforeach
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
  <label for="payload">Payload Capacity</label> 
  <div class="col-sm-2">
    <input id="payload" name="payload" type="text" class="form-control">
  </div>
 
  </div>
<br>
<div class="form-row">
  <label for="max_speed">Maximum Speed</label> 
  <div class="col-sm-2">
    <input id="max_speed" name="max_speed" type="text" class="form-control">
  </div>
  
  </div>
<br>
<div class="form-row">
  <label for="flight_time">Flight Time</label> 
  <div class="col-sm-2">
    <input id="flight_time" name="flight_time" type="text" class="form-control">
  </div>
  
  </div>
  <br>
<div class="form-row">
  <label for="onewaydis">One Way Distance</label> 
  <div class="col-sm-2">
    <input id="onewaydis" name="onewaydis" type="text" class="form-control">
  </div>
  
  </div>
 @if(!$recovery->isEmpty()) 
  <script>

  $("#date_rec").val("{{$recovery[0]->dor}}");
  $("#agency_rec").val("{{$recovery[0]->rec_agency}}");
  $("#type_drone").val("{{$recovery[0]->type_drone}}");
  $("#model_drone").val("{{$recovery[0]->model}}");
  $("#payload").val("{{$recovery[0]->payload_cap}}");
  $("#max_speed").val("{{$recovery[0]->max_speed}}");
  $("#flight_time").val("{{$recovery[0]->flight_time}}");
  $("#onewaydis").val("{{$recovery[0]->one_way}}");
  </script>
  @else

  @endif
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
    <input name="bsf_drone[]" id="bsf_drone" type="text" class="form-control">
    <div class="input-group-append">
    <button type="button" id="bsf_add" class="btn btn-primary">Add</button>
    </div>
    </div>
    <div class="bsf-wrap">
    @foreach ($bsf_posts as $bsf_post)
    <input name="bsf_dron_id[]" type="hidden" class="form-control" value="{{ $bsf_post->id }}">
    <input name="bsf_dron[]" type="text" class="form-control" value="{{ $bsf_post->bsf_post }}">
    @endforeach
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
    @foreach ($indian_bops as $indian_bop)
    <input name="indian_bop_id[]" type="hidden" class="form-control" value="{{ $indian_bop->id }}">
    <input name="indian_bop[]" type="text" class="form-control" value="{{ $indian_bop->bop }}">
    @endforeach
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
    @foreach ($pak_bops as $pak_bop)
    <input name="pak_bop_id[]" type="hidden" class="form-control" value="{{ $pak_bop->id }}">
    <input name="pak_bop[]" type="text" class="form-control" value="{{ $pak_bop->bop }}">
    @endforeach
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
    
    @foreach ($indian_vill as $ind_vill)
    <div class="form-row">
    <input name="ind_vill_id[]" type="hidden" class="form-control" value="{{ $ind_vill->id }}">
    <div class="col-md-4">
    <input name="ind_vill[]" type="text" class="form-control" value="{{ $ind_vill->vill }}">
    </div>
    <div class="col-md-2">
    <input name="ind_vill_dist[]" type="text" class="form-control" value="{{ $ind_vill->dist }}">
    </div>
    </div>
    @endforeach
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
    
    @foreach ($pak_vill as $pk_vill)
    <div class="form-row">
    <input name="pk_vill_id[]" type="hidden" class="form-control" value="{{ $pk_vill->id }}">
    <div class="col-md-4">
    <input name="pk_vill[]" type="text" class="form-control" value="{{ $pk_vill->vill }}">
    </div>
    <div class="col-md-2">
    <input name="pk_vill_dist[]" type="text" class="form-control" value="{{ $pk_vill->dist }}">
    </div>
    </div>
    @endforeach
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
      @foreach ($arrest_per as $arr_per)
    <div class="form-row">
    <input name="per_arr_id[]" type="hidden" class="form-control" value="{{ $arr_per->id }}">
    <div class="col-md-2">
    <input name="per_arr[]" type="text" class="form-control" value="{{ $arr_per->name }}">
    </div>
    <div class="col-md-2">
    <input name="per_arr_so[]" type="text" class="form-control" value="{{ $arr_per->father }}">
    </div>
    <div class="col-md-3">
    <input name="per_arr_ro[]" type="text" class="form-control" value="{{ $arr_per->address }}">
    </div>
     <div class="col-md-2">
    <input name="per_arr_dis[]" type="text" class="form-control" value="{{ $arr_per->district }}">
    </div>
    <div class="col-md-2">
    <input name="per_arr_age[]" type="text" class="form-control" value="{{ $arr_per->age }}">
    </div>
    </div>
    @endforeach
      </div>
<h4><strong>Indian Suspects near Drone Location</strong></h4>
      <div class="form-row">
  <div class="form-group col-md-2">
  
    <label for="india_susp">Suspect Name</label>
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
    @foreach ($ind_susp as $ind_sus)
    <div class="form-row">
    <input name="indian_susp_id[]" type="hidden" class="form-control" value="{{ $ind_sus->id }}">
    <div class="col-md-2">
    <input name="indian_susp[]" type="text" class="form-control" value="{{ $ind_sus->name }}">
    </div>
    <div class="col-md-2">
    <input name="indian_susp_so[]" type="text" class="form-control" value="{{ $ind_sus->father }}">
    </div>
    <div class="col-md-3">
    <input name="indian_susp_ro[]" type="text" class="form-control" value="{{ $ind_sus->address }}">
    </div>
     <div class="col-md-2">
    <input name="indian_susp_dis[]" type="text" class="form-control" value="{{ $ind_sus->district }}">
    </div>
    <div class="col-md-2">
    <input name="indian_susp_age[]" type="text" class="form-control" value="{{ $ind_sus->age }}">
    </div>
    </div>
    @endforeach
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
    @foreach ($ind_roads as $ind_road)
    <input name="road_drone_id[]" type="hidden" class="form-control" value="{{ $ind_road->id }}">
    <input name="road_drone[]" type="text" class="form-control" value="{{ $ind_road->road }}">
    @endforeach
      </div>
    </div>
  </div>

            <div class="button-row d-flex mt-4">
              <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
              <button class="btn btn-success ml-auto" type="submit" title="Send">Send</button>
            </div>
          </div>
        </div>
      </form>
     </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
$( document ).ready(function() {


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
   if("{{$drone->cons_dropped}}"=="Yes"){
   $("input[name='cons_dropped'][value='Yes']").prop("checked", true).trigger("click");
 }
 if("{{$drone->recovery}}"=="Yes"){
  
    $("input[name='rec_radio'][value='Yes']").prop("checked", true).trigger("click");
  }
  if("{{$drone->forensics}}"=="Yes"){
    $("input[name='forensic_radio'][value='Yes']").prop("checked", true).trigger("click");
  }
  var msg = '{{Session::get('status')}}';
  var exist = '{{Session::has('status')}}';
  if(exist){
    alert(msg);
  }
 var drone_types = ["Single-Rotor Drones","Multi-Rotor Drones","Fixed-Wing Drones","Fixed-Wing Hybrid Drones","Small Drones","Micro Drones","Tactical Drones","Reconnaissance Drones","Large Combat Drones","Non-Combat Large Drones","Target and Decoy Drones","GPS Drones","Photography Drones","Racing Drones"];

 var bops="{{$Bops}}";
var bopArr=JSON.parse(bops.replace(/&quot;/g,'"'));
  
   var distopt="<option value=''>Select District</option>";
                for(var key in bopArr){
                  distopt+= "<option value='"+key+"'>"+ key + "</option>";
                }
                $("#district").html(distopt);
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
    // Display city dropdown based on country name
    $("#ps").change(function(){
    var selectedPS = $("#ps option:selected").val();
    var bopopt="<option value=''>Select BOP</option>";
    if(selectedPS !== ''){
          //dict_ps = dict_ps[selectedPS];
         //console.log(dict_ps[selectedPS]);
        for(var value of dict_ps[selectedPS]){
            bopopt+="<option value='"+value+"'>"+ value+ "</option>";
        }
        //console.log(psopt);
        $("#bop_rec").html(bopopt);
    }
    });

$("#unit_dis").val("{{$dispen_unit}}");

if($("#district").val("{{$drone->district}}").change())
{
  if($("#ps").val("{{$drone->ps}}").change())
  {
    $("#bop_rec").val("{{$drone->bop}}");
  }
    
}


var itemArr = {"Fire Arms":["Pistol","Revolver","AK-47 Rifle","Other Rifle","Short Range Cartridges","Long Range Cartridges","Long Range Magazines","Long Range Magazines"],"Explosive (in Kg)":["RDX ","TeTn","Nitroglycrine","Black Powder","Trintro Components"],"Narcotics (in Kg)":["Heroin","Opium","Poppy Husk","Charas","Intoxicant tablets","Tromadol","Morphine","Codeine"],"IEDs":["Detonators","Wire","Timer Switches","IED","Codex pieces"," Electronic Detonators","Steel Containers","Batteries","Tiffin Bomb"],"Communication Devices":["Pakistani Phone"," Pakistani SIM","Satellite Phone","Dongle"],"FICN":[],"Hand grenades":[]
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

var indian_susb = $("#indian_susb"); //Add button ID
var x = 1; //initlal text box count
$(indian_susb).click(function(e){ //on add input button click
e.preventDefault();
if(x < 15){ //max input box allowed
x++; //text box increment
$(".indian_susp-wrap").append('<div class="form-row"><div class="col-md-4">  <input name="indiansusp[]" type="text" class="form-control" placeholder="Name"></div><div class="col-md-2"><input name="indiansusp_so[]" type="text" class="form-control"></div><div class="col-md-3"><input name="indiansusp_ro[]" type="text" class="form-control"></div><div class="col-md-2"><input name="indiansusp_age[]" type="number" class="form-control"></div></div>'); //add input box
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


var bsf_add = $("#bsf_add"); //Add button ID
var x = 1; //initlal text box count
$(bsf_add).click(function(e){ //on add input button click
e.preventDefault();
var bsf_drone=$("#bsf_drone").val();
$("#bsf_drone").val('');
//alert(bsf_drone);
if(x < 15){ //max input box allowed
x++; //text box increment
$(".bsf-wrap").append('<input name="bsf_drone[]" type="text" class="form-control" value="'+bsf_drone+'">'); //add input box
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


