@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Update AddOn</h3></div>
                    <div class="card-body">
                        <form method="POST" action="{{URL::to('update-addon/'.$addon->id)}}" enctype="multipart/form-data">
                        @csrf
                            <div class="form-row ">
                                <div class="col-md-5 m-auto">
                                    <div class="form-group">
                                        <label class="Large mb-1" for="inputFirstName">AddOn Name</label>
                                        <input class="form-control py-4" name="addon_name" type="text" placeholder="" value="{{ $addon->addon_name}}" required/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row ">
                                <div class="col-md-5 m-auto">
                                    <div class="form-group">
                                        <label class="Large mb-1" for="inputLastName">Price</label>
                                        <input class="form-control py-4" name="price" type="text" value="{{ $addon->price}}" required />
                                    </div>
                                </div>
                            </div>



                            <div class="form-row ">
                                <div class="col-md-5 m-auto">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label Large mb-1">AddOn Pic</label>

                                        <input class="form-control" type="file" name="image" id="formFile">
                                        <input class="form-control" type="hidden" name="image" id="formFile" value="{{ $addon->image }}" >
                                        <img width="130px" height="100px" src= "data:image/jpg;base64,  {{$addon->image}} ">
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