<template>
  <app-layout title="Dashboard">
    <template #header>
      <div class="flex justify-between">
        <div>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hotels
          </h2>
        </div>

        <button
          @click="openModal()"
          class="
            bg-transparent
            hover:bg-blue-500
            text-blue-700
            font-semibold
            hover:text-white
            py-2
            px-4
            border border-blue-500
            hover:border-transparent
            rounded
          "
        >
          Add Hotel User<svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6 inline"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
            />
          </svg>
        </button>
      </div>
    </template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div
      v-if="modal"
      class="fixed z-10 inset-0 overflow-y-auto"
      aria-labelledby="modal-title"
      role="dialog"
      aria-modal="true"
    >
      <div
        class="
          flex
          items-end
          justify-center
          min-h-screen
          pt-4
          px-4
          pb-20
          text-center
          sm:block sm:p-0
        "
      >
        <!--
      Background overlay, show/hide based on modal state.

      Entering: "ease-out duration-300"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100"
        To: "opacity-0"
    -->
        <div
          class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
          aria-hidden="true"
        ></div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span
          class="hidden sm:inline-block sm:align-middle sm:h-screen"
          aria-hidden="true"
          >&#8203;</span
        >

        <!--
      Modal panel, show/hide based on modal state.

      Entering: "ease-out duration-300"
        From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        To: "opacity-100 translate-y-0 sm:scale-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100 translate-y-0 sm:scale-100"
        To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    -->
        <div
          class="
            inline-block
            align-bottom
            bg-white
            rounded-lg
            text-left
            overflow-hidden
            shadow-xl
            transform
            transition-all
            sm:my-8 sm:align-middle sm:max-w-lg sm:w-full
          "
        >
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div
                class="
                  mx-auto
                  flex-shrink-0 flex
                  items-center
                  justify-center
                  h-12
                  w-12
                  rounded-full
                  bg-green-100
                  sm:mx-0 sm:h-10 sm:w-10
                "
              >
                <!-- Heroicon name: outline/exclamation -->
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
                    d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                  />
                </svg>
              </div>
              <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left inline">
                <h3
                  class="text-lg leading-6 font-medium text-gray-900"
                  id="modal-title"
                >
                <span v-if="editMode == false"> Adds</span> <span v-else> Edit</span> Hotel

                </h3>
              </div>
            </div>
            <div class="mt-2 flex flex-col justify-center">
              <jet-validation-errors class="mb-4" />
              <form
                class="
                  bg-white
                  inline-block
                  shadow-md
                  rounded
                  px-8
                  pt-6
                  pb-8
                  mb-4
                  w-full
                "
              >
                <div class="mb-4">
                  <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="hotel_name"
                  >
                    Hotel Name
                  </label>
                  <input
                    class="
                      shadow
                      appearance-none
                      border
                      rounded
                      w-full
                      py-2
                      px-3
                      text-gray-700
                      leading-tight
                      focus:outline-none focus:shadow-outline
                    "
                    type="text"
                    placeholder="Hotel Name"
                    autocomplete="off"
                    v-model="form.hotel_name"
                    id="hotel_name"
                  />
                </div>
                <div class="mb-4">
                  <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="hotel_name"
                  >
                    District
                  </label>

                  <Multiselect
                    class="
                      shadow
                      appearance-none
                      border
                      rounded
                      w-full
                      py-2
                      px-3
                      text-gray-700
                      leading-tight
                      focus:outline-none focus:shadow-outline
                    "
                    v-model="form.district_id"
                    valueProp="id"
                    trackBy="name"
                    label="name"
                    :options="districts"
                    searchable="true"
                  />
                </div>
                <div class="mb-4">
                  <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="name"
                  >
                    Hotel Admin's Name
                  </label>
                  <input
                    class="
                      shadow
                      appearance-none
                      border
                      rounded
                      w-full
                      py-2
                      px-3
                      text-gray-700
                      leading-tight
                      focus:outline-none focus:shadow-outline
                    "
                    id="name"
                    type="text"
                    placeholder="Name"
                    autocomplete="off"
                    v-model="form.hotel_admin_name"
                  />
                </div>
                <div class="mb-4">
                  <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="designation"
                  >
                    Designation
                  </label>
                  <input
                    autocomplete="off"
                    class="
                      shadow
                      appearance-none
                      border
                      rounded
                      w-full
                      py-2
                      px-3
                      text-gray-700
                      leading-tight
                      focus:outline-none focus:shadow-outline
                    "
                    id="designation"
                    type="text"
                    placeholder="Designation"
                    v-model="form.designation"
                  />
                </div>
                <div class="mb-4">
                  <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="designation"
                  >
                    Phone No
                  </label>
                  <input
                    autocomplete="off"
                    class="
                      shadow
                      appearance-none
                      border
                      rounded
                      w-full
                      py-2
                      px-3
                      text-gray-700
                      leading-tight
                      focus:outline-none focus:shadow-outline
                    "
                    id="phone"
                    type="text"
                    placeholder="Phone"
                    v-model="form.phone"
                  />
                </div>
                <div class="mb-4">
                  <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="email"
                  >
                    Email
                  </label>
                  <input
                    autocomplete="off"
                    class="
                      shadow
                      appearance-none
                      border
                      rounded
                      w-full
                      py-2
                      px-3
                      text-gray-700
                      leading-tight
                      focus:outline-none focus:shadow-outline
                    "
                    id="email"
                    type="email"
                    placeholder="Email"
                    v-model="form.email"
                  />
                </div>

                <div class="mb-4">
                  <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="nid"
                  >
                    NID
                  </label>
                  <input
                    autocomplete="off"
                    class="
                      shadow
                      appearance-none
                      border
                      rounded
                      w-full
                      py-2
                      px-3
                      text-gray-700
                      leading-tight
                      focus:outline-none focus:shadow-outline
                    "
                    id="nid"
                    type="text"
                    placeholder="NID"
                    v-model="form.nid"
                  />
                </div>

                <div class="mb-4">
                  <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="nid"
                  >
                    Date Of Birth
                  </label>
                  <input
                    v-model="form.dob"
                    autocomplete="off"
                    class="
                      shadow
                      appearance-none
                      border
                      rounded
                      w-full
                      py-2
                      px-3
                      text-gray-700
                      leading-tight
                      focus:outline-none focus:shadow-outline
                    "
                    type="date"
                    placeholder="Date Of Birth"
                  />
                </div>

                <div class="mb-4">
                  <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="license"
                  >
                    License / Registration
                  </label>
                  <input
                    autocomplete="off"
                    class="
                      shadow
                      appearance-none
                      border
                      rounded
                      w-full
                      py-2
                      px-3
                      text-gray-700
                      leading-tight
                      focus:outline-none focus:shadow-outline
                    "
                    type="text"
                    placeholder="Trade License"
                    v-model="form.license"
                  />
                </div>

                <div class="mb-4">
                  <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="password"
                  >
                    Status
                  </label>
                  <select
                    autocomplete="off"
                    class="
                      shadow
                      appearance-none
                      border
                      rounded
                      w-full
                      py-2
                      px-3
                      text-gray-700
                      leading-tight
                      focus:outline-none focus:shadow-outline
                    "
                    type="text"
                    v-model="form.status"
                  >
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>

                <div class="mb-6">
                  <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="password"
                  >
                    Password
                  </label>
                  <input
                    autocomplete="off"
                    class="
                      shadow
                      appearance-none
                      border border-red-500
                      rounded
                      w-full
                      py-2
                      px-3
                      text-gray-700
                      mb-3
                      leading-tight
                      focus:outline-none focus:shadow-outline
                    "
                    type="password"
                    placeholder="******************"
                    v-model="form.password"
                  />
                  <p class="text-red-500 text-xs italic">
                    Please choose a password.
                  </p>
                </div>

                <div class="mb-6">
                  <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="password-confirmation"
                  >
                    Confirm Password
                  </label>
                  <input
                    autocomplete="off"
                    class="
                      shadow
                      appearance-none
                      border border-red-500
                      rounded
                      w-full
                      py-2
                      px-3
                      text-gray-700
                      mb-3
                      leading-tight
                      focus:outline-none focus:shadow-outline
                    "
                    id="password-confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    placeholder="******************"
                  />
                  <p class="text-red-500 text-xs italic">
                    Please choose same password.
                  </p>
                </div>
              </form>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            
            <button v-if="editMode == false"
              @click="addHotel"
              type="button"
              class="
                w-full
                inline-flex
                justify-center
                rounded-md
                border border-transparent
                shadow-sm
                px-4
                py-2
                bg-green-600
                text-base
                font-medium
                text-white
                hover:bg-green-700
                focus:outline-none
                focus:ring-2
                focus:ring-offset-2
                focus:ring-green-500
                sm:ml-3 sm:w-auto sm:text-sm
              "
            >
              Add Hotel
            </button>
              <button v-else
              @click="updateHotel"
              type="button"
              class="
                w-full
                inline-flex
                justify-center
                rounded-md
                border border-transparent
                shadow-sm
                px-4
                py-2
                bg-green-600
                text-base
                font-medium
                text-white
                hover:bg-green-700
                focus:outline-none
                focus:ring-2
                focus:ring-offset-2
                focus:ring-green-500
                sm:ml-3 sm:w-auto sm:text-sm
              "
            >
              Update Hotel
            </button>
            <button
              type="button"
              class="
                mt-3
                w-full
                inline-flex
                justify-center
                rounded-md
                border border-gray-300
                shadow-sm
                px-4
                py-2
                bg-white
                text-base
                font-medium
                text-gray-700
                hover:bg-gray-50
                focus:outline-none
                focus:ring-2
                focus:ring-offset-2
                focus:ring-indigo-500
                sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm
              "
              @click="closeModal"
            >
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>

    <div
      class="
        w-full
        mx-auto
        px-4
        sm:px-6
        lg:px-8
        mx-5
        mt-10
        p-5
        bg-white
        rounded-lg
        overflow-scroll
      "
    >
      <div>
        <h3 class="p-3 text-center text-xl">Hotel List</h3>
        <table class="border-separate border w-full text-center" id="example">
          <thead>
            <tr>
              <th class="border">Hotel Name</th>
              <th class="border">District</th>
              <th class="border">Admin Name</th>
              <th class="border">Admin Phone</th>
              <th class="border">Admin Email</th>
              <th class="border">Admin Designation</th>
              <th class="border">Admin NID</th>
              <th class="border">Hotel License</th>
              <th class="border">Hotel Status</th>
              <th class="border">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="hotel in hotels">
              <td class="border">{{ hotel.hotel.name }}</td>
              <td class="border">{{ hotel.hotel.district.name }}</td>
              <td class="border">{{ hotel.name }}</td>
              <td class="border">{{ hotel.phone }}</td>
              <td class="border">{{ hotel.email }}</td>
              <td class="border">{{ hotel.designation }}</td>
              <td class="border">{{ hotel.nid }}</td>
              <td class="border">{{ hotel.hotel.license }}</td>
              <td class="border">
                <button
                  class="bg-green-500 px-5 text-white rounded-full"
                  v-if="hotel.hotel.status == 1"
                >
                  Active
                </button>
                <button
                  class="bg-red-500 px-5 text-white rounded-full"
                  v-if="hotel.hotel.status == 0"
                >
                  Inctive
                </button>
              </td>
              <td class="border">
                <div class="flex flex-row gap-2">
                  <button
                    @click="deleteHotel(hotel.id)"
                    title="View"
                    class="
                      bg-blue-500
                      hover:bg-blue-700
                      text-white
                      font-bold
                      py-2
                 
                      px-4
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
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                      />
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                      />
                    </svg>
                  </button>
                  <button

                    @click="editHotel(hotel)"
                    title="Edit"
                    class="
                      w-30
                      bg-white
                      hover:bg-gray-100
                      text-gray-800
                      font-semibold
                      py-2
                      px-4
                      border border-gray-400
                      rounded
                      shadow
                    "
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-6 w-6 inline"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                      />
                    </svg>
                  </button>
                  <button
                    @click="deleteHotel(hotel.id)"
                    title="Delete"
                    class="
                      bg-red-500
                      hover:bg-red-700
                      text-white
                      font-bold
                      py-2
                      px-4
                      rounded
                    "
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-6 w-6 inline"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                      />
                    </svg>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import Multiselect from "@vueform/multiselect";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import Swal from "sweetalert2";

