@php
    $urlFechar = url('/dashboard');
    $urlAdicionarEntrada = url('/financeiro/lancamentos/entrada/adicionar');
    $urlAdicionarSaida = url('/financeiro/lancamentos/saida/adicionar');
    $urlLocalizar = url('/financeiro/lancamentos');
@endphp

@section('title', 'FINABEN')
@section('sub-title', 'Lançamentos')

<x-app-layout>
    <x-slot name="javascript">
        <script type="text/javascript" src="{{ url('/js/plugins/jquery.maskedinput.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/financeiro/lancamentos/filt-lancamentos.js') }}"></script>
        <script type="text/javascript">
            $(function () {
                //Date picker
                $("#data_inicio_psq").mask("99/99/9999");
                $('#data_inicio_psq').datepicker({
                    todayHighlight: true,
                    autoclose: true,
                    format: 'dd/mm/yyyy',
                    todayHighLight: true,
                    orientation: 'bottom'
                });
                //Date picker
                $("#data_final_psq").mask("99/99/9999");
                $('#data_final_psq').datepicker({
                    todayHighlight: true,
                    autoclose: true,
                    format: 'dd/mm/yyyy',
                    todayHighLight: true,
                    orientation: 'bottom'
                });
            });
        </script>
    </x-slot>
    <x-slot name="header">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Lançamentos</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Financeiro</li>
                            <li class="breadcrumb-item active">Lançamentos</li>
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
                                <h3 class="card-title">Filtro de Lançamentos</h3>
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
                                    <label>Periodo de</label>
                                    <input type="text" id="data_inicio_psq" name="data_inicio_psq"
                                           class="form-control" value="{{ $data['data_inicio_psq'] }}">
                                </div>
                                <div class="form-group">
                                    <label>até</label>
                                    <input type="text" id="data_final_psq" name="data_final_psq"
                                           class="form-control" value="{{ $data['data_final_psq'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="tipo_psq">Tipo</label>
                                    <select id="tipo_psq" name="tipo_psq" class="form-control custom-select">
                                        <option value="" selected> -- TODOS --</option>
                                        <option value="ac" @if ($data['tipo_psq'] == 'E') selected @endif>ENTRADAS
                                        </option>
                                        <option value="al" @if ($data['tipo_psq'] == 'S') selected @endif>SAÍDAS
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tipo_psq">Categorias</label>
                                    <select id="tipo_psq" name="tipo_psq" class="form-control custom-select">
                                        <option value="" selected> -- TODAS --</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="uf_psq">UF</label>
                                    <select id="uf_psq" name="uf_psq" class="form-control custom-select">
                                        <option value="" selected> -- TODOS --</option>
                                        <option value="ac" @if ($data['uf_psq'] == 'ac') selected @endif>Acre</option>
                                        <option value="al" @if ($data['uf_psq'] == 'al') selected @endif>Alagoas
                                        </option>
                                        <option value="am" @if ($data['uf_psq'] == 'am') selected @endif>Amazonas
                                        </option>
                                        <option value="ap" @if ($data['uf_psq'] == 'ap') selected @endif>Amapá</option>
                                        <option value="ba" @if ($data['uf_psq'] == 'ba') selected @endif>Bahia</option>
                                        <option value="ce" @if ($data['uf_psq'] == 'ce') selected @endif>Ceará</option>
                                        <option value="df" @if ($data['uf_psq'] == 'df') selected @endif>Distrito
                                            Federal
                                        </option>
                                        <option value="es" @if ($data['uf_psq'] == 'es') selected @endif>Espírito
                                            Santo
                                        </option>
                                        <option value="go" @if ($data['uf_psq'] == 'go') selected @endif>Goiás</option>
                                        <option value="ma" @if ($data['uf_psq'] == 'ma') selected @endif>Maranhão
                                        </option>
                                        <option value="mt" @if ($data['uf_psq'] == 'mt') selected @endif>Mato Grosso
                                        </option>
                                        <option value="ms" @if ($data['uf_psq'] == 'ms') selected @endif>Mato Grosso do
                                            Sul
                                        </option>
                                        <option value="mg" @if ($data['uf_psq'] == 'mg') selected @endif>Minas Gerais
                                        </option>
                                        <option value="pa" @if ($data['uf_psq'] == 'pa') selected @endif>Pará</option>
                                        <option value="pb" @if ($data['uf_psq'] == 'pb') selected @endif>Paraíba
                                        </option>
                                        <option value="pr" @if ($data['uf_psq'] == 'pr') selected @endif>Paraná</option>
                                        <option value="pe" @if ($data['uf_psq'] == 'pe') selected @endif>Pernambuco
                                        </option>
                                        <option value="pi" @if ($data['uf_psq'] == 'pi') selected @endif>Piauí</option>
                                        <option value="rj" @if ($data['uf_psq'] == 'rj') selected @endif>Rio de
                                            Janeiro
                                        </option>
                                        <option value="rn" @if ($data['uf_psq'] == 'rn') selected @endif>Rio Grande do
                                            Norte
                                        </option>
                                        <option value="ro" @if ($data['uf_psq'] == 'ro') selected @endif>Rondônia
                                        </option>
                                        <option value="rs" @if ($data['uf_psq'] == 'rs') selected @endif>Rio Grande do
                                            Sul
                                        </option>
                                        <option value="rr" @if ($data['uf_psq'] == 'rr') selected @endif>Roraima
                                        </option>
                                        <option value="sc" @if ($data['uf_psq'] == 'sc') selected @endif>Santa
                                            Catarina
                                        </option>
                                        <option value="se" @if ($data['uf_psq'] == 'se') selected @endif>Sergipe
                                        </option>
                                        <option value="sp" @if ($data['uf_psq'] == 'sp') selected @endif>São Paulo
                                        </option>
                                        <option value="to" @if ($data['uf_psq'] == 'to') selected @endif>Tocantins
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="categoria_lancamento_id_psq">Congregação</label>
                                    <select id="categoria_lancamento_id_psq" class="form-control custom-select">
                                        <option value="" selected> -- TODAS --</option>
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
                                <button type="button" class="btn btn-success" title="Adicionar Nova Entrada"
                                        onclick="location.href='{{ $urlAdicionarEntrada }}'"><i class="fas fa-plus"></i>
                                    Entrada
                                </button>
                                <button type="button" class="btn btn-danger" title="Adicionar Nova Saída"
                                        onclick="location.href='{{ $urlAdicionarSaida }}'"><i class="fas fa-plus"></i>
                                    Saída
                                </button>
                                <a href="{{ $urlFechar }}" class="btn btn-secondary">Fechar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tabela de Lançamentos</h3>

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
                                            <th>Data</th>
                                            <th>Categoria</th>
                                            <th>Tipo</th>
                                            <th>Título</th>
                                            <th>Valor</th>
                                            <th>Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (count($lancamentos) > 0)
                                            @foreach ($lancamentos as $lancamento)
                                                @php
                                                    $tipo = "Entrada";
                                                    if ($lancamento->tipo == "S") {
                                                        $tipo = "Saída";
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>#</td>
                                                    <td align="center">{{ date('d/m/Y H:i:s', strtotime($lancamento->created_at)) }}</td>
                                                    <td align="center">{{ date('d/m/Y', strtotime($lancamento->data_lancamento)) }}</td>
                                                    <td>{{ $lancamento->categoria->nome }}</td>
                                                    <td>{{ $tipo }}</td>
                                                    <td>{{ $lacamento->titulo }}</td>
                                                    <td align="center">
                                                        <button type="button" class="btn btn-info btn-sm"
                                                                onclick="location.href='{{ url("/financeiro/lancamentos/{$lancamento->id}/editar") }}';">
                                                            <i class="fas fa-pencil-alt"></i> Editar
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="8">Nenhum registro encontrado!</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                @if (isset($data))
                                    {{ $lancamentos->appends($data)->links() }}
                                @else
                                    {{ $lancamentos->links() }}
                                @endif
                            </div>
                        </div>
                        <!-- /.card -->
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>R$ 2.000,<sup style="font-size: 20px">00</sup></h3>
                                        <p>Total Entradas</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                @php
                                    $class_saidas = "danger";
                                    $total_saidas = 540;
                                    if ($total_saidas >= 620) {
                                        $class_saidas = "primary";
                                    }
                                @endphp
                                <div class="small-box bg-{{ $class_saidas }}">
                                    <div class="inner">
                                        <h3>R$ {{ $total_saidas }},<sup style="font-size: 20px">00</sup></h3>
                                        <p>Total Saídas</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Cálculo de Saídas</h3>

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
                                            <th>10% MINISTÉRIO</th>
                                            <th>10% DÍZIMO</th>
                                            <th>5% CONGIAP</th>
                                            <th>3% MISSÕES</th>
                                            <th>3% FAP</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>#</td>
                                            <td align="right"><b>R$ 200,00</b></td>
                                            <td align="right"><b>R$ 200,00</b></td>
                                            <td align="right"><b>R$ 100,00</b></td>
                                            <td align="right"><b>R$ 60,00</b></td>
                                            <td align="right"><b>R$ 60,00</b></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- card-body -->
                            <div class="card-footer text-right">
                                <b>Valor Total: <span class="text-primary">R$ 620,00</span></b>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>

</x-app-layout>
