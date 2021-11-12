<template>
    <hotel-layout title="Add Room">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add new room information
            </h2>
        </template>


        <form action="" @submit.prevent="submit()">
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="flex bg-white p-4 my-4 rounded-md flex-col lg:flex-row">
                    <div class="w-full p-4">
                        <h2 class="font-bold">Room Description</h2>
                        <p>
                            Please provide detailed information about each room. You can
                            change the suggested name to your desired custom name. After you
                            complete room registration you will still be able to make changes
                            to your listing before it goes live
                        </p>
                    </div>

                    <div class="w-full p-4">
                        <div class="pb-4">
                            <h2 class="font-medium pb-2">Room Type*</h2>
                            <!-- dropdown -->
                            <select
                                class="
                              border border-gray-300
                              text-gray-600
                              h-10
                              pl-2
                              pr-2
                              rounded-sm
                              w-full
                              bg-white
                              hover:border-gray-400
                              focus:outline-none
                            "
                                v-model="form.room_type"
                            >
                                <option disabled selected>Select room type</option>
                                <option v-for="(roomType, idx) of roomTypes" :value="roomType" :key="idx">{{ roomType}}</option>
                            </select>
                            <jet-input-error v-if="form.errors.room_type" :message="form.errors.room_type[0]" class="mt-2" />
                        </div>

                        <div class="pb-4">
                            <h2 class="font-medium pb-2">Room Characteristics</h2>
                            <!-- dropdown -->
                            <select
                                class="
                              border border-gray-300
                              text-gray-600
                              h-10
                              pl-2
                              pr-2
                              rounded-sm
                              w-full
                              bg-white
                              hover:border-gray-400
                              focus:outline-none
                            "
                                v-model="form.room_character"
                            >
                                <option disabled selected>Select room type</option>
                                <option value="None">None</option>
                                <option v-for="(character, idx) of characteristics" :value="character" :key="idx">{{ character}}</option>
                            </select>
                            <jet-input-error v-if="form.errors.room_character" :message="form.errors.room_character[0]" class="mt-2" />
                        </div>
                        <div class="pb-4">
                            <h2 class="font-medium pb-2">Room View</h2>
                            <!-- dropdown -->
                            <select
                                class="
                                  border border-gray-300
                                  text-gray-600
                                  h-10
                                  pl-2
                                  pr-2
                                  rounded-sm
                                  w-full
                                  bg-white
                                  hover:border-gray-400
                                  focus:outline-none
                                "
                                v-model="form.room_view"
                            >
                                <option disabled selected>Select Room View</option>
                                <option v-for="(room_view, idx) of room_views" :value="room_view" :key="idx">{{ room_view}}</option>
                            </select>
                            <jet-input-error v-if="form.errors.room_view" :message="form.errors.room_view[0]" class="mt-2" />
                        </div>
                        <div class="pb-4">
                            <label for="room_name" class="font-medium pb-2 block">Custom Room Name</label>
                            <input
                                id="room_name"
                                type="text"
                                name="room_name"
                                placeholder=""
                                v-model="form.room_name"
                                class="px-4 py-2 rounded-sm border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 w-full"
                            />
                            <jet-input-error v-if="form.errors.room_name" :message="form.errors.room_name[0]" class="mt-2" />
                        </div>
                        <div class="pb-4">
                            <h2 class="font-medium pb-2">Smoking Policy*</h2>
                            <!-- dropdown -->
                            <select
                                class="
                              border border-gray-300
                              text-gray-600
                              h-10
                              pl-2
                              pr-2
                              rounded-sm
                              w-full
                              bg-white
                              hover:border-gray-400
                              focus:outline-none
                            "
                                v-model="form.smoking_policy"
                            >
                                <option disabled selected>Select smoking policy</option>
                                <option  value="0" >None</option>
                                <option  value="1" >Allow Smoking</option>
                                <option  value="2" >None Smoking</option>
                            </select>
                            <jet-input-error v-if="form.errors.smoking_policy" :message="form.errors.room_type[0]" class="mt-2" />
                        </div>
                        <h2 class="font-medium pb-2">
                            How many rooms do you have of this kind?*
                        </h2>
                        <div class="custom-number-input h-10 w-32">
                            <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                <button
                                    @click.prevent="decrement('room')"
                                    class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                                    <span class="m-auto text-2xl font-thin">−</span>
                                </button>
                                <input type="number"
                                       disabled
                                       class="outline-none focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none"
                                       name="custom-input-number"
                                       v-model="form.total_rooms"
                                >
                                <button
                                    @click.prevent="increment('room')"
                                    class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                                    <span class="m-auto text-2xl font-thin">+</span>
                                </button>
                            </div>
                            <jet-input-error v-if="form.errors.total_rooms" :message="form.errors.total_rooms[0]" class="mt-2" />
                        </div>
                    </div>
                    <!-- room description -->
                </div>

                <div class="flex bg-white p-4 my-4 rounded-md flex-col lg:flex-row">
                    <div class="w-full p-4">
                        <h2 class="font-bold">Bed Options</h2>
                        <p> Please provide detailed information about existing beds in a room. Do not include extra beds.</p>
                    </div>

                    <div class="w-full p-4">
                        <div class="pb-2" v-for="(room_bed, index) of room_beds" :key="room_bed">
                            <div class="pb-2 flex" >
                                <div class="w-full pr-1">
                                    <h2 class="font-semibold text-sm pb-2">Bed Type*</h2>
                                    <!-- dropdown -->
                                    <select
                                        class="
                                      border border-gray-300
                                      text-gray-600
                                      h-10
                                      pl-2
                                      pr-2
                                      rounded-sm
                                      w-full
                                      bg-white
                                      hover:border-gray-400
                                      focus:outline-none
                                     "
                                        v-model="room_beds[index].bed_type"
                                    >
                                        <option v-for="bed_type of bed_types" :key="bed_type" :value="bed_type">{{ bed_type }}</option>
                                    </select>
