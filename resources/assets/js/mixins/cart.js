export default {
    methods: {
        addProductInCart (productId) {
            this.$http.post('/cart/add-product', {productId});
        },
        decrementProductInCart (productId) {
            this.$http.post('/cart/decrement-product', {productId});
        },
        removeProductInCart (productId) {
            this.$http.delete(`/cart/remove-product/${productId}`);
        },
        processCart () {
            this.$http.post('/cart/process');
        },
        totalCost (products) {
            return products.reduce((total, p) => total + (p.price * p.qty), 0);
        }
    }
}