<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}&currency=USD"></script>
<script>
    $(document).ready(function() {
        function getFormData() {
            var formData = new FormData();
            formData.append('customer_id', `{{ auth()->guard('customer')->user()->id }}`);
            formData.append('order_id', $('.order_id').val());
            formData.append('total_money', $('.total_money').val());
            return formData;
        }

        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({
            // Call your server to set up the transaction
            createOrder: function(data, actions) {
                return fetch('/api/paypal/order/createUser', {
                    method: 'POST',
                    body: getFormData(),
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    return orderData.id;
                });
            },

            // Call your server to finalize the transaction
            onApprove: function(data, actions) {
                return fetch('/api/paypal/order/captureUser', {
                    method: 'POST',
                    body: JSON.stringify({
                        orderId: data.orderID,
                    })
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    window.location.href = `{{ route('fe.order') }}`;
                });
            }

        }).render('#paypal-button-container');
    })
</script>
