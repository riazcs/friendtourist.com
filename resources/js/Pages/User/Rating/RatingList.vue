<template>
    <frontend-layout title="Review List">
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-2 border-blue-700">
                    <div class="bg-blue-900">
                        <h3 class="p-3 text-center text-white">Review List</h3>
                    </div>
                    <div class="p-3 table-responsive">
                        <table class="w-full text-center py-3 border-bottom-0" id="hotel">
                            <thead>
                            <tr>
                                <th class="border">Rating Date</th>
                                <th class="border text-left">Invoice</th>
                                <th class="border text-left">Hotel Name</th>
                                <th class="border">Overall</th>
                                <th class="border">Hotel</th>
                                <th class="border">Staff</th>
                                <th class="border">Facility</th>
                                <th class="border">Cleanliness</th>
                                <th class="border">Comfort</th>
                                <th class="border">Price</th>
                                <th class="border">Location</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(review, idx) in reviews" :key="review.id">
                                <td class="border">{{ review.review_date }}</td>
                                <td class="border text-left">
                                    <Link class="block text-indigo-800" :href="route('user.booking.invoice', review.booking.invoice_no? review.booking.invoice_no: review.booking_id)" title="Show Invoice">
                                        <strong>#{{ review.booking.invoice_no }}</strong>
                                    </Link>
                                </td>
                                <td class="border text-left">
                                    <Link class="text-base" :href="route('details', review.hotel_id)" title="Show Hotel">
                                        {{ review.hotel.name }}
                                    </Link>
                                </td>
                                <td class="border">{{ review.overall_rating }}</td>
                                <td class="border">{{review.hotel_rating}}</td>
                                <td class="border">{{review.staff_rating}}</td>
                                <td class="border">{{ review.facility_rating}}</td>
                                <td class="border">{{review.cleanliness_rating}}</td>
                                <td class="border">{{ review.comfort_rating }}</td>
                                <td class="border">{{review.price_rating }}</td>
                                <td class="border">{{review.location_rating }}</td>
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
import FrontendLayout from "../../../Layouts/FrontendLayout";
import {Link} from "@inertiajs/inertia-vue3";
//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";

export default {
    name: "RatingList",
    components: {
        FrontendLayout,
        Link
    },
    props: [
        'reviews',
    ],
    mounted: function () {
        this.dtRef = $("#hotel").DataTable();
    },
}
</script>

<style scoped>

</style>
