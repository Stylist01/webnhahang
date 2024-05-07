<script>
    $(document).ready(function() {
        $(document).on('click', '.cart__remove--btn', function() {
            let parent = $(this).closest('.cart__table--body__items');
            let cart_detail_id = parent.find('.cart_detail_id');
            $.ajax({
                url: `{{ route('deleteOneCart') }}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    cart_detail_id: cart_detail_id.val(),
                },
                cache: false,
                method: 'POST',
                success: function(response) {
                    if (response.code == 200) {
                        alert("Xóa món ăn thành công");
                        window.location.reload();
                    } else {
                        alert("Xóa món ăn thất bại");
                    }
                },
                error: function(xhr) {
                    alert("Xóa món ăn thất bại");
                }
            });
        });

        $('.continue__shopping--clear').on('click', function() {
            let order_id = $(".order_id").val();
            $.ajax({
                url: `{{ route('deleteAllCart') }}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    order_id: order_id,
                },
                cache: false,
                method: 'POST',
                success: function(response) {
                    if (response.code == 200) {
                        alert("Xóa món ăn thành công");
                        window.location.reload();
                    } else {
                        alert("Xóa món ăn thất bại");
                    }
                },
                error: function(xhr) {
                    alert("Xóa món ăn thất bại");
                }
            });
        });
    })
</script>
