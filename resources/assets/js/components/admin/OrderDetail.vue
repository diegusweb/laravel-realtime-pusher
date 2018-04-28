<template>
    <div class="row pt-5">
        <div class="col-12">
            <orders-detail :order="order" :is-admin="true"> </orders-detail>
        </div>
    </div>
</template>

<script>
    import OrdersDetail from "../OrderDetail.vue";
    export default {
        components: {OrdersDetail},
        name: "orders-admin-detail",
        props: {
            orderId: {
                type: String,
                required: true
            }
        },
        data () {
            return {
                order: {}
            }
        },
        mounted () {
            this.$http.get(`/admin/orders/jsonDetail/${this.orderId}`).then(order => {
                this.order = order.data;

                window.Echo.private(`processing-order-${this.order.id}`).listen('ProcessingOrder', (e) => {
                    let order = e.order;
                    console.log("processing order...");
                    this.order = order;
                });
            });
        }
    }
</script>
