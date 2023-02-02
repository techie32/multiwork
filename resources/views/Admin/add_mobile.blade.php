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
                                        <label class="Large mb-1" for="inputFirstName">Mobile Name</label>
                                        <input class="form-control py-4" name="mobile_name" type="text" placeholder="" required/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row ">
                                <div class="col-md-5 m-auto">
                                    <div class="form-group">
                                        <label class="Large mb-1" for="inputLastName">Model</label>
                                        <input class="form-control py-4" name="model" type="text" placeholder=" " required />
                                    </div>
                                </div>
                            </div>

                           

                            <div class="form-row ">
                                <div class="col-md-5 m-auto">
                                    <div class="form-group">
                                        <label class="Large mb-1" for="inputLastName">Battery Replacement Price</label>
                                        <input class="form-control py-4" name="battery_replacement_price" type="number" placeholder=" " required />
                                    </div>
                                </div>
                            </div>

                            <div class="form-row ">
                                <div class="col-md-5 m-auto">
                                    <div class="form-group">
                                        <label class="Large mb-1" for="inputLastName">Screen Replacement Price</label>
                                        <input class="form-control py-4" name="screen_replacement_price" type="number" placeholder=" " required />
                                    </div>
                                </div>
                            </div>

                         
                            <div class="form-row ">
                                <div class="col-md-5 m-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="modelcategory[]" value="White Screen" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            White Screen
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="modelcategory[]" value="Black Screen" id="flexCheckChecked">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Black Screen
                                        </label>
                                    </div>
                                </div>
                            </div>
                                
                            <div class="form-row ">
                                <div class="col-md-5 m-auto">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label Large mb-1">Warrenty Name</label>
                                        <input class="form-control" type="text" name="warrenty_name" id="formFile" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row ">
                                <div class="col-md-5 m-auto">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label Large mb-1">Warrenty Price</label>
                                        <input class="form-control" type="text" name="warrenty_price" id="formFile" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row ">
                                <div class="col-md-5 m-auto">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label Large mb-1">Mobile Pic</label>
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