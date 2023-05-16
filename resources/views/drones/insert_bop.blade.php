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
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container-fluid">
	<form method="GET" action="{{ route('drones.submit_bop') }}" id="form">
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
    <label for="nbop">New BOP</label> 
    <div>
      <input id="nbop" name="nbop" class="form-control" type="text">
    </div>
  </div>
  </div>
  <div class="button-row d-flex">
              <button class="btn btn-success mr-auto" type="submit" title="Send">Add</button>
            </div>
          </form>
</div>

  @endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>
var bops="{{$Bops}}";
var bopArr=JSON.parse(bops.replace(/&quot;/g,'"'));
	 
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
         //console.log(dict_ps[selectedPS]);
        for(var value of dict_ps[selectedPS]){
            bopopt+="<option value='"+value+"'>"+ value + "</option>";
        }
        //console.log(psopt);
        $("#bop_rec").html(bopopt);
    }
    });


</script>
	 @endsection