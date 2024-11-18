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

                @if(auth()->user()->isAdmin)
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <div class="d-inline-block">
                                    <h3 class="card-title text-white">Total <br>Proposal</h3>
                                    <h2 class="text-white">{{ $proposalCount }}</h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><a href="{{ route('proposals.index') }}"><i class="icon-notebook text-white"></i></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <div class="d-inline-block">
                                    <h3 class="card-title text-white">Thesis <br>Proposal</h3>
                                    <h2 class="text-white">{{ $thesisProposalCount }}</h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><a href="{{ route('department.proposals.thesis') }}"><i class="icon-notebook text-white"></i></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <div class="d-inline-block">
                                    <h3 class="card-title text-white">Project <br>Proposal</h3>
                                    <h2 class="text-white">{{ $projectProposalCount }}</h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><a href="{{ route('department.proposals.project') }}"><i class="icon-notebook text-white"></i></a></span>
                            </div>
                        </div>
                    </div>
        
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-4">
                            <div class="card-body">
                                <div class="d-inline-block">
                                    <h3 class="card-title text-white">Pending <br>Proposal</h3>
                                    <h2 class="text-white">{{ $pendingProposalCount }}</h2>
                                </div>
                                <span class="float-right display-5 opacity-5">
                                    
                                    <a href="{{ route('proposals.pending') }}"><i class="icon-notebook text-white"></i></a>
                                    
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                @elseif(auth()->user()->role == 'supervisor' && !auth()->user()->isAdmin)
                <div class="row">
                    <div class="col-lg-4 col-sm-12">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <div class="d-inline-block">
                                    <h3 class="card-title text-white">Total Proposal</h3>
                                    <h2 class="text-white">{{ $proposalCount }}</h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="icon-notebook text-white"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <div class="d-inline-block">
                                    <h3 class="card-title text-white">Thesis Proposal</h3>
                                    <h2 class="text-white">{{ $thesisProposalCount }}</h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><a href="{{ route('supervisor.proposals.thesis') }}"><i class="icon-notebook text-white"></i></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <div class="d-inline-block">
                                    <h3 class="card-title text-white">Project Proposal</h3>
                                    <h2 class="text-white">{{ $projectProposalCount }}</h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><a href="{{ route('supervisor.proposals.project') }}"><i class="icon-notebook text-white"></i></a></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                @elseif(auth()->user()->role == 'student')
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <a href="{{ route('proposals.create') }}">
                            <div class="card gradient-2">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <h3 class="text-white">Submit Your Proposal</h3>
                                    <span class="display-5 opacity-5"><i class="icon-notebook text-white"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <a href="{{ route('proposals.indexSubmission') }}">
                            <div class="card gradient-3">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <h3 class="text-white">Check Your Proposals</h3>
                                    <span class="display-5 opacity-5"><i class="icon-notebook text-white"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                </div>
                @endif

                @if(auth()->user()->role == 'supervisor')
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h4 class="card-title mr-4 mt-2">{{ auth()->user()->isAdmin ? 'Pending' : '' }} Proposals</h4>

                                    @if(auth()->user()->isAdmin)
                                    <a href="{{ route('proposals.pending') }}">
                                        <button class="btn btn-sm btn-secondary text-white">See All</button>
                                    </a>
                                    @endif
                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-xs mb-0">
                                        <thead>
                                            <tr>
                                                <th>View</th>
                                                <th>Submission Date</th>
                                                <th>Type</th>
                                                <th>Student Id</th>
                                                <th>Area</th>
                                                <th>Title</th>
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
                                                <td>{{ $proposal->type == 'thesis' ? 'Thesis' : 'Project' }}</td>
                                                <td>{{ $proposal->student->official_id }}</td>
                                                <td>{{ $proposal->area }}</td>
                                                <td>{{ $proposal->title }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Pie chart</h4>
                                <canvas id="pieChart" width="500" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
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

    @if(auth()->user()->role == 'supervisor')
    <script>
        var ctx = document.getElementById("pieChart");
        ctx.height = 450;
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                    data: [{{ $thesisProposalCount }}, {{ $projectProposalCount }}],
                    backgroundColor: [
                        "#FB9F9E",
                        "#FFBD79"
                    ]

                }],
                labels: [
                    "Thesis",
                    "Project",
                ]
            },
            options: {
                responsive: true
            }
        });
    </script>
    @endif

</body>

</html>