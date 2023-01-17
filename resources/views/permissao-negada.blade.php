@php
    $urlFechar = url('/dashboard');
@endphp

@section('title', 'FINABEN')
@section('sub-title', 'Permissão Negada')

<x-app-layout>
    <x-slot name="javascript">
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
                        <h1 class="m-0">Permissão <small>Negada</small></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Permissão Negada</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </x-slot>
    <!-- Main content -->
    <section class="content">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1><center><i class="fa fa-exclamation-triangle"></i> Permissão Negada <i class="fa fa-exclamation-triangle"></i></center></h1>
                    <h2><center>Favor entrar em contato com o administrador do Sistema.</center></h2>
                    <h3><center><a href="{{ $urlFechar }}"><i class="fa fa-arrow-left"></i> Voltar Página Principal</a></center></h3>
                </div>

            </div>
        </div>

    </section>
    <!-- /.content -->
</x-app-layout>
