@section('title', 'FINABEN')
@section('sub-title', 'Login')

<x-guest-layout>
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}"><b>FINA</b>BEN</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">

            <div class="card-body login-card-body">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <p class="login-box-msg">Faça login para iniciar sua sessão</p>

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" id="email" class="form-control" placeholder="Email" name="email" :value="old('email')" required autofocus />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" class="form-control" placeholder="Senha"
                               name="password"
                               required autocomplete="current-password" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember_me" name="remember_me">
                                <label for="remember_me">
                                    Lembrar-me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                @if (Route::has('password.request'))
                    <p class="mb-1">
                        <a href="{{ route('password.request') }}">Esqueci a minha senha</a>
                    </p>
                @endif
                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center">Registre-se</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

</x-guest-layout>
