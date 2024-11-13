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


    <div class="login-form-bg">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form my-5    ">
                            <div class="card-body pt-5">
                                <div class="text-center">
                                    <img src="template/images/favicon.png" width="48">
                                    <h4 class="mt-3">Proposal Portal</h4>
                                    <h5 class="mt-3">Student Registration</h5>
                                </div>

                                <form method="POST" action="{{ route('register') }}" onsubmit="return validateForm()">
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

                                    <div class="form-group mt-2">
                                        <label for="dept_id">Department</label>
                                        <select name="dept_id" class="form-control">
                                            @foreach($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
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
        @include('template.home.layouts.footer')
    </div>


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