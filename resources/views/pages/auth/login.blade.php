@extends('layouts.auth')

@section('title')
    Page de connexion
@endsection

@section('content')
    <div class="login-content">
        <!-- Login -->
        <form action="{{route('login')}}" method="post" class="nk-block toggled" id="l-login">
            {{ csrf_field() }}
            <div class="nk-form">
                @if($errors->has('invalid'))
                    <h3 style="color: red">{{ $errors->first('invalid') }}</h3>
                @endif
                <div class="input-group">
                    <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                    <div class="nk-int-st">
                        <input type="text"  name="email" class="form-control" placeholder="nom d'utilisateur">
                    </div>
                    @if($errors->has('email'))
                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                    @endif
                </div>
                <div class="input-group mg-t-15">
                    <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
                    <div class="nk-int-st">
                        <input type="password"  name="password" class="form-control" placeholder="mot de passe">
                    </div>
                    @if($errors->has('password'))
                        <p class="help is-danger">{{ $errors->first('password') }}</p>
                    @endif
                </div>
                <!-- se connecter -->
                <div class="input-group mg-t-15">
                    <div class="nk-int-st">
                        <button type="submit" class="btn btn-success btn-block">se connecter </button>
                    </div>
                </div>
            </div>
        </form>

    </div>

@endsection
