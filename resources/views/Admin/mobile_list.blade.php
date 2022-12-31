@extends('layouts.admin_master')
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Available Mobile
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <div class="btn btn-sm btn-info" style="margin-bottom:15px"> <a class="nav-link text-white" href="{{ url('/add-new-mobile') }}">Add New Mobile</a></div>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Model</th>
                        <th>Price</th>
                        <th>Pic</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                	@foreach($mobile as $row)
                    <tr>
                        <td>{{ $row->mobile_name }}</td>
                        <td>{{ $row->model }}</td>
                        <td>{{ $row->price }}</td>
                        <td><img width="50px" height="50px" src= "data:image/jpg;base64,  {{$row->image}} "></td>
                        <td>
                            <a href="{{route('mobile.edit', ['id' => $row->id] )}}" class="btn btn-sm btn-info">Edit</a>
                            <a href="{{route('mobile.delete', ['id' => $row->id] )}}" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection