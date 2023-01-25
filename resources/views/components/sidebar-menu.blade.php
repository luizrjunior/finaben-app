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
        @if (Session::get('session_congregacao_id'))
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
                @can('Manter_Permissoes')
                <li class="nav-item">
                    <a id="itemMenuPermissoes" href="{{ url('/acl/permissoes') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Permissões</p>
                    </a>
                </li>
                @endcan
                @can('Manter_Grupos')
                <li class="nav-item">
                    <a id="itemMenuGrupos" href="{{ url('/acl/grupos') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Grupos de Usuários</p>
                    </a>
                </li>
                @endcan
                @can('Manter_Congregacoes')
                <li class="nav-item">
                    <a id="itemMenuCongregacoes" href="{{ url('/acl/congregacoes') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Congregações</p>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('Menu_Financeiro')
        <li id="itemMenuFinanceiro" class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-landmark"></i>
                <p>Financeiro<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                @can('Manter_Categorias')
                <li class="nav-item">
                    <a id="itemMenuCategoriasLancamentos" href="{{ url('/financeiro/categorias-lancamentos') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Categorias</p>
                    </a>
                </li>
                @endcan
                @can('Manter_Lancamentos')
                <li class="nav-item">
                    <a id="itemMenuLancamentos" href="{{ url('/financeiro/lancamentos') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lançamentos</p>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @endif
    </ul>
</nav>
<!-- /.sidebar-menu -->
