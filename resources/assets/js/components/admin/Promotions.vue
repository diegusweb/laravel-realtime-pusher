<template>
    <div class="row pt-3 pb-3">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <button class="btn btn-dark" @click="addPromotion">
                        Añadir promoción
                    </button>
                </div>

                <div class="card-body">
                    <div class="alert alert-primary text-center" v-if="processing">
                        <i class="fa fa-compass"></i> Procesando petición...
                    </div>

                    <v-server-table ref="promotionsTable" :columns="columns" url="/admin/promotions/json" :options="options">
                        <div slot="name" slot-scope="props">
                            <p>{{ props.row.product.name }}</p>
                        </div>

                        <div slot="image" slot-scope="props">
                            <img height="60" :src="`/products/${props.row.product.image}`" />
                        </div>

                        <div slot="price" slot-scope="props">
                            <div class="card-box noradius noborder bg-default">
                                <h6 class="text-white text-uppercase m-b-20">
                                    <span style="text-decoration: line-through">{{ props.row.product.price }}€</span>
                                    {{ props.row.price }}€
                                </h6>
                            </div>
                        </div>

                        <div slot="actions" slot-scope="props">
                            <button class="btn btn-danger" @click="removePromotion(props.row)">
                                Eliminar
                            </button>
                        </div>
                    </v-server-table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "promotions-list",
        data () {
            return {
                selected_promotion: {},
                showModal: false,
                products: [],
                processing: false,
                status: null,
                url: `/admin/promotions/json`,
                columns: ['id', 'image', 'name', 'price', 'actions'],
                options: {
                    filterByColumn: true,
                    perPage: 10,
                    perPageValues: [10, 25, 50, 100, 500],
                    headings: {
                        id: 'ID',
                        name: 'Nombre',
                        price: 'Precio',
                        image: 'Imagen',
                        actions: 'Acciones'
                    },
                    sortable: ['id', 'name', 'price', 'image'],
                    filterable: [],
                    requestFunction: function (data) {
                        return window.axios.get(this.url, {
                            params: data
                        })
                            .catch(function (e) {
                                this.dispatch('error', e);
                            }.bind(this));
                    }
                }
            }
        },
        methods: {
            addPromotion () {
                window.location.href = `/admin/promotions/create`;
            },
            removePromotion (product) {
                this.$http.delete(`/admin/promotions/${product.id}`, {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }).then(() => {
                    this.$refs.promotionsTable.refresh();
                });
            }
        }
    }
</script>

<style>
    .table-bordered>thead>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>tfoot>tr>td {
        text-align: center !important;
    }
</style>
