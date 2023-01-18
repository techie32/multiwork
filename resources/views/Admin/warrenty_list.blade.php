@extends('layouts.admin_master')
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Available Warrenty
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <div class="btn btn-sm btn-info" style="margin-bottom:15px"> <a class="nav-link text-white" href="{{ url('/add-new-warrenty') }}">Add New Warrenty</a></div>
                <thead>
                    <tr>
                        <th>Sno</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                	@foreach($warrenty as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->price }}</td>
                    
                        <td>
                            <a href="{{route('warrenty.edit', ['id' => $row->id] )}}" class="btn btn-sm btn-info custom-btn">Edit</a>
                            <a href="{{route('warrenty.delete', ['id' => $row->id] )}}" class="btn btn-sm btn-danger custom-btn">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection