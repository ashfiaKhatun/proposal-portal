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
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h4 class="cart-title">Students</h4>
                                    <a href="{{ route('students.create') }}">
                                        <button type="button" class="btn btn-sm btn-secondary text-white">
                                            Add New Student
                                        </button>
                                    </a>

                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped verticle-middle mt-3">
                                        <thead>
                                            <tr>
                                                <th>Student ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Batch</th>
                                                <th>Credit Finished</th>
                                                <th>Current CGPA</th>
                                                <th>Assigned Teacher</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($students as $student)
                                            <tr>
                                                <td>{{ $student->official_id }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->batch }}</td>
                                                <td>{{ $student->credit_finished }}</td>
                                                <td>{{ $student->cgpa }}</td>
                                                <td>{{ $student->assigned_teacher }}</td>
                                                <td>
                                                    <!-- Edit Button -->
                                                     <a href="{{ route('students.edit', $student->id) }}">
                                                         <button class="btn bg-transparent btn-sm"><i class="fa-regular fa-pen-to-square" data-toggle="tooltip" title="Edit"></i></button>
                                                     </a>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn bg-transparent btn-sm" onclick="return confirm('Are you sure you want to delete this student?')" data-toggle="tooltip" title="Delete"><i class="fa-solid fa-trash"></i></button>
                                                    </form>
                                                </td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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