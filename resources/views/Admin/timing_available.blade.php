
@extends('layouts.admin_master')
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 29px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 22px;
  width: 22px;
  left: 1px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
.div_size{
  width:170px;
}
.show_time{
  display:none;
}
</style>

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Availability
    </div>
    <div class="card-body">
      <h3>Hours Operation</h3>
      <form method="POST" action="{{ url('/insert-timing') }}" >
        @csrf
        <div id="outer"></div>

      <!-- 
        <div class="form-group" style="display:flex">
          <div>
            <label class="switch">
              <input type="checkbox" class="timing_select_sun" name="timing_select" value="sunday">
              <span class="slider round"></span>
            </label> 
          </div>
          <div class="div_size">
            <h3 style="margin-left:30px;font-size:20px">Sunday</span>
          </div>
          <div class="show_time" id="" style="display:none">
            <div id="range"></div>
            <label>
                Start
                <input name="start_time"  id="start" mbsc-input placeholder="Please select..." />
            </label>
            <label>
                End
                <input id="end" name="end_time"   mbsc-input placeholder="Please select..." />
            </label>
          </div>
        
        </div> -->

        

        <div class="form-row">
          <div class="col-md-5 m-auto">
            <div class="form-group text-center">
              <button class="btn btn-primary  btn-default m-auto">Submit</button>
            </div>
          </div>
        </div>
      </form>
    </div>
</div>

<script>
const img_list = ['Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday',  'Saturday'];

const myFunc=(i)=>{
  // const id =  document.getElementById(i);
  // const divid =  document.getElementById(i);
  // id.onclick = function(){
  //     if(divid.style.display == "none"){

  //       document.getElementById(i).style.display = "block";
  //     }
  //     else{
  //       document.getElementById(i).style.display = "none";
  //     }
  // }
  if(i>=0){
    document.getElementById(i).style.display = "block"; 
  }else{
    document.getElementById(i).style.display = "none"; 
  }
 

  // var x = document.getElementById(i);
  // alert(x);
  // if (x.style.display === "none") {
  //   x.style.display = "block";
  //   x.style.background = "black";
  // } else {
  //   x.style.display = "none";
  // }
  
  
}


let result = img_list.map((v, i) => `<div class='form-group' style='display:flex' >
                                        <div>
                                          <label class='switch'>
                                            <input type='checkbox'  id="${i}"    class='timing_select' name='day_select[]' value='${v}'>
                                            <span class='slider round'></span>
                                          </label> 
                                            
                                        </div>
                                        <div class='div_size' >
                                          <h3 style='margin-left:30px;font-size:20px'>${v}</span>
                                        </div>
                                        
                                        <div key='range-${i}'  class='show_time' id="${i}-range-picker" style="display:none">
                                          <div style="display:flex">
                                            <div id='range'></div>
                                            <label>
                                                Start
                                                <input id=' ' name='start_time_${i}' mbsc-input placeholder='Please select...' />
                                            </label>
                                            <label>
                                                End
                                                <input id='end' name='end_time_${i}'   mbsc-input placeholder='Please select...' />
                                            </label>
                                            </div>
                                        </div>
                                    </div>`).join('');

document.getElementById('outer').innerHTML = result;
</script>
<script>

  $(".timing_select").click(function() {
    if($(this).is(":checked")){
        var id = $($(this)).attr("id");
        $(`#${id}-range-picker`).show(); 
    }else if(!($(this).is(":checked"))){
        var id = $($(this)).attr("id");
        $(`#${id}-range-picker`).hide(); 
    }
    
  });

  
  // $('.timing_select').each(function(){
  //   $(this).click(function(){
  //     if($(this).is(":checked")){
  //       var id = $($(this)).attr("id");
  //       $(`#${id}-range-picker`).show(); 
  //     }else if(!($(this).is(":checked"))){
  //       var id = $($(this)).attr("id");
  //       $(`#${id}-range-picker`).hide(); 
  //     }
  //   });
  // })

  $('#range').mobiscroll().datepicker({
    controls: ['time'],
    select: 'range',
    startInput: '#start',
    endInput: '#end',
    touchUi: true
  });
</script>

@endsection