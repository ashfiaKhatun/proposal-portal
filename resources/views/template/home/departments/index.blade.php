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
                                    <h4 class="cart-title">Departments</h4>
                                    <button type="button" class="btn btn-sm btn-secondary text-white" data-toggle="modal" data-target="#addDepartmentModal">
                                        Add New Department
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped verticle-middle mt-3">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($departments as $department)
                                            <tr>
                                                <td>{{ $department->name }}</td>
                                                <td>
                                                   
                                                    <!-- View Teachers Button -->
                                                    <a href="{{ route('departments.supervisors', $department->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="View Supervisors">
                                                        Supervisors<i class="fa-solid fa-chalkboard-teacher ml-2"></i> 
                                                    </a>

                                                    <!-- View Students Button -->
                                                    <a href="{{ route('departments.students', $department->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="View Students">
                                                        Students<i class="fa-solid fa-user-graduate ml-2"></i> 
                                                    </a>

                                                     <!-- Edit Button -->
                                                     <button class="btn btn-secondary btn-sm text-white" data-toggle="modal" data-target="#editDepartmentModal" data-id="{{ $department->id }}" data-name="{{ $department->name }}">Edit<i class="fa-regular fa-pen-to-square ml-2" data-toggle="tooltip" title="Edit"></i></button>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this department?')" data-toggle="tooltip" title="Delete">Delete<i class="fa-solid fa-trash ml-2"></i></button>
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

                <!-- Add Department Modal -->
                <div class="modal fade" id="addDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addDepartmentModalLabel">Add New Department</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="departmentForm" action="{{ route('departments.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">Department Name:</label>
                                        <input type="text" id="name" name="name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary text-white" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-sm btn-primary">Save Department</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Department Modal -->
                <div class="modal fade" id="editDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="editDepartmentModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editDepartmentModalLabel">Edit Department</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="editDepartmentForm" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="editName">Department Name:</label>
                                        <input type="text" id="editName" name="name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary text-white" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-sm btn-primary">Update Department</button>
                                </div>
                            </form>
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
        // Handle the edit button click
        $('#editDepartmentModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var departmentId = button.data('id'); // Extract info from data-* attributes
            var departmentName = button.data('name');

            var modal = $(this);
            modal.find('#editName').val(departmentName);
            modal.find('form').attr('action', '/departments/' + departmentId);
        });
    </script>

</body>

</html>