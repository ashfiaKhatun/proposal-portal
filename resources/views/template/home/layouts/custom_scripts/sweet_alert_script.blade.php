@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Unauthorized Access',
        text: "{{ session('error') }}",
        confirmButtonText: 'OK'
    });
</script>
@elseif(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Successful',
        text: "{{ session('success') }}",
        confirmButtonText: 'OK'
    });
</script>
@endif