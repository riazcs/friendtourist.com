<template>
    <!-- overlay -->
    <div id="modal_overlay" class="hidden fixed overflow-y-scroll inset-0 bg-black bg-opacity-30 h-screen w-full flex justify-center items-start md:items-center pt-10 md:pt-0">
        <!-- modal -->
        <div id="modal" class="opacity-0 transform -translate-y-full relative w-10/12 md:w-1/2 h-auto lg:h-auto  bg-white rounded shadow-lg transition-opacity transition-transform duration-300">
            <!-- button close -->
            <button
                @click.prevent="closeModal()"
                class="absolute -top-3 -right-3 bg-red-500 hover:bg-red-600 text-2xl w-10 h-10 rounded-full focus:outline-none text-white">
                &cross;
            </button>
            <!-- header -->
            <div class="px-4 py-3 border-b border-gray-200">
                <p class="font-semibold text-lg text-gray-800">
                    Bulk Edit
                </p>
            </div>
            <!-- body -->
            <form action="" @submit.prevent="submit">
                <div class="w-full p-3 text-gray-600">
                    <div class="flex lg:mb-2 flex-col lg:flex-row">
                        <div class="mr-2">
                            <date-picker
                                v-model="form.range"
                                :masks="masks"
                                is-range
                                mode="date"
                                :min-date="new Date()"
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
                                            <label class="text-sm" for="to_date">To</label>
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
                                    <jet-input-error v-if="form.errors.start_date" :message="form.errors.start_date[0]" class="mt-2 inline" />
                                    <jet-input-error v-if="form.errors.end_date" :message="form.errors.end_date[0]" class="mt-2 inline" />
                                </template>
                            </date-picker>

                        </div>
                    </div>
                    <!-- Checkbox start -->
                    <div class="my-4">
                        <h3 class="text-sm mb-1">Which days of the weeks do you want to apply changes to?</h3>
                        <div class="flex text-sm mt-1">
                            <label class="inline-flex items-center">
                                <input type="checkbox" v-model="form.selected_days" value="1" class="form-checkbox" />
                                <span class="ml-2">Sa</span>
                            </label>
                            <label class="inline-flex items-center ml-2">
                                <input type="checkbox" v-model="form.selected_days" value="2" class="form-checkbox" />
                                <span class="ml-2">Su</span>
                            </label>
                            <label class="inline-flex items-center ml-2">
                                <input type="checkbox" v-model="form.selected_days" value="3" class="form-checkbox" />
                                <span class="ml-2">Mon</span>
                            </label>
                            <label class="inline-flex items-center ml-2">
                                <input type="checkbox" v-model="form.selected_days" value="4" class="form-checkbox" />
                                <span class="ml-2">Tu</span>
                            </label>
                            <label class="inline-flex items-center ml-2">
                                <input type="checkbox" v-model="form.selected_days" value="5" class="form-checkbox" />
                                <span class="ml-2">We</span>
                            </label>
                            <label class="inline-flex items-center ml-2">
                                <input type="checkbox" v-model="form.selected_days" value="6" class="form-checkbox" />
                                <span class="ml-2">Th</span>
                            </label>
                            <label class="inline-flex items-center ml-2">
                                <input type="checkbox" v-model="form.selected_days" value="7" class="form-checkbox" />
                                <span class="ml-2">Fr</span>
                            </label>

                            <label class="inline-flex items-center ml-2">
                                <input @click="selectDays()" type="checkbox" class="form-checkbox" />
                                <span class="ml-2">Select All</span>
                            </label>
                        </div>
                    </div>
                    <!-- Checkbox End -->
                    <!-- select room start -->
                    <div class="flex flex-col lg:flex-row text-sm mt-1 mt-4 gap-x-4">
                        <div class="pb-4 w-full">
                            <h2 class="pb-2">Select Your Room</h2>
                            <select v-model="form.room_id" class="border border-gray-300 text-gray-600 py-2  pl-2  pr-2 rounded-md w-full bg-white hover:border-gray-400 focus:outline-none ">
                                <option v-for="(name, id) in room_list" :value="id">{{ name}}</option>
                            </select>
                        </div>
                        <div class="pb-4 w-full">
                            <h2 class="pb-2">Select Your Board Type</h2>
                            <select v-model="form.board_type"  class=" border border-gray-300 text-gray-600 py-2 pl-2 pr-2 rounded-md w-full bg-white hover:border-gray-400 focus:outline-none " >
                                <option v-for="(name, idx) in board_types" :value="idx">{{ name}}</option>
                            </select>
                        </div>
                    </div>
                    <!-- select room end -->
                    <!-- refund radio button start -->
                    <div class="flex flex-col lg:flex-row text-sm mt-1 mt-4 gap-x-4">
                        <div class="pb-4 w-full">
                            <h2 class="pb-2">Is it refundable</h2>
                            <div class="flex">
                                <label class="flex radio p-2 cursor-pointer">
                                    <input class="my-auto transform scale-125 checked:text-green-700 border-green-600" v-model="form.refundable" value="1" type="radio" name="refund" />
                                    <div class="title px-2">Yes</div>
                                </label>
                                <label class="flex radio p-2 cursor-pointer">
                                    <input class="my-auto transform scale-125 checked:text-red-600 border-red-700 " v-model="form.refundable" value="0" type="radio" name="refund" />
                                    <div class="title px-2">No</div>
                                </label>
                            </div>
                        </div>
                        <div class="pb-4 w-full">
                            <h2 class="pb-2">Mark if the room is open or close for sell</h2>
                            <div class="flex">
                                <label class="flex radio p-2 cursor-pointer">
                                    <input class="my-auto transform scale-125 checked:text-green-700 border-green-600" v-model="form.room_status" value="1" type="radio" name="sell" />
                                    <div class="title px-2">Open</div>
                                </label>
                                <label class="flex radio p-2 cursor-pointer">
                                    <input class="my-auto transform scale-125 checked:text-red-600 border-red-700" v-model="form.room_status" value="0" type="radio" name="sell" />
                                    <div class="title px-2">Close</div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- refund radio button end -->
                    <!-- number of room to sell start -->
                    <div class="flex flex-col lg:flex-row text-sm mt-1 mt-4 gap-x-4">
                        <div class="pb-4 w-full">
                            <label for="available_room" class="pb-2 block">Number of room to sell</label>
                            <div class="flex flex-col space-y-2 w-full">
                                <input
                                    id="available_room"
                                    type="number"
                                    v-model="form.available_room"
                                    name="default"
                                    placeholder=""
                                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 lg:w-full"
                                />
                            </div>
                            <jet-input-error v-if="form.errors.available_room" :message="form.errors.available_room[0]" class="mt-2" />
                        </div>
                        <div class="pb-4 w-full">
                            <label for="bar_rate" class="pb-2 block">BAR Rate (Inc.) BDT; Rack Rate: BDT <span>{{ rack_price }}</span></label>
                            <div class="flex flex-col space-y-2">
                                <input
                                    id="bar_rate"
                                    type="number"
                                    step="0.01"
                                    v-model="form.bar_rate"
                                    name="bar_rate"
                                    placeholder=""
                                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 lg:w-full"
                                />
                            </div>
                            <jet-input-error v-if="form.errors.bar_rate" :message="form.errors.bar_rate[0]" class="mt-2" />
                        </div>
                    </div>
                    <!-- number of room to sell end -->

                    <alert-message></alert-message>
                </div>
                <!-- footer -->
                <div class="flex items-center justify-between px-4 py-3 bg-gray-200 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    <jet-validation-errors class="mb-4 text-left" />

                    <div class=" px-4 py-2 border-gray-200 w-full flex justify-end items-center gap-3 " >
                        <jet-button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                                    class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none"
                        >
                            <span>Save</span>
                        </jet-button>
                        <jet-button type="button" @click.prevent="closeModal()" :disabled="form.processing"
                                    class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white focus:outline-none"
                        >
                            Close
                        </jet-button>
                    </div>

                </div>

            </form>
        </div>
    </div>
    <!-- modal -->

