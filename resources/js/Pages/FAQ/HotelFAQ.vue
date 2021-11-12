<template>
    <hotel-layout title="Dashboard">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Hotel FAQ List
                </h2>
                <button
                    @click="openModal()"
                    class=" bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded ">
                        Add FAQ
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
        <div v-if="modal" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" >
            <div  class=" flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0 " >
                <div
                    class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                    aria-hidden="true"
                ></div>
                <span
                    class="hidden sm:inline-block sm:align-middle sm:h-screen"
                    aria-hidden="true"
                >&#8203;</span
                >
                <div class=" inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full ">
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
                                    Add FAQ
                                </h3>
                            </div>
                        </div>
                        <div class="mt-2 flex flex-col justify-center">
                            <jet-validation-errors class="mb-4" />
                            <form class="bg-white inline-block shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full">
                                <div class="mb-2"> <span class="text-sm">Question</span>
                                    <textarea class="w-full border-gray-200 border rounded focus:outline-none focus:border-gray-300" rows="3" v-model="form.question"></textarea>
                                </div>
                                <div class="mb-2"> <span class="text-sm">Answer</span>
                                    <textarea  class="w-full border-gray-200 border rounded focus:outline-none focus:border-gray-300" rows="8" v-model="form.answer"></textarea>
                                </div>
                                <div class="mb-2"> <span class="text-sm">Status</span>
                                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" v-model="form.status">
                                        <option selected value="">-Select Status-</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button
                            v-show="!editMode"
                            @click="addFaq"
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
                            Add FAQ
                        </button>
                        <button
                            v-show="editMode"
                            @click="updateFaq"
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
                            Update FAQ
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
            <div class=" container mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <h3 class="p-3 text-center">FAQ List</h3>
                    <div class="p-3">
                        <table
                            class="py-2 w-full text-center "
                            id="amenity"
                        >
                            <thead>
                            <tr>
                                <th class="border">Question</th>
                                <th class="border">Answer</th>
                                <th class="border">Status</th>
                                <th class="border">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="faq in faqs" :key="faq.id">
                                <td class="border">{{ faq.question }}</td>
                                <td class="border">{{ faq.answer }}
                                </td>
                                <td class="border">
                                    {{ faq.status == "1" ? "Active" : "Inactive" }}
                                </td>
                                <td class="border">
                                    <button
                                        @click="editFaq(faq)"
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
                                        @click="deleteFaq(faq.id)"
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
    </hotel-layout>
</template>

<script>
    import { defineComponent } from "vue";
    import HotelLayout from '@/Layouts/HotelLayout.vue';
    import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
    import {Link} from "@inertiajs/inertia-vue3";
    import Swal from "sweetalert2";
    import "jquery/dist/jquery.min.js";
    //Datatable Modules
    import "datatables.net-dt/js/dataTables.dataTables";
    import "datatables.net-dt/css/jquery.dataTables.min.css";
    import $ from "jquery";
    export default defineComponent({
        props: {
            faqs: [],

        },
        components: {
            HotelLayout,
            JetValidationErrors,
            Link
        },
        data() {
            return {
                modal: false,
                editMode: false,
                faq_id: "",
                dtRef: null,
                images: [],
                form: this.$inertia.form({
                    question: "",
                    answer: '',
                    status:""
                }),
            };
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
            addFaq() {
                this.form.post(route("hotel.faq.store"), {
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess() {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "FAQ added Successfully",
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
                            position: "top-end"
                        });
                    },
                });
                this.form.question = "";
                (this.form.answer = ""), (this.form.status = "");
                this.closeModal();
            },
            editFaq(data) {
                this.faq_id = data.id;
                this.form.question = data.question;
                this.form.answer = data.answer;
                this.form.status = data.status;
                this.editMode = true;
                this.openModal();
            },
            updateFaq() {
                this.form.post(route("hotel.faq.update", this.faq_id), {
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess() {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "FAQ updated Successfully",
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
                            position: "top-end"
                        });
                    },
                });
                this.closeModal();
            },
            deleteFaq(id) {
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
                        this.form.delete(route("hotel.faq.destroy", id), {
                            preserveScroll: true,
                            forceFormData: true,
                            onSuccess() {
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: "FAQ deleted Successfully",
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
                                    position: "top-end"
                                });
                            },
                        });
                    }
                });
                this.closeModal();
            },
        },
    });
</script>