<!--                                    <jet-input-error v-if="form.errors.beds[index].bed_type" :message="form.errors.room_beds[index].bed_type" class="mt-2" />-->
                                </div>
                                <div class="w-full">
                                    <h2 class="font-semibold text-sm pb-2">Bed Size</h2>
                                    <!-- dropdown -->
                                    <select
                                        class="
                                      border border-gray-300
                                      text-gray-600
                                      h-10
                                      pl-2
                                      pr-2
                                      rounded-sm
                                      w-full
                                      bg-white
                                      hover:border-gray-400
                                      focus:outline-none
                                    "
                                        v-model="room_beds[index].bed_size"
                                    >
                                        <option v-for="bed_size of bed_sizes" :key="bed_size" :value="bed_size">{{ bed_size }}</option>
                                    </select>
<!--                                    <jet-input-error v-if="form.errors.beds[index].bed_size" :message="form.errors.room_beds[index].bed_size" class="mt-2" />-->
                                    <!-- dropdown -->
                                </div>
                            </div>

                            <div class="pb-4 text-right">
                                <button type="button" class="mr-2 text-md font-semibold text-red-400" @click.prevent="removeBed(index, room_bed.id)"><span>-</span> Remove</button>
                            </div>
                        </div>

                        <div class="flex pb-4">
                            <button class="mr-2 text-md font-semibold text-blue-700" @click.prevent="addBed()"><span>+</span> Add bed</button>
                        </div>

                        <div class="pb-4 flex">
                            <div class="w-full pr-1">
                                <h2 class="font-medium text-sm pb-2">Adult Occupancy</h2>
                                <!-- counter -->
                                <div class="custom-number-input h-10 w-32">
                                    <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                        <button @click.prevent="decrement('adult')"
                                                class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                                            <span class="m-auto text-2xl font-thin">−</span>
                                        </button>
                                        <input type="number"
                                               disabled
                                               class="outline-none focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none"
                                               name="custom-input-number"
                                               v-model="form.adult_occupancy">
                                        <button @click.prevent="increment('adult')"
                                                class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                                            <span class="m-auto text-2xl font-thin">+</span>
                                        </button>
                                    </div>
                                    <jet-input-error v-if="form.errors.adult_occupancy" :message="form.errors.adult_occupancy[0]" class="mt-2" />
                                </div>
                                <!-- counter -->
                            </div>
                            <div class="w-full">
                                <h2 class="text-sm font-medium pb-2">Complementary Child Occupancy <br> (For children up to 5 years)</h2>
                                <!-- counter -->
                                <div class="custom-number-input h-10 w-32">
                                    <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                        <button @click.prevent="decrement('child')"
                                                class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                                            <span class="m-auto text-2xl font-thin">−</span>
                                        </button>
                                        <input type="number"
                                               disabled
                                               class="outline-none focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none"
                                               name="custom-input-number"
                                               v-model="form.child_occupancy"
                                        >
                                        <button @click.prevent="increment('child')"
                                                class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                                            <span class="m-auto text-2xl font-thin">+</span>
                                        </button>
                                    </div>
                                    <jet-input-error v-if="form.errors.child_occupancy" :message="form.errors.child_occupancy[0]" class="mt-2" />
                                </div>
                                <!-- counter -->
                            </div>
                        </div>

                        <div class="pb-2">
                            <h2 class="font-medium text-sm pb-2">Extra bed</h2>
                            <div class="custom-number-input h-10 w-32">
                                <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                    <button @click.prevent="decrement('e_bed')"
                                            class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                                        <span class="m-auto text-2xl font-thin">−</span>
                                    </button>
                                    <input type="number"
                                           disabled
                                           class="outline-none focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none"
                                           name="custom-input-number"
                                           v-model="form.extra_bed"
                                    >
                                    <button @click.prevent="increment('e_bed')"
                                            class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                                        <span class="m-auto text-2xl font-thin">+</span>
                                    </button>
                                </div>
                                <jet-input-error v-if="form.errors.extra_bed" :message="form.errors.extra_bed[0]" class="mt-2" />
                            </div>
                        </div>

                        <div>
                            <h2 class="font-medium text-sm pb-2 ">
                                What is the maximum number of guest you will allow in this room ?
                            </h2>
                            <!-- input fleld -->
                            <div class="flex flex-col space-y-2">
                                <input
                                    id="default"
                                    type="number"
                                    name="default"
                                    placeholder=""
                                    v-model="form.max_guest_allow"
                                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 lg:w-2/5"
                                />
                                <jet-input-error v-if="form.errors.max_guest_allow" :message="form.errors.max_guest_allow[0]" class="mt-2" />
                            </div>
                            <!-- input field -->
                        </div>
                    </div>
                </div>
                <div class="flex bg-white p-4 my-4 rounded-md flex-col lg:flex-row">
                    <div class="w-full p-4">
                        <h2 class="font-bold">Room Measurement</h2>
                        <p>
                            Tell us about the room space
                        </p>
                    </div>

                    <div class="w-full p-4">
                        <div class="pb-4 flex">
                            <div class="w-full pr-1">
                                <h2 class="font-semibold text-sm pb-2">Room Size in Squire feet</h2>
                                <!-- input fleld -->
                                <div class="flex flex-col space-y-2">
                                    <input
                                        id="default1"
                                        type="number"
                                        step="0.01"
                                        v-model="form.room_size"
                                        name="default"
                                        placeholder=""
                                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 lg:w-2/5"
                                    />
                                </div>
                                <jet-input-error v-if="form.errors.room_size" :message="form.errors.room_size[0]" class="mt-2" />
                                <!-- input field -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex bg-white p-4 my-4 rounded-md flex-col lg:flex-row">
                    <div class="w-full p-4">
                        <h2 class="font-bold">Rate Options</h2>
                        <p> Tell us only about the rack rate for this room. Please DO NOT include extra bed and service charge</p>
                    </div>

                    <div class="w-full p-4">
                        <div class="pb-4 flex">
                            <div class="w-full pr-1">
                                <h2 class="font-semibold text-sm pb-2">Rack Rate*</h2>
                                <!-- input fleld -->
                                <div class="flex w-3/4">
                                    <span class="text-sm border border-2 rounded-l px-2 py-2 w-full bg-blue-100 whitespace-no-wrap text-center font-medium">BDT per night</span>
                                    <input name="field_name"
                                           v-model="form.rack_price"
                                           class="border border-2 rounded-r px-4 py-2 w-full focus:outline-none focus:ring-1 focus:ring-gray-200 lg:px-10"
                                           type="number" step="0.01" placeholder=""/>
                                </div>
                                <jet-input-error v-if="form.errors.rack_price" :message="form.errors.rack_price[0]" class="mt-2" />
                                <!-- input field -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Rate Options -->
                <div class="flex items-center justify-between px-4 py-3 bg-gray-200 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    <jet-validation-errors class="mb-4" />

                    <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                        Saved.
                    </jet-action-message>

                    <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="bg-green-700">
                        <span>Save Information</span>
                    </jet-button>
                </div>
                <!-- Close and Update button -->
            </div>
        </form>
    </hotel-layout>
