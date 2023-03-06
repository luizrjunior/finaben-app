@php
    $urlFechar = url('/dashboard');
    $urlAdicionarEntrada = url('/financeiro/lancamentos/entrada/adicionar');
    $urlAdicionarSaida = url('/financeiro/lancamentos/saida/adicionar');
    $urlLocalizar = url('/financeiro/lancamentos');
    $urlAdicionarPercentualSede = url('/financeiro/lancamentos/adicionar-saida-percentual-sede');

    $array_categ_entradas_calculo = ['DIZIMO', 'OFERTA', 'OFERTA ESPECIAL'];
    $array_categ_saidas_calculo = ['SAIDAS PERCENTUAIS SEDE'];

    $valor_total_entradas = 0;
    $valor_total_saidas = 0;

    $valor_total_entradas_lancadas = 0;
    $valor_total_saidas_lancadas = 0;
    $valor_total_ofertas_missoes_lancadas = 0;

    $perc_ministerio = 10;
    $valor_total_perc_ministerio = 0;
    $perc_dizimo = 10;
    $valor_total_perc_dizimo = 0;
    $perc_congiap = 5;
    $valor_total_perc_congiap = 0;
    $perc_missoes = 3;
    $valor_total_perc_missoes = 0;
@endphp

@section('title', 'FINABEN')
@section('sub-title', 'Lançamentos')

