<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<body>
    <div class="container-fluid mt-3">
        <div class="card">
            <div class="card-body">
                <!-- ./row -->
                <div class="row">
                    <div class="col-12">
                      <h4>Waiter Panel</h4>
                    </div>
                  </div>
                  <!-- ./row -->
                  <div class="row">
                    <div class="col-12 col-sm-6 col-lg-12">
                      <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                          <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">New Order</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Order List</a>
                            </li>
                          </ul>
                        </div>
                        @if (session('message'))
                          <div class="alert alert-success">
                              {{ session('message') }}
                          </div>
                        @endif
                        <div class="card-body">
                          <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">   
                              <div class="d-flex bd-highlight mb-3">
                                <div class="mr-auto p-2 bd-highlight"><h1>Order Form</h1></div>
                                <div class="p-2 bd-highlight">
                                  {{-- <div class="input-group rounded">
                                    <form action="{{ url('/search/order') }}" method="GET" role="search">
                                      @csrf
                                      <input type="search" class="form-control rounded" name="search" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                      <span class="input-group-text border-0" id="search-addon">
                                        <i class="fas fa-search"></i>
                                      </span>
                                    </form>
                                  </div> --}}
                                </div>
                              </div>
                              
                              <form action="{{ route('order.submit') }}" method="POST">
                                @csrf
                                <div class="row">
                                  @foreach ($dishes as $dish)
                                    <div class="col-md-3 mt-5">
                                        <div class="card-deck">
                                            <div class="card">
                                              <img class="card-img-top" src="{{ asset('images/dishes/'.$dish->image )}}" width="100" height="200" alt="Card image cap">
                                              <div class="card-body">
                                                <h5 class="card-title"><b>{{ $dish->name }}</b></h5><br>
                                                <h3><b>$ {{ $dish->price }}</b></h3><br>
                                                <label for="">Quantity: </label>
                                                <input type="number" class="from-control" name="{{ $dish->id }}">
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                  @endforeach
                               </div>

                               <div class="form-group mt-3 col-md-4">
                                 <label for="">Table</label>
                                 <select name="table" id="" class="form-control">
                                   @foreach ($tables as $table)
                                      <option value="{{ $table->id }}">{{ $table->number }}</option>
                                   @endforeach
                                 </select>
                               </div>
                               <button type="submit" class="btn btn-info mt-3">Order</button>
                              </form>
                            </div>

                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                              <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Dish Name</th>
                                    <th scope="col">Table Number</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                  </tr>
                                </thead>
                                <tbody>
                                 @foreach ($orders as $order)
                                    <tr>
                                      <td>{{ $order->id }}</td>
                                      <td>{{ $order->dish->name }}</td>
                                      <td>{{ $order->table_id }}</td>
                                      <td>{{ $status[$order->status]}}</td>
                                      <td><a href="{{ route('kitchen.serve', $order->id) }}" type="button" class="btn btn-primary">Serve</a></td>
                                    </tr>
                                 @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <!-- /.card -->
                      </div>
                    </div>
                  </div>
                  <!-- /.row -->
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>
    <!-- DataTables  & /plugins -->
    <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
</body>
</html>