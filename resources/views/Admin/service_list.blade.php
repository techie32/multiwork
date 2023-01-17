@extends('layouts.admin_master')
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Available Services
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <div class="btn btn-sm btn-info" style="margin-bottom:15px"> <a class="nav-link text-white" href="{{ url('/add-new-service') }}">Add New Service</a></div>
                <thead>
                    <tr>
                        <th>Sno</th>
                        <th>Service Name</th>
                        <th>Pic</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                	@foreach($service as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->service_name }}</td>
                      
                        <td><img width="50px" height="50px" src= "data:image/jpg;base64,  {{$row->image}} "></td>
                        <td>
                            <a href="{{route('service.edit', ['id' => $row->id] )}}" class="btn btn-sm btn-info custom-btn">Edit</a>
                            <a href="{{route('service.delete', ['id' => $row->id] )}}" class="btn btn-sm btn-danger custom-btn">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection