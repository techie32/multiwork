@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Update Mobile</h3></div>
                    <div class="card-body">
                        <form method="POST" action="{{URL::to('update-update_leadtime/'.$leadtime->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control select" name="leadtime">
                                            <option class="check1" value="{{ $leadtime->lead_time}}">1 hour</option>
                                            <option class="check2" value="{{ $leadtime->mobile_name}}">2 hour</option>
                                            <option class="check3" value="{{ $leadtime->mobile_name}}">3 hour</option>
                                        </select>
                                    </div>
                                </div>
                            
                           
                            <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection