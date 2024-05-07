<!-- Summernote -->
<script>
    $(document).ready(function() {
        $(document).on('click', '.link_detail_order', function() {
            $('#modal-order-detail').empty();
            let order_id = $(this).text();
            $.ajax({
                url: `{{ route('getOrderDetail') }}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    order_id: order_id,
                },
                cache: false,
                method: 'POST',
                success: function(response) {
                    $("#detailOrderModal").removeClass('d-none')
                    $('#detailOrderModalLabel .order_id').text(order_id);
                    $('#modal-order-detail').html(response);
                },
                error: function(xhr) {}
            });
        });

        window.onclick = function(event) {
            if ($("#detailOrderModal").closest(event.target).length) {
                $("#detailOrderModal").addClass('d-none')
            }
        }

    })
</script>
