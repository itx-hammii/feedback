<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    $(".alert-danger").fadeTo(3000, 1000).slideUp(1000, function(){
        $("#success-alert").slideUp(1000);
    });
    $(document).on('click', '.confirm', function (e) {
        e.preventDefault(); //alert($(this).attr('href'));
        // $('#alertModal2').modal('show');
        var type_confirmation_text=$(this).attr('data-confirmation-text');
        var description=$(this).attr('data-description');
        var action = $(this).attr('href');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                 $('#delete-form').attr('action',action);
                $('#delete-form').submit();
            }
        })
    });
</script>
