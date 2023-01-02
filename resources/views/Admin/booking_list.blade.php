@extends('layouts.admin_master')
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Booking List
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <div class=" text-center" style="margin-bottom:15px"> <h5 class="">Booking List </h5> </div>
                <thead>
                <tr>
                        <th>zip_code</th>
                        <th>service_type</th>
                        <th>model</th>
                        <th>device_issue_name</th>
                        <th>device_issue_description</th>
                        <th>screen_color</th>
                        <th>warrenty</th>
                        <th>charge_cable</th>
                        <th>date</th>
                        <th>time</th>
                        <th>address</th>
                        <th>unit_floor</th>
                        <th>name</th>
                        <th>phone</th>
                        <th>email</th>
                        <th>total price</th>
                    </tr>
                </thead>
                
                <tbody>
                	@foreach($bookings as $row)
                    <tr>
                        <td>{{ $row->zip_code }}</td>
                        <td>{{ $row->service_type }}</td>
                        <td>{{ $row->model }}</td>
                        <td>{{ $row->device_issue_name }}</td>
                        <td>{{ $row->device_issue_description }}</td>
                        <td>{{ $row->screen_color }}</td>
                        <td>{{ $row->warrenty }}</td>
                        <td>{{ $row->charger_cable }}</td>
                        <td>{{ $row->date }}</td>
                        <td>{{ $row->time }}</td>
                        <td>{{ $row->address }}</td>
                        <td>{{ $row->unit_floor }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->phone }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->total_price }}</td>
                        <td>
                            
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection