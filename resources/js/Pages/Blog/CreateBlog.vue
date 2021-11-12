
<template>
    <app-layout title="Blog">
        <template #header>
            <div class="flex justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Blog
                    </h2>
                </div>
            </div>
        </template>
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mt-2 flex flex-col justify-center">
                        <jet-validation-errors class="mb-4" />
                        <form class="bg-white inline-block rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="submit()">
                            <div class="mb-2"> <span class="text-sm">Title</span>
                                <input type="text" class="w-full border-gray-200 border rounded focus:outline-none focus:border-gray-300" v-model="form.title"/>
                            </div>
                            <div class="mb-2"> <span class="text-sm">Description</span>
                                <ckeditor :editor="editor" v-model="form.description" :config="editorConfig"></ckeditor>
                            </div>
                            <div v-if="image" class="mx-1 mb-2 rounded-lg shadow-lg relative">
                                <div class="h-40 w-48 relative">
                                        <img class="w-full h-full rounded-lg"
                                             :src="image"
                                             alt="Header Image" />
                                        <svg @click.prevent="remove_image()" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-500 absolute right-0 top-0 pr-1 " viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="mb-2"> <span>Upload Header Image</span>
                                <div class="relative h-40 rounded-lg border-dashed border-2 border-gray-200 bg-white flex justify-center items-center hover:cursor-pointer">
                                    <div class="absolute">
                                        <div class="flex flex-col items-center "> <i class="fa fa-cloud-upload fa-3x text-gray-200"></i> <span class="block text-gray-400 font-normal">Attach you files here</span> <span class="block text-gray-400 font-normal">or</span> <span class="block text-blue-400 font-normal">Browse files</span> </div>
                                    </div> <input type="file" class="h-full w-full opacity-0" id="file" ref="photo" @change="updatePhotoPreview($event)">
                                </div>
                                <div class="flex justify-between items-center text-gray-400"> <span>Accepted file type:.jpg .png .jpeg only</span> <span class="flex items-center "><i class="fa fa-lock mr-1"></i> secure</span> </div>
                            </div>
                            <div class="mb-2"> <span class="text-sm">Type</span>
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" v-model="form.type">
                                    <option selected value="">-Select Type-</option>
                                    <option v-for="(blog_type, index) in blog_types" :key="index" :value="blog_type.data">
                                        {{ blog_type.data }}
                                    </option>
                                </select>
                            </div>
                            <div class="mb-2"> <span class="text-sm">Status</span>
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" v-model="form.status">
                                    <option selected value="">-Select Status-</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
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

    class UploadAdapter {
        constructor(loader) {
            this.loader = loader;
        }
        upload() {
            return this.loader.file
                .then( uploadedFile => {
                    return new Promise( ( resolve, reject ) => {
                        const data = new FormData();
                        data.append( 'upload', uploadedFile );
                        axios( {
                            url: route("admin.blog.upload_blog_photos"),
                            method: 'POST',
                            data,
                            headers: {
                                'Content-Type': 'multipart/form-data;'
                            },
                            withCredentials: false
                        } ).then( response => {
                            if ( response.data.result == 'success' ) {
                                resolve( {
                                    default: response.data.path
                                } );
                            } else {
                               reject( response.data.message );
                            }
                        } ).catch( response => {
                           reject( 'Upload failed' );
                        } );

                    } );
                } );
        }
        abort() {
        }
    }

    export default defineComponent({
        data() {
            return {
                editMode: false,
                options: [],
                value: null,
                blog_id: "",
                editor: ClassicEditor,
                editorConfig: {
                    extraPlugins: [ this.MyCustomUploadAdapterPlugin ],
                },
                image:'',
                form: this.$inertia.form({
                    title: "",
                    type: "",
                    status: "",
                    description: "",
                    image:''
                }),
            };
        },
        props: {
            blog_types:[]
        },
        components: {
            AppLayout,
            JetValidationErrors,
            JetButton,
            ckeditor: CKEditor.component,
        },
        mounted() {

        },
        methods: {
            submit() {
                this.form.post(route("admin.blog.store"), {
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess() {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Blog created Successfully",
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
                this.form.title = "";
                this.form.image = "";
                this.image = "";
                (this.form.description = ""), (this.form.type = "");
            },
            MyCustomUploadAdapterPlugin ( editor ) {
                editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                    return new UploadAdapter( loader );
                };
            },
            selectNewPhoto() {
                this.$refs.photo.click();
            },
            remove_image() {
                this.image= '';
                this.form.image = '';
            },

            updatePhotoPreview(e) {
                let input = this.$refs.photo;
                let file = input.files;
                this.form.image = e.target.files[0];
                if (file && file[0]) {
                    let reader = new FileReader;
                    reader.onload = e => {
                        this.image = e.target.result;
                    }
                    reader.readAsDataURL(file[0]);
                }
            },
        },
    });
</script>
<style>
    .ck-editor__editable {
        min-height: 300px;
    }
</style>
