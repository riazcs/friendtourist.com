<template>
    <frontend-layout title="My Favourite List">

        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-2 border-blue-700">
                    <div class="bg-blue-900">
                        <h3 class="p-3 text-center text-white">Favourite List</h3>
                    </div>
                    <div class="p-3 table-responsive">
                        <table class="py-3 border-bottom-0 w-full" id="hotel">
                            <thead>
                            <tr>
                                <th class="border">Hotel Name</th>
                                <th class="border">Contact Info</th>
                                <th class="border">Hotel Address</th>
                                <th class="border text-center w-20">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="hotel in favourite_hotels" :key="hotel.id">
                                <td class="border">
                                    <Link :href="route('details', hotel.id)" title="Show Hotel">
                                        {{ hotel.name }}
                                    </Link>

                                </td>
                                <td class="border">
                                    {{ hotel.contact_first_name }}
                                    <p class="m-0 text-sm text-green-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                        </svg>
                                        : {{ hotel.contact_phone }}
                                    </p>
                                </td>
                                <td class="border">
                                    {{ hotel.address_line }},
                                    {{ hotel.area }},
                                    {{  hotel.district?hotel.district.name: '' }}
                                </td>
                                <td class="border text-center">
                                    <a href="#" class="text-lg text-pink-800 mr-3" @click.prevent="unfavourite(hotel.id)" title="Remove from favourite list">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                    <Link :href="route('details', hotel.id)" title="Show Hotel">
                                        <i class="fas fa-eye text-lg" aria-hidden="true"></i>
                                    </Link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </frontend-layout>
</template>


<script>
    import FrontendLayout from "../../Layouts/FrontendLayout";
    import Swal from "sweetalert2";
    //Datatable Modules
    import "datatables.net-dt/js/dataTables.dataTables";
    import "datatables.net-dt/css/jquery.dataTables.min.css";
    import $ from "jquery";
    import {Link} from "@inertiajs/inertia-vue3";

    export default {
        name: "FavouriteHotelList",
        components: {
            FrontendLayout,
            Link
        },
        props: [
            'favourite_hotels',
        ],
        data() {
            return {
                dtRef:'',
                is_favourite:false,
                form: this.$inertia.form({
                }),
            };
        },
        mounted: function () {
            this.dtRef = $("#hotel").DataTable();
        },
        methods:{
            unfavourite(hotel_id){
                this.form.post(route("make_un_favourite",hotel_id), {
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess() {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Unfavourite list added successfully",
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
                        this.is_favourite = true;
                    },
                });
            }

        }
    }
</script>
