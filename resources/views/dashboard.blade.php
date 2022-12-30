@section('title', 'FINABEN')
@section('sub-title', 'Dashboard')

<x-app-layout>
    <x-slot name="javascript">
        <script src="{{ asset('/js/dashboard.js') }}"></script>
    </x-slot>
    <x-slot name="header">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </x-slot>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Controles Principais</h3>
                        </div>
                        <div class="card-body">
                            <a href="{{ url('/usuarios') }}" class="btn btn-app bg-success">
                                <span class="badge bg-purple">{{ $totalUsers }}</span>
                                <i class="fas fa-users"></i> Usuários
                            </a>
                            <a href="{{ url('/acl/congregacoes') }}" class="btn btn-app bg-secondary">
                                <span class="badge bg-success">{{ $totalCongregacoes }}</span>
                                <i class="fas fa-barcode"></i> Congregações
                            </a>
                            <a class="btn btn-app bg-danger">
                                <i class="fas fa-plus-circle"></i> Entradas
                            </a>
                            <a class="btn btn-app bg-warning">
                                <i class="fas fa-minus-circle"></i> Saídas
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

</x-app-layout>
