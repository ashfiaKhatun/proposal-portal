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
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h4 class="cart-title">Supervisors ({{ $supervisorCount }})</h4>
                                    <a href="{{ route('supervisors.create') }}">
                                        <button type="button" class="btn btn-sm btn-secondary text-white">
                                            Add New Supervisor
                                        </button>
                                    </a>
                                </div>

                                <!-- Search Field -->
                                <div class="mb-1 w-25">
                                    <input type="text" id="searchInput" class="form-control-sm rounded" placeholder="Search...">
                                </div>


                                <div class="table-responsive text-nowrap">
                                    <table id="table" class="table table-bordered table-striped verticle-middle mt-3">
                                        <thead>
                                            <tr>
                                                <th>Teacher ID</th>
                                                <th>Name</th>
                                                <th>Teacher Initial</th>
                                                <th>Email</th>
                                                <th>Designation</th>
                                                <th>Status</th>
                                                <th>Change Status</th>
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
                                                    @if($supervisor->status == 'approved')
                                                    <span class="label label-pill label-success">Approved</span>
                                                    @elseif($supervisor->status == 'rejected')
                                                    <span class="label label-pill label-danger">Rejected</span>
                                                    @elseif($supervisor->status == 'pending')
                                                    <span class="label label-pill label-warning">Pending</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <form action="{{ route('supervisors.updateStatus', $supervisor->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="status" class="form-select-sm" onchange="this.form.submit()">
                                                            <option value="pending" {{ $supervisor->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="approved" {{ $supervisor->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                                            <option value="rejected" {{ $supervisor->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                        </select>
                                                    </form>
                                                </td>

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