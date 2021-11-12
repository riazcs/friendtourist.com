
<template>
    <app-layout title="Blog">
        <template #header>
            <div class="flex justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Blog Details
                    </h2>
                </div>
            </div>
        </template>
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="w-full bg-gradient-to-r from-yellow-400 via-red-500 to-pink-500 ... mb-5" style="aspect-ratio: auto 1000 / 200;  overflow: hidden;  " >
                <img :src="blog.attachment.file_path" class="w-full" >
            </div>
            <div style="margin: 0 auto" class="container">
                <div>
                    <h5 class="text-5xl my-5 pt-10">{{blog.title}}</h5>
                    <button v-if="blog.type" type="button" class="rounded-full px-4 mr-2 bg-green-600 text-white p-2 rounded  leading-none flex items-center mb-3">
                        {{blog.type}}
                    </button>
                    <div class="flex justify-center">
                        <p class="mb-10 py-4" v-html="blog.description"> </p>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import {defineComponent} from "vue";
    import AppLayout from "@/Layouts/AppLayout.vue";
    export default defineComponent({
        data() {
            return {
                form: this.$inertia.form({
                }),
            };
        },
        props: {
            blog:Object
        },
        components: {
            AppLayout
        },
        mounted() {
        },
        methods: {
        },
    });
</script>
<style>

</style>
