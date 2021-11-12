<template>
    <hotel-layout title="Reservation">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Reservation List
                </h2>
            </div>
        </template>
        <div class="container mx-auto py-10 sm:px-6 lg:px-8" >
            <div class="mx-auto bg-white px-4 py-5 rounded-md my-5">
                <form action="" @submit.prevent="filter_reservation()">
                    <div class="flex flex-col lg:flex-row mb-4 gap-x-3 gap-y-2">
                        <date-picker
                            v-model="filter_form.range"
                            is-range
                            mode="date"
                            :masks="masks"
                            :min-date='new Date()'
                        >
                            <template v-slot="{ inputValue, inputEvents, isDragging }">
                                <div class="flex flex-col sm:flex-row justify-start items-center">
                                    <div class="relative flex-grow">
                                        <label class="text-sm" for="from_date">Check in From</label>
                                        <svg
                                            class="text-gray-600 w-4 h-full mx-2 absolute pointer-events-none"
                                            style="top: 10px"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" ></path>
                                        </svg>
                                        <input
                                            class="flex-grow pl-8 pr-2 py-1 bg-gray-100 border rounded w-full"
                                            :class="isDragging ? 'text-gray-600' : 'text-gray-900'"
                                            :value="inputValue.start"
                                            v-on="inputEvents.start"
                                            id="from_date"
                                            autocomplete="off"
                                        />
                                    </div>
                                    <span class="flex-shrink-0 mt-4 mx-2 items-center">
                                        <svg class="w-4 h-4 stroke-current text-gray-600 " viewBox="0 0 24 24" >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3"
                                            />
                                        </svg>
                                    </span>
                                    <div class="relative flex-grow">
                                        <label class="text-sm" for="to_date">Check in To</label>
                                        <svg
                                            class="text-gray-600 w-4 h-full mx-2 absolute pointer-events-none"
                                            style="top: 10px"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" ></path>
                                        </svg>
                                        <input
                                            class="flex-grow pl-8 pr-2 py-1 bg-gray-100 border rounded w-full"
                                            :class="isDragging ? 'text-gray-600' : 'text-gray-900'"
                                            :value="inputValue.end"
                                            v-on="inputEvents.end"
                                            id="to_date"
                                            autocomplete="off"
                                        />
                                    </div>
                                </div>
                            </template>
                        </date-picker>
                        <div class="flex place-items-end">
                            <button type="submit" class="py-1 pl-5 pr-5 bg-blue-900 text-gray-100 text-md rounded-lg focus:outline-none border-blue-300 hover:bg-blue-800">
                                Set Period
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="mx-auto bg-white px-4 py-5 rounded-md my-5">
                <div class="p-3 table-responsive">
                    <table class="w-full text-center py-3 border-bottom-0" id="hotel">
                        <thead>
                        <tr>
                            <th class="border">Booking ID</th>
                            <th class="border">Contact Info</th>
                            <th class="border">Guests</th>
                            <th class="border">Check In</th>
                            <th class="border">Check Out</th>
                            <th class="border">Nights</th>
                            <th class="border">Room(s)</th>
                            <th class="border">Payed Amount</th>
                            <th class="border">Status</th>
                            <th class="border">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(reservation, idx) in reservations.data" :key="reservation.id">
                            <td class="border text-left">
                                <Link class="block text-indigo-800" :href="route('hotel.reservation.invoice', reservation.invoice_no? reservation.invoice_no: reservation.id)" title="Show Invoice">
                                    <strong>#{{ reservation.invoice_no }}</strong>
                                </Link>
                            </td>
                            <td class="border text-left">
                                <p class="m-0 text-md font-bold capitalize">{{ reservation.user.name }}</p>
                                <small class="text-sm font-mono">Phone: {{ reservation.user.phone }}</small>
                            </td>
                            <td class="border text-left" :title="'Adult: '+reservation.adult+' Child: '+reservation.child">
                                <p class="">
                                    <i class="fas fa-user-friends"></i>
                                    -{{ reservation.adult }}
                                </p>
                                <p>
                                    <i class="fas fa-baby"></i>
                                    -{{reservation.child}}
                                </p>

                            </td>

                            <td class="border">{{ reservation.check_in_date }}</td>
                            <td class="border">{{reservation.check_out_date}}</td>
                            <td class="border">{{reservation.nights}}</td>
                            <td class="border">{{ reservation.total_room }}</td>
                            <td class="border">{{reservation.total_amount }}</td>
                            <td class="border ">
                                <div
                                    :class="status_bg(reservation.status)"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-0 text-white focus:outline-none transition"
                                    v-if="reservation.status == 5"
                                >
                                    {{ reservation.status_label }}
                                </div>
                                <jet-dropdown align="right" width="48" v-if="reservation.status < 5">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                    type="button"
                                                    :class="status_bg(reservation.status)"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-0 text-white focus:outline-none transition"
                                            >
                                                {{ reservation.status_label }}
                                                <svg
                                                    v-if="reservation.status ==1 || reservation.status ==2 || reservation.status ==4"
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                        <path
                                                          fill-rule="evenodd"
                                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                          clip-rule="evenodd"
                                                        />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content v-if="reservation.status ==1 || reservation.status ==2 || reservation.status ==4">

                                        <div v-if="reservation.status < 4"
                                             @click.prevent="update_status(reservation.id, 4)"
                                             class="block text-left px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
                                            Check In
                                        </div>
                                        <div v-if="reservation.status == 4"
                                             @click.prevent="update_status(reservation.id, 5)"
                                             class="block text-left px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
                                            Check Out
                                        </div>

                                    </template>
                                </jet-dropdown>
                            </td>
                            <td class="border text-center">
                                <a :href="route('hotel.reservation.invoice', reservation.invoice_no? reservation.invoice_no: reservation.id)" target="_blank"
                                   class="shadow-sm rounded-md hover:text-white hover:bg-blue-500 relative no-underline inline-flex items-center px-3 py-2 border hover:border-0 text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </hotel-layout>