import "jquery/dist/jquery.min.js";
//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";

import { Inertia } from "@inertiajs/inertia";

export default defineComponent({
  data() {
    return {
      modal: false,
      editMode: false,
      options: [],
      value: null,
      dtRef: null,
      form: this.$inertia.form({
        hotel_name: "",
        district_id: "",
        hotel_admin_name: "",
        designation: "",
        phone: "",
        nid: "",
        dob: "",
        license: "",
        status: "",
        password: "",
        password_confirmation: "",
        id: "",
        email: ""
      }),
    };
  },
  props: {
    districts: [],
    available: false,
    hotels: [],
  },
  components: {
    AppLayout,
    Welcome,
    Multiselect,
    JetValidationErrors,
  },
  methods: {
    openModal() {
      this.editMode = false;
      this.modal = true;
    },
    closeModal() {
      this.editMode = false;
      this.modal = false;
    },
    addHotel() {
      let $that = this;
      this.form.post(route("admin.hotel.store"), {
        preserveScroll: true,
        forceFormData: true,
        onSuccess() {
          $that.closeModal();
          Swal.fire({
            icon: "success",
            title: "Success",
            text: "Hotel added Successfully",
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
            footer: '<a href="">Scroll up on the modal to see the issue!</a>',
          });
        },
      });
    
    },
    updateHotel(id){
      let $that = this;
      this.form.post(route("admin.hotel.update"), {
        preserveScroll: true,
        forceFormData: true,
        onSuccess() {
          $that.closeModal();
          Swal.fire({
            icon: "success",
            title: "Success",
            text: "Hotel Updated Successfully",
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
            footer: '<a href="">Scroll up on the modal to see the issue!</a>',
          });
        },
      });
    
    },
    deleteHotel(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          Inertia.post(route("admin.hotel.delete", id));
          Swal.fire("Deleted!", "Your file has been deleted.", "success");
          $("#example").DataTable().reload();
        }
      });
    },
    editHotel(hotel){
      this.form.hotel_name = hotel.hotel.name;
      this.form.district_id = hotel.hotel.district_id;
      this.form.hotel_admin_name = hotel.name;
      this.form.designation = hotel.designation;
      this.form.phone = hotel.phone;
      this.form.email = hotel.email;
      this.form.nid = hotel.nid;
      this.form.dob =  hotel.dob;
      this.form.license = hotel.hotel.license;
      this.form.status =  hotel.hotel.status;
      this.form.id = hotel.id;
      this.modal = true;
      this.editMode = true;

    }

  },
  updated: function () {},
  mounted: function () {
    this.dtRef = $("#example").DataTable();
  },
});
</script>


<style src="@vueform/multiselect/themes/default.css"></style>


