<template>
    <app-layout title="Dashboard">
        <template #header>
            <div class="flex justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Amenities
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
                    Add Amenity
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
                <div
                    class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                    aria-hidden="true"
                ></div>
                <span
                    class="hidden sm:inline-block sm:align-middle sm:h-screen"
                    aria-hidden="true"
                >&#8203;</span
                >
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
                                    Add Amenity
                                </h3>
                            </div>
                        </div>
                        <div class="mt-2 flex flex-col justify-center">
                            <jet-validation-errors class="mb-4"/>
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
                                    >
                                        Type
                                    </label>
                                    <select autocomplete="off" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        type="text"
                                        v-model="form.type" @change="getPropertyRelatedAmenity"
                                    >
                                        <option selected value="">-Select Type-</option>
                                        <option value="1">Hotel</option>
                                        <option value="2">Room</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label
                                        class="block text-gray-700 text-sm font-bold mb-2"
                                    >
                                        Parent
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
                                        v-model="form.parent_id"
                                    >
                                        <option selected value="">-Select Parent Category-</option>
                                        <option
                                            v-for="(amemity, index) in parent_amemites"
                                            :key="index"
                                            :value="amemity.id"
                                        >
                                            {{ amemity.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label
                                        class="block text-gray-700 text-sm font-bold mb-2"
                                        for="name"
                                    >
                                        Amenity Name
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
                                        v-model="form.amenity_name"
                                    />
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button
                            v-show="!editMode"
                            @click="addAmenity"
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
                            Add Amenity
                        </button>
                        <button
                            v-show="editMode"
                            @click="updateAmenity"
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
                            Update Amenity
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

        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div>
                        <h3 class="p-3 text-center">Amenity List</h3>
                        <table
                            class="border-separate border w-full text-center"
                            id="amenity"
                        >
                            <thead>
                            <tr>
                                <th class="border">Name</th>
                                <th class="border">Parent Name</th>
                                <th class="border">Type</th>
                                <th class="border">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="amemity in amemites" :key="amemity.id">
                                <td class="border">{{ amemity.name }}</td>
                                <td class="border">
                                    <span v-if="amemity.parent">{{ amemity.parent.name }}</span>
                                </td>
                                <td class="border">
                                    {{ amemity.type == "2" ? "Room" : "Hotel" }}
                                </td>
                                <td class="border">
                                    <button
                                        @click="editAmenity(amemity)"
                                        class="
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

                                        Edit
                                    </button>
                                    <button
                                        @click="deleteAmenity(amemity.id)"
                                        class="
                        bg-blue-500
                        hover:bg-blue-700
                        text-white
                        font-bold
                        py-2
                        ml-2
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
                                        Delete
                                    </button>
                                </td>
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
    import {defineComponent} from "vue";
    import AppLayout from "@/Layouts/AppLayout.vue";
    import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
    import Swal from "sweetalert2";
    import "jquery/dist/jquery.min.js";
    //Datatable Modules
    import "datatables.net-dt/js/dataTables.dataTables";
    import "datatables.net-dt/css/jquery.dataTables.min.css";
    import $ from "jquery";

    export default defineComponent({
        data() {
            return {
                modal: false,
                editMode: false,
                options: [],
                value: null,
                amenity_id: "",
                dtRef: null,
                parent_amemites: [],
                form: this.$inertia.form({
                    amenity_name: "",
                    parent_id: "",
                    type: "",
                }),
            };
        },
        props: {
            amemites: [],

        },
        components: {
            AppLayout,
            JetValidationErrors,
        },
        mounted: function () {
            this.dtRef = $("#amenity").DataTable();
        },
        methods: {
            openModal() {
                this.modal = true;
            },
            closeModal() {
                this.modal = false;
                this.editMode = false;
            },
            addAmenity() {
                this.form.post(route("admin.amenity.store"), {
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess() {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Amenity added Successfully",
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
                this.form.amenity_name = "";
                (this.form.parent_id = ""), (this.form.type = "");
                this.closeModal();
            },
            editAmenity(data) {
                this.amenity_id = data.id;
                this.form.amenity_name = data.name;
                this.form.parent_id = data.parent_id;
                this.form.type = data.type;
                this.editMode = true;
                this.openModal();
            },
            updateAmenity() {
                this.form.post(route("admin.amenity.update", this.amenity_id), {
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess() {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Amenity updated Successfully",
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
                this.form.amenity_name = "";
                (this.form.parent_id = ""), (this.form.type = "");
                this.closeModal();
            },
            deleteAmenity(amenity_id) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to delete this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.post(route("admin.amenity.destroy", amenity_id), {
                            preserveScroll: true,
                            forceFormData: true,
                            onSuccess() {
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: "Amenity deleted Successfully",
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                                $("#amenity").DataTable().reload();
                            },
                            onError() {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                    position: "top-end",
                                    footer:
                                        '<a href="">Scroll up on the modal to see the issue!</a>',
                                });
                            },
                        });
                    }
                });
                this.closeModal();
            },
            getPropertyRelatedAmenity() {
                axios.get(route("admin.amenity.get_property_related_amenity", this.form.type)).then(
                    result => {
                        this.parent_amemites = result.data.parent_amemites;
                    },
                    error => {
                        console.error(error);
                    }
                );

            }
        },
    });
</script>


