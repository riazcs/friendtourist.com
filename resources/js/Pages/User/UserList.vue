<template>
    <app-layout title="Dashboard">
        <template #header>
            <div class="flex justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                       All User
                    </h2>
                </div>


            </div>
        </template>
        <!-- This example requires Tailwind CSS v2.0+ -->

        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div>
                        <h3 class="p-3 text-center">User List</h3>
                        <table
                            class="border-separate border w-full text-center"
                            id="amenity"
                        >
                            <thead>
                            <tr>
                                <th class="border">Name</th>
                                <th class="border">Email</th>
                                <th class="border">Phone</th>
                                <th class="border">Nick Name</th>
                                <th class="border">Designation</th>
                                <th class="border">Address</th>
                                <th class="border">Age</th>
                                <th class="border">Status</th>
                                <th class="border">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in users" :key="user.id">
                                <td class="border">{{ user.name }}</td>
                                <td class="border">{{user.email}}</td>
                                <td class="border">{{user.phone}}</td>
                                <td class="border">{{user.sur_name}}</td>
                                <td class="border">{{user.designation}}</td>
                                <td class="border">{{user.address}}</td>
                                <td class="border">{{user.age}}</td>
                                <td class="border"><button class="bg-green-500 px-5 text-white rounded-full">{{user.status == 1 ? 'Active':'Inactive'}}</button> </td>
                                <td class="border">
                                    <button
                                        @click="updateStatus(user.id)"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 ml-2 px-4 rounded
                      "
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-6 w-6 inline"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                            />
                                        </svg>

                                        Change Status
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout.vue";
    import Swal from "sweetalert2";
    import "jquery/dist/jquery.min.js";
    //Datatable Modules
    import "datatables.net-dt/js/dataTables.dataTables";
    import "datatables.net-dt/css/jquery.dataTables.min.css";
    import $ from "jquery";
    export default {
        data() {
            return {
                dtRef: null,
                form: this.$inertia.form({
                }),
            };
        },
        props: {
            users: [],

        },
        components: {
            AppLayout,
        },
        mounted: function () {
            this.dtRef = $("#amenity").DataTable();
        },
        methods: {
            updateStatus(user_id) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't want to change status!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, change it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.post(route("admin.user.status.update", user_id), {
                            preserveScroll: true,
                            forceFormData: true,
                            onSuccess() {
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: "Status updated Successfully",
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
                                    position: "top-end"
                                });
                            },
                        });
                    }
                });
            }
        },
    };
</script>


