<template>
    <!-- Modal -->
    <div :id="'modal_overlay_'+room.id"
        class="hidden fixed overflow-y-scroll inset-0 bg-black bg-opacity-30 h-screen w-full flex justify-center items-start md:items-center pt-10 md:pt-0"
    >
        <!-- modal -->
        <div :id="'modal_'+room.id" class=" opacity-0 transform -translate-y-full scale-150 relative w-10/12 md:w-3/5 h-auto bg-white rounded shadow-lg transition-opacity transition-transform duration-300">
            <!-- button close -->
            <button @click.prevent="closeModal()" class=" absolute -top-3 -right-3 bg-red-500 hover:bg-red-600 text-2xl w-10 h-10 rounded-full focus:outline-none text-white ">
                &cross;
            </button>

            <!-- header -->
            <div class="px-4 py-3 border-b border-gray-200">
                <p class="font-semibold text-lg text-gray-800">
                    All available amenities for room <strong>{{ room.room_name }}</strong>
                </p>
            </div>

            <!-- body -->

            <div class="w-full p-3">
                <div class=" flex lg:flex-row flex-col p-6 border-gray-200 rounded-tl-lg rounded-tr-lg ">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-x-6 justify-items-start">
                        <div
                            v-for="(amenity, index) in room.amenities"
                            :key="index"
                            class="mb-2"
                        >
                            <div class=" bg-blue-50 flex justify-center items-center w-14 h-14 rounded-full " >
                                <i class="fas fa-info-circle text-blue-800 text-lg"></i>
                            </div>
                            <h6 class="mt-1 font-semibold text-blue-900">{{ amenity.name }}</h6>
                            <div v-if="amenity.children && amenity.children.length> 0">
                                <div class="mt-2"
                                     v-for="(child, idx) in amenity.children"
                                     :key="index+'_'+idx"
                                >
                                    <label class="inline-flex items-center">
                                        <span style="color: #0071c2; font-size: 14px; font-weight:300 !important;">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="ml-2 text-blue-900">{{ child.name }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-4 py-3 border-t border-gray-200 w-full flex justify-end items-center gap-3">
                <button
                    @click.prevent="closeModal()"
                    class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white focus:outline-none"
                >Close</button>
            </div>

        </div>
    </div>
    <!-- Modal -->
</template>

<script>
export default {
    name: "RoomAmenityModal",
    props:['room'],
    methods:{
        closeModal(){
            const modal_overlay = document.querySelector("#modal_overlay_"+this.room.id);
            const modal = document.querySelector("#modal_"+this.room.id);
            const modalCl = modal.classList;
            let overlayCl = modal_overlay;
            modalCl.add("-translate-y-full");
            setTimeout(() => {
                modalCl.add("opacity-0");
                modalCl.add("scale-150");
            }, 100);
            setTimeout(() => overlayCl.classList.add("hidden"), 300);
        }
    }
}
</script>

<style scoped>

</style>
