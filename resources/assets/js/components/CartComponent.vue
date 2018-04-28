<template>
    <div class="row pt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa fa-image"></i>Carrito</h3>
                </div>

                <preloader :center="true" :processing="processing" v-if="processing"> </preloader>

                <div v-else>
                    <div class="card-body" v-if="products.length">
                        <table class="table table-responsive-lg table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Producto</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="product in products" :key="product.id">
                                <td>{{ product.name }}</td>
                                <td>
                                    <img height="40" :src="`/products/${product.image}`" />
                                </td>
                                <td>{{ product.qty }}</td>
                                <td>{{ product.price }}</td>
                                <td>
                                    <button class="btn btn-warning" @click="decrementProductInCart(product.id)">
                                        <i class="fa fa-minus bigfonts" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-primary" @click="addProductInCart(product.id)">
                                        <i class="fa fa-plus bigfonts" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-danger" @click="removeProductInCart(product.id)">
                                        <i class="fa fa-trash bigfonts" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="1">
                                    <button class="btn btn-outline-dark" @click="processCart">
                                        Procesar pedido
                                    </button>
                                </td>
                                <td colspan="1">
                                    <label class="badge badge-success p-3">
                                        Coste total: {{ totalCost(products) }}
                                    </label>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body" v-else>
                        <div class="alert alert-warning" role="alert">
                            <h4 class="alert-heading">No hay productos en el carrito!</h4>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import Preloader from './Preloader';
    import CartMixin from '../mixins/cart';
    export default {
        name: "cart-component",
        mixins: [CartMixin],
        components: {
            Preloader
        },
        props: {
            user_id: {
                type: Number,
                required: true
            }
        },
        data () {
            return {
                products: [],
                processing: false
            }
        },
        mounted () {
            this.$http.get('/cart').then(cartData => {
                cartData.data.map(product => {
                    this.products.push(product);
                });
            });

            window.Echo.private(`cart-updated.${this.user_id}`).listen('UserCart', (e) => {
                this.processing = true;
                setTimeout(() => {
                    let cart = e.cart;
                    this.products = [];
                    cart.map(product => {
                        this.products.push(product);
                    });
                    this.processing = false;
                }, 1200);
            });
        }
    }
</script>
