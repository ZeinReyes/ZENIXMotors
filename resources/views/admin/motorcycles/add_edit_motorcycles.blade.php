@extends('admin.layout.layout')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $title }}</h3>
                        </div>
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form name="motorcyclesForm" id="motorcyclesForm"
                            @if(empty($motorcycles['id']))
                            action="{{ url('admin/add-edit-motorcycles') }}"
                            @else
                            action="{{ url('admin/add-edit-motorcycles/'.$motorcycles['id']) }}"
                            @endif
                            method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"
                                        @if(!empty($motorcycles['name'])) value="{{ $motorcycles['name'] }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price"
                                        @if(!empty($motorcycles['price'])) value="{{ $motorcycles['price'] }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                    @if(!empty($motorcycles['image']))
                                    <img src="{{ url('frontend/images/motorcycles/'.$motorcycles['image']) }}" alt="Accessory Image" style="width: 100px; margin-top: 10px;">
                                    <p>Current Image</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="3" id="description" name="description" placeholder="Enter description">@if(!empty($motorcycles['description'])) {{ $motorcycles['description'] }} @endif</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="engine_type">Engine Type</label>
                                    <input type="text" class="form-control" id="engine_type" name="engine_type" placeholder="Enter Engine Type"
                                        @if(!empty($motorcycles['engine_type'])) value="{{ $motorcycles['engine_type'] }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="displacement">Displacement</label>
                                    <input type="text" class="form-control" id="displacement" name="displacement" placeholder="Enter Displacement"
                                        @if(!empty($motorcycles['displacement'])) value="{{ $motorcycles['displacement'] }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="top_speed">Top Speed</label>
                                    <input type="text" class="form-control" id="top_speed" name="top_speed" placeholder="Enter Top Speed"
                                        @if(!empty($motorcycles['top_speed'])) value="{{ $motorcycles['top_speed'] }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="fuel_capacity">Fuel Capacity</label>
                                    <input type="text" class="form-control" id="fuel_capacity" name="fuel_capacity" placeholder="Enter Fuel Capacity"
                                        @if(!empty($motorcycles['fuel_capacity'])) value="{{ $motorcycles['fuel_capacity'] }}" @endif>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection