<template>
  <app-layout title="Dashboard">
    <template #header>
      <div class="flex justify-between">
        <div>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <button
              @click="back"
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
              <svg
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
                  d="M10 19l-7-7m0 0l7-7m-7 7h18"
                />
              </svg>
            </button>
            Settings
          </h2>
        </div>
      </div>
    </template>
    <div class="py-12">
      <div class="mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div>
            <h3 class="p-3 text-center">District List</h3>
            <table
              class="border-separate border w-full text-center"
              id="district"
            >
              <thead>
                <tr>
                  <th class="border">District Name</th>
                  <th class="border">Division Name</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="district in districts" :key="district.id">
                  <td class="border">{{ district.name }}</td>
                  <td class="border">{{ district.division.name }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>
<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import "jquery/dist/jquery.min.js";
//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";
export default defineComponent({
  data() {
    return {
      dtRef: null,
      form: this.$inertia.form({}),
    };
  },
  props: {
    districts: [],
  },
  components: {
    AppLayout,
  },
  mounted: function () {
    this.dtRef = $("#district").DataTable();
  },
  methods: {
    back() {
      this.$inertia.get(route("admin.setting.index"));
    },
  },
});
</script>



