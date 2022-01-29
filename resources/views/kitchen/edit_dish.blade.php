@extends('layouts.master')

@section('content')
   
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Dish</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              {{-- <a href="" type="button" class="btn btn-default">Create</a> --}}
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('dish.update', $dish->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $dish->name) }}">
                  </div>

                  <div class="form-group mt-3">
                    <label for="">Category</label>
                    <select name="category" class="form-control">
                      <option value="">Select Category</option>
                      @foreach ($cats as $cat)
                      <option value="{{ $cat->id }}" {{ $cat->id == $dish->category_id ? 'selected' : '' }}>{{ $cat->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  
                  <div class="form-group mt-3">
                    <label for="">Image</label>
                    <input type="file" name="image" class="form-control mb-3">
                    <img src="{{ asset('images/dishes/'.$dish->image)}}" alt="" width="300px" height="200px"><br><br>
                  </div>

                  <div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('dish.index') }}" type="button" class="btn btn-info">Back</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->

@endsection





