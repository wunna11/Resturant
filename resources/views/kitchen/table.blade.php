@extends('layouts.master')

@section('content')
   
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Table</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <ol class="breadcrumb float-sm-right">
              <a href="{{ route('table.create') }}" type="button" class="btn btn-default">Create</a>
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
                <table id="dish" class="table table-bordered table-striped dishes">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Number</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
  
                      <tbody>
                        @foreach ($tables as $table)
                        <tr>
                          <td>{{ $table->id }}</td>
                          <td>{{ $table->number }}</td>
                          <td>
                            <div class="form-row">
                              <a href="{{ route('table.edit', $table->id) }}" type="button" class="btn btn-warning" style="height: 40px; margin-right: 10px;">Edit</a>
                              <form action="{{ route('table.destroy', $table->id )}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you want to delete this item?');">Delete</button>
                              </form>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>                      
                  </table>
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


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
  <script>
    $( document ).ready(function() {
      $('#dish').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
      });
    });
  
  </script>
@endsection





