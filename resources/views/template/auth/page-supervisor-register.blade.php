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
                                    <h4 class="mt-3">Proposal Portal</h4>
                                </div>

                                <form method="POST" action="{{ route('supervisors.register') }}">
                                    @csrf

                                    <!-- ID -->
                                    <div>
                                        <label class="col-form-label">Teacher ID:</label>
                                        <input class="form-control rounded" type="text" name="teacher_id" placeholder="Teacher ID" required>

                                    </div>

                                    <!-- Name -->
                                    <div>
                                        <label class="col-form-label">Name:</label>
                                        <input id="name" class="form-control rounded" type="text" name="name" :value="old('name')" placeholder="Name" required autocomplete="name">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <!-- Email Address -->
                                    <div>
                                        <label class="col-form-label">Email:</label>
                                        <input id="email" class="form-control rounded" type="email" name="email" :value="old('email')" placeholder="Email" required autocomplete="email" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- <div class="form-group">
                                            <label for="isAdmin">Is Admin?</label>
                                            <input type="checkbox" name="isAdmin" value="1" />
                                        </div>
    
                                        <div class="form-group">
                                            <label for="isSuperAdmin">Is Super Admin?</label>
                                            <input type="checkbox" name="isSuperAdmin" value="1" />
                                        </div> -->

                                    <div class="form-group mt-2">
                                        <label for="dept_id">Department</label>
                                        <select name="dept_id" class="form-control">
                                            @foreach($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Designation -->
                                    <div>
                                        <label class="col-form-label">Designation:</label>
                                        <input class="form-control rounded" type="text" name="designation" placeholder="Designation" required>

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

                                    <button class="btn btn-primary my-3">Register</button>

                                </form>

                                <div>
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="/">
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