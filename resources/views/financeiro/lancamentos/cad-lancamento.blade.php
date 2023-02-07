@php
    $lancamento = isset($lancamento) ? $lancamento : null;
    $lancamento_id = isset($lancamento->id) ? $lancamento->id : null;
    $status_lancamento = isset($lancamento->status) ? $lancamento->status : '0';
    $tipo_lancamento = isset($lancamento->tipo) ? $lancamento->tipo : 'E';
    $titulo_lancamento = isset($lancamento->titulo) ? $lancamento->titulo : null;
    $data_lancamento = isset($lancamento->data) ? \DateTime::createFromFormat('Y-m-d', $lancamento->data)->format('d/m/Y') : null;
    $valor_lancamento = isset($lancamento->valor) ? "R$ " . numberFormatFinaBen($lancamento->valor) : "R$ 0,00";
    $url_comprovante = isset($lancamento->url_comprovante) ? $lancamento->url_comprovante : null;
    $observacao = isset($lancamento->observacao) ? $lancamento->observacao : null;
    $categoria_lancamento_id = isset($lancamento->categoria_lancamento_id) ? $lancamento->categoria_lancamento_id : null;
    $congregacao_id = isset($lancamento->congregacao_id) ? $lancamento->congregacao_id : $session_congregacao_id;
    $uf_lancamento = isset($lancamento->congregacao->uf) ? $lancamento->congregacao->uf : $session_congregacao_uf;

    $url_comprovante_view = "";
    $status_imagem_comprovante = false;

    $url_arquivo_comprovante = $_SERVER['DOCUMENT_ROOT'] . "/storage" . str_replace("public", "", $url_comprovante);
    if (file_exists($url_arquivo_comprovante)) {
        $url_comprovante_view = asset(str_replace("public", "storage", $url_comprovante));
        $array_extensao = ["png", "jpg", "jpeg"];
        $extensao_comprovante = pegarExtensaoArquivo($url_comprovante);
        if (in_array($extensao_comprovante, $array_extensao)) {
            $status_imagem_comprovante = true;
        }
    }

    $lancamento_id = retornaValorAntigo($lancamento_id, 'lancamento_id');
    $tipo_lancamento = retornaValorAntigo($tipo_lancamento, 'tipo_lancamento');
    $titulo_lancamento = retornaValorAntigo($titulo_lancamento, 'titulo_lancamento');
    $data_lancamento = retornaValorAntigo($data_lancamento, 'data_lancamento');
    $valor_lancamento = retornaValorAntigo($valor_lancamento, 'valor_lancamento');
    $url_comprovante = retornaValorAntigo($url_comprovante, 'url_comprovante');
    $observacao = retornaValorAntigo($observacao, 'observacao');
    $categoria_lancamento_id = retornaValorAntigo($categoria_lancamento_id, 'categoria_lancamento_id');
    $congregacao_id = retornaValorAntigo($congregacao_id, 'congregacao_id');
    $uf_lancamento = retornaValorAntigo($uf_lancamento, 'uf_lancamento');

    $breadcrumb = 'Adicionar Novo';
    $btnAdicionar = 'Limpar';
    $disabled = "";

    $ds_tipo = "entrada";
    $ds_data = "do Recebimento";
    $disabled_titulo_lancamento = "";
    $disabled_categoria_lancamento_id = "";
    $disabled_status_lancamento = "disabled";
    if ($tipo_lancamento == "S") {
        $ds_tipo = "saida";
        $ds_data = "de Pagamento";
        $disabled_status_lancamento = "autofocus";
    }
    if ($categoria_lancamento_id == 7) {
        $disabled_status_lancamento = "disabled";
        $disabled_categoria_lancamento_id = "disabled";
        $disabled_titulo_lancamento =  "disabled";
    }

    $urlAdicionar = url('/financeiro/lancamentos/' . $ds_tipo . '/adicionar');
    $urlVoltar = url('/financeiro/lancamentos');
    $url = url('/financeiro/lancamentos/inserir');
    $urlQuitar = url('/financeiro/lancamentos/quitar');

    if ($lancamento_id != null) {
        $breadcrumb = 'Editar';
        $btnAdicionar = 'Adicionar Novo';
        $url = url('/financeiro/lancamentos/atualizar');
    }
@endphp

