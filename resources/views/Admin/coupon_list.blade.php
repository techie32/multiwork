@extends('layouts.admin_master')
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Available Coupon
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <div class="btn btn-sm btn-info" style="margin-bottom:15px"> <a class="nav-link text-white" href="{{ url('/add-new-couponcode') }}">Add New Coupon</a></div>
                <thead>
                    <tr>
                        <th>Coupon Code</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                	@foreach($coupon as $row)
                    <tr>
                        <td>{{ $row->coupon_code }}</td>
                        <td>{{ $row->amount }}</td>
                        <td>
                            <a href="{{route('coupon.edit', ['id' => $row->id] )}}" class="btn btn-sm btn-info">Edit</a>
                            <a href="{{route('coupon.delete', ['id' => $row->id] )}}" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection