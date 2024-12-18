<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
</head>

<body>

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


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Navbar start
        ***********************************-->
        @include('template.home.layouts.navbar')
        <!--**********************************
        Navbar end ti-comment-alt
        ***********************************-->

        <!--**********************************
        Sidebar start
        ***********************************-->
        @include('template.home.layouts.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mx-auto">
                            <div class="card-body">
                                <h4 class="cart-title">Create New Supervisor</h4>
                                <div>
                                    <form method="POST" action="{{ route('supervisors.store') }}">
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

                                        <!-- Teacher Initial -->
                                        <div>
                                            <label class="col-form-label">Teacher Initial:</label>
                                            <input class="form-control rounded" type="text" name="teacher_initial" placeholder="Teacher Initial" required>
                                        </div>
    
                                        <!-- Email Address -->
                                        <div>
                                            <label class="col-form-label">Email:</label>
                                            <input id="email" class="form-control rounded" type="email" name="email" :value="old('email')" placeholder="Email" required autocomplete="email" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
    
                                        <!-- Designation -->
                                        <div>
                                            <label class="col-form-label">Designation:</label>
                                            <input class="form-control rounded" type="text" name="designation" placeholder="Designation" required>
    
                                        </div>
    
                                        <div class="form-group mt-3">
                                            <input type="checkbox" name="isAdmin" value="1" />
                                            <label class="ml-2" for="isAdmin">Is Admin?</label>
                                        </div>
    
                                        <!-- <div class="form-group">
                                            <label for="isSuperAdmin">Is Super Admin?</label>
                                            <input type="checkbox" name="isSuperAdmin" value="1" />
                                        </div> -->
    
                                        <!-- Password -->
                                        <div>
                                            <label class="col-form-label">Password:</label>
                                            <input id="password" class="form-control rounded" type="password" name="password" placeholder="Password" required autocomplete="new-password" />
                                            <x-input-error :messages="$errors->get('password')" />
                                        </div>
    
                                        <div>
                                            <label class="col-form-label">Confirm Password:</label>
                                            <input id="password_confirmation" class="form-control rounded" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        </div>
    
                                        <button class="btn btn-primary my-3">Register</button>
    
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        @include('template.home.layouts.footer')
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    @include('template.home.layouts.scripts')
    @include('template.home.layouts.custom_scripts.sweet_alert_script')


</body>

</html>