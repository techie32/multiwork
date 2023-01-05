@extends('layouts.admin_master')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Availability
    </div>
    <div class="card-body">
        <div>
            <h3>Minimum & Future booking lead time </h3>
            <h5 class="mt-5">How much lead time do you need before a job can be scheduled online ? </h5>
        </div>
       
        <form method="POST" action="{{ url('/insert-leadtime/'.$leadtime->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control select" name="leadtime">
                            <option class="check1" value="1 hour">1 hour</option>
                            <option class="check2" value="2 hour">2 hour</option>
                            <option class="check3" value="3 hour">3 hour</option>
                        </select>
                    </div>
                </div>
            </div>
            <h5>How far in advance can new jobs be scheduled online ? </h5>
            <div class="form-row ">
                <div class="col-md-3">
                    <div class="form-group">
                       
                        <input class="form-control py-4" name="model" type="number" min="1"   />
                    </div>
                </div>
            </div>
            <div class="col-md-5 m-auto">
                <div class="form-group text-center">
                    <button class="btn btn-primary  btn-default m-auto">Submit</button>
                </div>
            </div>
            <div class="col-md-5 m-auto">
                <div class="form-group text-center">
                    <button class="btn btn-primary  btn-default m-auto">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(function(){
        $('.select').change(function(){
            var leadtime = $('.select').find(":selected").val();
            $.ajax({
                url: 'timing_available.blade.php',
                type: "POST",
                async:true,
                data: {"myData":leadtime} , 
                dataType: 'html',
                success: function(data) {
                    $('.Hours').html(data);
                }
            });    
        });
        
    
    });
    $(function () {
      $.ajax({
          url: 'timing_available.blade.php',
          type: "get",
          async:true,
          data: {name: 'ccenter', value: 'Sales Department' } , 
          dataType: 'html',
          success: function(data) {
              $('#employeeid').html(data);
          }
      });    
    });
        
   
</script>
@endsection