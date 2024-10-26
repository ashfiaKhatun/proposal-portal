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

                                <div>
                                    <h4 class="card-title">Submitted Proposal</h4>

                                    @if($proposal->status == 'approved')
                                    <span class="label label-pill label-success">Approved</span>
                                    @elseif($proposal->status == 'rejected')
                                    <span class="label label-pill label-danger">Rejected</span>
                                    @elseif($proposal->status == 'pending')
                                    <span class="label label-pill label-warning">Pending</span>
                                    @endif

                                </div>

                                <div class="proposal-details mt-4">

                                    <div class="row">
                                        <b class="col-3">Student ID:</b>
                                        <p class="col-9 ">{{ $proposal->student->official_id }}</p>
                                    </div>

                                    <div class="row">
                                        <b class="col-3">Student Name:</b>
                                        <p class="col-9 ">{{ $proposal->student->name }}</p>
                                    </div>

                                    <div class="row">
                                        <b class="col-3">Batch:</b>
                                        <p class="col-9 ">{{ $proposal->student->batch }}</p>
                                    </div>

                                    <div class="row">
                                        <b class="col-3">Area:</b>
                                        <p class="col-9 ">{{ $proposal->area }}</p>
                                    </div>


                                    <div class="row">
                                        <b class="col-3">Title:</b>
                                        <p class="col-9 ">{{ $proposal->title }}</p>
                                    </div>

                                    @if($proposal->type == 'project')
                                    <div class="row">
                                        <b class="col-3">Brief Discussion:</b>
                                        <p class="col-9 ">{{ $proposal->description }}</p>
                                    </div>

                                    <div class="row">
                                        <b class="col-3">Skills:</b>
                                        <p class="col-9 ">{{ $proposal->skills }}</p>
                                    </div>

                                    @elseif($proposal->type == 'thesis')
                                    <div class="row">
                                        <b class="col-3">Background Study:</b>
                                        <p class="col-9 ">{{ $proposal->background }}</p>
                                    </div>

                                    <div class="row">
                                        <b class="col-3">Research Questions:</b>
                                        <p class="col-9 ">{{ $proposal->question }}</p>
                                    </div>

                                    <div class="row">
                                        <b class="col-3">Research Objectives:</b>
                                        <p class="col-9 ">{{ $proposal->objective }}</p>
                                    </div>

                                    <div class="row">
                                        <b class="col-3">Skills:</b>
                                        <p class="col-9 ">{{ $proposal->skills }}</p>
                                    </div>
                                    @endif

                                    <div class="row">
                                        <b class="col-3">Assigned To:</b>
                                        <p class="col-9 ">{{ $proposal->assignedTeacher->name }} ( {{ $proposal->assignedTeacher->official_id }} )</p>
                                    </div>

                                    <div class="row">
                                        <b class="col-3">Supervisors Feedback:</b>
                                        <p class="col-9 ">{{ $proposal->feedback }}</p>
                                    </div>

                                    <div class="row">
                                        <b class="col-3">Change Status:</b>
                                        <form action="{{ route('proposals.updateStatus', $proposal->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-select-sm" onchange="this.form.submit()">
                                                <option value="pending" {{ $proposal->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="approved" {{ $proposal->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                                <option value="rejected" {{ $proposal->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                            </select>
                                        </form>
                                    </div>

                                    <div class="row mt-3">
                                        <b class="col-3">Assign Supervisor:</b>
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
                                    </div>

                                    <div class="row mt-3">
                                        <b class="col-3">Provide Feedback:</b>
                                        <!-- Supervisor Dropdown -->
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
                                                            @method('PUT')
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
                                    </div>

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

    <script>
        document.getElementById('type').addEventListener('change', function() {
            var selectedType = this.value;

            // Clear fields when type changes
            clearFields();

            // Show/hide fields based on selected type
            document.getElementById('projectFields').style.display = selectedType === 'project' ? 'block' : 'none';
            document.getElementById('thesisFields').style.display = selectedType === 'thesis' ? 'block' : 'none';
        });

        // Function to clear all fields
        function clearFields() {
            // Clear common fields
            document.getElementById('area').value = '';
            document.getElementById('title').value = '';

            // Clear project-specific fields
            document.getElementById('description').value = '';
            document.getElementById('projectSkills').value = '';

            // Clear thesis-specific fields
            document.getElementById('background').value = '';
            document.getElementById('question').value = '';
            document.getElementById('objective').value = '';
            document.getElementById('thesisSkills').value = '';
        }
    </script>

</body>

</html>