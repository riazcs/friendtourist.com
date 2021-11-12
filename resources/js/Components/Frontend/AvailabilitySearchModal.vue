<template>
    <!-- Modal -->
    <div id="modal_overlay_search"
         class="hidden fixed overflow-y-scroll inset-0 bg-black bg-opacity-30 h-screen w-full flex justify-center items-start md:items-center pt-10 md:pt-0"
    >
        <!-- modal -->
        <div id="modal_search" class=" opacity-0 transform -translate-y-full scale-150 relative w-10/12 md:w-3/5 h-auto bg-white rounded shadow-lg transition-opacity transition-transform duration-300">
            <!-- button close -->
            <button @click.prevent="closeModal()" class=" absolute -top-3 -right-3 bg-red-500 hover:bg-red-600 text-2xl w-10 h-10 rounded-full focus:outline-none text-white ">
                &cross;
            </button>

            <!-- header -->
            <div class="px-4 py-3 border-b border-gray-200">
                <p class="font-semibold text-lg text-gray-800">
                    Modify Availability Search
                </p>
            </div>

            <!-- body -->

            <div class="w-full p-3">
                <search-section></search-section>
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
import SearchSection from "./SearchSection";
export default {
    name: "AvailabilitySearchModal",
    components: {SearchSection},
    props:['filter'],
    methods:{
        closeModal(){
            const modal_overlay = document.querySelector("#modal_overlay_search");
            const modal = document.querySelector("#modal_search");
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
