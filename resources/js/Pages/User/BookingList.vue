<template>
    <frontend-layout title="Booking List">
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-2 border-blue-700">
                    <div class="bg-blue-900">
                        <h3 class="p-3 text-center text-white">Booking List</h3>
                    </div>
                    <div class="p-3 table-responsive">
                        <table class="w-full text-center py-3 border-bottom-0" id="hotel">
                            <thead>
                            <tr>
                                <th class="border">#</th>
                                <th class="border">Hotel Name</th>
                                <th class="border">Room(s)</th>
                                <th class="border">Check In</th>
                                <th class="border">Check Out</th>
                                <th class="border">Guests</th>
                                <th class="border">Rack Total</th>
                                <th class="border">Discount</th>
                                <th class="border">Total Charge</th>
                                <th class="border">Coupon</th>
                                <th class="border">Convenience Fee</th>
                                <th class="border">Payed Amount</th>
                                <th class="border">Status | Payment Status</th>

                                <th class="border">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(booking, idx) in bookings" :key="booking.id">
                                <td class="border">{{ idx+1 }}</td>
                                <td class="border text-left">
                                    <Link class="block text-indigo-800" :href="route('user.booking.invoice', booking.invoice_no? booking.invoice_no: booking.id)" title="Show Invoice">
                                        <strong>#{{ booking.invoice_no }}</strong>
                                    </Link>
                                    <Link class="text-base" :href="route('details', booking.hotel_id)" title="Show Hotel">
                                        {{ booking.hotel.name }}
                                    </Link>
                                </td>
                                <td class="border">{{ booking.total_room }}</td>
                                <td class="border">{{ booking.check_in_date }}</td>
                                <td class="border">{{booking.check_out_date}}</td>
                                <td class="border text-left" :title="'Adult: '+booking.adult+' Child: '+booking.child">
                                    <p class="">
                                        <i class="fas fa-user-friends"></i>
                                        -{{ booking.adult }}
                                    </p>
                                    <p>
                                        <i class="fas fa-baby"></i>
                                        -{{booking.child}}
                                    </p>

                                </td>
                                <td class="border">{{booking.rack_total}}</td>
                                <td class="border">{{ parseInt(booking.hotel_discount).toFixed(0)}} %</td>
                                <td class="border">{{booking.total_charge}}</td>
                                <td class="border">{{ booking.coupon_discount }}</td>
                                <td class="border">{{booking.convenience_fee}}</td>
                                <td class="border">{{booking.total_amount }}</td>
                                <td class="border ">
                                    <div class="flex w-full">
                                        <span :class="status_bg(booking.status)" class="text-white relative inline-flex flex justify-center items-center px-3 py-2 shadow-md text-sm font-medium w-1/2">
                                            {{ booking.status_label }}
                                        </span>
                                        <span :class="payment_status_bg(booking.payment_status)" class="text-white md:inline-flex flex justify-center relative items-center px-3 py-2 shadow-md text-sm font-medium w-1/2">
                                            {{ booking.payment_label }}
                                        </span>
                                    </div>
                                </td>
                                <td class="border flex text-center">
                                    <a :href="route('user.booking.invoice', booking.invoice_no? booking.invoice_no: booking.id)" target="_blank"
                                       class="shadow-sm rounded-tl-md rounded-bl-md hover:text-white hover:bg-blue-500 relative no-underline inline-flex items-center px-3 py-2 border hover:border-0 text-sm font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </a>
                                    <Link v-if="booking.status > 3 && !booking.rating" :href="route('user.rating.create', booking.invoice_no? booking.invoice_no: booking.id)" class="shadow-sm rounded-tr-md rounded-br-md text-gray-500 text-purple-700 hover:text-white hover:bg-purple-500 hidden no-underline md:inline-flex relative items-center px-3 py-2 border hover:border-0 text-sm font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                    </Link>
                                    <Link v-if="booking.status < 3" href="#" class="shadow-sm rounded-tr-md rounded-br-md text-gray-500 text-red-700 hover:text-white hover:bg-red-500 hidden no-underline md:inline-flex relative items-center px-3 py-2 border hover:border-0 text-sm font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
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
    import {Link} from "@inertiajs/inertia-vue3";
    //Datatable Modules
    import "datatables.net-dt/js/dataTables.dataTables";
    import "datatables.net-dt/css/jquery.dataTables.min.css";
    import $ from "jquery";

    export default {
        name: "BookingList",
        components: {
            FrontendLayout,
            Link
        },
        props: [
            'bookings',
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
            payment_status_bg(status){
                let bg = '';
                switch (status){
                    case 1:
                        bg = 'bg-green-500';
                        break;
                    case 2:
                        bg = 'bg-red-500';
                        break;
                    case 3:
                        bg = 'bg-blue-500';
                        break;
                    case 4:
                        bg = 'bg-yellow-500';
                        break;
                    default:
                        bg= 'bg-purple-500';
                        break;
                }

                return bg;
            },
            status_bg(status){
                let bg = '';
                switch (status){
                    case 1:
                        bg = 'bg-blue-500';
                        break;
                    case 2:
                        bg = 'bg-yellow-500';
                        break;
                    case 3:
                        bg = 'bg-red-500';
                        break;
                    case 4:
                        bg = 'bg-green-500';
                        break;
                    default:
                        bg= 'bg-purple-500';
                        break;
                }

                return bg;
            },
        },
        computed:{

        }
    }
</script>
