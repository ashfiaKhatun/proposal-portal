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
                                <h4 class="cart-title">Create New Student</h4>
                                <div>
                                    <form method="POST" action="{{ route('students.store') }}" onsubmit="return validateForm()">
                                        @csrf

                                        <!-- ID -->
                                        <div>
                                            <label class="col-form-label">Student ID:</label>
                                            <input class="form-control rounded" type="text" name="student_id" placeholder="Student ID" required>

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

                                        <!-- Batch -->
                                        <div>
                                            <label class="col-form-label">Batch:</label>
                                            <input class="form-control rounded" type="text" name="batch" placeholder="Batch" required>

                                        </div>

                                        <!-- Semester -->
                                        <div>
                                            <label class="col-form-label">Semester of Final Defense Registration:</label>
                                            <input class="form-control rounded" type="text" name="semester" placeholder="Ex: SPRING-2025" required>

                                        </div>

                                        <!-- Credit Finished -->
                                        <div>
                                            <label class="col-form-label">Credit Finished:</label>
                                            <input id="credit_finished" class="form-control rounded" type="text" name="credit_finished" placeholder="Credit Finished" required>
                                            <span id="creditError" style="color: red; display: none;">You need to complete at least 100 credits to register.</span>

                                        </div>

                                        <!-- CGPA -->
                                        <div>
                                            <label class="col-form-label">Current CGPA:</label>
                                            <input class="form-control rounded" type="text" name="cgpa" placeholder="Current CGPA" required>

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

    <script>
        function validateForm() {
            const creditFinished = document.getElementById("credit_finished").value;
            const creditError = document.getElementById("creditError");

            if (parseInt(creditFinished) < 100) {
                creditError.style.display = "inline";
                return false; // Prevent form submission
            } else {
                creditError.style.display = "none";
                return true; // Allow form submission
            }
        }
    </script>

</body>

</html>