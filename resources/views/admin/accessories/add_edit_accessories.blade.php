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
                        <form name="accessoriesForm" id="accessoriesForm"
                            @if(empty($accessories['id']))
                            action="{{ url('admin/add-edit-accessories') }}"
                            @else
                            action="{{ url('admin/add-edit-accessories/'.$accessories['id']) }}"
                            @endif
                            method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"
                                        @if(!empty($accessories['name'])) value="{{ $accessories['name'] }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                    @if(!empty($accessories['image']))
                                    <img src="{{ url('frontend/images/accessories/'.$accessories['image']) }}" alt="Accessory Image" style="width: 100px; margin-top: 10px;">
                                    <p>Current Image</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price"
                                        @if(!empty($accessories['price'])) value="{{ $accessories['price'] }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="3" id="description" name="description" placeholder="Enter description">@if(!empty($accessories['description'])) {{ $accessories['description'] }} @endif</textarea>
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