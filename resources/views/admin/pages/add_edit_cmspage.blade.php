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
            <form name="cmsForm" id="cmsForm" 
              @if(empty($cmspage['id'])) 
                action="{{ url('admin/add-edit-cms-page') }}" 
              @else 
                action="{{ url('admin/add-edit-cms-page/'.$cmspage['id']) }}" 
              @endif 
              method="post">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" 
                  @if(!empty($cmspage['title'])) value="{{ $cmspage['title'] }}" @endif>
                </div>
                <div class="form-group">
                  <label for="url">URL</label>
                  <input type="text" class="form-control" id="url" name="url" placeholder="Enter URL" 
                  @if(!empty($cmspage['url'])) value="{{ $cmspage['url'] }}" @endif>
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" rows="3" id="description" name="description" placeholder="Enter description">@if(!empty($cmspage['description'])) {{ $cmspage['description'] }} @endif</textarea>
                </div>
                <div class="form-group">
                  <label for="meta_title">Meta Title</label>
                  <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter Meta Title" 
                  @if(!empty($cmspage['meta_title'])) value="{{ $cmspage['meta_title'] }}" @endif>
                </div>
                <div class="form-group">
                  <label for="meta_description">Meta Description</label>
                  <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Enter Meta Description" 
                  @if(!empty($cmspage['meta_description'])) value="{{ $cmspage['meta_description'] }}" @endif>
                </div>
                <div class="form-group">
                  <label for="meta_keywords">Meta Keywords</label>
                  <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Enter Meta Keywords" 
                  @if(!empty($cmspage['meta_keywords'])) value="{{ $cmspage['meta_keywords'] }}" @endif>
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