</template>

<script>
import { DatePicker }  from 'v-calendar';
import Swal from "sweetalert2";
import JetButton from '@/Jetstream/Button.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetActionMessage from '@/Jetstream/ActionMessage.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import AlertMessage from "../../Helpers/AlertMessage";

export default {
    name: "ScheduleModal",
    components: {
        AlertMessage,
        DatePicker,
        JetActionMessage,
        JetButton,
        JetInputError,
        JetValidationErrors,
    },
    props:['room_id', 'rack_price', 'room_list', 'board_types'],
    data(){
        return{
            masks: {
                input: 'YYYY-MM-DD',
            },
            form: this.$inertia.form({
                range:"",
                selected_days:[],
                room_id: '',
                board_type: 1,
                refundable: 1,
                room_status: 1,
                available_room: 0,
                bar_rate: 0,
            }),
        }
    },
    methods:{
        submit(){
            this.form
                .transform((data) => ({
                    ...data,

                    start_date: this.form.range.start,
                    end_date: this.form.range.end,
                }))
                .post(route('hotel.schedules.store'),{
                    preserveScroll: true,
                    preserveState: true,
                    resetOnSuccess: true,
                    onSuccess: page => {
                        if (!page.props.flash.error && !page.errors){
                            this.closeModal();
                            this.form.reset();
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
                            timer: 2500,
                            // footer: '<a href="">Scroll up on the modal to see the issue!</a>',
                        });
                    },
            })
        },
        closeModal(){
            const modal_overlay = document.querySelector("#modal_overlay");
            const modal = document.querySelector("#modal");
            const modalCl = modal.classList;

            modalCl.add("-translate-y-full");
            setTimeout(() => {
                modalCl.add("opacity-0");
                modalCl.add("scale-150");
            }, 100);
            setTimeout(() => modal_overlay.classList.add("hidden"), 300);
        },
        selectDays(){
            this.form.selected_days = [1,2,3,4,5,6,7];
        }
    },
    watch:{
        room_id:{
            handler(newVal, oldVal){
                this.form.room_id = this.room_id;
                this.form.bar_rate = this.rack_price;
            }
        },
    }
}
</script>

<style scoped>

</style>
