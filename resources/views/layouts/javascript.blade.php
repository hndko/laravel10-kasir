<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('assets/js/ruang-admin.min.js') }}"></script>
<!-- Page level plugins -->
<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable(); // ID From dataTable 
        $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
</script>

<script>
    @if (session('status') && session('status') === 'error')
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('message') }}',
            timer: 3000, // Auto-close after 3 seconds (adjust the time as needed)
            showConfirmButton: false // Hide the "OK" button
        });
    @endif

    @if (session('status') && session('status') === 'success')
        Swal.fire({
            icon: 'success',
            title: 'Hore...',
            text: '{{ session('message') }}',
            timer: 3000, // Auto-close after 3 seconds (adjust the time as needed)
            showConfirmButton: false // Hide the "OK" button
        });
    @endif
</script>
