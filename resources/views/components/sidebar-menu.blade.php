<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a id="itemMenuDashboard" href="{{ url('/dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        @can('Menu_Usuarios')
        <li class="nav-item">
            <a id="itemMenuUsuarios" href="{{ url('/usuarios') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Usuários</p>
            </a>
        </li>
        @endcan
        @can('Menu_ACL')
        <li id="itemMenuAcl" class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-lock"></i>
                <p>ACL<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a id="itemMenuPermissoes" href="{{ url('/acl/permissoes') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Permissões</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="itemMenuGrupos" href="{{ url('/acl/grupos') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Grupos de Usuários</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="itemMenuCongregacoes" href="{{ url('/acl/congregacoes') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Congregações</p>
                    </a>
                </li>
            </ul>
        </li>
        @endcan
        @can('Menu_Financeiro')
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-landmark"></i>
                <p>Financeiro<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Categorias de Contas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/lancamentos.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lançamentos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Cálculo de Saídas</p>
                    </a>
                </li>
            </ul>
        </li>
        @endcan
    </ul>
</nav>
<!-- /.sidebar-menu -->
