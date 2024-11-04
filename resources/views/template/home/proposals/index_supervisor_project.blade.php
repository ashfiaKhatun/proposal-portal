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
                                <h4 class="cart-title">Project Proposals</h4>

                                <!-- Search Field -->
                                <div class="mb-1 w-25">
                                    <input type="text" id="searchInput" class="form-control-sm rounded" placeholder="Search...">
                                </div>

                                <div class="table-responsive text-nowrap">
                                    <table id="table" class="table table-bordered table-striped verticle-middle mt-3">
                                        <thead>
                                            <tr>
                                                <th>View</th>
                                                <th>Student ID</th>
                                                <th>Student Name</th>
                                                <th>Batch</th>
                                                <th>Area</th>
                                                <th>Title</th>
                                                <th>Status</th>
                                                <th>Feedback</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($proposals as $proposal)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('proposals.show', $proposal->id) }}">
                                                        <button class="btn bg-transparent btn-sm"><i class="fa-regular fa-eye" data-toggle="tooltip" title="View"></i></button>
                                                    </a>
                                                </td>
                                                <td>{{ $proposal->student->official_id }}</td>
                                                <td>{{ $proposal->student->name }}</td>
                                                <td>{{ $proposal->student->batch }}</td>
                                                <td>{{ $proposal->area }}</td>
                                                <td>{{ $proposal->title }}</td>
                                                <td>
                                                    @if($proposal->status == 'approved')
                                                    <span class="label label-pill label-success">Approved</span>
                                                    @elseif($proposal->status == 'rejected')
                                                    <span class="label label-pill label-danger">Rejected</span>
                                                    @elseif($proposal->status == 'pending')
                                                    <span class="label label-pill label-warning">Pending</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#feedbackModal{{ $proposal->id }}">
                                                        Give Feedback
                                                    </button>

                                                    <!-- Feedback Modal -->
                                                    <div class="modal fade" id="feedbackModal{{ $proposal->id }}" tabindex="-1" aria-labelledby="feedbackModalLabel{{ $proposal->id }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="feedbackModalLabel{{ $proposal->id }}">Give Feedback on {{ $proposal->student_id }}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('proposals.giveFeedback', $proposal->id) }}" method="POST">
                                                                        @csrf

                                                                        <div class="mb-3">
                                                                            <label for="feedback" class="form-label">Feedback</label>
                                                                            <textarea class="form-control" id="feedback" name="feedback" rows="3" required>{{ $proposal->feedback }}</textarea>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary">Submit Feedback</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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

    @include('template.home.layouts.custom_scripts.search_script')

</body>

</html>