@php
    $usuario_tem_permissao = false;
    $sub_nome_congregacao = "";
    $nome_congregacao = "";
    if (Session::get('session_congregacao_id')) {
        $sub_nome_congregacao = "Congregação:";
        $nome_congregacao = " <small class='text-success'>" . Session::get('session_congregacao_nome') . " / " . Session::get('session_congregacao_uf') . "</small>";
    }
@endphp

@section('title', 'FINABEN')
@section('sub-title', 'Dashboard')

<x-app-layout>
    <x-slot name="javascript">
        <script type="text/javascript">
            top.urlCarregarCongregacoes = '{{ url('/acl/congregacoes') }}';
        </script>
        <script src="{{ asset('/js/dashboard.js') }}"></script>
    </x-slot>
    <x-slot name="header">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                        {{ $sub_nome_congregacao }}
                        <h1 class="m-0">{!! $nome_congregacao !!}</h1>
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
                @if (!Session::get('session_congregacao_id'))
                    <div class="col-md-3">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('/salvar-congregacao-usuario') }}" autocomplete="off">
                        @csrf
                        <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Informe a sua Congregação</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"
                                                title="Remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="uf_congregacao">UF Congregação <span
                                                class="text-red">*</span></label>
                                        <select id="uf_congregacao" name="uf_congregacao"
                                                class="form-control custom-select {{ $errors->has('uf_congregacao') ? 'is-invalid' : '' }}">
                                            <option value="" selected> - - SELECIONE - -</option>
                                            @foreach($array_estados_congregacoes as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        <span
                                            class="error invalid-feedback">{{ $errors->first('uf_congregacao') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="congregacao_id">Congregação <span class="text-red">*</span></label>
                                        <select id="congregacao_id" name="congregacao_id"
                                                class="form-control custom-select {{ $errors->has('congregacao_id') ? 'is-invalid' : '' }}">
                                            <option value="" selected> -- SELECIONE UMA UF --</option>
                                        </select>
                                        <span
                                            class="error invalid-feedback">{{ $errors->first('congregacao_id') }}</span>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <input type="submit" value="Salvar" class="btn btn-primary"
                                           onclick="return validar();">
                                </div>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="col-md-4">

                        @if (Session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                </button>
                                <h5><i class="icon fas fa-check"></i> Sucesso!</h5>
                                {!! Session('success') !!}
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Controles Principais</h3>
                            </div>
                            <div class="card-body">
                                @can('Manter_Usuarios')
                                    @php
                                        $usuario_tem_permissao = true;
                                    @endphp
                                    <a href="{{ url('/usuarios') }}" class="btn btn-app bg-success">
                                        <span class="badge bg-purple">{{ $totalUsers }}</span>
                                        <i class="fas fa-users"></i> Usuários
                                    </a>
                                @endcan
                                @can('Manter_Congregacoes')
                                    @php
                                        $usuario_tem_permissao = true;
                                    @endphp
                                    <a href="{{ url('/acl/congregacoes') }}" class="btn btn-app bg-secondary">
                                        <span class="badge bg-success">{{ $totalCongregacoes }}</span>
                                        <i class="fas fa-barcode"></i> Congregações
                                    </a>
                                @endcan
                                @can('Manter_Lancamentos')
                                    @php
                                        $usuario_tem_permissao = true;
                                    @endphp
                                    <a href="{{ url('/financeiro/lancamentos') }}" class="btn btn-app bg-info">
                                        <i class="fas fa-barcode"></i> Lançamentos
                                    </a>
                                @endcan
                                @can('Registrar_Entradas')
                                    @php
                                        $usuario_tem_permissao = true;
                                    @endphp
                                    <a href="{{ url('/financeiro/lancamentos/entrada/adicionar') }}" class="btn btn-app bg-danger">
                                        <i class="fas fa-plus-circle"></i> Entradas
                                    </a>
                                @endcan
                                @can('Registrar_Saidas')
                                    @php
                                        $usuario_tem_permissao = true;
                                    @endphp
                                    <a href="{{ url('/financeiro/lancamentos/saida/adicionar') }}" class="btn btn-app bg-warning">
                                        <i class="fas fa-minus-circle"></i> Saídas
                                    </a>
                                @endcan

                                @if (!$usuario_tem_permissao)
                                    Favor solicitar permissão dos controles ao administrador do sistema.
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

</x-app-layout>
