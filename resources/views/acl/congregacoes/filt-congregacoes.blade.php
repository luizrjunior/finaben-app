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
                                    <label for="uf_psq">UF</label>
                                    <select id="uf_psq" name="uf_psq" class="form-control custom-select">
                                        <option value="" selected> -- TODOS -- </option>
                                        <option value="ac" @if ($data['uf_psq'] == 'ac') selected @endif>Acre</option>
                                        <option value="al" @if ($data['uf_psq'] == 'al') selected @endif>Alagoas</option>
                                        <option value="am" @if ($data['uf_psq'] == 'am') selected @endif>Amazonas</option>
                                        <option value="ap" @if ($data['uf_psq'] == 'ap') selected @endif>Amapá</option>
                                        <option value="ba" @if ($data['uf_psq'] == 'ba') selected @endif>Bahia</option>
                                        <option value="ce" @if ($data['uf_psq'] == 'ce') selected @endif>Ceará</option>
                                        <option value="df" @if ($data['uf_psq'] == 'df') selected @endif>Distrito Federal</option>
                                        <option value="es" @if ($data['uf_psq'] == 'es') selected @endif>Espírito Santo</option>
                                        <option value="go" @if ($data['uf_psq'] == 'go') selected @endif>Goiás</option>
                                        <option value="ma" @if ($data['uf_psq'] == 'ma') selected @endif>Maranhão</option>
                                        <option value="mt" @if ($data['uf_psq'] == 'mt') selected @endif>Mato Grosso</option>
                                        <option value="ms" @if ($data['uf_psq'] == 'ms') selected @endif>Mato Grosso do Sul</option>
                                        <option value="mg" @if ($data['uf_psq'] == 'mg') selected @endif>Minas Gerais</option>
                                        <option value="pa" @if ($data['uf_psq'] == 'pa') selected @endif>Pará</option>
                                        <option value="pb" @if ($data['uf_psq'] == 'pb') selected @endif>Paraíba</option>
                                        <option value="pr" @if ($data['uf_psq'] == 'pr') selected @endif>Paraná</option>
                                        <option value="pe" @if ($data['uf_psq'] == 'pe') selected @endif>Pernambuco</option>
                                        <option value="pi" @if ($data['uf_psq'] == 'pi') selected @endif>Piauí</option>
                                        <option value="rj" @if ($data['uf_psq'] == 'rj') selected @endif>Rio de Janeiro</option>
                                        <option value="rn" @if ($data['uf_psq'] == 'rn') selected @endif>Rio Grande do Norte</option>
                                        <option value="ro" @if ($data['uf_psq'] == 'ro') selected @endif>Rondônia</option>
                                        <option value="rs" @if ($data['uf_psq'] == 'rs') selected @endif>Rio Grande do Sul</option>
                                        <option value="rr" @if ($data['uf_psq'] == 'rr') selected @endif>Roraima</option>
                                        <option value="sc" @if ($data['uf_psq'] == 'sc') selected @endif>Santa Catarina</option>
                                        <option value="se" @if ($data['uf_psq'] == 'se') selected @endif>Sergipe</option>
                                        <option value="sp" @if ($data['uf_psq'] == 'sp') selected @endif>São Paulo</option>
                                        <option value="to" @if ($data['uf_psq'] == 'to') selected @endif>Tocantins</option>
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
                                <input type="button" value="Adicionar Congregação" class="btn btn-warning"
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
                                                    <td align="center">{{ strtoupper($congregacao->uf) }}</td>
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
