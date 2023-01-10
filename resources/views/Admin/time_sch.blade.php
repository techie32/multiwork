
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
.week-name{
  margin-left:30px;font-size:20px
}

/* responsive  */

@media (max-width: 575.98px) {
  
  .week-name{
    margin-left:20px;font-size:18px
  }
  .switch{
    width:40px;
    height:21px;
  }
  .slider{
    right: -6px;
  }
  .slider:before{
    height: 18px;
    width:18px;
    bottom:2px;
    left:1px;
  }
  .top-heading{
    font-size:20px;
  }
}
@media (max-width: 498.98px) {
    .div_size{
      width:80px;
    }
    .slot-menu label{
      margin-right:1px;
    }

}
@media (max-width: 415.98px){
  .week-name {
    margin-left: 13px;
    font-size: 15px;
  }
  .switch{
    width:32px;
    height:18px;
  }
  .slider{
    right:-10px;
  }
  .slider:before{
    height: 15px;
    width: 15px;
    bottom: 2px;
    left: 1px;
  }
  .show_time label{
    margin-left:15px;
  }
  .slot-menu{
      margin-left:15px;
  }
  .slot-menu label{
      margin-right:10px;
  }
  .slot-menu input{
      width:80px;
      height:20px;
  }
  .week-name{
    /* width:20px; */
    font-size:13px;
  }
  

}

</style>

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Availability
    </div>
    <div style="display:flex">
      <div class="card-body">
        <h3 class="top-heading">Hours Operation</h3>
        <form method="POST" action="{{ url('/insert-timing') }}" >
          @csrf
          <div id="outer"></div>
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
  // on off show time
window.addEventListener('load', function () {
  const timing = {!! json_encode($timing) !!}
  timing.forEach((item, i)=>{
    console.log({item});
    if( item.active === "1"){
      document.getElementById(i).checked =true
      document.getElementById(`${i}-range-picker`).style.display = 'block'
    }else{
      document.getElementById(`${i}-range-picker`).style.display = 'none'
    }
  })
  
})

  // all days 
  const timing = {!! json_encode($timing) !!}
  const img_list = ['Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday',  'Saturday'];
  console.log(timing);


let result = timing.map((v, i) => `<div class='form-group' style='display:flex' >
                                        <div>
                                          <label class='switch'>
                                            <input type='hidden'     class='timing_select' name='id[]' value='${v.id}'>
                                            
                                            <input type='checkbox'  id="${i}"  class='timing_select' name='${i}' value='1'>
                                            <span class='slider round'></span>
                                          </label> 
                                            
                                        </div>
                                        <div class='div_size' >
                                          <h3 class='week-name' style=''>${v.day_name}</span>
                                        </div>
                                        
                                        <div   class='show_time' id="${i}-range-picker" style="display:none">
                                          <div style="display:flex" class='slot-menu'>
                                            <div id='range'></div>
                                            <label style=''>
                                               
                                                <input value='${v.start_time}' id='start_time' type='time' name='start_time[]' mbsc-input placeholder='Please select...' />
                                            </label>  
                                            <label>
                                          
                                                <input value='${v.end_time}' id='end_time'   type='time' name='end_time[]'   mbsc-input placeholder='Please select...' />
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

  

</script>

@endsection