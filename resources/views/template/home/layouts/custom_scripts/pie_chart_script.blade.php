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