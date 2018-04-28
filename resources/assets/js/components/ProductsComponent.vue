<template>
    <div class="row pt-5 pb-5">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa fa-image"></i>Productos</h3>
                </div>

                <div class="card-body" v-if="products.length || processing">
                    <div class="row">
                        <div
                            v-for="(product, index) in products"
                            :key="index"
                            class="col-sm-3"
                            style="margin-bottom: 10px"
                        >
                            <a
                                v-if="!logged"
                                :href="`/products/${product.image}`"
                                style="margin-top: 15px"
                                target="_blank"
                            >
                                <img :alt="product.name" :src="`/products/${product.image}`" class="img-fluid" />
                            </a>
                            <a
                                v-else
                                @click.prevent="addProductInCart(product.id)"
                                style="margin-top: 15px; cursor: pointer"
                            >
                                <img :alt="product.name" :src="`/products/${product.image}`" class="img-fluid" />
                            </a>

                            <div class="text-center">
                                <span class="badge badge-danger text-white text-center">
                                    Precio: {{ product.price }}
                                </span>
                            </div>
                        </div>

                        <preloader :processing="processing"> </preloader>
                    </div>
                </div>

                <div v-else="" class="card-body">
                    <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading">No hay productos disponibles!</h4>
                        <p>Aún no hay productos, pero pueden aparecer en cualquier momento!</p>
                    </div>
                </div>

            </div><!-- end card-->
        </div>
    </div>
</template>

<script>
    import CartMixin from '../mixins/cart';
    import ProductsMixin from '../mixins/products';
    import Preloader from "./Preloader";
    export default {
        components: {Preloader},
        name: "products-component",
        mixins: [CartMixin, ProductsMixin],
        data () {
            return {
                products: [],
                processing: false,
                url: '/products'
            }
        },
        methods: {
            prepareData (productsData) {
                let products = productsData.data;
                products.forEach(product => {
                    this.products.push({
                        id: product.id,
                        name: product.name,
                        price: product.price,
                        image: product.image
                    });
                });
            }
        },
        mounted () {
            window.Echo.channel('product-added').listen('ProductAdded', (e) => {
                let product = e.product;
                this.processing = true;
                setTimeout(() => {
                    this.products.push({
                        id: product.id,
                        name: product.name,
                        price: product.price,
                        image: product.image
                    });
                    this.processing = false;
                }, 1500);
            });

            window.Echo.channel('product-deleted').listen('ProductDeleted', (e) => {
                let productId = e.id;
                console.log("product deleted...");
                this.processing = true;
                setTimeout(() => {
                    const productIndex = this.products.findIndex(p => p.id === productId);
                    if(productIndex > -1) {
                        this.products.splice(productIndex, 1);
                    }
                    this.processing = false;
                }, 1500);
            });
        }
    }
</script>