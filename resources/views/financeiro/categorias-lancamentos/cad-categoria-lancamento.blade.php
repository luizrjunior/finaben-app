@php
    $categoria = isset($categoria) ? $categoria : null;
    $categoria_id = isset($categoria->id) ? $categoria->id : null;
    $nome_categoria = isset($categoria->nome) ? $categoria->nome : null;
    $tipo_categoria = isset($categoria->tipo) ? $categoria->tipo : 'E';

    $categoria_id = retornaValorAntigo($categoria_id, 'categoria_id');
    $nome_categoria = retornaValorAntigo($nome_categoria, 'nome_categoria');
    $tipo_categoria = retornaValorAntigo($tipo_categoria, 'tipo_categoria');

    $breadcrumb = 'Adicionar Nova';
    $btnAdicionar = 'Limpar';
    $disabled = "";

    $urlAdicionar = url('/financeiro/categorias-lancamentos/adicionar');
    $urlVoltar = url('/financeiro/categorias-lancamentos');
    $url = url('/financeiro/categorias-lancamentos/inserir');

    if ($categoria_id != null) {
        $breadcrumb = 'Editar';
        $btnAdicionar = 'Adicionar Nova';
        $url = url('/financeiro/categorias-lancamentos/atualizar');
    }
@endphp

@section('title', 'FINABEN')
@section('sub-title', 'Categorias de Lançamentos')

<x-app-layout>
    <x-slot name="javascript">
        <script src="{{ asset('/js/financeiro/categorias/cad-categoria-lancamento.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function () {
            })
        </script>
    </x-slot>
    <x-slot name="header">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{!! $breadcrumb !!} <small>Categoria de Lançamento</small></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item">Financeiro</li>
                            <li class="breadcrumb-item">Categorias de Lançamentos</li>
                            <li class="breadcrumb-item active">{!! $breadcrumb !!} Categoria de Lançamento</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </x-slot>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <form id="formCadastroGrupo" class="form-horizontal" method="POST" action="{{ $url }}"
                          autocomplete="off">
                        @csrf
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Cadastro de Categorias de Lançamentos</h3>
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
                                <input type="hidden" id="categoria_id" name="categoria_id" value="{{ $categoria_id }}">
                                <div class="form-group">
                                    <label for="nome_categoria" class="control-label">Nome <span class="text-red">*</span></label>
                                    <input type="text" id="nome_categoria" name="nome_categoria"
                                           class="form-control {{ $errors->has('nome_categoria') ? 'is-invalid' : '' }}"
                                           placeholder="Nome do Categorias de Lançamentos" value="{{ $nome_categoria }}" autofocus>
                                    <span class="error invalid-feedback">{{ $errors->first('nome_categoria') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="tipo_categoria" class="control-label">Tipo <span class="text-red">*</span></label><br />
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary2" name="tipo_categoria" value="E" @if ($tipo_categoria == 'E') checked @endif>
                                        <label for="radioPrimary2">Entrada</label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary3" name="tipo_categoria" value="S" @if ($tipo_categoria == 'S') checked @endif>
                                        <label for="radioPrimary3">Saída</label>
                                    </div><br />
                                    <span class="error invalid-feedback">{{ $errors->first('tipo_categoria') }}</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" value="Salvar" class="btn btn-primary">
                                <input type="button" value="{{ $btnAdicionar }}" class="btn btn-warning"
                                       onclick="location.href='{{ $urlAdicionar }}'">
                                <a href="{{ $urlVoltar }}" class="btn btn-secondary">Voltar</a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

</x-app-layout>
