<template>
    <!-- Modal -->
    <div id="modal_overlay"
        class=" hidden fixed overflow-y-scroll inset-0 bg-black bg-opacity-30 h-screen w-full flex justify-center items-start md:items-center pt-10 md:pt-0"
    >
        <!-- modal -->
        <div id="modal" class=" opacity-0 transform -translate-y-full scale-150 relative w-10/12 md:w-1/2 h-auto bg-white rounded shadow-lg transition-opacity transition-transform duration-300">
            <!-- button close -->
            <button @click.prevent="closeModal()" class=" absolute -top-3 -right-3 bg-red-500 hover:bg-red-600 text-2xl w-10 h-10 rounded-full focus:outline-none text-white ">
                &cross;
            </button>

            <!-- header -->
            <div class="px-4 py-3 border-b border-gray-200">
                <p class="font-semibold text-lg text-gray-800">
                    Add or edit the amenities available in {{ room.room_name? room.room_name: 'this' }} room
                </p>
            </div>

            <!-- body -->
            <form action="" @submit.prevent="submit()">
                <div class="w-full p-3">
                    <div class=" flex lg:flex-row flex-col justify-center p-6 border-gray-200 rounded-tl-lg rounded-tr-lg ">
                        <div class="grid grid-cols-2 md:grid-cols-4 justify-items-start">
                            <div
                                v-if="amenities && amenities.length > 0"
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
                                        <label :for="'amenity_'+idx" class="inline-flex items-center">
                                            <input type="checkbox" :id="'amenity_'+idx" class="form-checkbox" v-model="form.amenity_ids" :value="child.id" />
                                            <span class="ml-2 text-blue-900">{{ child.name }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between px-4 py-3 bg-gray-200 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    <jet-validation-errors class="mb-4" />

                    <div class=" px-4 py-2 border-gray-200 w-full flex justify-end items-center gap-3 " >
                        <jet-button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                                    class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none"
                        >
                            <span>Save Amenities</span>
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
    <!-- Modal -->
</template>

<script>
import Swal from "sweetalert2";
import JetButton from '@/Jetstream/Button.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetActionMessage from '@/Jetstream/ActionMessage.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';

export default {
    name: "AmenityModal",
    props:['amenities', 'room'],
    components: {
        JetActionMessage,
        JetButton,
        JetInputError,
        JetValidationErrors,
    },
    data(){
        return{
            form: this.$inertia.form({
                room_id:"",
                amenity_ids:[],
            }),
        }
    },
    methods:{
        closeModal(){
            const modal_overlay = document.querySelector("#modal_overlay");
            const modal = document.querySelector("#modal");
            const modalCl = modal.classList;
            let overlayCl = modal_overlay;
            modalCl.add("-translate-y-full");
            setTimeout(() => {
                modalCl.add("opacity-0");
                modalCl.add("scale-150");
            }, 100);
            setTimeout(() => overlayCl.classList.add("hidden"), 300);

            this.form.reset();
        },
        submit(){
            this.form.post(route('hotel.rooms.amenity.store', this.room.id),{
                preserveScroll: true,
                onSuccess: () => {
                    this.closeModal();
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Room amenity added Successfully",
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
    },
    computed:{
        checkRoomDetails(){
            return JSON.parse(JSON.stringify(this.room))
        }
    },
    watch:{
        checkRoomDetails:{
            handler(newVal, oldVal){
                if (newVal !== oldVal){
                    this.form.room_id = this.room.id;
                    if(this.room.facilities && this.room.facilities.length > 0){
                        this.room.facilities.forEach((item)=>{
                            this.form.amenity_ids.push(item.id);
                        })
                    }
                }
            }
        },
    }
}
</script>

<style scoped>

</style>
