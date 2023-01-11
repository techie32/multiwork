@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Add New Mobile</h3><div class="btn btn-sm btn-info float-right" style="margin-bottom:15px"> <a class="nav-link text-white" href="{{ url('/mobile-list') }}">Back</a></div></div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/insert-mobile') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row ">
                                <div class="col-md-5 m-auto">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">Mobile Name</label>
                                        <input class="form-control py-4" name="mobile_name" type="text" placeholder="" required/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row ">
                                <div class="col-md-5 m-auto">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Model</label>
                                        <input class="form-control py-4" name="model" type="text" placeholder=" " required />
                                    </div>
                                </div>
                            </div>

                           
                            <div class="form-row ">
                                <div class="col-md-5 m-auto">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label small mb-1">Mobile Pic</label>
                                        <input class="form-control" type="file" name="image" id="formFile" required>
                                    </div>
                                </div>
                            </div>

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
            </div>
        </div>
    </div>
</main>

@endsection