@section('title', 'FINABEN')
@section('sub-title', 'Lançamentos')

<x-app-layout>
    <x-slot name="javascript">
        <script type="text/javascript">
            top.urlCarregarCongregacoes = '{{ url('/acl/congregacoes') }}';
        </script>
        <script type="text/javascript" src="{{ url('/js/plugins/guiMoneyMask.js') }}"></script>
        <script type="text/javascript" src="{{ url('/js/plugins/jquery.maskedinput.js') }}"></script>
        <script src="{{ asset('/js/financeiro/lancamentos/cad-lancamento.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#congregacao_id').val('{{ $congregacao_id }}');
            });
        </script>
    </x-slot>
    <x-slot name="header">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{!! $breadcrumb !!} <small>Lançamento</small></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item">Financeiro</li>
                            <li class="breadcrumb-item">Lançamentos</li>
                            <li class="breadcrumb-item active">{!! $breadcrumb !!} Lançamento</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </x-slot>
    <section class="content">
        <div class="container-fluid">
            <form id="formCadastroGrupo" class="form-horizontal" method="POST" action="{{ $url }}"
                  autocomplete="on" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Congregação do Lançamento</h3>
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
                                    <label for="uf_lancamento">UF Congregação <span class="text-red">*</span></label>
                                    <select id="uf_lancamento" name="uf_lancamento"
                                            class="form-control custom-select {{ $errors->has('uf_lancamento') ? 'is-invalid' : '' }}">
                                        <option value="" selected> - - SELECIONE - - </option>
                                        @foreach($array_estados_congregacoes as $key => $value)
                                            <option value="{{ $key }}" @if ($uf_lancamento == $key) selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <span class="error invalid-feedback">{{ $errors->first('uf_lancamento') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="congregacao_id">Congregação <span class="text-red">*</span></label>
                                    <select id="congregacao_id" name="congregacao_id"
                                            class="form-control custom-select {{ $errors->has('congregacao_id') ? 'is-invalid' : '' }}">
                                        <option value="" selected> -- SELECIONE UMA UF --</option>
                                        @foreach ($congregacoes as $congregacao)
                                            @php
                                                $selected = "";
                                                if ($congregacao_id == $congregacao->id) {
                                                    $selected = "selected";
                                                }
                                            @endphp
                                            <option
                                                value="{{ $congregacao->id }}" {{ $selected }}>{{ $congregacao->nome }}</option>
                                        @endforeach
                                    </select>
                                    <span class="error invalid-feedback">{{ $errors->first('congregacao_id') }}</span>
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Cadastro do Lançamento</h3>
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
                                @if (Session('success'))
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                        </button>
                                        <h5><i class="icon fas fa-check"></i> Sucesso!</h5>
                                        {!! Session('success') !!}
                                    </div>
                                @endif

                                <input type="hidden" id="lancamento_id" name="lancamento_id"
                                       value="{{ $lancamento_id }}">
                                <input type="hidden" id="tipo_lancamento" name="tipo_lancamento"
                                       value="{{ $tipo_lancamento }}">

                                <div class="form-group">
                                    <label for="tipo_lancamento">Tipo  <span class="text-red">*</span></label>
                                    <select id="tipo_lancamento" name="tipo_lancamento"
                                            class="form-control custom-select" disabled>
                                        <option value=""> -- SELECIONE --</option>
                                        <option value="E" @if ($tipo_lancamento == 'E') selected @endif>ENTRADA</option>
                                        <option value="S" @if ($tipo_lancamento == 'S') selected @endif>SAÍDA</option>
                                    </select>
                                </div>
                                    <div class="form-group">
                                        <label for="status_lancamento">Situação  <span class="text-red">*</span></label>
                                        <select id="status_lancamento" name="status_lancamento"
                                                class="form-control custom-select" {{ $disabled_status_lancamento }}>
                                            <option value=""> -- SELECIONE --</option>
                                            <option value="0" @if ($status_lancamento == '0') selected @endif>NOVO</option>
                                            <option value="1" @if ($status_lancamento == '1') selected @endif>PENDENTE</option>
                                            <option value="2" @if ($status_lancamento == '2') selected @endif>QUITADO</option>
                                        </select>
                                    </div>
                                <div class="form-group">
                                    <label for="categoria_lancamento_id">Categoria</label>
                                    <select id="categoria_lancamento_id" name="categoria_lancamento_id"
                                            class="form-control custom-select" {{ $disabled_categoria_lancamento_id }}>
                                        <option value="">SEM CATEGORIA</option>
                                        @foreach ($categorias as $categoria)
                                            @php
                                                $selected = "";
                                                if ($categoria_lancamento_id == $categoria->id) {
                                                    $selected = "selected";
                                                }
                                            @endphp
                                            <option value="{{ $categoria->id }}" {{ $selected }}>{{ $categoria->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Data {{ $ds_data }}<span class="text-red">*</span></label>
                                    <input type="text" id="data_lancamento" name="data_lancamento"
                                           class="form-control {{ $errors->has('data_lancamento') ? 'is-invalid' : '' }}"
                                           value="{{ $data_lancamento }}">
                                    <span class="error invalid-feedback">{{ $errors->first('data_lancamento') }}</span>
                                </div>
                                <div class="form-group">
                                    <label>Valor <span class="text-red">*</span></label>
                                    <input type="text" id="valor_lancamento" name="valor_lancamento"
                                           class="guiMoneyMask form-control {{ $errors->has('valor_lancamento') ? 'is-invalid' : '' }}"
                                           value="{{ $valor_lancamento }}">
                                    <span class="error invalid-feedback">{{ $errors->first('valor_lancamento') }}</span>
                                </div>
                                <div class="form-group">
                                    <label>Titulo <small>(Opcional)</small></label>
                                    <input
                                        class="form-control {{ $errors->has('titulo_lancamento') ? 'is-invalid' : '' }}"
                                        type="text" id="titulo_lancamento" name="titulo_lancamento"
                                        value="{{ $titulo_lancamento }}" {{ $disabled_titulo_lancamento }}>
                                    <span
                                        class="error invalid-feedback">{{ $errors->first('titulo_lancamento') }}</span>
                                </div>
                                @if ($lancamento_id != null)
                                    @if ($tipo_lancamento == 'S')
                                <div class="form-group">
                                    <label>Anexar Comprovante <small>(Extensões:png, jpeg, jpg ou pdf)</small></label>
                                    <div class="custom-file">
                                        <input type="file" class="{{ $errors->has('file_lancamento') ? 'is-invalid' : '' }}" id="file_lancamento" name="file_lancamento">
                                        <span class="error invalid-feedback">{{ $errors->first('file_lancamento') }}</span>
                                    </div>
                                    @if ($url_comprovante != "")
                                        Comprovante: <a href="{{ $url_comprovante_view }}" target="_blank">Clique aqui.</a>
                                    @endif
                                </div>
                                    @endif
                                @endif
                            </div>
                            <div class="card-footer">
                                @php
                                $disabled_submit = "disabled";
                                $st_permissao_entradas = false;
                                @endphp
                                @can('Registrar_Entradas')
                                    @php
                                        $st_permissao_entradas = true;
                                    @endphp
                                @endcan
                                @php
                                    $st_permissao_saidas = false;
                                @endphp
                                @can('Registrar_Saidas')
                                    @php
                                        $st_permissao_saidas = true;
                                    @endphp
                                @endcan
                                @if ($st_permissao_entradas || $st_permissao_entradas)
                                    @php
                                        $disabled_submit = "";
                                    @endphp
                                @endif
                                <input type="submit" value="Salvar" class="btn btn-primary"
                                       onclick="return validarFormLancamento();" {{ $disabled_submit }}>
                                <input type="button" value="{{ $btnAdicionar }}" class="btn btn-warning"
                                       onclick="location.href='{{ $urlAdicionar }}'">
                                @if ($session_disabled == "")
                                <input type="button" value="Quitar" class="btn btn-info"
                                       onclick="location.href='{{ $urlQuitar }}'">
                                @endif
                                <a href="{{ $urlVoltar }}" class="btn btn-secondary">Voltar</a>
                            </div>
                        </div>
                    </div>
                    @if ($status_imagem_comprovante)
                    <div class="col-md-6">
                        <div class="card card-widget">
                            <div class="card-header">
                                <h3 class="card-title">Comprovante do Lançamento</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <img class="img-fluid pad" src="{{ $url_comprovante_view }}" alt="Photo">
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>
</x-app-layout>
