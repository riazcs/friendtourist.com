<template>
    <frontend-layout title="Home">
        <header class="bp-header">
            <search-section></search-section>
        </header>
        <!-- Tour place start -->
        <section>
            <div class="container place">
                <div class="row mt-4">
                    <div class="col-md-6" v-for="area in areas.splice(0,2)" :key="area.id">
                        <div class="image-container aspect-ratio-1 mb-4 mb-md-0">
                            <img :src="area.attachment.file_path" :alt="area.area_name">
                            <div class="after">
                                <h5>{{area.area_name}}</h5>
<!--                                <p>40 Properties</p>-->
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row mt-4">
                    <div class="col-md-4 mb-3" v-for="area in areas" :key="area.id">
                        <div class="image-container aspect-ratio-2 mb-4 mb-md-0">
                            <img :src="area.attachment.file_path" width="100%" :alt="area.area_name">
                            <div class="after">
                                <h5>{{area.area_name}}</h5>
<!--                                <p>40 Properties</p>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Tour place end -->

        <!-- Get inspiration end -->
        <section>
            <div class="inspiration container pb-4">
                <div class="section-header">
                    <h5>Get inspiration for your next trip</h5>
                </div>
                <div class="row ">
                    <div  v-for="(blog, ind) in blogs"
                          :key="blog.id"
                          :class="ind <3 ?'col-md-4': 'col-md-6 mt-4'"
                    >
                        <Link :href="route('blog.show', blog.id)">
                        <div class="image-container aspect-ratio-3 mb-4 mb-md-0">
                            <img :src="blog.attachment.file_path" width="100%" :alt="blog.title">
                            <div class="after1">
                                <div>
                                    <h5>{{blog.title}}</h5>
                                    <p>{{blog.description}}</p>
                                </div>
                            </div>
                        </div>
                        </Link>
                    </div>
                </div>

            </div>
        </section>
        <!-- Get inspiration start -->
    </frontend-layout>
</template>

<script>
import FrontendLayout from "../../Layouts/FrontendLayout";
import {Link} from "@inertiajs/inertia-vue3";
import SearchSection from "../../Components/Frontend/SearchSection";
export default {
    name: "Home",
    props: {
        areas: [],
        blogs:[],
        facebook:Object,
        youtube:Object,
        instagram:Object,
    },
    components: {SearchSection, FrontendLayout, Link}
}
</script>

