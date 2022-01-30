@extends('layouts.master')

@section('content')
   
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Order Confirm Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <ol class="breadcrumb float-sm-right">
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
                      <th>Dish Name</th>
                      <th>Table</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>

                    <tbody>
                      @foreach ($orders as $order)
                      <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->dish->name }}</td>
                        <td>{{ $order->table_id }}</td>
                        <td>{{ $status[$order->status] }}</td>
                        <td>
                          <a href="{{ route('kitchen.approve', $order->id) }}" type="button" class="btn btn-warning">Approve</a>
                          <a href="{{ route('kitchen.cancel', $order->id) }}" type="button" class="btn btn-danger" onclick="return confirm('Are you want to delete this item?')";>Cancel</a>
                          <a href="{{ route('kitchen.ready', $order->id) }}" type="button" class="btn btn-success">Ready</a>
                        </td>
                        </div>
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
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
      });
    });
  
  </script>
@endsection





