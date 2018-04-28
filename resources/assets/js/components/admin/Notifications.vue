<template>
    <li class="list-inline-item dropdown notif">
        <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <i class="fa fa-fw fa-bell-o"></i>
            <span class="notif-bullet" v-if="notifications.length"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg">
            <!-- item-->
            <div class="dropdown-item noti-title">
                <h5>
                    <small>
                        <span class="label label-danger pull-xs-right">
                            {{ notifications.length }}
                        </span>
                        Alertas
                    </small>
                </h5>
            </div>

            <!-- All-->
            <button
                @click="buildDetailUrl(notification)"
                target="_blank"
                v-for="(notification, index) in notifications"
                :key="index"
                class="dropdown-item notify-item notify-all"
            >
                {{ notification.title }}
            </button>

        </div>
    </li>
</template>

<script>
    export default {
        name: "admin-notifications",
        data () {
            return {
                notifications: []
            }
        },
        mounted () {
            window.Echo.private('new-order').listen('NewOrder', (e) => {
                this.notifications.push({
                    id: e.order.id,
                    title: `Nuevo pedido: ${Date.now()}`
                })
            });
        },
        methods: {
            buildDetailUrl (notification) {
               window.location.href = `/admin/orders/${notification.id}`;
            }
        }
    }
</script>

<style scoped>

</style>