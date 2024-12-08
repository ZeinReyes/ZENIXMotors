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
                        <form name="categoryForm" id="categoryForm"
                            @if(empty($category['id']))
                            action="{{ url('admin/add-edit-category') }}"
                            @else
                            action="{{ url('admin/add-edit-category/'.$category['id']) }}"
                            @endif
                            method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category_name">Category Name</label>
                                    <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter Category Name"
                                        @if(!empty($category['category_name'])) value="{{ $category['category_name'] }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="category_name">Category Level</label>
                                    <select name="parent_id" class="form-control">
                                        <option value="">Select</option>
                                        <option value="0" @if($category['id'] == 0) selected="" @endif>Main Category</option>
                                        @foreach($getCategories as $getCategory)
                                            <option @if(isset($category['parent_id']) && $category['parent_id'] == $getCategory['id']) selected @endif value="{{ $getCategory['id'] }}">{{ $getCategory['category_name'] }}</option>
                                            @if(!empty($getCategory['sub_categories']))
                                                @foreach($getCategory['sub_categories'] as $subCategory)
                                                    <option @if(isset($category['parent_id']) && $category['parent_id'] == $subCategory['id']) selected @endif value="{{ $subCategory['id'] }}">&nbsp;&nbsp;&raquo;{{ $subCategory['category_name'] }}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="category_discount">Category Discount</label>
                                    <input type="text" class="form-control" id="category_discount" name="category_discount" placeholder="Enter Category Discount"
                                        @if(!empty($category['category_discount'])) value="{{ $category['category_discount'] }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="url">URL</label>
                                    <input type="text" class="form-control" id="url" name="url" placeholder="Enter URL"
                                        @if(!empty($category['url'])) value="{{ $category['url'] }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="category_description">Category Description</label>
                                    <textarea class="form-control" rows="3" id="category_description" name="category_description" placeholder="Enter category description">@if(!empty($category['category_description'])) {{ $category['category_description'] }} @endif</textarea>
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