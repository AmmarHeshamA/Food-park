@extends('frontend.layouts.master')

@section('content')
    <!-- BREADCRUMB START -->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/login_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>Reset Password</h1>
                    <ul>
                        <li><a href="javascript:;">home</a></li>
                        <li><a href="#">Reset Password</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- BREADCRUMB END -->


    <!-- Resect START -->
    <section class="fp__signup" style="background: url({{ asset('frontendimages/login_bg.jpg') }});">
        <div class="fp__signup_overlay pt_125 xs_pt_95 pb_100 xs_pb_70">
            <div class=" container">
                <div class="row wow fadeInUp" data-wow-duration="1s">
                    <div class="col-xxl-5 col-xl-6 col-md-9 col-lg-7 m-auto">
                        <div class="fp__login_area">
                            <form method="POST" action="{{ route('password.store') }}">
                                @csrf
                                <div class="row">

                                    <!-- Password Reset Token -->
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                    <!-- Email -->
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <label>email</label>
                                            <input type="email" placeholder="Email" name="email"
                                                value="{{ old('email', $request->email) }}">
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <label>password</label>
                                            <input type="password" placeholder="Password" name="password">
                                        </div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <label>confirm password</label>
                                            <input type="password" placeholder="Confirm Password"
                                                name="password_confirmation">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <button type="submit" class="common_btn">Reset Password</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <p class="create_account d-flex justify-content-between">
                                <a href="{{ route('login') }}">login</a>
                                <a href="{{ route('register') }}">Create Account</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Resect END -->
@endsection

@push('scripts')
    <script>
        @if (session('status'))
            toastr.success('{{ session('status') }}');
        @endif
    </script>
@endpush
