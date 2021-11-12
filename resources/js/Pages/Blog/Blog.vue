<template>
    <app-layout title="Blog">
        <template #header>
            <div class="flex justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Blog
                    </h2>
                </div>
                <button  @click="this.$inertia.get(route('admin.blog.create'))" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                    <i class="fas fa-pencil" aria-hidden="true"></i>
                    Write Blog
                </button>
            </div>
        </template>
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div>
                        <h3 class="p-3 text-center">Blog List</h3>
                        <div class="p-3 table-responsive">
                        <table class="py-3 border-bottom-0 w-full" id="amenity">
                            <thead>
                            <tr>
                                <th class="border">Title</th>
                                <th class="border">Type</th>
                                <th class="border">Status</th>
                                <th class="border">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="blog in blogs" :key="blog.id">
                                <td class="border">{{ blog.title }}</td>
                                <td class="border">{{ blog.type }}</td>
                                <td class="border"><button class="bg-green-500 px-5 text-white rounded-full">{{ blog.status == "1" ? "Active" : "Inactive" }}</button></td>
                                <td class="border">
                                    <button @click="show(blog.id)" title="Show Hotel" class="bg-blue hover:bg-blue-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                        </svg>
                                        View
                                    </button>
                                    <button @click="edit(blog.id)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                        Edit
                                </button>
                                    <button @click="deleteBlog(blog.id)" class=" bg-red-500 hover:bg-red-700 text-white font-bold py-2 ml-2 px-4 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
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
    import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
    import {Link} from "@inertiajs/inertia-vue3";
    import Swal from "sweetalert2";
    import "jquery/dist/jquery.min.js";
    //Datatable Modules
    import "datatables.net-dt/js/dataTables.dataTables";
    import "datatables.net-dt/css/jquery.dataTables.min.css";
    import $ from "jquery";

    export default defineComponent({
        data() {
            return {
                amenity_id: "",
                dtRef: null,
                form: this.$inertia.form({
                }),
            };
        },
        props: {
            blogs: [],

        },
        components: {
            AppLayout,
            JetValidationErrors,
            Link
        },
        mounted: function () {
            this.dtRef = $("#amenity").DataTable();
        },
        methods: {
            edit(id) {
                this.$inertia.get(route("admin.blog.edit",id));
            },
            show(id) {
                this.$inertia.get(route("admin.blog.show_details",id));
            },
            deleteBlog(id) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to delete this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.delete(route("admin.blog.destroy", id), {
                            preserveScroll: true,
                            forceFormData: true,
                            onSuccess() {
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: "Blog deleted Successfully",
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                                $("#amenity").DataTable().reload();
                            },
                            onError() {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                    position: "top-end"
                                });
                            },
                        });
                    }
                });
            },
        },
    });
</script>


