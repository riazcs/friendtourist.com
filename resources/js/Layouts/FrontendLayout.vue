<template>
    <div>
        <Head :title="title" >
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
            <link :href="route('index')+'/template/css/bootstrap.min.css'" rel="stylesheet" />
            <link :href="route('index')+'/template/css/style.css'" rel="stylesheet" />
        </Head>

        <!-- nav start -->
        <component :is="currentNavbar"></component>
        <!-- navbar end -->

        <slot></slot>
        <!--Footer start-->
        <frontend-footer></frontend-footer>
        <!--Footer end-->
<!--        <div id="loader">-->
<!--            <img :src="route('index')+'/images/preloader.gif'" alt="" sty>-->
<!--        </div>-->
    </div>
</template>

<script>
import FrontendNavbar from "../Partials/Frontend/FrontendNavbar";
import FrontendHeaderFixed from "../Partials/Frontend/FrontendHeaderFixed";
import FrontendFooter from "../Partials/Frontend/FrontendFooter";
import {Head} from "@inertiajs/inertia-vue3";

export default {
    name: "FrontendLayout",
    components: {FrontendFooter, FrontendHeaderFixed, FrontendNavbar, Head},
    props: {
        title: String,
    },
    data(){
        return{
            loader: true,
        }
    },
    mounted() {
        this.loader = false;
    },
    computed:{
        currentNavbar(){
            if (route().current('index')){
                return 'FrontendNavbar';
            }else{
                return 'FrontendHeaderFixed'
            }
        }
    }
}
</script>

<style scoped>
#loader{
    position: absolute;
    top:0;
    width: 100vw;
    height: 100%;
    text-align: center;
    background: #fff;
    display: block;
    z-index: 9999999999;
}
#loader img{
    margin: 0 auto;
    width: 100%;
    height: 100%;
}
</style>