<x-app-layout>
    <x-slot name="javascript">
        <script type="text/javascript">
            top.urlCarregarCategorias = '{{ url('/financeiro/categorias-lancamentos') }}';
            top.urlCarregarCongregacoes = '{{ url('/acl/congregacoes') }}';
        </script>
        <script type="text/javascript" src="{{ url('/js/plugins/jquery.maskedinput.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/financeiro/lancamentos/filt-lancamentos.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                carregarInputCongregacoes("congregacao_id_psq", "congregacao_uf_psq", {{ $data['congregacao_id_psq'] }});
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
                            <li class="breadcrumb-item">Financeiro</li>
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
                                        <option value="E" @if ($data['tipo_psq'] == 'E') selected @endif>ENTRADAS
                                        </option>
                                        <option value="S" @if ($data['tipo_psq'] == 'S') selected @endif>SAÍDAS
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="categoria_lancamento_id_psq">Categorias</label>
                                    <select id="categoria_lancamento_id_psq" name="categoria_lancamento_id_psq"
                                            class="form-control custom-select">
                                        <option value="" selected> -- TODAS --</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="congregacao_uf_psq">UF</label>
                                    <select id="congregacao_uf_psq" name="congregacao_uf_psq"
                                            class="form-control custom-select" {{ $session_disabled }}>
                                        <option value="" selected> -- TODOS --</option>
                                        @foreach($array_estados_congregacoes as $key => $value)
                                            <option value="{{ $key }}"
                                                    @if ($data['congregacao_uf_psq'] == $key) selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="congregacao_id_psq">Congregação</label>
                                    <select id="congregacao_id_psq" name="congregacao_id_psq"
                                            class="form-control custom-select" {{ $session_disabled }}>
                                        <option value="" selected> -- TODAS --</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="totalPage" class="control-label">Qtde. Itens por Página</label>
                                    <select class="form-control custom-select" id="totalPage" name="totalPage">
                                        @foreach($array_total_page as $key => $value)
                                            <option value="{{ $key }}"
                                                    @if ($data['totalPage'] == $key) selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" value="Filtrar" class="btn btn-primary"
                                       onclick="return validar();">
                                @can('Registrar_Entradas')
                                    <button type="button" class="btn btn-success" title="Adicionar"
                                            onclick="location.href='{{ $urlAdicionarEntrada }}'"><i
                                            class="fas fa-plus"></i>
                                        Entrada
                                    </button>
                                @endcan
                                @can('Registrar_Saidas')
                                    <button type="button" class="btn btn-danger" title="Adicionar"
                                            onclick="location.href='{{ $urlAdicionarSaida }}'"><i
                                            class="fas fa-plus"></i>
                                        Saída
                                    </button>
                                @endcan
                                <a href="{{ $urlFechar }}" class="btn btn-secondary">Fechar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tabela de Lançamentos - No período
                                    de {{ $data['data_inicio_psq'] }} até {{ $data['data_final_psq'] }}</h3>

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
                                            <th>Congregação / Data / Situação</th>
                                            <th>Tipo</th>
                                            <th>Categoria / Titulo</th>
                                            <th>Valor / Comprovante</th>
                                            <th>Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (count($lancamentos) > 0)
                                            @foreach ($lancamentos as $lancamento)
                                                @php
                                                    $descricao_status = '<span class="text-warning">Novo</span>';
                                                    if ($lancamento->status == 1) {
                                                        $descricao_status = '<span class="text-danger">Pendente</span>';
                                                    }
                                                    if ($lancamento->status == 2) {
                                                        $descricao_status = '<span class="text-primary">Quitado</span>';
                                                    }
                                                    $descricao_data = 'Recebido';
                                                    $bg_span = "btn btn-success";
                                                    $tipo = "ENTRADA";
                                                    if ($lancamento->tipo == "S") {
                                                        $descricao_data = 'Pagamento';
                                                        $bg_span = "btn btn-danger";
                                                        $tipo = "SAÍDA";
                                                        $valor_total_saidas += $lancamento->valor;
                                                    } else {
                                                        $valor_total_entradas += $lancamento->valor;
                                                    }
                                                    $nome_categoria = "SEM CATEGORIA";
                                                    if ($lancamento->categoria_lancamento_id != "") {
                                                        $nome_categoria = $lancamento->categoria->nome;
                                                        if (in_array($lancamento->categoria->nome, $array_categ_entradas_calculo)) {
                                                            $valor_total_entradas_lancadas += $lancamento->valor;
                                                        }
                                                        if (in_array($lancamento->categoria->nome, $array_categ_saidas_calculo)) {
                                                            $valor_total_saidas_lancadas += $lancamento->valor;
                                                        }
                                                        if ($lancamento->categoria->nome == 'OFERTA DE MISSÕES') {
                                                            $valor_total_ofertas_missoes_lancadas += $lancamento->valor;
                                                        }
                                                    }
                                                    $descricao_comprovante = "";
                                                    if ($lancamento->url_comprovante != "") {
                                                        $descricao_comprovante = '<a href="' . asset(str_replace("public", "storage", $lancamento->url_comprovante)) . '" target="_blank">Comprovante</a>';
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>#</td>
                                                    <td>
                                                        <a>{{ $lancamento->congregacao->nome . " / " . $lancamento->congregacao->uf }}</a>
                                                        <br/>
                                                        <small>
                                                            {{ $descricao_data }} em {{ date('d/m/Y', strtotime($lancamento->data)) }}
                                                            - Situação: {!! $descricao_status !!}
                                                        </small>
                                                    </td>
                                                    <td>
                                                        <span class="{{ $bg_span }}">{{ $tipo }}</span>
                                                    </td>
                                                    <td>
                                                        {{ $nome_categoria }}
                                                        @if ($lancamento->titulo != "")
                                                            <br/>
                                                            <small>
                                                                Titulo: {{ $lancamento->titulo }}
                                                            </small>
                                                        @endif
                                                    </td>
                                                    <td align="right">
                                                        R$ {{ numberFormatFinaBen($lancamento->valor) }}
                                                        @if ($descricao_comprovante != "")
                                                            <br/>
                                                            <small>
                                                                {!! $descricao_comprovante !!}
                                                            </small>
                                                        @endif
                                                    </td>
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
                    @php
                        $valor_total_perc_ministerio = (($valor_total_entradas_lancadas * $perc_ministerio) / 100);
                        $valor_total_perc_dizimo = (($valor_total_entradas_lancadas * $perc_dizimo) / 100);
                        $valor_total_perc_congiap = (($valor_total_entradas_lancadas * $perc_congiap) / 100);
                        $valor_total_perc_missoes = $valor_total_ofertas_missoes_lancadas + (($valor_total_entradas_lancadas * $perc_missoes) / 100);
                        $valor_total_percentuais = $valor_total_perc_ministerio + $valor_total_perc_dizimo + $valor_total_perc_congiap + $valor_total_perc_missoes;
                        $valor_saldo = $valor_total_percentuais - $valor_total_saidas_lancadas;
                        $color_label = "danger";
                        if ($valor_saldo <= 0.00) {
                            $color_label = "primary";
                        }
                    @endphp
                    <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Cálculo de Saídas para SEDE - No período
                                    de {{ $data['data_inicio_psq'] }} até {{ $data['data_final_psq'] }}</h3>

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
                                            <th span="6">ENTRADAS: <span class="text-success">R$ {{ numberFormatFinaBen($valor_total_entradas_lancadas) }} (100%)</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>10% MINISTÉRIO</th>
                                            <th>10% DÍZIMO</th>
                                            <th>5% CONGIAP</th>
                                            <th>OFERTAS DE MISSÕES + 3%</th>
                                            <th>TOTAL</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>#</td>
                                            <td align="center">
                                                R$ {{ numberFormatFinaBen($valor_total_perc_ministerio) }}</td>
                                            <td align="center">
                                                R$ {{ numberFormatFinaBen($valor_total_perc_dizimo) }}</td>
                                            <td align="center">
                                                R$ {{ numberFormatFinaBen($valor_total_perc_congiap) }}</td>
                                            <td align="center">
                                                R$ {{ numberFormatFinaBen($valor_total_perc_missoes) }}</td>
                                            <td align="right"><span
                                                    class="text-primary">R$ {{ numberFormatFinaBen($valor_total_percentuais) }}</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- card-body -->
                            <div class="card-footer text-right">
                                <p>Saldo @if ($valor_saldo > 0.00) Pendente @endif: <span
                                        class="text-{{ $color_label }}"><b>R$ {{ numberFormatFinaBen($valor_saldo) }}</b></span>
                                </p>
                                @if ( $data['congregacao_id_psq'] != "")
                                    @if ($valor_saldo > 0.00)
                                        <input type="hidden" id="valor_lancamento" name="valor_lancamento" value="R$ {{ numberFormatFinaBen($valor_saldo) }}">
                                        <button type="button" class="btn btn-danger" id="btnLancarSaldoPendenteSede" name="btnLancarSaldoPendenteSede"
                                                title="Lançar Saldo Pendente Sede"
                                                onclick="location.href='{{ $urlAdicionarEntrada }}'">
                                            Lançar Saldo Pendente para Sede
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Valores Totais - No período de {{ $data['data_inicio_psq'] }}
                                    até {{ $data['data_final_psq'] }}</h3>
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
                                <div class="row">
                                    <div class="col-lg-4 col-12">
                                        <div class="small-box bg-success">
                                            <div class="inner">
                                                <h3>R$ {{ numberFormatFinaBen($valor_total_entradas) }}</h3>
                                                <p>Total Entradas</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="small-box bg-danger">
                                            <div class="inner">
                                                <h3>R$ {{ numberFormatFinaBen($valor_total_saidas) }}</h3>
                                                <p>Total Saídas</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h3>
                                                    R$ {{ numberFormatFinaBen($valor_total_entradas - $valor_total_saidas) }}</h3>
                                                <p>Saldo Total</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-pie-graph"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form role="form" method="POST" id="formAdicionarPercentualSede" name="formAdicionarPercentualSede"
                  action="{{ $urlAdicionarPercentualSede }}">
                @csrf
                <input type="hidden" id="congregacao_uf_sede" name="congregacao_uf_sede" value="{{ $data['congregacao_uf_psq'] }}">
                <input type="hidden" id="congregacao_id_sede" name="congregacao_id_sede" value="{{ $data['congregacao_id_psq'] }}">
                <input type="hidden" id="categoria_lancamento_id_sede" name="categoria_lancamento_id_sede" value="7">
                <input type="hidden" id="valor_lancamento_sede" name="valor_lancamento_sede" value="R$ {{ numberFormatFinaBen($valor_saldo) }}">
                <input type="hidden" id="titulo_lancamento_sede" name="titulo_lancamento_sede" value="Período de {{ $data['data_inicio_psq'] }} até {{ $data['data_final_psq'] }}">
            </form>
        </div><!-- /.container-fluid -->
    </section>

</x-app-layout>
