<template>
  <hotel-layout title="Rooms">
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Hotel Rooms List
        </h2>
        <Link
          :href="route('hotel.rooms.create')"
          class="
            p-2
            pl-5
            pr-5
            bg-blue-800
            text-gray-100 text-lg
            rounded-lg
            focus:border-4
            border-blue-300
            hover:bg-blue-500
          "
        >
          + Add Room
        </Link>
      </div>
    </template>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <div class="w-full" v-if="rooms.data && rooms.data.length > 0">
        <!-- room details -->
        <div
          class="mx-auto bg-white px-4 py-5 rounded-md my-5"
          v-for="room of rooms.data"
          :key="room.id"
        >
          <div
            class="flex sm:flex-col lg:flex-row justify-between border-gray-300"
          >
            <div class="text-lg font-bold">
              <h2>{{ room.room_name }}</h2>
            </div>
            <div class="flex lg:flex-row gap-x-2 items-center">
              <div>
                <button
                  type="button"
                  class="
                    py-1.5
                    pl-5
                    pr-5
                    bg-white
                    border-2 border-gray-300
                    text-gray-500 text-lg
                    rounded-lg
                    font-semibold
                  "
                  @click.prevent="openAmenityModal(room)"
                >
                  Add/Edit Amenities
                </button>
              </div>
              <div>
                <Link
                  :href="route('hotel.rooms.edit', room.id)"
                  class="
                    py-1.5
                    pl-5
                    pr-5
                    bg-white
                    border-2 border-gray-300
                    text-gray-500 text-lg
                    rounded-lg
                    font-semibold
                  "
                >
                  Edit Room
                </Link>
              </div>
              <div>
                <i
                  @click.prevent="deleteRoom(room.id)"
                  class="fas fa-trash-alt text-lg text-gray-500"
                ></i>
              </div>
            </div>
          </div>

          <div
            class="
              flex
              sm:flex-col
              lg:flex-row
              justify-between
              w-2/5
              text-gray-500
            "
          >
            <div>
              <!--Room-->
              <div class="flex">
                <div>
                  <p>{{ room.total_rooms }} Room</p>
                </div>
                <div>
                  <p class="ml-1">
                    {{ room.beds ? room.beds.length : "0" }} bed
                  </p>
                </div>
              </div>
              <div
                class="block w-full"
                v-if="room.beds && room.beds.length > 0"
              >
                <div
                  class="flex items-center gap-2"
                  v-for="bed of room.beds"
                  :key="'bed_' + bed.id"
                >
                  <i class="fas fa-bed"></i>
                  <p>{{ bed.bed_type }}</p>
                </div>
              </div>
            </div>
            <!--Room-->
            <div>
              <p>Sleeps</p>
              <div class="flex items-center gap-2">
                <i class="fas fa-user-friends"></i>
                <p>Max-{{ room.max_guest_allow }}</p>
              </div>
            </div>
            <div>
              <p>Sq.Feet</p>
              <div class="flex items-center gap-2">
                <i class="fas fa-ruler-horizontal"></i>
                <p v-if="room.room_size">Max-{{ room.room_size }}</p>
              </div>
            </div>
          </div>
        </div>
        <!-- room details end -->
      </div>
      <pagination :meta="rooms.meta"></pagination>
    </div>
    <amenity-modal :room="selectedRoom" :amenities="amenities"></amenity-modal>
  </hotel-layout>
</template>

<script>
import HotelLayout from "@/Layouts/HotelLayout";
import { Link } from "@inertiajs/inertia-vue3";
import Pagination from "../../Helpers/Pagination";
import Swal from "sweetalert2";
import { Inertia } from "@inertiajs/inertia";
import AmenityModal from "./AmenityModal";

export default {
  name: "HotelRooms",
  components: {
    AmenityModal,
    Pagination,
    HotelLayout,
    Link,
  },
  props: ["rooms", "amenities"],
  data() {
    return {
      selectedRoom: {},
    };
  },
    mounted() {
    },
    methods: {
    deleteRoom(id) {
      Swal.fire({
        title: "Are you sure? want to delete this room",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          Inertia.delete(route("hotel.rooms.destroy", id), {
            onSuccess: () => {
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
            },
          });
        }
      });
    },
    openAmenityModal(room) {
      this.selectedRoom = room;

      const modal_overlay = document.querySelector("#modal_overlay");
      const modal = document.querySelector("#modal");
      const modalCl = modal.classList;
      let overlayCl = modal_overlay;

      overlayCl.classList.remove("hidden");
      setTimeout(() => {
        modalCl.remove("opacity-0");
        modalCl.remove("-translate-y-full");
        modalCl.remove("scale-150");
      }, 100);
    },
  },
};
</script>

<style scoped>
</style>
