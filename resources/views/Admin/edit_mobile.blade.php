@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Update Mobile</h3></div>
                    <div class="card-body">
                        <form method="POST" action="{{URL::to('update-mobile/'.$mobile->id)}}" enctype="multipart/form-data">
                        @csrf
                            <div class="form-row ">
                                <div class="col-md-5 m-auto">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">Mobile Name</label>
                                        <input class="form-control py-4" name="mobile_name" type="text" placeholder="" value="{{ $mobile->mobile_name}}" required/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row ">
                                <div class="col-md-5 m-auto">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Model</label>
                                        <input class="form-control py-4" name="model" type="text" value="{{ $mobile->model}}" required />
                                    </div>
                                </div>
                            </div>

                            <div class="form-row ">
                                <div class="col-md-5 m-auto">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Battery Replacement Price</label>
                                        <input class="form-control py-4" name="battery_replacement_price" type="number" value="{{ $mobile->battery_replacement_price}}" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-row ">
                                <div class="col-md-5 m-auto">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Screen Replacement Price</label>
                                        <input class="form-control py-4" name="screen_replacement_price" type="number" value="{{ $mobile->screen_replacement_price}}"  />
                                    </div>
                                </div>
                            </div>

                            <div class="form-row ">
                                <div class="col-md-5 m-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="modelcategory[]" value="White Screen {{  ($mobile->modelcategory == 'White Screen' ? ' checked' : '') }}" id="flexCheckDefault">
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
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Warrenty Name</label>
                                        <input class="form-control py-4" name="warrenty_name" type="text" value="{{ $mobile->warrenty_name}}"  />
                                    </div>
                                </div>
                            </div>   <div class="form-row ">
                                <div class="col-md-5 m-auto">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Warrenty Price</label>
                                        <input class="form-control py-4" name="warrenty_price" type="number" value="{{ $mobile->warrenty_price}}"  />
                                    </div>
                                </div>
                            </div>

                            <div class="form-row ">
                                <div class="col-md-5 m-auto">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label small mb-1">Mobile Pic</label>
                                        <input class="form-control" type="file" name="image" id="formFile" value="{{ $mobile->image}}"  required>
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