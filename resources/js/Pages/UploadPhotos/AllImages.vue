<template>
  <hotel-layout title="Dashboard">
    <template #header>
      <div class="flex justify-between">
        <div>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Photo
          </h2>
        </div>
      </div>
    </template>
    <!-- This example requires Tailwind CSS v2.0+ -->

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div>
            <button
              @click="uploadPhoto('hotel')"
              class="
                bg-transparent
                hover:bg-blue-500
                text-blue-700
                font-semibold
                hover:text-white
                py-2
                px-4
                my-2
                ml-1
                border border-blue-500
                hover:border-transparent
                rounded
              "
            >
              Hotel Photos<svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                />
              </svg>
            </button>
            <button
              @click="propertyType('hotel')"
              class="
                bg-transparent
                hover:bg-blue-500
                text-blue-700
                font-semibold
                hover:text-white
                py-2
                px-4
                ml-2
                my-2
                border border-blue-500
                hover:border-transparent
                rounded
              "
            >
              Room Photos<svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                />
              </svg>
            </button>
            <!-- <PropertyTypeSetting /> -->
          </div>
        </div>
      </div>
    </div>
  </hotel-layout>
</template>

<script>
import { defineComponent } from "vue";
import HotelLayout from "@/Layouts/HotelLayout";
export default {
    name: 'AllImages',
    data() {
        return {
            form: this.$inertia.form({}),
        };
    },
    props: {},
    components: {
        HotelLayout,
    },
    methods: {
        uploadPhoto(type) {
            this.$inertia.get(route("hotel.photos.show", type));
        },
    },
};
</script>



