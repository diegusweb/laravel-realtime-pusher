<template>
    <div class="row pt-3 pb-3">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

                    <div class="alert alert-primary text-center" v-if="processing">
                        <i class="fa fa-compass"></i> Recibiendo nuevo pedido...
                    </div>

                    <v-server-table ref="ordersTable" :columns="columns" url="/admin/orders/json" :options="options">

                        <div slot="status" slot-scope="props">
                            <order-status :order="props.row"> </order-status>
                        </div>

                        <div slot="total" slot-scope="props">
                            <span class="badge badge-info p-3 d-block">
                                 {{ props.row.total }}€
                            </span>
                        </div>

                        <div slot="products" slot-scope="props">
                            <span class="badge badge-success p-3 d-block">
                                 {{ totalProducts(props.row.order_lines) }}
                            </span>
                        </div>

                        <div slot="actions" slot-scope="props">
                            <button class="btn btn-info btn-block" @click="showDetail(props.row)">
                                Ver detalle
                            </button>
                        </div>
                    </v-server-table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import OrderMixin from '../../mixins/order';
    import OrderStatus from "../OrderStatus";
    export default {
        components: {OrderStatus},
        mixins: [OrderMixin],
        data () {
            return {
                name: 'orders-admin',
                processing: false,
                status: null,
                url: `${process.env.MIX_APP_URL}/admin/orders/json`,
                columns: ['id', 'status', 'total', 'products', 'actions'],
                options: {
                    filterByColumn: true,
                    perPage: 10,
                    perPageValues: [10, 25, 50, 100, 500],
                    headings: {
                        id: 'ID',
                        status: 'Estado',
                        total: 'Total',
                        products: 'Productos',
                        actions: 'Acciones'
                    },
                    sortable: ['id', 'status', 'total', 'products'],
                    filterable: [],
                    requestFunction: function (data) {
                        return window.axios.get(this.url, {
                            params: data
                        })
                            .catch(function (e) {
                                this.dispatch('error', e);
                            }.bind(this));
                    }
                },
            }
        },
        mounted () {
            window.Echo.private('new-order').listen('NewOrder', (e) => {
                this.processing = true;
                setTimeout(() => {
                    this.$refs.ordersTable.refresh();
                    this.processing = false;
                }, 1500);
            })
        },
        methods: {
            showDetail (order) {
                window.location.href = `/admin/orders/${order.id}`;
            }
        },
    }
</script>
