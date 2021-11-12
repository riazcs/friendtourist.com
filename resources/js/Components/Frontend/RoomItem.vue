<template>
    <div class="w-full">
        <div class="d-flex border p-3 shadow mb-4">
            <div id="card-option-left" class="flex-fill mr-5" style="width: 35%; height: auto;">
                <h3 style="font-size: 22px; color: #000; padding-bottom: 10px;">{{ room.room_name }}</h3>
                <div style="width: 100%; height: auto;" class="grid grid-cols-2 gap-2 justify-items-center">
                    <img alt="Room Image" class=" inline-block" style="height: 90px; width: 100%; border-radius: 10px;"
                         v-for="(attachment,index) in room.attachments.slice(0,4)" :key="index"
                         :src='attachment.file_path'
                    >
                </div>
                <template v-if="room.facilities && room.facilities.length > 0">
                    <h5 class="pt-3 mb-2 text-md" style="font-size: 16px;">Amenities:</h5>
                    <div class="d-flex">
                        <div class="flex-fill">
                        <span v-for="facility in room.facilities.slice(0, 3)">
                            <p class="text-sm">
                                <span style="color: #0071c2; font-size: 14px; font-weight:300 !important;">
                                    <i class="fas fa-check"></i>
                                </span> {{ facility.name }}
                            </p>
                        </span>
                        </div>
                        <div class="flex-fill">
                        <span  v-for="facility in room.facilities.slice(4,7)">
                            <p class="text-sm">
                                <span style="color: #0071c2; font-size: 14px; font-weight:300 !important;"><i class="fas fa-check"></i>
                                </span> {{ facility.name }}
                            </p>
                        </span>
                        </div>
                    </div>
                    <div class="text-center w-full mt-4">
                        <a href="#" class="cursor-pointer " @click.prevent="openAmenityModal()">Show More</a>
                    </div>
                </template>
            </div>
            <div id="card-option-right" class="flex-fill" style="width: 65%; height: auto;">
                <room-option-item
                    v-if="room.schedules && room.schedules.length > 0"
                    v-for="(schedule, idx) in room.schedules"
                    :key="schedule.id"
                    :schedule="schedule"
                    :room="room"
                    :index="idx"
                    :cart="cart"
                    :room_qty="room_qty"
                ></room-option-item>
            </div>
        </div>
        <room-amenity-modal :room="room" ></room-amenity-modal>
    </div>
</template>

<script>
import RoomOptionItem from "./RoomOptionItem";
import RoomAmenityModal from "./RoomAmenityModal";
export default {
    name: "RoomItem",
    components: {RoomAmenityModal, RoomOptionItem},
    props:['room', 'cart', 'room_qty'],
    data(){
        return{
            selectedAmenities:{},
        }
    },
    methods:{
        openAmenityModal(){
            const modal_overlay = document.querySelector("#modal_overlay_"+this.room.id);
            const modal = document.querySelector("#modal_"+this.room.id);
            const modalCl = modal.classList;
            let overlayCl = modal_overlay;

            overlayCl.classList.remove("hidden");
            setTimeout(() => {
                modalCl.remove("opacity-0");
                modalCl.remove("-translate-y-full");
                modalCl.remove("scale-150");
            }, 100);
        }
    }
}
</script>

<style scoped>

</style>
