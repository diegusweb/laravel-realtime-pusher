export default {
    methods: {
        totalProducts (orderLines) {
            if (orderLines) {
                return orderLines.reduce((total, o) => total + (o.qty), 0);
            }
        },
        updateStatus (orderId, orderLineId, nextStatus) {
            console.log(orderId);
            this.$http.put(`/order_lines/${orderLineId}/status`, {
                orderId, status: nextStatus
            })
        }
    }
}
