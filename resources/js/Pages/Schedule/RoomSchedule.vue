<template>
    <hotel-layout title="Calender & Rates">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Calender and Rates
                </h2>
            </div>
        </template>
        <div class="container mx-auto py-10 sm:px-6 lg:px-8" >
            <div class="mx-auto bg-white px-4 py-5 rounded-md my-5">
                <form action="" @submit.prevent="filter_search()">
                    <div class="flex flex-col lg:flex-row mb-4 gap-x-3 gap-y-2">
                        <date-picker
                            v-model="filter_form.range"
                            is-range
                            mode="date"
                            :masks="masks"
                            :min-date='new Date()'
                            :max-date='maxDate'
                        >
                            <template v-slot="{ inputValue, inputEvents, isDragging }">
                                <div class="flex flex-col sm:flex-row justify-start items-center">
                                    <div class="relative flex-grow">
                                        <label class="text-sm" for="from_date">From</label>
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
                                        <label class="text-sm" for="to_date">To (Max 15 days)</label>
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
                    <div class="mb-4">
                        <label class="py-2 mb-2 px-3 mx-1 text-sm rounded-lg border hover:border-transparent focus:border-4 hover:bg-blue-800 hover:text-white"
                               v-for="(name, id) in room_list"
                               :key="id"
                               :for="'room_'+id"
                               :class="filter_form.room_ids.indexOf(id) > -1 ? 'bg-blue-900 text-gray-100': 'bg-transparent border-blue-900 text-blue-700'"
                        >
                            {{ name }}
                            <input type="checkbox" class="hidden" :id="'room_'+id" v-model="filter_form.room_ids" :value="id">
                        </label>
                    </div>
                </form>
            </div>
            <div class="mx-auto bg-white px-4 py-5 rounded-md my-5">
                <div class="header-table-top shadow-md">
                    <table class="mb-4 w-full items-center">
                        <tr>
                            <th style="text-align: left;">Dates</th>
                            <td v-for="date in dates" :key="date.date">
                                {{ date.day }} <br>
                                {{date.date}}
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- table -->
                <table class="table-common w-full mb-4 shadow-lg p-1"
                    v-if="room_schedules && room_schedules.length > 0"
                    v-for="(room_schedule, index) in room_schedules"
                    :key="index"
                >
                    <tr>
                        <th>{{ room_schedule.room_name }}</th>
                        <th :colspan="dates ? dates.length: ''">
                            <div class="flex justify-start md:justify-end items-center">
                                <button type="button" @click.prevent="openModal(room_schedule.id, room_schedule.rack_price)">
                                    <svg
                                        style="color: #0d80b5"
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
                                    <span style="color: #0d80b5;">Edit</span>
                                </button>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th class="font-normal">Room To Sell</th>
                        <td class="text-center" v-for="(available, index) in room_schedule.available_rooms" :key="'avail_'+index">{{ available }}</td>
                    </tr>
                    <tr>
                        <th class="font-normal">Room Sold</th>
                        <td class="text-center" v-for="(sold_room, index) in room_schedule.sold_rooms" :key="'sold_'+index">{{ sold_room }}</td>
                    </tr>
                    <template v-for="(option, index) in room_schedule.schedules" :key="'option_'+index">
                        <tr v-if="option.have_value == 1">
                            <th class="font-normal">
                                <span>
                                    Option : {{ option.title }}
                                </span>
                            </th>
                            <td
                                v-if="option.values && option.values.length"
                                v-for="(item, index) in option.values"
                                :key="'op_p_'+index"
                                :class="item.status == 1? 'bg-green-td' : 'bg-red-td'"
                                class="text-center"
                            >{{ item.price }}</td>
                        </tr>
                    </template>

                </table>
            </div>
        </div>
        <schedule-modal
            :room_id="room_id"
            :rack_price="rack_price"
            :room_list="room_list"
            :board_types="board_types"
        ></schedule-modal>
    </hotel-layout>
</template>

<script>
import HotelLayout from "../../Layouts/HotelLayout";
import ScheduleModal from "./ScheduleModal";
import { DatePicker }  from 'v-calendar';

export default {
    name: "RoomSchedule",
    components: {
        ScheduleModal,
        HotelLayout,
        DatePicker
    },
    props:[
        'rooms',
        'room_list',
        'filter_data',
        'board_types',
        'dates',
        'room_schedules'
    ],
    data(){
        return{
            room_id: '',
            rack_price: '',
            op: 1,
            filter_form: this.$inertia.form({
                room_ids: [],
                range:{
                    start: '',
                    end: ''
                }
            }),
            minDate: new Date(),
            maxDate:'',
            masks: {
                input: 'DD-MM-YYYY',
                iso: 'DD-MM-YYYY'
            },
        }
    },
    mounted() {
        this.filter_form.room_ids = this.filter_data.room_ids;
        this.filter_form.range = this.filter_data.range;
        this.maxDate = this.minDate.setDate(this.minDate.getDate() + 15);
    },
    methods:{
        openModal(roomId, rack_price){
            this.room_id = roomId;
            this.rack_price = rack_price;

            const modal_overlay = document.querySelector("#modal_overlay");
            const modal = document.querySelector("#modal");
            const modalCl = modal.classList;
            modal_overlay.classList.remove("hidden");
            setTimeout(() => {
                modalCl.remove("opacity-0");
                modalCl.remove("-translate-y-full");
                modalCl.remove("scale-150");
            }, 100);
        },
        filter_search(){
            this.filter_form.get(route('hotel.schedules.index'));
        }
    }
}
</script>

<style scoped>
table,
td,
th {
    border: 2px solid #ddd;
    background-color: #fff;
    color: #1a1a1a;
    font-size: 12px;
}

.text-center{
    text-align: center!important;
}
table {
    border-collapse: collapse;
    table-layout: fixed;
    width: 100%;
    overflow: hidden;
    word-wrap: break-word;
}

th,
td {
    padding: 10px 5px;
    text-align: left;
}

/* th:not(:first-child),
td:not(:first-child) {
  text-align: center;
} */
th:first-child,
td:first-child {
    width: 200px;
}

.header-table-top table {
    border: none;
    background-color: #e0f3f8;
}
.header-table-top th {
    border: none;
    background-color: #e0f3f8;
    text-align: center;
}
.header-table-top td {
    border: none;
    background-color: #e0f3f8;
    text-align: center;
}

.header-table-top th,
td {
    padding: 5px 5px;
}


.bg-green-td {
    background-color: #D5F5E3;
}

.bg-red-td {
    background-color: #FADBD8;
}

</style>
