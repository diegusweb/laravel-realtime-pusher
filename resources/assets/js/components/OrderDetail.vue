<template>
    <div class="card">
        <div class="card-header">
            <h3><i class="fa fa-bell"></i> <span class="badge badge-dark">ID PEDIDO: {{ order.id }}</span></h3>
        </div>

        <div class="card-body">
            <div class="row">

                <order-status :order="order"> </order-status>

                <div class="col-sm">
                    <span class="badge badge-info p-3 d-block">
                         TOTAL PRODUCTOS: {{ totalProducts(order.order_lines) }}
                    </span>
                </div>

                <div class="col-sm">
                    <span class="badge badge-info p-3 d-block">
                         COSTE TOTAL: {{ order.total }}€
                    </span>
                </div>
            </div>

            <table class="table table-responsive-lg table-hover">
                <thead>
                    <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>

                    <tr v-for="order_line in order.order_lines" :key="order_line.id">
                        <td scope="col">
                            <img height="40" :src="`/products/${order_line.product.image}`" />
                        </td>
                        <td scope="col">{{ order_line.product.name }}</td>
                        <td scope="col">{{ order_line.qty }}</td>
                        <td scope="col">{{ order_line.product.price * order_line.qty }}€</td>
                        <td scope="col" v-if="isAdmin">
                            <button
                                class="btn btn-warning"
                                v-if="order_line.status === 'PENDING'"
                                @click="updateStatus(order_line.order_id, order_line.id, 'PROCESSING')"
                            >
                                INICIAR
                            </button>
                            <button
                                v-else-if="order_line.status === 'PROCESSING'"
                                class="btn btn-primary"
                                @click="updateStatus(order_line.order_id, order_line.id, 'FINISHED')"
                            >
                                FINALIZAR
                            </button>
                            <button
                                v-else=""
                                class="btn btn-danger"
                                disabled
                            >
                                LISTO
                            </button>
                        </td>
                        <td scope="col" v-else>
                            <button
                                class="btn btn-warning text-white"
                                v-if="order_line.status === 'PENDING'"
                                disabled
                            >
                                PENDIENTE
                            </button>
                            <button
                                v-else-if="order_line.status === 'PROCESSING'"
                                class="btn btn-primary text-white"
                                disabled
                            >
                                PROCESANDO
                            </button>
                            <button
                                v-else=""
                                class="btn btn-danger text-white"
                                disabled
                            >
                                FINALIZADO
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import OrderMixin from '../mixins/order';
    import Preloader from "./Preloader.vue";
    import OrderStatus from "./OrderStatus.vue";
    export default {
        components: {
            OrderStatus,
            Preloader
        },
        mixins: [OrderMixin],
        name: "orders-detail",
        props: {
            order: {
                type: Object,
                required: true
            },
            isAdmin: {
                type: Boolean
            }
        }
    }
</script>
