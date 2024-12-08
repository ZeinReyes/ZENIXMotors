@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Motorcycles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Motorcycles</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if(Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success:</strong> {{ Session::get('success_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Motorcycles</h3>
                            <a style="max-width: 150px; float:right; display: inli ne-block;" class="btn btn-block btn-primary" href="{{ url('admin/add-edit-motorcycles') }}">Add Motorcycles</a>
                        </div>
                        <div class="card-body">
                            <table id="categories" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Engine Type</th>
                                        <th>Displacement</th>
                                        <th>Top Speed</th>
                                        <th>Fuel Capacity</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($motorcycles as $motorcycle)
                                    <tr>
                                        <td>{{ $motorcycle['id'] }}</td>
                                        <td>{{ $motorcycle['name'] }}</td>
                                        <td>{{ $motorcycle['price'] }}</td>
                                        <td>
                                            @if(!empty($motorcycle['image']))
                                            <img src="{{ asset('frontend/images/motorcycles/'.$motorcycle['image']) }}" alt="" style="width: 100px; height: auto;">
                                            @else
                                            <p>No Image</p>
                                            @endif
                                        </td>
                                        <td>{{ $motorcycle['description'] }}</td>
                                        <td>{{ $motorcycle['engine_type'] }}</td>
                                        <td>{{ $motorcycle['displacement'] }}</td>
                                        <td>{{ $motorcycle['top_speed'] }}</td>
                                        <td>{{ $motorcycle['fuel_capacity'] }}</td>
                                        <td>
                                            @if($motorcycle['status']==1)
                                            <a class="updateMotorcyclesStatus" id="motorcycles-{{ $motorcycle['id'] }}" motorcycles_id="{{ $motorcycle['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-on" status="Active"></i></a>
                                            @else
                                            <a class="updateMotorcyclesStatus" id="motorcycles-{{ $motorcycle['id'] }}" motorcycles_id="{{ $motorcycle['id'] }}" style="color:grey" href="javascript:void(0)"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                            @endif
                                            &nbsp;&nbsp;
                                            <a href="{{ url('admin/add-edit-motorcycles/'.$motorcycle['id']) }}"><i class="fas fa-edit"></i></a>
                                            &nbsp;&nbsp;
                                            <a style="color:#E74C3C" class="confirmDelete" name="motorcycles" title="Delete Motorcycle" record="motorcycle" recordid="{{ $motorcycle['id'] }}"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection