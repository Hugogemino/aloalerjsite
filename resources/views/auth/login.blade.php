@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center login">
            <div class="col-md-4">
                <div class="card">
                    {{--<div class="card-header">Entrar</div>--}}

                    <div class="card-body">

                        <div class="card-title">
                            <img src="/templates/mv/svg/logo-alo-alerj-callcenter.svg" class="alolerj-logo-login img-responsive" alt="AloAlerj - Callcenter">

                            <h3> <i class="fas fa-sign-in-alt"></i> Entrar</h3>
                        </div>



                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                {{--<label for="email" class="col-sm-4 col-form-label text-md-right">Login Alerj</label>--}}

                                <div class="col-md-12">
                                    <input id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                {{--<label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>--}}

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  placeholder="Senha"  required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            Lembrar de mim
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button id="loginButton" type="submit" class="btn btn-primary btn-block">
                                        Entrar
                                    </button>


                                    {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                    {{--Esqueceu a senha?--}}
                                    {{--</a>--}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
