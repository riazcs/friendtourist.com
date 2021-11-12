<template>
    <frontend-layout>
            <div class="w-full bg-gradient-to-r from-yellow-400 via-red-500 to-pink-500 ..." style="aspect-ratio: auto 1000 / 200;  overflow: hidden;  " >
            <img :src="blog.attachment.file_path" class="w-full" >
            </div>
        <div class="container">
            <div>
                <h5 class="text-5xl my-5">{{blog.title}}</h5>
                <button v-if="blog.type" type="button" class="rounded-full px-4 mr-2 bg-green-600 text-white p-2 rounded  leading-none flex items-center mb-3">
                    {{blog.type}}
                </button>
                <p class="mb-10" v-html="blog.description"> </p>
            </div>
        </div>
    </frontend-layout>
</template>

<script>
    import FrontendLayout from "../../Layouts/FrontendLayout";
    import FilterForm from "@/Partials/Frontend/FilterForm";
    export default {
        name: "BlogDetails.vue",
        components: {
            FrontendLayout,
            FilterForm
        },
        props: [
            'blog',
        ],
        data() {
            return {
                form: this.$inertia.form({
                }),
            };
        },
        methods:{
        }
    }
</script>
