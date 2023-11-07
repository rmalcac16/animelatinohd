<!-- =============================================== -->

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('assets/dist/img/user_logo.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">PRINCIPAL</li>
            <li class="{{ $category_name === 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('admin.index') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview {{ $category_name === 'animes' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Animes</span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $page_name === 'listAnime' ? 'active' : '' }}">
                        <a href="{{ route('admin.animes.index') }}">
                            <i class="fa fa-circle-o"></i> Lista
                        </a>
                    </li>
                    <li class="{{ $page_name === 'GenerateAnime' ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-circle-o"></i> Generar
                        </a>
                    </li>
                    <li class="{{ $page_name === 'LatinoAnime' ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-circle-o"></i> Latino
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ $category_name === 'genres' ? 'active' : '' }}">
                <a href="{{ route('admin.genres.index') }}">
                    <i class="fa fa-th"></i> <span>Generos</span>
                </a>
            </li>
            <li class="{{ $category_name === 'servers' ? 'active' : '' }}">
                <a href="{{ route('admin.servers.index') }}">
                    <i class="fa fa-server"></i> <span>Servidores</span>
                </a>
            </li>
            <li class="header">OTROS</li>
            <li class="treeview {{ $category_name === 'configuration' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-cog"></i> <span>Configuración</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->
