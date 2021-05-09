@extends('layouts.frontend.main')
@section('title', 'Mi perfil')
@section('content')

    <div class="container py-md-5">
        <br>
        <br>
        <div class="title-content text-center">
            <h6 class="sub-title">
                <strong>
                    &nbsp;
                </strong>
            </h6>
            <h3 class="title-big">Mi Perfil</h3>
        </div>
        <div class="pt-lg-5 pt-4">

            @if(session('message'))
            <div class="row">
                <div class="col-md-10 offset-md-1 mb-3">
                    <p style="text-align: center;" class="text-success">Perfil Actualizado</p>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <form method="POST" action="{{ route('update-profile') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name"
                                           value="{{ auth()->user()->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                           name="email"
                                           value="{{ auth()->user()->email  }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Actualizar Perfil
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div style="height:80px;"></div>
                </div>
                <div class="col-md-6">
                    <div>
                        <form method="POST" action="{{ route('update-password') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="current_password" class="col-md-4 col-form-label text-md-right">Password Actual</label>

                                <div class="col-md-6">
                                    <input id="current_password" type="password"
                                           class="form-control @error('current_password') is-invalid @enderror"
                                           name="current_password" required autocomplete="new-password">

                                    @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password_confirmation"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password_confirmation" type="password" class="form-control"
                                           name="password_confirmation" required
                                           autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Actualizar Password
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                    <div style="height:80px;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="parallax2"></div>
@endsection

