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
      <form class="multisteps-form__form" method="POST" action="{{ route('drones.store') }}">
      @csrf
        <!--single form panel-->
        <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="scaleIn">
          <div class="multisteps-form__content">
          <div class="form-row">
  <div class="form-group col-md-4">
    <label for="uav_type">UAV/Drone Type</label> 
    <div>
      <select id="uav_type" name="uav_type" class="custom-select">
        <option value="">Select  Type</option>
      </select>
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
  <div class="form-group">
    <label for="textarea">Action Taken</label> 
    <textarea id="textarea" name="action" cols="40" rows="5" class="form-control"></textarea>
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

      <div class="form-row">
  <div class="form-group col-md-4">
  
    <label for="india_susp">Indian Suspects near Drone Location</label>
    <div class="input-group mb-3">
    <input name="india_susp[]" type="text" class="form-control" placeholder="Name">
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
      </form>
     </div>
  </div>
</div>

@endsection

@section('scripts')
<script>

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
$(".indian_susp-wrap").append('<div class="form-row"><div class="col-md-4">  <input name="india_susp[]" type="text" class="form-control" placeholder="Name"></div><div class="col-md-2"><input name="indiansusp_so[]" type="text" class="form-control"></div><div class="col-md-3"><input name="indiansusp_ro[]" type="text" class="form-control"></div><div class="col-md-2"><input name="indiansusp_age[]" type="number" class="form-control"></div></div>'); //add input box
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


