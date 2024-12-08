@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Accessories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Accessories</li>
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
                            <h3 class="card-title">Accessories</h3>
                            <a style="max-width: 150px; float:right; display: inli ne-block;" class="btn btn-block btn-primary" href="{{ url('admin/add-edit-accessories') }}">Add Accessories</a>
                        </div>
                        <div class="card-body">
                            <table id="categories" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($accessories as $accessory)
                                    <tr>
                                        <td>{{ $accessory['id'] }}</td>
                                        <td>{{ $accessory['name'] }}</td>
                                        <td>
                                            @if(!empty($accessory['image']))
                                            <img src="{{ asset('frontend/images/accessories/'.$accessory['image']) }}" alt="Accessory Image" style="width: 100px; height: auto;">
                                            @else
                                            <p>No Image</p>
                                            @endif
                                        </td>
                                        <td>{{ $accessory['price'] }}</td>
                                        <td>{{ $accessory['description'] }}</td>
                                        <td>
                                            @if($accessory['status'] == 1)
                                            <a class="updateAccessoriesStatus" id="accessories-{{ $accessory['id'] }}" accessories_id="{{ $accessory['id'] }}" href="javascript:void(0)">
                                                <i class="fas fa-toggle-on" status="Active"></i>
                                            </a>
                                            @else
                                            <a class="updateAccessoriesStatus" id="accessories-{{ $accessory['id'] }}" accessories_id="{{ $accessory['id'] }}" style="color:grey" href="javascript:void(0)">
                                                <i class="fas fa-toggle-off" status="Inactive"></i>
                                            </a>
                                            @endif
                                            &nbsp;&nbsp;
                                            <a href="{{ url('admin/add-edit-accessories/'.$accessory['id']) }}"><i class="fas fa-edit"></i></a>
                                            &nbsp;&nbsp;
                                            <a style="color:#E74C3C" class="confirmDelete" name="accessories" title="Delete Accessories" record="accessories" recordid="{{ $accessory['id'] }}"><i class="fas fa-trash"></i></a>
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