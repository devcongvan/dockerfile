<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>
                            Trang quản trị
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{Request::is('candidate/list')||Request::is('candidate/new')?'menu-open':''}}">
                    <a href="#" class="nav-link {{Request::is('candidate/list')||Request::is('candidate/new')||Request::is('candidate/edit/*')?'active':''}}">
                        <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                        <p>
                            Quản lý ứng viên
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('candidate.list')}}" class="nav-link {{Request::is('candidate/list')?'active':''}}">
                                <i class="nav-icon fa fa-list-ul" aria-hidden="true"></i>
                                <p>Danh sách ứng viên</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('candidate.new')}}" class="nav-link {{Request::is('candidate/new')?'active':''}}">
                                <i class="nav-icon fa fa-plus" aria-hidden="true"></i>
                                <p>Thêm ứng viên</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{Request::is('career/list')||Request::is('career/new')?'menu-open':''}}">
                    <a href="#" class="nav-link {{Request::is('career/list')||Request::is('career/new')?'active':''}}">
                        <i class="nav-icon fa fa-building-o" aria-hidden="true"></i>
                        <p>
                            Quản lý ngành nghề
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="career/list" class="nav-link {{Request::is('career/list')?'active':''}}">
                                <i class="nav-icon fa fa-list-ul" aria-hidden="true"></i>
                                <p>Danh sách ngành nghề</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="career/new" class="nav-link {{Request::is('career/new')?'active':''}}">
                                <i class="nav-icon fa fa-plus" aria-hidden="true"></i>
                                <p>Thêm ngành nghề</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{Request::is('source/list')||Request::is('source/new')?'menu-open':''}}">
                    <a href="#" class="nav-link {{Request::is('source/list')||Request::is('source/new')?'active':''}}">
                        <i class="nav-icon fa fa-cubes" aria-hidden="true"></i>
                        <p>
                            Quản lý nguồn
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="source/list" class="nav-link {{Request::is('source/list')?'active':''}}">
                                <i class="nav-icon fa fa-list-ul" aria-hidden="true"></i>
                                <p>Danh sách nguồn</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="source/new" class="nav-link {{Request::is('source/new')?'active':''}}">
                                <i class="nav-icon fa fa-plus" aria-hidden="true"></i>
                                <p>Thêm nguồn</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{Request::is('skill/list')||Request::is('skill/new')?'menu-open':''}}">
                    <a href="#" class="nav-link {{Request::is('skill/list')||Request::is('skill/new')?'active':''}}">
                        <i class="nav-icon fa fa-code" aria-hidden="true"></i>
                        <p>
                            Quản lý ký năng
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="skill/list" class="nav-link {{Request::is('skill/list')?'active':''}}">
                                <i class="nav-icon fa fa-list-ul" aria-hidden="true"></i>
                                <p>Danh sách kỹ năng</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="skill/new" class="nav-link {{Request::is('skill/new')?'active':''}}">
                                <i class="nav-icon fa fa-plus" aria-hidden="true"></i>
                                <p>Thêm kỹ năng</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="" style="position: relative;">
                    <a class="nav-link" id="collapse-navbar" data-toggle="false" data-widget="pushmenu" href="#"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>