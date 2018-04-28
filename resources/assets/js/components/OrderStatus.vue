<template>
    <div class="col-sm">
        <span class="badge badge-danger p-3 d-block" v-if="order.status === 'PENDING'">
            {{ order.status }}
        </span>
        <span class="badge badge-info d-block" v-else-if="order.status === 'PROCESSING'">
            <preloader :processing="true" :size="37"> </preloader>
        </span>
        <span class="badge badge-success p-3 d-block" v-else-if="order.status === 'FINISHED'">
            {{ order.status }}
        </span>
    </div>
</template>

<script>
    import Preloader from "./Preloader.vue";
    export default {
        name: 'order-status',
        components: {Preloader},
        props: ['order']
    }
</script>
