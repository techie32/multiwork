@extends('layouts.admin_master')
@section('content')
<div class="card mb-4 ">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Availability
    </div>
    <div class="card-body">
        <div>
            <h3>Minimum & Future booking lead time </h3>
            <h5 class="mt-5">How much lead time do you need before a job can be scheduled online ? </h5>
        </div>
        
        <form method="POST" action="{{URL::to('insert-leadtime/'.$leadtime[0]->id) }}" >
            @csrf
            <div class="form-row">
                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control select" name="leadtime">
                            @foreach($leadtime as $row)
                                <option class="check1" value="{{ $row->lead_time }}">{{ $row->lead_time }}</option>
                                @if($row->lead_time == "3 hour"){   
                                    <option class="check1" value="1 hour">1 hour</option>
                                    <option class="check1" value="2 hour">2 hour</option>
                                }@endif

                                @if($row->lead_time == "2 hour"){   
                                    <option class="check1" value="1 hour">1 hour</option>
                                    <option class="check1" value="3 hour">3 hour</option>
                                }@endif

                                @if($row->lead_time == "1 hour"){   
                                    <option class="check1" value="1 hour">2 hour</option>
                                    <option class="check1" value="3 hour">3 hour</option>
                                }@endif
                                
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
           
            <div class="col-md-5 m-auto">
                <div class="form-group text-center">
                    <button class="btn btn-primary  btn-default m-auto">Submit</button>
                </div>
            </div>
           
        </form>
    </div>
   
</div>
@endsection