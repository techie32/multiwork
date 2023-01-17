@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Update Service</h3></div>
                    <div class="card-body">
                        <form method="POST" action="{{URL::to('update-service/'.$service->id)}}" enctype="multipart/form-data">
                        @csrf
                            <div class="form-row ">
                                <div class="col-md-5 m-auto">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">Service Name</label>
                                        <input class="form-control py-4" name="service_name" type="text" placeholder="" value="{{ $service->service_name}}" required/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row ">
                                <div class="col-md-5 m-auto">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label small mb-1">Service Pic</label>
                                        <input class="form-control" type="file" name="image" id="formFile" required>
                                        <img width="50px" height="50px" src= "data:image/jpg;base64,  {{$service->image}} ">
                                    </div>
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