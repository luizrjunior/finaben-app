@section('title', 'FINABEN')
@section('sub-title', 'Registre-se')

<x-guest-layout>
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url('/') }}"><b>FINA</b>BEN</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Registrar um novo membro</p>

                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Nome completo" name="name" :value="old('name')" required autofocus />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Email" name="email" :value="old('email')" required />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <span class="error invalid-feedback">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Senha"
                               name="password"
                               required autocomplete="new-password" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <span class="error invalid-feedback">{{ $errors->first('password') }}</span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password_confirmation" class="form-control" placeholder="Repetir a senha"
                               name="password_confirmation" required />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <a href="{{ route('login') }}" class="text-center">Já sou membro</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->
</x-guest-layout>
