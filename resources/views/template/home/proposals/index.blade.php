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

                                <!-- Search Field -->
                                <div class="mb-1 d-lg-flex justify-content-between">

                                    <div>
                                        @if($type == 'project')
                                        <h4 class="cart-title">Project Proposals ({{ $proposalCount }})</h4>

                                        @elseif($type == 'thesis')
                                        <h4 class="cart-title">Thesis Proposals ({{ $proposalCount }})</h4>

                                        @elseif(!$type)
                                        <h4 class="cart-title">All Submissions ({{ $proposalCount }})</h4>

                                        @endif

                                        @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                        @endif
                                    </div>

                                    <input type="text" id="searchInput" class="form-control-sm rounded" placeholder="Search...">
                                </div>

                                @if($batches)
                                <label for="batchFilter">Filter by Batch:</label>
                                <select id="batchFilter" onchange="filterByBatch()">
                                    <option value="all">All Batches</option>
                                    @foreach ($batches as $batch)
                                    <option value="{{ $batch }}">{{ $batch }}</option>
                                    @endforeach
                                </select>
                                @endif

                                <div class="table-responsive text-nowrap">
                                    <table id="table" class="table table-bordered table-striped verticle-middle mt-3">
                                        <thead>
                                            <tr>
                                                <th>View</th>
                                                <th>Submission Date
                                                    <button class="btn bg-transparent" onclick="sortTable('submissionDate')">↑↓</button>
                                                </th>
                                                <th>Student ID
                                                    <button class="btn bg-transparent" onclick="sortTable('studentID')">↑↓</button>
                                                </th>
                                                <th>Student Name
                                                    <button class="btn bg-transparent" onclick="sortTable('studentName')">↑↓</button>
                                                </th>
                                                <th>Batch
                                                    <button class="btn bg-transparent" onclick="sortTable('batch')">↑↓</button>
                                                </th>
                                                <th>CGPA
                                                    <button class="btn bg-transparent" onclick="sortTable('cgpa')">↑↓</button>
                                                </th>
                                                <th>Area
                                                    <button class="btn bg-transparent" onclick="sortTable('area')">↑↓</button>
                                                </th>
                                                <th>Title
                                                    <button class="btn bg-transparent" onclick="sortTable('title')">↑↓</button>
                                                </th>
                                                <th>Status
                                                    <button class="btn bg-transparent" onclick="sortTable('status')">↑↓</button>
                                                </th>
                                                <th>Assigned Supervisor
                                                    <button class="btn bg-transparent" onclick="sortTable('supervisor')">↑↓</button>
                                                </th>
                                                <th>Supervisor Initial
                                                    <button class="btn bg-transparent" onclick="sortTable('supervisorInitial')">↑↓</button>
                                                </th>
                                                @if($showExtraColumns)
                                                <th>Change Status</th>
                                                <th>Assign Supervisor</th>
                                                @endif
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
                                                <td>{{ $proposal->created_at->format('j F Y') }}</td>
                                                <td>{{ $proposal->student->official_id }}</td>
                                                <td>{{ $proposal->student->name }}</td>
                                                <td>{{ $proposal->student->batch }}</td>
                                                <td>{{ $proposal->student->cgpa }}</td>
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

                                                <td>{{ $proposal->assignedTeacher ? $proposal->assignedTeacher->name : 'Not Assigned' }}</td>

                                                <td>{{ $proposal->assignedTeacher ? $proposal->assignedTeacher->teacher_initial : 'Not Assigned' }}</td>

                                                @if($showExtraColumns)

                                                <td>
                                                    @if(auth()->user()->isAdmin && auth()->user()->dept_id == $proposal->dept_id)
                                                    <form action="{{ route('proposals.updateStatus', $proposal->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="status" class="form-select-sm" onchange="this.form.submit()">
                                                            <option value="pending" {{ $proposal->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="approved" {{ $proposal->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                                            <option value="rejected" {{ $proposal->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                        </select>
                                                    </form>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if(auth()->user()->isAdmin && auth()->user()->dept_id == $proposal->dept_id && $proposal->status == 'approved')
                                                    <!-- Supervisor Dropdown -->
                                                    <form action="{{ route('proposals.assignTeacher', $proposal->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="ass_teacher_id" class="form-select-sm" onchange="this.form.submit()">
                                                            <option value="">-- Select Supervisor --</option>
                                                            @foreach ($supervisors as $supervisor)
                                                            <option value="{{ $supervisor->official_id }}" {{ $proposal->ass_teacher_id == $supervisor->official_id ? 'selected' : '' }}>
                                                                {{ $supervisor->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </form>
                                                    @endif
                                                </td>
                                                @endif

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
    @include('template.home.layouts.custom_scripts.proposal_table_filter_script')
    @include('template.home.layouts.custom_scripts.batch_filter_script')

</body>

</html>