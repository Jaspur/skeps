@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="large-10 large-centered small-12 columns">
            <h1>Login</h1>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {!! csrf_field() !!}

                @if ($errors->has('email'))
                    <div class="callout alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </div>
                @endif
                <div class="input-group">
                    <span class="input-group-label">E-mailadres</span>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                </div>

                @if ($errors->has('password'))
                    <div class="callout alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </div>
                @endif
                <div class="input-group">
                    <span class="input-group-label">Wachtwoord</span>
                    <input type="password" class="form-control" name="password">
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                </div>

                <div class="form-group">
                    <input type="submit" class="button" value="Login" />

                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                </div>
            </form>
        </div>
    </div>
@endsection
