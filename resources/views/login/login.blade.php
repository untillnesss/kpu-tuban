@extends('lay.lay')

@section('title', 'Login')

@section('main')

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header text-center d-flex justify-content-center flex-column align-items-center">
            <img src="{{asset('logo/KPU_Logo.svg')}}" height="100" width="100" alt="" class="mb-2">
            <span class="font-weight-bold">KOMISI PEMILIHAN UMUM</span>
            <span>Kabupaten {{env('APP_KAB')}}</span>
        </div>
        <div class="card-body">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" id="email" class="form-control" placeholder="Email address"
                            required="required" autocomplete="off">
                        <label for="inputEmail">Email address</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" id="pass" class="form-control" placeholder="Password"
                            required="required" autocomplete="off">
                        <label for="inputPassword">Password</label>
                    </div>
                </div>

            <button class="btn btn-primary btn-block text-white" id="btnLogin">Login</button>
            {{-- <div class="text-center mt-1">
                <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
            </div> --}}
        </div>
    </div>
</div>

@endsection
