        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard')}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route('admin.dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
           <div class="sidebar-heading">Interface</div>

            <!-- Nav Item - Pages Collapse Menu -->
          

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Users</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">USERS</h6>
                        <a class="collapse-item" href="{{route('view-users')}}">View Users</a>
                        {{-- <a class="collapse-item" href="#">View Editors</a> --}}
                        <a class="collapse-item" href="{{route('view-roles')}}">User Roles</a>


                    </div>
                </div>
            </li>

             <!-- Nav Item - Single Page Menu -->
             
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('product')}}">
                    <i class="fas fa-camera"></i>
                    <span>Products</span>
                </a>
            </li>

            
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsefour"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Inventory</span>
                </a>
                <div id="collapsefour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">INVENTORY</h6>
                        <a class="collapse-item" href="{{route('inventory')}}">Inventory In</a>
                        <a class="collapse-item" href="{{route('all-inventory')}}">Overall Inventory</a>
                        <a class="collapse-item" href="{{route('faulty-inventory')}}">Faulty Inventory</a>
                        <a class="collapse-item" href="{{route('return-inventory')}}">Return Inventory</a>
                        <a class="collapse-item" href="{{route('inventory-status')}}">Inventory Status</a>


                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('suppliers')}}">
                    <i class="fas fa-truck"></i>
                    <span>Suppliers</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('warehouses')}}">
                    <i class="fas fa-home"></i>
                    <span>WareHouses</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('stores')}}">
                    <i class="fas fa-store"></i>
                    <span>Stores</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Orders</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">ORDERS</h6>
                        <a class="collapse-item" href="{{route('all-orders')}}">All Orders</a>
                        <a class="collapse-item" href="{{route('remaining-orders')}}">Remaining Orders</a>
                        <a class="collapse-item" href="{{route('dispatch-orders')}}">Dispatched Orders</a>
                        <a class="collapse-item" href="{{route('dispatch-centers')}}">Dispatched Centers</a>

                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

           

        </ul>
        <!-- End of Sidebar -->