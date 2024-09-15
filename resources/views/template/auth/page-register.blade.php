<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    @include('template.home.layouts.head')

</head>

<body class="h-100">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form my-5    ">
                            <div class="card-body pt-5">
                                <div class="text-center">
                                    <img src="template/images/favicon.png" width="48">
                                    <h4 class="mt-3">BizMappers</h4>
                                </div>

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <!-- Name -->
                                    <div>
                                        <label class="col-form-label">Name:</label>
                                        <input id="name" class="form-control rounded" type="text" name="name" :value="old('name')" placeholder="Name" required autofocus autocomplete="name">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <!-- Email Address -->
                                    <div>
                                        <label class="col-form-label">Email:</label>
                                        <input id="email" class="form-control rounded" type="email" name="email" :value="old('email')" placeholder="Email" required autocomplete="email" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- Password -->
                                    <div>
                                        <label class="col-form-label">Password:</label>
                                        <input id="password" class="form-control rounded" type="password" name="password" placeholder="Password" required autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <div>
                                        <label class="col-form-label">Confirm Password:</label>
                                        <input id="password_confirmation" class="form-control rounded" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>

                                    <div class="d-flex justify-content-end mt-4">
                                        <input type="submit" name="submit" value="Register" class="btn btn-primary">
                                    </div>

                                </form>
                                <div>
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="/">
                                        {{ __('Already registered?') }}
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!--**********************************
        Scripts
    ***********************************-->
    @include('template.home.layouts.scripts')
</body>

</html>