    @php
    $lancamento = isset($lancamento) ? $lancamento : null;
    $lancamento_id = isset($lancamento->id) ? $lancamento->id : null;
    $tipo_lancamento = isset($lancamento->tipo) ? $lancamento->tipo : 'E';
    $titulo_lancamento = isset($lancamento->titulo) ? $lancamento->titulo : null;
    $data_lancamento = isset($lancamento->data) ? $lancamento->data : null;
    $valor_lancamento = isset($lancamento->valor) ? $lancamento->valor : null;
    $url_comprovante = isset($lancamento->url_comprovante) ? $lancamento->url_comprovante : null;
    $observacao = isset($lancamento->observacao) ? $lancamento->observacao : null;
    $categoria_lancamento_id = isset($lancamento->categoria_lancamento_id) ? $lancamento->categoria_lancamento_id : null;
    $congregacao_id = isset($lancamento->congregacao_id) ? $lancamento->congregacao_id : $session_congregacao_id;
    $uf_lancamento = isset($lancamento->congregacao->uf) ? $lancamento->congregacao->uf : $uf_session;

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
    if ($tipo_lancamento == "S") {
        $ds_tipo = "saida";
    }

    $urlAdicionar = url('/financeiro/lancamentos/' . $ds_tipo . '/adicionar');
    $urlVoltar = url('/financeiro/lancamentos');
    $url = url('/financeiro/lancamentos/inserir');

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
        <script src="{{ asset('/js/financeiro/lancamentos/cad-lancamento.js') }}"></script>$congregacao_id
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
                  autocomplete="off">
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
                                    <label for="uf_lancamento">UF Congregação</label>
                                    <select id="uf_lancamento" name="uf_lancamento" class="form-control custom-select">
                                        <option value="" selected> -- SELECIONE --</option>
                                        <option value="ac" @if ($uf_lancamento == 'ac') selected @endif>Acre</option>
                                        <option value="al" @if ($uf_lancamento == 'al') selected @endif>Alagoas</option>
                                        <option value="am" @if ($uf_lancamento == 'am') selected @endif>Amazonas
                                        </option>
                                        <option value="ap" @if ($uf_lancamento == 'ap') selected @endif>Amapá</option>
                                        <option value="ba" @if ($uf_lancamento == 'ba') selected @endif>Bahia</option>
                                        <option value="ce" @if ($uf_lancamento == 'ce') selected @endif>Ceará</option>
                                        <option value="df" @if ($uf_lancamento == 'df') selected @endif>Distrito
                                            Federal
                                        </option>
                                        <option value="es" @if ($uf_lancamento == 'es') selected @endif>Espírito Santo
                                        </option>
                                        <option value="go" @if ($uf_lancamento == 'go') selected @endif>Goiás</option>
                                        <option value="ma" @if ($uf_lancamento == 'ma') selected @endif>Maranhão
                                        </option>
                                        <option value="mt" @if ($uf_lancamento == 'mt') selected @endif>Mato Grosso
                                        </option>
                                        <option value="ms" @if ($uf_lancamento == 'ms') selected @endif>Mato Grosso do
                                            Sul
                                        </option>
                                        <option value="mg" @if ($uf_lancamento == 'mg') selected @endif>Minas Gerais
                                        </option>
                                        <option value="pa" @if ($uf_lancamento == 'pa') selected @endif>Pará</option>
                                        <option value="pb" @if ($uf_lancamento == 'pb') selected @endif>Paraíba</option>
                                        <option value="pr" @if ($uf_lancamento == 'pr') selected @endif>Paraná</option>
                                        <option value="pe" @if ($uf_lancamento == 'pe') selected @endif>Pernambuco
                                        </option>
                                        <option value="pi" @if ($uf_lancamento == 'pi') selected @endif>Piauí</option>
                                        <option value="rj" @if ($uf_lancamento == 'rj') selected @endif>Rio de Janeiro
                                        </option>
                                        <option value="rn" @if ($uf_lancamento == 'rn') selected @endif>Rio Grande do
                                            Norte
                                        </option>
                                        <option value="ro" @if ($uf_lancamento == 'ro') selected @endif>Rondônia
                                        </option>
                                        <option value="rs" @if ($uf_lancamento == 'rs') selected @endif>Rio Grande do
                                            Sul
                                        </option>
                                        <option value="rr" @if ($uf_lancamento == 'rr') selected @endif>Roraima</option>
                                        <option value="sc" @if ($uf_lancamento == 'sc') selected @endif>Santa Catarina
                                        </option>
                                        <option value="se" @if ($uf_lancamento == 'se') selected @endif>Sergipe</option>
                                        <option value="sp" @if ($uf_lancamento == 'sp') selected @endif>São Paulo
                                        </option>
                                        <option value="to" @if ($uf_lancamento == 'to') selected @endif>Tocantins
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="congregacao_id">Congregação</label>
                                    <select id="congregacao_id" name="congregacao_id"
                                            class="form-control custom-select">
                                        <option value="" selected> -- SELECIONE UMA UF --</option>
                                        @foreach ($congregacoes as $congregacao)
                                            @php
                                                $selected = "";
                                                if ($congregacao_id == $congregacao->id) {
                                                    $selected = "selected";
                                                }
                                            @endphp
                                            <option value="{{ $congregacao->id }}" {{ $selected }}>{{ $congregacao->nome }}</option>
                                        @endforeach
                                    </select>
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
                                <h3 class="card-title">Cadastro de Lançamento</h3>
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
                                    <label for="categoria_lancamento_id">Categoria Lançamento</label>
                                    <select id="categoria_lancamento_id" name="categoria_lancamento_id"
                                            class="form-control custom-select">
                                        <option value=""> - - SEM CATEGORIA - -</option>
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
                                    <label>Titulo</label>
                                    <input class="form-control" type="text">
                                </div>
                                <div class="form-group">
                                    <label>Data Lançamento</label>
                                    <input type="text" id="data_lancamento" name="data_lancamento"
                                           class="form-control" value="{{ $data_lancamento }}">
                                </div>
                                <div class="form-group">
                                    <label>Valor Lançamento</label>
                                    <input type="text" id="valor_lancamento" name="valor_lancamento" class="guiMoneyMask form-control">
                                </div>
                                <div class="form-group">
                                    <label>Comprovante</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Escolha o arquivo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" value="Salvar" class="btn btn-primary">
                                <input type="button" value="{{ $btnAdicionar }}" class="btn btn-warning"
                                       onclick="location.href='{{ $urlAdicionar }}'">
                                <a href="{{ $urlVoltar }}" class="btn btn-secondary">Voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>
</x-app-layout>
