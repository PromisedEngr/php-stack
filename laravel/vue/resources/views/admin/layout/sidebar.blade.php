<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->

      <!-- <a href="index3.html" class="brand-link">

        <img src="{{URL::asset('public/admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">

        <span class="brand-text font-weight-light">AdminLTE 3</span>

      </a> -->



    <!-- Sidebar -->

    <div class="sidebar">

      <!-- Sidebar user panel (optional) -->

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="image">

          <img src="{{URL::asset('public/admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">

        </div>

        <div class="info">

          <a href="#" class="d-block">{{ Auth::user()->name }}</a>

        </div>

      </div>



      <!-- SidebarSearch Form -->

  

      <!-- Sidebar Menu -->

      <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @if(Auth::user()->role == 1 && Auth::user()->status == 'active')
         

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-search"></i>
              <p>
               Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.users')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Users</p>
                </a>
              </li>
            </ul>
          </li>

          @endif




      @if(Auth::user()->role == 0 && Auth::user()->status == 'active')

      <li class="nav-item">

        <a href="{{route('admin.dashboard')}}" class="nav-link">

          <i class="nav-icon fas fa-chart-pie"></i>

          <p>

          {{ Auth::user()->name }} Dashboard

            <!-- <i class="right fas fa-angle-left"></i> -->

          </p>

        </a>

        <!-- <ul class="nav nav-treeview">

          <li class="nav-item">

            <a href="pages/charts/chartjs.html" class="nav-link">

              <i class="far fa-circle nav-icon"></i>

              <p>ChartJS</p>

            </a>

          </li>

          <li class="nav-item">

            <a href="pages/charts/flot.html" class="nav-link">

              <i class="far fa-circle nav-icon"></i>

              <p>Flot</p>

            </a>

          </li>

          <li class="nav-item">

            <a href="pages/charts/inline.html" class="nav-link">

              <i class="far fa-circle nav-icon"></i>

              <p>Inline</p>

            </a>

          </li>

          <li class="nav-item">

            <a href="pages/charts/uplot.html" class="nav-link">

              <i class="far fa-circle nav-icon"></i>

              <p>uPlot</p>

            </a>

          </li>

        </ul> -->

      </li>

        <!-- <li class="nav-item">

          <a href="#" class="nav-link">

            <i class="nav-icon fas fa-table"></i>

            <p>

            General Settings

              <i class="fas fa-angle-left right"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">

              <a href="#" class="nav-link">

                <i class="far fa-circle nav-icon"></i>

                <p>Banner</p>

              </a>

            </li>

            

          </ul>

        </li> -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-bars"></i>
            <p>General Section</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.ocr_settings')}}" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>OCR Settings</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('admin.users')}}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Users</p>
          </a>
        </li>

        <li class="nav-item">

          <a href="{{route('admin.vendors')}}" class="nav-link">
            <!-- <i class="nav-icon fas fa-chart-pie"></i> -->
            <i class="nav-icon fas fa-users"></i>
            <p>
              Vendors
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.service_category')}}" class="nav-link">
            <!-- <i class="nav-icon fas fa-chart-pie"></i> -->
            <i class="nav-icon fas fa-stream"></i>
            <p>
              Service Category
            </p>
          </a>
        </li>
        <li class="nav-item">

          <a href="{{route('admin.configurations')}}" class="nav-link">

            <!-- <i class="nav-icon fas fa-chart-pie"></i> -->
            <i class="nav-icon fas fa-wrench"></i>
            <!-- <i class="fas fa-wrench"></i> -->
            <p>

              Configurations

            </p>

          </a>

        </li>
        <li class="nav-item">
          <a href="{{route('admin.blog')}}" class="nav-link">
            <i class="nav-icon fas fa-wrench"></i>
            <p>Blog</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>Country & State<i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="{{route('admin.country')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Country</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.state')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>State</p>
              </a>
            </li>
          </ul>
        </li>

      @endif



      <!-- Vendor Section -->

      @if(Auth::user()->role == 3 && Auth::user()->status == 'active')
            <li class="nav-item">

              <a href="{{route('vendar.profile')}}" class="nav-link">

                <i class="fas fa-user nav-icon"></i>

                <p>Vendor Profile</p>

              </a>

            </li> 


            <!-- <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i><p>Voucher<i class="fas fa-angle-left right"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('vendar.voucher')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Voucher</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('vendar.create_voucher')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Voucher</p>
                  </a>
                </li>
              </ul>
            </li> -->

           <li class="nav-item">

            <a href="#" class="nav-link">

            <i class="fas fa-tasks nav-icon"></i>

              <p>Your Tasker</p>

            </a>
          </li>


          <li class="nav-item">

          <a href="#" class="nav-link">

          <i class="fas fa-wallet nav-icon"></i>

            <p>My Wallet</p>

          </a>
          </li>


          <li class="nav-item">

          <a href="#" class="nav-link">
          <i class="fas fa-archive nav-icon"></i>

            <p>VIP Package</p>

          </a>
          </li>


          <li class="nav-item">

          <a href="#" class="nav-link">

          <i class="fas fa-tools nav-icon"></i>

            <p>Marketing Tools</p>

          </a>
          </li>



          <li class="nav-item">

          <a href="#" class="nav-link">

          <i class="fas fa-user nav-icon"></i>

            <p>My Profile</p>

          </a>
          </li>



          <li class="nav-item">

          <a href="#" class="nav-link">

          <i class="fas fa-address-book nav-icon"></i>

            <p>Report</p>

          </a>
          </li>

         @endif

        </ul>

      </nav>

      <!-- /.sidebar-menu -->

    </div>

    <!-- /.sidebar -->

  </aside>

