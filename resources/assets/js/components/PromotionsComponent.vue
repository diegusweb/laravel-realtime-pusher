<template>
    <div class="row pt-5 pb-5">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa fa-image"></i>Promociones</h3>
                </div>

                <div class="card-body" v-if="promotions.length || processing">
                    <div class="row">
                        <div
                            v-for="(promotion, index) in promotions"
                            :key="index"
                            class="col-sm-3"
                            style="margin-bottom: 10px"
                        >
                            <a
                                v-if="!logged"
                                :href="`/products/${promotion.image}`"
                                style="margin-top: 15px"
                                target="_blank"
                            >
                                <img :alt="promotion.name" :src="`/products/${promotion.image}`" class="img-fluid" />
                            </a>
                            <a
                                v-else
                                @click.prevent="addProductInCart(promotion.productId)"
                                style="margin-top: 15px; cursor: pointer"
                            >
                                <img :alt="promotion.name" :src="`/products/${promotion.image}`" class="img-fluid" />
                            </a>

                            <div class="text-center">
                                <span class="badge badge-danger text-white text-center">
                                    Precio: {{ promotion.price }}
                                </span>
                            </div>
                        </div>

                        <preloader :processing="processing"> </preloader>

                    </div>
                </div>

                <div v-else="" class="card-body">
                    <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading">No hay promociones disponibles!</h4>
                        <p>Aún no hay promociones, pero pueden aparecer en cualquier momento!</p>
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
        name: "promotions-component",
        mixins: [CartMixin, ProductsMixin],
        data () {
            return {
                promotions: [],
                processing: false,
                url: '/promotions'
            }
        },
        methods: {
            prepareData (promotionsData) {
                let promotions = promotionsData.data;
                promotions.forEach(promotion => {
                    this.promotions.push({
                        id: promotion.id,
                        productId: promotion.product.id,
                        name: promotion.product.name,
                        price: promotion.price,
                        image: promotion.product.image
                    });
                });
            }
        },
        mounted () {
            window.Echo.channel('new-promotion').listen('.new-promotion-added', (e) => {
                let promotion = e.promotion;
                this.processing = true;
                setTimeout(() => {
                    this.promotions.push({
                        id: promotion.id,
                        productId: promotion.product.id,
                        name: promotion.product.name,
                        price: promotion.price,
                        image: promotion.product.image
                    });
                    this.processing = false;
                }, 1500);
            });

            window.Echo.channel('promotion-deleted').listen('PromotionDeleted', (e) => {
                let productId = e.productId;
                this.processing = true;
                setTimeout(() => {
                    const promotionIndex = this.promotions.findIndex(p => p.productId === productId);
                    if(promotionIndex > -1) {
                        this.promotions.splice(promotionIndex, 1);
                    }
                    this.processing = false;
                }, 1500);
            })
        }
    }
</script>