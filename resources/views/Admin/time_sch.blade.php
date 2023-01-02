
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
    <div style="display:flex">
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
      <div>
        <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th>Day Name</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                      </tr>
                  </thead>
                    
                  <tbody>
                    @foreach($timing as $row)
                      <tr>
                        <td>{{ $row->day_name }}</td>
                        <td>{{ $row->start_time }}</td>
                        <td>{{ $row->end_time }}</td>
                        <td>{{ $row->end_time }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
   
</div>


<script>
window.addEventListener('load', function () {
  // alert('{!! json_encode($timing) !!}')
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

  // {{$timing}}.map((item)=>console.log({item}))
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
                                          <h3 style='margin-left:30px;font-size:20px'>${v.day_name}</span>
                                        </div>
                                        
                                        <div   class='show_time' id="${i}-range-picker" style="display:none">
                                          <div style="display:flex">
                                            <div id='range'></div>
                                            <label>
                                                Start
                                                <input value='${v.start_time}' id='start_time' type='time' name='start_time[]' mbsc-input placeholder='Please select...' />
                                            </label>  
                                            <label>
                                                End
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