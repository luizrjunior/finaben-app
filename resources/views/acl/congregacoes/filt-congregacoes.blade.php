@php
    $urlFechar = url('/dashboard');
    $urlAdicionar = url('/acl/congregacoes/adicionar');
    $urlLocalizar = url('/acl/congregacoes');
@endphp

@section('title', 'FINABEN')
@section('sub-title', 'Congregações')

<x-app-layout>
    <x-slot name="javascript">
        <script src="{{ asset('/js/acl/congregacoes/filt-congregacoes.js') }}"></script>
    </x-slot>
    <x-slot name="header">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Congregações</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">ACL</li>
                            <li class="breadcrumb-item active">Congregações</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </x-slot>
    <section class="content">
        <div class="container-fluid">
            <form class="form-horizontal" role="form" method="POST"
                  action="{{ $urlLocalizar }}" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Filtro de Congregações</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name_psq" class="control-label">Nome</label>
                                    <input type="text" id="name_psq" name="name_psq"
                                           class="form-control" value="{{ $data['name_psq'] }}" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="congregacao_uf_psq">UF</label>
                                    <select id="congregacao_uf_psq" name="congregacao_uf_psq" class="form-control custom-select">
                                        <option value="" selected> - - TODOS - - </option>
                                        @foreach($array_estados_congregacoes as $key => $value)
                                            <option value="{{ $key }}" @if ($data['congregacao_uf_psq'] == $key) selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="totalPage" class="control-label">Qtde. Itens por Página</label>
                                    <select class="form-control custom-select" id="totalPage" name="totalPage">
                                        <option value="5" @if ($data['totalPage'] == 5) selected @endif>05</option>
                                        <option value="10" @if ($data['totalPage'] == 10) selected @endif>10
                                        </option>
                                        <option value="15" @if ($data['totalPage'] == 15) selected @endif>15
                                        </option>
                                        <option value="20" @if ($data['totalPage'] == 20) selected @endif>20
                                        </option>
                                        <option value="25" @if ($data['totalPage'] == 25) selected @endif>25
                                        </option>
                                        <option value="30" @if ($data['totalPage'] == 30) selected @endif>30
                                        </option>
                                        <option value="35" @if ($data['totalPage'] == 35) selected @endif>35
                                        </option>
                                        <option value="40" @if ($data['totalPage'] == 40) selected @endif>40
                                        </option>
                                        <option value="45" @if ($data['totalPage'] == 45) selected @endif>45
                                        </option>
                                        <option value="50" @if ($data['totalPage'] == 50) selected @endif>50
                                        </option>
                                        <option value="100" @if ($data['totalPage'] == 100) selected @endif>100
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" value="Filtrar" class="btn btn-primary">
                                <input type="button" value="Adicionar" class="btn btn-warning"
                                       onclick="location.href='{{ $urlAdicionar }}'">
                                <a href="{{ $urlFechar }}" class="btn btn-secondary">Fechar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tabela de Congregações</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Criado em</th>
                                            <th>Nome Congregação</th>
                                            <th>UF</th>
                                            <th>Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (count($congregacoes) > 0)
                                            @foreach ($congregacoes as $congregacao)
                                                <tr>
                                                    <td>#</td>
                                                    <td align="center">{{ date('d/m/Y H:i:s', strtotime($congregacao->created_at)) }}</td>
                                                    <td>{{ $congregacao->nome }}</td>
                                                    <td align="center">{{ $congregacao->uf }}</td>
                                                    <td align="center">
                                                        <a class="btn btn-info btn-sm"
                                                           href="{{ url("/acl/congregacoes/{$congregacao->id}/editar") }}">
                                                            <i class="fas fa-pencil-alt"></i> Editar
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6">Nenhum registro
                                                    encontrado!
                                                </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                @if (isset($data))
                                    {{ $congregacoes->appends($data)->links() }}
                                @else
                                    {{ $congregacoes->links() }}
                                @endif
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>

</x-app-layout>
