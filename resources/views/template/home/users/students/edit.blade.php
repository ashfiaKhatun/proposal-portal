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

            <div class="container-fluid mt-3">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card w-75 mx-auto">
                            <div class="card-body">
                                <h4 class="cart-title">Create New Supervisor</h4>
                                <div>
                                    <form method="POST" action="{{ route('students.update', $student->id) }}">
                                        @csrf
                                        @method('PUT')
    
                                        <!-- ID -->
                                        <div>
                                            <label class="col-form-label">Student ID:</label>
                                            <input class="form-control rounded" type="text" name="student_id" value="{{ $student->official_id }}" placeholder="Teacher ID" required>
    
                                        </div>
    
                                        <!-- Name -->
                                        <div>
                                            <label class="col-form-label">Name:</label>
                                            <input id="name" class="form-control rounded" type="text" name="name" value="{{ $student->name }}" placeholder="Name" required autofocus autocomplete="name">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
    
                                        <!-- Email Address -->
                                        <div>
                                            <label class="col-form-label">Email:</label>
                                            <input id="email" class="form-control rounded" type="email" name="email" value="{{ $student->email }}" placeholder="Email" required autocomplete="email" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
    
                                        <div class="form-group mt-2">
                                            <label for="dept_id">Department</label>
                                            <select name="dept_id" class="form-control">
                                                @foreach($departments as $department)
                                                <option value="{{ $department->id }}" {{ $student->dept_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                        </div> 
    
                                        <button class="btn btn-primary btn-sm my-3">Update</button>
    
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

</body>

</html>