@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Update Mobile</h3></div>
                    <div class="card-body">
                        <form method="POST" action="{{URL::to('update-coupon/'.$coupon->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-5 m-auto">
                                    <div class="form-group">
                                        <label class="Large mb-1" for="inputFirstName">Coupon Code</label>
                                        <input class="form-control py-4" name="coupon_code" type="text"  value="{{ $coupon->coupon_code}}" placeholder="" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-5 m-auto">
                                    <div class="form-group">
                                        <label class="Large mb-1" for="inputLastName">Amount</label>
                                        <input class="form-control py-4" name="amount" type="text" value="{{ $coupon->amount}}" placeholder="" required />
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