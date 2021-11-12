<template>
    <app-layout title="Blog">
        <template #header>
            <div class="flex justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Terms and Policies
                    </h2>
                </div>
                <Link :href="route('admin.setting.index')"
                      class=" bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-3 border border-blue-500 hover:border-transparent rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </Link>
            </div>
        </template>
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mt-2 flex flex-col justify-center">
                        <jet-validation-errors class="mb-4" />
                        <form class="bg-white inline-block rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="submit()">
                            <div class="mb-2"> <span class="text-sm">Terms and Policy Type:</span>
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" v-model="form.type" @change="getTermPolicy()">
                                    <option selected value="">-Select Type-</option>
                                    <option value="terms">Terms</option>
                                    <option value="refund_policy">Refund Policy</option>
                                    <option value="emi_policy">EMI Policy</option>
                                    <option value="privacy_policy">Privacy Policy</option>
                                    <option value="career">Career</option>
                                </select>
                            </div>
                            <div class="mb-2"> <span class="text-sm">Terms/Policy description:</span>
                                <ckeditor :editor="editor" v-model="form.description"></ckeditor>
                            </div>
                            <div class="flex items-center justify-between px-4 py-3 bg-gray-200 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                                <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="bg-green-700">
                                    Submit
                                </jet-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import {defineComponent} from "vue";
    import AppLayout from "@/Layouts/AppLayout.vue";
    import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
    import Swal from "sweetalert2";
    import JetButton from '@/Jetstream/Button.vue';
    import "jquery/dist/jquery.min.js";
    import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
    import CKEditor from "@ckeditor/ckeditor5-vue";
    import {Link} from "@inertiajs/inertia-vue3";
    //Datatable Modules
    import "datatables.net-dt/js/dataTables.dataTables";
    import "datatables.net-dt/css/jquery.dataTables.min.css";
    import $ from "jquery";
    export default defineComponent({
        data() {
            return {
                // setting_id: "",
                editor: ClassicEditor,
                form: this.$inertia.form({
                    type: "",
                    status: "",
                    description: "",
                    setting_id: "",
                }),
            };
        },
        props: {
        },
        components: {
            AppLayout,
            JetValidationErrors,
            JetButton,
            ckeditor: CKEditor.component,
            Link
        },
        methods: {
            submit() {
                this.form.post(route("admin.store.terms_policy"), {
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess() {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Terms and Policy added Successfully",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    },
                    onError() {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                            position: "top-end",
                        });
                    },
                });
            },
            getTermPolicy() {
                axios.get(route("admin.get.terms_policy", this.form.type)).then(
                    result => {
                        this.form.description = result.data.result.data;
                        this.form.setting_id = result.data.result.id;
                    },
                    error => {
                        console.error(error);
                    }
                );

            }
        },
    });
</script>
<style>
    .ck-editor__editable {
        min-height: 300px;
    }
</style>