</template>

<script>
import HotelLayout from "../../Layouts/HotelLayout";
import {DatePicker} from "v-calendar";
import {Link} from "@inertiajs/inertia-vue3";
//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import Swal from "sweetalert2";
export default {
    name: "ReservationList",
    components: {
        HotelLayout,
        DatePicker,
        Link,
        JetDropdown,
        JetDropdownLink,
    },
    props:['reservations', 'filter_data'],
    data(){
        return{
            dtRef:'',
            filter_form: this.$inertia.form({
                room_ids: [],
                range:{
                    start: '',
                    end: ''
                }
            }),
            minDate: new Date(),
            masks: {
                input: 'DD-MM-YYYY',
                iso: 'DD-MM-YYYY'
            },
            status_form: this.$inertia.form({
                booking_id: '',
                status: '',
            }),
        }
    },
    mounted() {
        this.dtRef = $("#hotel").DataTable();
        this.filter_form.range = this.filter_data.range;
    },
    methods:{
        filter_reservation(){
            this.filter_form.get(route('hotel.reservation.index'));
        },
        update_status(booking_id, status){
            Swal.fire({
                title: status==5? 'Guest Check Out': ' Guest Check in',
                text: status==5? 'Are you sure. This Guest want Check Out?': 'Are you sure. This Guest want Check In?',
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: status==5? 'Yes. Check Out': 'Yes. Check in',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.status_form
                        .transform((data) => ({
                            ...data,
                            booking_id: booking_id,
                            status: status,
                        }))
                        .post(route('hotel.reservation.status.update'),{
                            preserveScroll: true,
                            preserveState: true,
                            resetOnSuccess: true,
                            onSuccess: page => {
                                if (!page.props.flash.error && !page.errors){
                                    this.status_form.reset();
                                    Swal.fire({
                                        icon: "success",
                                        title: "Success",
                                        text: page.props.flash.success,
                                        position: "top-end",
                                        showConfirmButton: false,
                                        timer: 1500,
                                    });
                                    page.props.flash.success="";
                                    page.props.flash.error="";
                                }else{
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "Something went wrong!",
                                        position: "top-end",
                                        showConfirmButton: false,
                                        timer: 1500,
                                        // footer: '<a href="">Scroll up on the modal to see the issue!</a>',
                                    });
                                }
                            },
                            onError: errors => {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                    position: "top-end",
                                    showConfirmButton: true,
                                    timer: 1500,
                                    // footer: '<a href="">Scroll up on the modal to see the issue!</a>',
                                });
                            },
                        })
                }
            });
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
    }
}
</script>

<style scoped>

</style>