</template>

<script>
import HotelLayout from "@/Layouts/HotelLayout";
import JetButton from '@/Jetstream/Button.vue';
import JetActionMessage from '@/Jetstream/ActionMessage.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import Swal from "sweetalert2";
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import {Link} from "@inertiajs/inertia-vue3";

export default {
    name: "CreateUpdateHotelRoom",
    components: {
        HotelLayout,
        JetActionMessage,
        JetButton,
        JetInputError,
        JetValidationErrors,
        Link
    },
    props:[
        'roomTypes',
        'characteristics',
        'room_views',
        'bed_types',
        'bed_sizes',
        'room'
    ],
    data(){
        return {
            form: this.$inertia.form({
                room_type:"",
                room_character:"",
                room_view:"",
                room_name:"",
                smoking_policy:"",
                total_rooms:1,
                adult_occupancy:1,
                child_occupancy:0,
                extra_bed:0,
                max_guest_allow:0,
                room_size:0.00,
                rack_price:0,
                beds:[],
            }),
            room_beds:[],
            deleted_beds: [],
        }
    },
    mounted() {
        if(this.room){
            this.form.room_type=this.room.room_type;
            this.form.room_character=this.room.room_character;
            this.form.room_view=this.room.room_view;
            this.form.room_name=this.room.room_name;
            this.form.smoking_policy=this.room.smoking_policy;
            this.form.total_rooms=this.room.total_rooms;
            this.form.adult_occupancy=this.room.adult_occupancy;
            this.form.child_occupancy=this.room.child_occupancy;
            this.form.extra_bed=this.room.extra_bed;
            this.form.max_guest_allow=this.room.max_guest_allow;
            this.form.room_size=this.room.room_size;
            this.form.rack_price=this.room.rack_price ;
        }

        if(this.room && this.room.beds){
            this.room.beds.forEach((selectedBed) => {
                let bed = {
                    id: selectedBed.id,
                    bed_type: selectedBed.bed_type,
                    bed_size: selectedBed.bed_size,
                };
                this.room_beds.push(bed);
            });
        }else{
            this.addBed();
        }

    },
    methods:{
        submit(){
            if(this.room){
                this.form.transform((data) => ({
                    ...data,
                    beds: this.room_beds ? this.room_beds : [],
                    deleted_beds: this.deleted_beds ? this.deleted_beds : [],
                })).put(route('hotel.rooms.update', this.room.id),{
                    preserveScroll: true,
                    onSuccess: () => {
                        // Swal.fire({
                        //     icon: "success",
                        //     title: "Success",
                        //     text: "Amenity added Successfully",
                        //     position: "top-end",
                        //     showConfirmButton: false,
                        //     timer: 1500,
                        // });
                    },
                    onError() {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                            position: "top-end",
                            // footer: '<a href="">Scroll up on the modal to see the issue!</a>',
                        });
                    },
                })
            }else{
                this.form.transform((data) => ({
                    ...data,
                    beds: this.room_beds ? this.room_beds : [],
                })).post(route('hotel.rooms.store'),{
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess: () => {
                        // Swal.fire({
                        //     icon: "success",
                        //     title: "Success",
                        //     text: "Amenity added Successfully",
                        //     position: "top-end",
                        //     showConfirmButton: false,
                        //     timer: 1500,
                        // });
                    },
                    onError() {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                            position: "top-end",
                            // footer: '<a href="">Scroll up on the modal to see the issue!</a>',
                        });
                    },
                })
            }

        },
        decrement(type){
            if(type === 'room'){
                if(this.form.total_rooms > 1){
                    this.form.total_rooms--;
                }
            }

            if(type === 'adult'){
                if(this.form.adult_occupancy > 1){
                    this.form.adult_occupancy--;
                }
            }

            if(type === 'child'){
                if(this.form.child_occupancy > 0){
                    this.form.child_occupancy--;
                }
            }
            if(type === 'e_bed'){
                if(this.form.extra_bed > 0){
                    this.form.extra_bed--;
                }
            }
        },
        increment(type){
            if(type === 'room'){
                this.form.total_rooms++;
            }

            if(type === 'adult'){
                this.form.adult_occupancy++;
            }

            if(type === 'child'){
                this.form.child_occupancy++;
            }
            if(type === 'e_bed'){
                this.form.extra_bed++;
            }
        },
        addBed(){
            let bed ={
                id: null,
                bed_type: "",
                bed_size: "",
            }
            this.room_beds.push(bed);
        },
        removeBed(index, id){
            if (id != null) {
                this.deleted_beds.push(id);
            }
            this.room_beds.splice(index, 1);
        },
    }
}
</script>

<style scoped>

</style>
