<script>
    var requestDisabled = false;
    $(document).on('change', '.comment', function (event) {
        if (requestDisabled) {
            event.preventDefault();
            return true;
        }
        requestDisabled = true;
        /*$('.status-check-box').not(this).bootstrapToggle('off');*/
        id = $(this).attr('data-id')
        value = $(this).is(":checked") ? 1 : 0;
        // console.log(value);

        $.ajax({
            url: "/comment-toggle/" + id,
            method: 'GET',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id, "value": value
            },
            success: function (result) {
                requestDisabled = false;
                Toast.fire({
                    icon: 'success',
                    title: 'Request has been processed.'
                })

            },
            error: function (result) {
                requestDisabled = false;
                console.log(result);
            }


        });

    });
</script>
