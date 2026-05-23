@include('component.head')
@include('component.header')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="height: max-content !important; max-height: max-content !important; min-height: calc(100vh - calc(3.5rem + 1px) - calc(3.5rem + 1px)) !important;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v3</li> -->
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
        <div class="col-md-12">
              <div class="card-default">
              <!-- /.card-header -->
              <div class="card-body">
                @if($note && $note->message1)
                <div class="callout callout-danger">
                  <h5><i class="fas fa-bullhorn"></i> {{$note->message1 ?? ''}}</h5>
                </div>
                @endif
                @if($note && $note->message2)
                <div class="callout callout-success">
                  <h5><i class="fas fa-bullhorn"></i> {{$note->message2 ?? ''}}</h5>
                </div>
                @endif
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <a class="col-12 col-sm-6 col-md-4" style="cursor:pointer; color: black;" href="#">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Members</span>
                <span class="info-box-number">{{$total_member}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <a class="col-12 col-sm-6 col-md-4" style="cursor:pointer; color: black;" href="#">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-secret"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">FOS</span>
                <span class="info-box-number">{{$total_fos}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>

          <a class="col-12 col-sm-6 col-md-4" style="cursor:pointer; color: black;" href="#">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Topup Team</span>
                <span class="info-box-number">
                {{$total_tt}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
          <!-- /.col -->
          <a class="col-12 col-sm-6 col-md-3" style="cursor:pointer; color: black;" href="#">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-child"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Retailers</span>
                <span class="info-box-number">{{$total_ret}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <a class="col-12 col-sm-6 col-md-3" style="cursor:pointer; color: black;" href="#">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-network-wired"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Companies</span>
                <span class="info-box-number">{{$company}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>


          <!-- /.col -->
             <!-- /.col -->
             <a class="col-12 col-sm-6 col-md-3" style="cursor:pointer; color: black;" href="#">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-print"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Recharge</span>
                <span class="info-box-number">{{$recharge}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
          <!-- /.col -->

             <!-- /.col -->
             <a class="col-12 col-sm-6 col-md-3" style="cursor:pointer; color: black;" href="#">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-print"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Monthly Recharge</span>
                <span class="info-box-number">{{$month_recharge}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-7">
            <div class="card p-2" id="bar">
                <h5 class="pl-3 pt-2">Credit VS Debit</h5>
              <div id="chart"></div>
                       <script>
                  var options = {
                    series: [{
                    data: [<?php foreach ($total_amt as $total_amts) {
                          echo $total_amts->order_amt . ',';
                        }; ?>]
                  }, {
                    data: [<?php foreach ($paid_amt as $paid_amts) {
                          echo $paid_amts->paid_amt . ',';
                        }; ?>]
                  }],
                    chart: {
                    type: 'bar',
                    height: 430
                  },
                  plotOptions: {
                    bar: {
                      horizontal: false,
                      dataLabels: {
                        position: 'top',
                      },
                    }
                  },
                  dataLabels: {
                    enabled: true,
                    offsetX: 0,
                    offsetY: -15,
                    style: {
                      fontSize: '12px',
                      colors: ['#000000']
                    }
                  },
                  stroke: {
                    show: true,
                    width: 1,
                    colors: ['#fff']
                  },
                  tooltip: {
                    shared: true,
                    intersect: false
                  },
                  xaxis: {
                  categories: [<?php foreach ($total_amt as $total_amts) {
                  $dateStr = $total_amts->month;
                  $date = DateTime::createFromFormat('Y-m', $dateStr);
                  $monthName = $date->format('F');
                   echo "'" . $monthName . "',";
                                }; ?>
            ],
                  },
                  };
                  var chart = new ApexCharts(document.querySelector("#chart"), options);
                  chart.render();
              </script>
            </div>
          </div>
          <div class="col-12 col-md-5">
            <div class="card p-2" id="pie">
                <h5 class="pl-3 pt-2">Recharge Company Wise</h5>
                <div id="chart2" ></div>
                <script>
                    var options = {
                      series: [<?php foreach ($companyrecharge as $companyrecharges) {
                          echo $companyrecharges->total_amount . ',';
                        }; ?>],
                      chart: {
                        toolbar: {
                          show: true,
                          tools: {
                              download: true,
                            },
                        },
                      width: '100%',
                      type: 'donut',
                    },
                    dataLabels: {
                      enabled: true,
                    },
                    fill: {
                      type: 'gradient',
                    },
                    legend: {
                      position: 'bottom'
                    },
                    labels: [<?php foreach ($companyrecharge as $companyrecharges) {
                    $comname =   DB::table('companies')->where('id', $companyrecharges->company_id)->first();
                                echo "'" . $comname->name . "',";
                              }; ?>],
                    responsive: [{
                      breakpoint: 480,
                        options: {
                          chart: {
                            width: '80%'
                          },
                        }
                    }]
                    };
                    var chart = new ApexCharts(document.querySelector("#chart2"), options);
                    chart.render();

                    let bar = document.getElementById('bar').clientHeight;
                    bar = parseFloat(bar).toFixed(2);
                    console.log(bar);
                    document.getElementById('pie').setAttribute("style",`height:${bar}px`);
                </script>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5>New members</h5>
              </div>
              <div class="card-body ">
                <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Document Detail</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($user as $users)
                  <tr>
                    <td>{{$users->name}}</td>
                    <td><?php if($users->role == '1'){ ?> Super Distributor <?php } else if($users->role == '2'){ ?> Distributor  <?php }else if($users->role == '3'){ ?> 
                       Topup Team <?php }else if($users->role == '4'){ ?>  FOS <?php }else{ ?> Retailes <?php } ?> </td>
                    <td>{{$users->email}} / {{$users->phone}} / {{$users->whatsapp}}</td>
                    <td>{{$users->shop}} / {{$users->address}} / {{$users->per_address}}</td>
                    <td>{{$users->adhaar}} / {{$users->pan}}</td>
                  </tr>
                @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Document Detail</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('component.footer')