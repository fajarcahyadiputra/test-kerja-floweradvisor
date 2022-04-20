@extends('app')
@section('content')
    @auth
        <p>Welcome <b>{{ Auth::user()->name }}</b></p>
        <a class="btn btn-primary" href="{{ route('password') }}">Change Password</a>
        <a class="btn btn-danger" href="{{ route('logout') }}">Logout</a>
    @endauth
    @guest
        {{-- <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
<a class="btn btn-info" href="{{ route('register') }}">Register</a> --}}
        <div class="login-wrap">
            <div class="login-html">
                <div class="group">
                    @if (session('success'))
                        <p class="alert alert-success">{{ session('success') }}</p>
                    @endif
                    @if ($errors->any())
                        @foreach ($errors->all() as $err)
                            <p class="alert alert-danger">{{ $err }}</p>
                        @endforeach
                    @endif
                </div>
                <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1"
                    class="tab">Sign In</label>
                <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign
                    Up</label>
                <div class="login-form">
                    <div class="sign-in-htm">
                        <form action="{{ route('login.action') }}" method="POST">
                            @csrf
                            <div class="group">
                                <label class="label">Username <span class="text-danger">*</span></label>
                                <input class="input" required type="username" name="username"
                                    value="{{ old('username') }}" />
                            </div>
                            <div class="group">
                                <label class="label">Password <span class="text-danger">*</span></label>
                                <input class="input" required type="password" name="password" />
                            </div>
                            <div class="group">
                                <div class="captcha">
                                    <span>{!! captcha_img() !!}</span>
                                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                                        &#x21bb;
                                    </button>
                                </div>
                            </div>
                            <div class="group">
                                <input id="captcha" type="text" class="input" class="text-white"
                                    placeholder="Enter Captcha" name="captcha">
                            </div>
                            <div class="group">
                                <input type="submit" class="button" value="Sign Up">
                            </div>
                        </form>
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <a href="#forgot">Forgot Password?</a>
                        </div>
                    </div>
                    <div class="sign-up-htm">
                        <form action="{{ route('register.action') }}" method="POST">
                            @csrf
                            <div class="group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input required class="input" type="text" name="name" value="{{ old('name') }}" />
                            </div>
                            <div class="group">
                                <label>Username <span class="text-danger">*</span></label>
                                <input required class="input" type="username" name="username"
                                    value="{{ old('username') }}" />
                            </div>
                            <div class="group">
                                <label>Password <span class="text-danger">*</span></label>
                                <input required class="input" type="password" name="password" />
                            </div>
                            <div class="group">
                                <label>Password Confirmation<span class="text-danger">*</span></label>
                                <input required class="input" type="password" name="password_confirm" />
                            </div>
                            <div class="group">
                                <button class="btn btn-primary">Register</button>
                                <a class="btn btn-danger" href="{{ route('home') }}">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endguest
@endsection

@section('javascript')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $('#reload').click(function() {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>
@endsection
