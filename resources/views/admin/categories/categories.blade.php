@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Categories</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Categories</li>
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
              <h3 class="card-title">Categories</h3>
              <a style="max-width: 150px; float:right; display: inli ne-block;" class="btn btn-block btn-primary" href="{{ url('admin/add-edit-category') }}">Add Categories</a>
            </div>
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Parent Category</th>
                    <th>URL</th>
                    <th>Created on</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($categories as $category)
                  <tr>
                    <td>{{ $category['id'] }}</td>
                    <td>{{ $category['category_name'] }}</td>
                    <td>
                      @if(isset($category['parentCategory']['category_name']))
                      {{ $category['parentCategory']['category_name'] }}
                      @endif
                    </td>
                    <td>{{ $category['url'] }}</td>
                    <td>{{ date("F j, Y, g:i a", strtotime($category['created_at'])); }}</td>
                    <td>
                      @if($category['status']==1)
                      <a class="updateCategoryStatus" id="category-{{ $category['id'] }}" category_id="{{ $category['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-on" status="Active"></i></a>
                      @else
                      <a class="updateCategoryStatus" id="category-{{ $category['id'] }}" category_id="{{ $category['id'] }}" style="color:grey" href="javascript:void(0)"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                      @endif
                      &nbsp;&nbsp;
                      <a href="{{ url('admin/add-edit-category/'.$category['id']) }}"><i class="fas fa-edit"></i></a>
                      &nbsp;&nbsp;
                      <a style="color:#E74C3C" class="confirmDelete" name="category" title="Delete Category" record="category" recordid="{{ $category['id'] }}"><i class="fas fa-trash"></i></a>
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