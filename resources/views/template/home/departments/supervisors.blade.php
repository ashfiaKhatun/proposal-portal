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
                                <div class="d-lg-flex justify-content-between">
                                    <h4 class="cart-title">Supervisors in {{ $department->name }}</h4>

                                    <!-- Search Field -->
                                    <div class="mb-1 mt-3 w-25">
                                        <input type="text" id="searchInput" class="form-control-sm rounded" placeholder="Search...">
                                    </div>
                                </div>


                                <a href="{{ route('departments.createAdmin', $department->id) }}">
                                    <button class="btn bg-secondary btn-sm text-white">Assign Admin</button>
                                </a>

                                <div class="table-responsive text-nowrap text-black">
                                    <table id="table" class="table table-bordered table-striped verticle-middle mt-3">
                                        <thead>
                                            <tr>
                                                <th>Teacher ID</th>
                                                <th>Name</th>
                                                <th>Teacher Initial</th>
                                                <th>Email</th>
                                                <th>Designation</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($supervisors as $supervisor)
                                            <tr>
                                                <td>{{ $supervisor->official_id }}</td>
                                                <td>{{ $supervisor->name }}</td>
                                                <td>{{ $supervisor->teacher_initial }}</td>
                                                <td>{{ $supervisor->email }}</td>
                                                <td>{{ $supervisor->designation }}</td>
                                                <td>
                                                    <!-- Edit Button -->
                                                    <a href="{{ route('supervisors.proposals', $supervisor->official_id) }}">
                                                        <button class="btn bg-transparent btn-sm"><i class="icon-notebook" data-toggle="tooltip" title="View Proposals"></i></button>
                                                    </a>

                                                    <!-- Edit Button -->
                                                    <a href="{{ route('supervisors.edit', $supervisor->id) }}">
                                                        <button class="btn bg-transparent btn-sm"><i class="fa-regular fa-pen-to-square" data-toggle="tooltip" title="Edit"></i></button>
                                                    </a>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('supervisors.destroy', $supervisor->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn bg-transparent btn-sm" onclick="return confirm('Are you sure you want to delete this supervisor?')" data-toggle="tooltip" title="Delete"><i class="fa-solid fa-trash"></i></button>
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
    @include('template.home.layouts.custom_scripts.sweet_alert_script')


    @include('template.home.layouts.custom_scripts.search_script')


</body>

</html>