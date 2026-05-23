
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-secondary navbar-light text-sm" style="height:58px; background-color: #26618e !important;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-light" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link  text-light">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link text-light">Contact</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <!-- <li class="nav-item">
        <a class="nav-link text-light" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar text-light" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar text-light" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar text-light" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> -->

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link text-light" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link text-light" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
      <li class="nav-item hidden-mobile">
        <div class="user-panel  d-flex">
          <div class="image">
            <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            <span class="activedot"></span>
          </div>
          <div class="info">
            <a href="{{route('view-profile')}}" class="d-block text-white">{{$loginName}} (<?php if($loginRole == '0'){ ?> Admin <?php } else if($loginRole == '1'){ ?> Super Distributor <?php } else if($loginRole == '2'){ ?> Distributor  <?php }else if($loginRole == '3'){ ?> 
                       Topup Team <?php }else if($loginRole == '4'){ ?>  FOS <?php }else{ ?> Retailer <?php } ?> )</a>
          </div>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-secondary elevation-4" style="background-color: #021829 !important; height: 100vh !important;">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link text-light" style="background-color: #26618e !important;">
      <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-normal text-white">Global Account</span>
    </a>  

    <!-- Sidebar -->
    <div class="sidebar" style="position: relative !important; overflow-y: auto !important;">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


               <?php if($loginRole == '0'){ ?>

                <li class="nav-item">
                            <a href="{{route('dashboard')}}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                   User Management
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('add-user')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('view-user')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View User</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                           <li class="nav-item">
                            <a href="{{route('add-notes')}}" class="nav-link">
                                <i class="nav-icon fa fa-fw fa-bullhorn"></i>
                                <p>
                                   Notes
                                </p>
                            </a>
                        </li>
                                      <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-fw fa-credit-card"></i>
                                <p>
                                   Report
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('account-statement')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Account statement</p> 
                                </a>
                                </li>
                                   <li class="nav-item">
                                    <a href="{{route('topup-credit-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Topup Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('topup-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Debit Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('income-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Income Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('companywise-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Companywise Report</p>
                                    </a>
                                </li>
                                
                                 <li class="nav-item">
                                    <a href="{{route('total-retailer-topup')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pending Payment</p>
                                    </a>
                                </li>
                                  <li class="nav-item">
                                    <a href="{{route('total-fos-cc-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cash Collect By FOS</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

              <?php } else if($loginRole == '1'){ ?>
                <li class="nav-item">
                            <a href="{{route('sup-dashboard')}}"  class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                   User Management
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('add-user')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('view-user')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View User</p>
                                    </a>
                                </li>
                            </ul>
                        </li>



                <?php } else if($loginRole == '2'){ ?>

                    <li class="nav-item">
                            <a href="{{route('dist-dashboard')}}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                   User Management
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('add-user')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('view-user')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View User</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                   FOS
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('change-fos')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>FOS Assign</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('view-fos')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View FOS Assign</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-university"></i>
                                <p>
                                   Company
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('add-company')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Company</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('view-company')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Company</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-fw fa-battery-half"></i>
                                <p>
                                   Balance
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('add-adjust')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Balance</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('view-adjust')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Partner Balance</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-fw fa-percent"></i>
                                <p>
                                   Charges
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('add-charges')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Charges</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('view-charges')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-fw fa-credit-card"></i>
                                <p>
                                   Report
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('account-statement')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Account statement</p>
                                    </a>
                                </li>
                                  <li class="nav-item">
                                    <a href="{{route('topup-credit-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Topup Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('topup-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Debit Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('income-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Income Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('companywise-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Companywise Report</p>
                                    </a>
                                </li>
                                  <li class="nav-item">
                                    <a href="{{route('total-retailer-topup')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pending Payment</p>
                                    </a>
                                </li>
                                   <li class="nav-item">
                                    <a href="{{route('total-fos-cc-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cash Collect By FOS</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                   <?php } else if($loginRole == '3'){ ?>
                    <li class="nav-item">
                            <a href="{{route('tt-dashboard')}}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-fw fa-hand-pointer"></i>
                                <p>
                                   Topup Management
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <!-- <li class="nav-item">
                                    <a href="{{route('add-topup-request')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Credit Topup</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('debit-payment')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Debit Topup</p>
                                    </a>
                                </li> -->
                                <li class="nav-item">
                                    <a href="{{route('view-topup')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Topup</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-fw fa-credit-card"></i>
                                <p>
                                   Payment Management
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('view-pending-payment')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pending Bills</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('view-collect')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Payment Done</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('dashboard')}}" class="nav-link">
                                <i class="nav-icon fa fa-fw fa-credit-card"></i>
                                <p>
                                   Report
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('account-statement')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Account statement</p>
                                    </a>
                                </li>
                                  <li class="nav-item">
                                    <a href="{{route('topup-credit-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Topup Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('topup-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Debit Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('income-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Income Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('companywise-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Companywise Report</p>
                                    </a>
                                </li>
                                  <li class="nav-item">
                                    <a href="{{route('total-retailer-topup')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pending Payment</p>
                                    </a>
                                </li>
                                   <li class="nav-item">
                                    <a href="{{route('total-fos-cc-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cash Collect By FOS</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php } else if($loginRole == '4'){ ?>
                            <li class="nav-item">
                            <a href="{{route('fos-dashboard')}}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-fw fa-credit-card"></i>
                                <p>
                                   Payment Management
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('view-pending-payment')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pending Bills</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('view-collect')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Payment Done</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-fw fa-credit-card"></i>
                                <p>
                                   Report
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('account-statement')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Account statement</p>
                                    </a>
                                </li>
                                  <li class="nav-item">
                                    <a href="{{route('topup-credit-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Topup Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('topup-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Debit Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('income-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Income Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('companywise-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Companywise Report</p>
                                    </a>
                                </li>
                                  <li class="nav-item">
                                    <a href="{{route('total-retailer-topup')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pending Payment</p>
                                    </a>
                                </li>
                                   <li class="nav-item">
                                    <a href="{{route('total-fos-cc-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cash Collect By FOS</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        
                        <?php } else if($loginRole == '5'){ ?>
                            <li class="nav-item">
                            <a href="{{route('ret-dashboard')}}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                            <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-fw fa-hand-pointer"></i>
                                <p>
                                   Topup Management
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('add-topup-request')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Credit Topup</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('debit-payment')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Debit Topup</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('view-topup')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Topup</p>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-fw fa-credit-card"></i>
                                <p>
                                   Payment Management
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('view-pending-payment')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pending Bills</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('view-collect')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Payment Done</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-fw fa-credit-card"></i>
                                <p>
                                   Report
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('account-statement')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Account statement</p>
                                    </a>
                                </li>
                                  <li class="nav-item">
                                    <a href="{{route('topup-credit-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Topup Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('topup-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Debit Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('income-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Income Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('companywise-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Companywise Report</p>
                                    </a>
                                </li>
                                 <li class="nav-item">
                                    <a href="{{route('total-retailer-topup')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pending Payment</p>
                                    </a>
                                </li>
                                   <li class="nav-item">
                                    <a href="{{route('total-fos-cc-report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cash Collect By FOS</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <?php } ?>

                        <li class="nav-item">
                            <a href="{{route('logout')}}" class="nav-link">
                                <i class="nav-icon fa fa-fw fa-power-off"></i>
                                <p>
                                   Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
