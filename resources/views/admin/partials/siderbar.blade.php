<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('homes.index')}}" class="brand-link">
        <img src="{{asset($company->logo)}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">LIZARDON</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('adminlte/dist/img/admin6.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('homes.index')}}" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-header">Bán hàng tại quán</li>
                <li class="nav-item">
                    <a href="{{ route('bills.index') }}" class="nav-link {{Request::is('admin/bills/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>
                            Hóa đơn
                            <span class="badge badge-info right">{{$bill_count_payment}}</span>
                            <span class="badge badge-info right">{{$bill_count_activated}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-header">Quản lý hóa đơn giao hàng</li>
                <li class="nav-item">
                    <a href="{{ route('contacts.index') }}" class="nav-link {{Request::is('admin/contacts/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>
                            Khách hàng gọi ship
                            <span class="badge badge-info right">{{$contact_count}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contacts.bill') }}" class="nav-link {{Request::is('admin/contactbills/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>
                            Hóa đơn giao hàng
                            <span class="badge badge-info right">{{$contactbill_count}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-header">Quản lý hóa đơn đặt bàn</li>
                <li class="nav-item">
                    <a href="{{ route('sets.index') }}" class="nav-link {{Request::is('admin/sets/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-blender-phone"></i>
                        <p>
                            Khách hàng đặt bàn
                            <span class="badge badge-info right">{{$set_count_status}}</span>
                            <span class="badge badge-info right">{{$set_count_activated}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sets.bill') }}" class="nav-link {{Request::is('admin/setbills/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-blender-phone"></i>
                        <p>
                            Hóa đơn đặt bàn
                            <span class="badge badge-info right">{{$setbill_count_payment}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-header">Quản lý hóa đơn đặt online</li>
                <li class="nav-item">
                    <a href="{{ route('order.index') }}" class="nav-link {{Request::is('admin/order/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>
                            Hóa đơn
                        </p>
                    </a>
                </li>
                <li class="nav-header">Quản lý nhân viên</li>
                <li class="nav-item">
                    <a href="{{ route('positions.index') }}" class="nav-link {{Request::is('admin/positions/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-fist-raised"></i>
                        <p>
                            Chức vụ
                            <span class="badge badge-info right">{{$position_count}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('personnels.index') }}" class="nav-link {{Request::is('admin/personnels/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-people-carry"></i>
                        <p>
                            Nhân viên
                            <span class="badge badge-info right">{{$personnel_count}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-header">Quản lý danh mục</li>
                <li class="nav-item">
                    <a href="{{route('categories.index')}}" class="nav-link {{Request::is('admin/categories/*') ? 'active' : ''}}">
                        <i class="nav-icon far fas fa-quran"></i>
                        <p>
                            Danh mục
                            <span class="badge badge-info right">{{$category_count}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-header">Quản lý kho</li>
                <li class="nav-item">
                    <a href="{{ route('dishs.index') }}" class="nav-link {{Request::is('admin/dishs/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-pepper-hot"></i>
                        <p>
                            Món ăn
                            <span class="badge badge-info right">{{$dish_count}}</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('ingredients.index') }}" class="nav-link {{Request::is('admin/ingredients/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-utensils"></i>
                        <p>
                            Nguyên liệu
                            <span class="badge badge-info right">{{$ingredient_count}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('recipes.index') }}" class="nav-link {{Request::is('admin/recipes/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-concierge-bell"></i>
                        <p>
                            Công thức
                            <span class="badge badge-info right">{{$recipe_count}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-header">Quản lý bàn ăn</li>
                <li class="nav-item">
                    <a href="{{ route('tables.index') }}" class="nav-link {{Request::is('admin/tables/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Bàn ăn
                            <span class="badge badge-info right">{{$table_count}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-header">Quản lý hình ảnh</li>
                <li class="nav-item">
                    <a href="{{ route('blogs.index') }}" class="nav-link {{Request::is('admin/blogs/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-camera-retro"></i>
                        <p>
                            Hình ảnh
                            <span class="badge badge-info right">{{$blog_count}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-header">Quản lý tin tức</li>
                <li class="nav-item">
                    <a href="{{ route('posts.index') }}" class="nav-link {{Request::is('admin/posts/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-book-reader"></i>
                        <p>
                            Tin tức
                            <span class="badge badge-info right">{{$post_count}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-header">Quản lý chính sách</li>
                <li class="nav-item">
                    <a href="{{ route('policies.index') }}" class="nav-link {{Request::is('admin/policies/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Chính sách
                            <span class="badge badge-info right">{{$policy_count}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-header">Quản lý nhà hàng</li>
                <li class="nav-item">
                    <a href="{{ route('companies.index') }}" class="nav-link {{Request::is('admin/companies/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>
                            Nhà hàng
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
