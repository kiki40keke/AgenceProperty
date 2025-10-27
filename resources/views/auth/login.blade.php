@extends('client.layout')

@section('title', 'Admin Login')
@section('content')

    <div class="form-signin w-100 m-auto">
        <form method="POST" action="{{ route('doLogin') }}">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">

            </div> @include('shared.input', ['type' => 'email', 'class' => '', 'label' => 'Email', 'name' => 'email', 'value' => '',  'placeholder' => 'Your email address'])
            <div class="form-floating">
                @include('shared.input', ['type' => 'password', 'class' => '', 'label' => 'Password', 'name' => 'password', 'value' => '',  'placeholder' => 'Your password'])
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
        </form>
    </div>



@endsection


@section('styles')

    <style>
        .form-signin {
            max-width: 330px;
            padding: 15px;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
@endsection
