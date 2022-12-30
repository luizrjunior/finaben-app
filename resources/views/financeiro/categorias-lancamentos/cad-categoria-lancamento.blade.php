@php
    $grupo = isset($grupo) ? $grupo : null;
    $grupo_id = isset($grupo->id) ? $grupo->id : null;
    $nome_grupo = isset($grupo->name) ? $grupo->name : null;
    $descrissao_grupo = isset($grupo->description) ? $grupo->description : null;

    $grupo_id = retornaValorAntigo($grupo_id, 'grupo_id');
    $nome_grupo = retornaValorAntigo($nome_grupo, 'nome_grupo');
    $descrissao_grupo = retornaValorAntigo($descrissao_grupo, 'descrissao_grupo');

    $breadcrumb = 'Adicionar Novo';
    $btnAdicionar = 'Limpar';
    $disabled = "";

    $urlAdicionar = url('/acl/grupos/adicionar');
    $urlVoltar = url('/acl/grupos');
    $url = url('/acl/grupos/inserir');

    if ($grupo_id != null) {
        $breadcrumb = 'Editar';
        $btnAdicionar = 'Adicionar Novo';
        $url = url('/acl/grupos/atualizar');
        if ($grupo_id == 1) {
            $disabled = "disabled";
        }
    }
@endphp

@section('title', 'FINABEN')
@section('sub-title', 'Grupos de Usuários')

<x-app-layout>
    <x-slot name="javascript">
        <script src="{{ asset('/js/acl/grupos/cad-grupo.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#checkTodos").click(function(){
                    $('input:checkbox').not(this).prop('checked', this.checked);
                });
            })
        </script>
    </x-slot>
    <x-slot name="header">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{!! $breadcrumb !!} <small>Grupo de Usuários</small></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item">ACL</li>
                            <li class="breadcrumb-item">Grupos de Usuários</li>
                            <li class="breadcrumb-item active">{!! $breadcrumb !!} Grupo de Usuários</li>
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
                                <h3 class="card-title">Cadastro de Grupo de Usuários</h3>
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
                                <input type="hidden" id="grupo_id" name="grupo_id" value="{{ $grupo_id }}">
                                <div class="form-group">
                                    <label for="nome_grupo" class="control-label">Nome <span class="text-red">*</span></label>
                                    <input type="text" id="nome_grupo" name="nome_grupo"
                                           class="form-control {{ $errors->has('nome_grupo') ? 'is-invalid' : '' }}"
                                           placeholder="Nome do Grupo de Usuários" value="{{ $nome_grupo }}" autofocus>
                                    <span class="error invalid-feedback">{{ $errors->first('nome_grupo') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="descrissao_grupo" class="control-label">Descrição</label>
                                    <textarea id="descrissao_grupo" name="descrissao_grupo"
                                              class="form-control {{ $errors->has('descrissao_grupo') ? 'is-invalid' : '' }}"
                                              rows="3" placeholder="Descrição...">{{ $descrissao_grupo }}</textarea>
                                    <span class="error invalid-feedback">{{ $errors->first('descrissao_grupo') }}</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" value="Salvar" class="btn btn-primary" {{ $disabled }}>
                                <input type="button" value="{{ $btnAdicionar }}" class="btn btn-warning"
                                       onclick="location.href='{{ $urlAdicionar }}'">
                                <a href="{{ $urlVoltar }}" class="btn btn-secondary">Voltar</a>
                            </div>
                        </div>
                    </form>
                </div>

                @if ($grupo_id != null)
                <div class="col-md-9">
                    @include('acl.grupos-tem-permissoes.partials.cad-grupo-tem-permissoes')
                </div>
                @endif

            </div>
        </div><!-- /.container-fluid -->
    </section>

</x-app-layout>
