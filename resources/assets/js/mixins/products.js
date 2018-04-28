import Preloader from '../components/Preloader';
export default {
    props: {
        logged: {
            type: Boolean,
            required: true
        }
    },
    components: {
        Preloader
    },
    mounted () {
        this.$http.get(this.url).then(data => {
            this.prepareData(data);
        });
    }
}