<style scoped>
    .place .image-container {
        position: relative;
    }
    .place .image-container .after {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        -webkit-transition: 0.5s ease;
        transition: 0.5s ease;
    }
    .place .image-container .after h5 {
        color: #fff;
        font-size: 22px;
        font-weight: 900;
        -webkit-transform: translate(15px, 20px);
        transform: translate(15px, 20px);
        text-shadow: 1px 1px 0 #2b2b2b;
    }
    .place .image-container .after p {
        color: #fff;
        font-size: 16px;
        -webkit-transform: translate(15px, 20px);
        transform: translate(15px, 20px);
        text-shadow: 1px 1px 0 #2b2b2b;
    }
    .place .after:hover {
        background: #000;
        background: -webkit-gradient(
            linear,
            left top,
            left bottom,
            from(rgba(0, 0, 0, 0.8)),
            color-stop(12%, rgba(0, 0, 0, 0.2)),
            to(rgba(0, 0, 0, 0))
        );
        background: linear-gradient(
            180deg,
            rgba(0, 0, 0, 0.8) 0%,
            rgba(0, 0, 0, 0.2) 12%,
            rgba(0, 0, 0, 0) 100%
        );
    }
    .place .aspect-ratio-1 {
        position: relative;
        --aspect-ratio: 684/336;
        background-color: #fff;
        height: 0;
        padding-bottom: calc(100% / (var(--aspect-ratio)));
    }
    .place .aspect-ratio-1 > * {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        -o-object-fit: cover;
        object-fit: cover;
        -o-object-position: center;
        object-position: center;
    }
    .place .aspect-ratio-2 {
        position: relative;
        --aspect-ratio: 456/336;
        background-color: #fff;
        height: 0;
        padding-bottom: calc(100% / (var(--aspect-ratio)));
    }
    .place .aspect-ratio-2 > * {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        -o-object-fit: cover;
        object-fit: cover;
        -o-object-position: center;
        object-position: center;
    }
    .inspiration .image-container {
        position: relative;
        overflow: hidden;
    }
    .inspiration .image-container img {
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
    }
    .inspiration .image-container img:hover {
        -webkit-transform: scale(1.2);
        transform: scale(1.2);
    }
    .inspiration .image-container .after1 {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 5px 20px;
        height: 100%;
        -webkit-transition: 0.5s ease;
        transition: 0.5s ease;
        background: #000;
        background: -webkit-gradient(
            linear,
            left bottom,
            left top,
            from(rgba(0, 0, 0, 0.8)),
            color-stop(60%, rgba(0, 0, 0, 0.2)),
            to(rgba(0, 0, 0, 0))
        );
        background: linear-gradient(
            360deg,
            rgba(0, 0, 0, 0.8) 0%,
            rgba(0, 0, 0, 0.2) 60%,
            rgba(0, 0, 0, 0) 100%
        );
    }
    .inspiration .image-container .after1 div {
        position: absolute;
        bottom: 10px;
        left: 15px;
    }
    .inspiration .image-container .after1 h5 {
        color: #fff;
        font-size: 18px;
        font-weight: 900;
    }
    .inspiration .image-container .after1 p {
        color: #fff;
        font-size: 14px;
    }
    .inspiration .image-container .after1:hover {
        background: #000;
        background: -webkit-gradient(
            linear,
            left top,
            left bottom,
            from(rgba(0, 0, 0, 0.8)),
            color-stop(12%, rgba(0, 0, 0, 0.2)),
            to(rgba(0, 0, 0, 0))
        );
        background: linear-gradient(
            180deg,
            rgba(0, 0, 0, 0.8) 0%,
            rgba(0, 0, 0, 0.2) 12%,
            rgba(0, 0, 0, 0) 100%
        );
    }
    .inspiration .image-container .after2 {
        position: relative;
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        -webkit-transition: 0.5s ease;
        transition: 0.5s ease;
        background: rgba(0, 0, 0, 0.2);
    }
    .inspiration .image-container .after2 div {
        position: absolute;
        bottom: 20px;
        left: 15px;
    }
    .inspiration .image-container .after2 h5 {
        color: #fff;
        font-size: 18px;
        font-weight: 900;
    }
    .inspiration .image-container .after2 p {
        color: #fff;
        font-size: 14px;
        padding-top: 5px;
    }
    .inspiration .image-container .after2:hover {
        background: #000;
        background: -webkit-gradient(
            linear,
            left top,
            left bottom,
            from(rgba(0, 0, 0, 0.8)),
            color-stop(12%, rgba(0, 0, 0, 0.2)),
            to(rgba(0, 0, 0, 0))
        );
        background: linear-gradient(
            180deg,
            rgba(0, 0, 0, 0.8) 0%,
            rgba(0, 0, 0, 0.2) 12%,
            rgba(0, 0, 0, 0) 100%
        );
    }
    .inspiration .aspect-ratio-3 {
        position: relative;
        --aspect-ratio: 442/400;
        background-color: #fff;
        height: 0;
        padding-bottom: calc(100% / (var(--aspect-ratio)));
    }
    .inspiration .aspect-ratio-3 > * {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        -o-object-fit: cover;
        object-fit: cover;
        -o-object-position: center;
        object-position: center;
    }
    .inspiration .aspect-ratio-4 {
        position: relative;
        --aspect-ratio: 674/400;
        background-color: #fff;
        height: 0;
        padding-bottom: calc(100% / (var(--aspect-ratio)));
    }
    .inspiration .aspect-ratio-4 > * {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        -o-object-fit: cover;
        object-fit: cover;
        -o-object-position: center;
        object-position: center;
    }
</style>
