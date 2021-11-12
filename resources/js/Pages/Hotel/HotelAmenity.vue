<template>
    <hotel-layout title="Hotel Amenity">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Hotel Amenity information
            </h2>
        </template>

        <form action="" @submit.prevent="submit()">
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="px-4 py-3 border-b border-gray-200 bg-white">
                    <p class="font-semibold text-lg text-gray-800">
                        Add or edit the amenities available in hotel
                    </p>
                </div>
                <div class="flex bg-white p-4 rounded-md flex-col lg:flex-row">
                    <div class="w-full p-3">
                        <div class=" flex lg:flex-row flex-col justify-start p-6 border-gray-200 rounded-tl-lg rounded-tr-lg ">
                            <div v-if="amenities && amenities.length > 0"
                                 class="grid grid-cols-2 md:grid-cols-4 justify-items-start">
                                <div
                                    v-for="(amenity, index) of amenities"
                                    :key="index"
                                    class="mb-2"
                                >
                                    <div class=" bg-blue-50 flex justify-center items-center w-14 h-14 rounded-full " >
                                        <i class="fas fa-info-circle text-blue-800 text-lg"></i>
                                    </div>
                                    <h2 class="mt-1 font-semibold text-blue-900">{{ amenity.name }}</h2>
                                    <div v-if="amenity.children && amenity.children.length> 0">
                                        <div class="mt-2"
                                             v-for="(child, idx) of amenity.children"
                                             :key="index+'_'+idx"
                                        >
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" class="form-checkbox" v-model="form.amenity_ids" :value="child.id" />
                                                <span class="ml-2 text-blue-900">{{ child.name }}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else class="bg-blue-300 border-t-4 w-full border-blue-500 rounded-b text-white px-4 py-3 mx-6 mt-3 shadow-md" role="alert">
                                <div class="flex">
                                    <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                    <div>
                                        <p class="font-bold">No Amenities Information available now.</p>
                                        <!-- <p class="text-sm">Make sure you know how these changes affect you.</p>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="amenities && amenities.length > 0" class="flex items-center justify-between px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md " >
                    <jet-validation-errors class="mb-4" />
                    <jet-action-message :on="form.recentlySuccessful" class="mr-3">Saved.</jet-action-message>
                    <jet-button
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none"
                    >
                        Update Amenities
                    </jet-button>
                </div>
            </div>
        </form>
    </hotel-layout>
</template>

<script>
import HotelLayout from "@/Layouts/HotelLayout";
import JetButton from "@/Jetstream/Button.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import Swal from "sweetalert2";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import ActionMessage from "@/Jetstream/ActionMessage";

export default {
    name: "HotelAmenity",
    components: {
        HotelLayout,
        JetActionMessage,
        JetButton,
        JetInputError,
        JetValidationErrors,
        ActionMessage
    },
    props:['amenities','myAmenities'],
    data(){
        return{
            form: this.$inertia.form({
                amenity_ids:[],
            }),
        }
    },
    mounted() {
        this.form.amenity_ids = this.myAmenities;
    },
    methods:{
        submit(){
            this.form.post(route('hotel.amenity.store'),{
                preserveScroll: true,
                onSuccess: () => {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Hotel amenity added Successfully",
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
                        // footer: '<a href="">Scroll up on the modal to see the issue!</a>',
                    });
                },
            })
        }
    }
}
</script>

<style scoped>

</style>
