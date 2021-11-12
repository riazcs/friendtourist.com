<template>
    <app-layout title="Dashboard">
        <template #header>
            <div class="flex justify-between">
                <div>
                    <Link
                        :href="route('admin.setting.index')"
                        class="
                        bg-transparent
                        hover:bg-blue-500
                        text-blue-700
                        font-semibold
                        hover:text-white
                        py-1
                        px-3
                        border border-blue-500
                        hover:border-transparent
                        rounded float-right
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
                    </Link>
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
                    Add Favourite Area<svg
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
                                    Add Area
                                </h3>
                            </div>
                        </div>
                        <div class="mt-2 flex flex-col justify-center">
                            <jet-validation-errors class="mb-4" />
                            <form class="bg-white inline-block shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full">
                                <div class="mb-2"> <span class="text-sm">Area Name</span> <input type="text" class="h-12 px-3 w-full border-gray-200 border rounded focus:outline-none focus:border-gray-300"  v-model="form.area_name"> </div>
                                <div class="mx-1 mb-2 rounded-lg shadow-lg relative"
                                     v-for="(image, index) of images"
                                     :key="index"
                                >
                                    <img class="w-full h-48 rounded-lg"
                                         :src="image"
                                         alt="product" />

                                    <svg @click.prevent="remove_image(index)" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-500 absolute right-0 top-0 pr-1 " viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="mb-2"> <span>Upload Photo</span>
                                    <div class="relative h-40 rounded-lg border-dashed border-2 border-gray-200 bg-white flex justify-center items-center hover:cursor-pointer">
                                        <div class="absolute">
                                            <div class="flex flex-col items-center "> <i class="fa fa-cloud-upload fa-3x text-gray-200"></i> <span class="block text-gray-400 font-normal">Attach you files here</span> <span class="block text-gray-400 font-normal">or</span> <span class="block text-blue-400 font-normal">Browse files</span> </div>
                                        </div> <input type="file" class="h-full w-full opacity-0" id="file" ref="photo" @change="updatePhotoPreview($event)">
                                    </div>
                                    <div class="flex justify-between items-center text-gray-400"> <span>Accepted file type:.jpg .png .jpeg only</span> <span class="flex items-center "><i class="fa fa-lock mr-1"></i> secure</span> </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button
                            v-show="!editMode"
                            @click="addArea"
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
                            Add Area
                        </button>
                        <button
                            v-show="editMode"
                            @click="updateArea"
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
                            Update Area
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
                        <h3 class="p-3 text-center">Favourite Area List</h3>
                        <table
                            class="border-separate border w-full text-center"
                            id="amenity"
                        >
                            <thead>
                            <tr>
                                <th class="border">Area Name</th>
                                <th class="border">Photo</th>
                                <th class="border">Status</th>
                                <th class="border">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="area in favourite_areas" :key="area.id">
                                <td class="border">{{ area.area_name }}</td>
                                <td class="border"  >
                                    <div
                                         v-for="(attachment, index) of area.attachments"
                                         :key="index" class="mx-1 mb-2 rounded-lg relative">
                                        <img class="w-20 h-20 rounded-lg"
                                             :src="attachment.file_path"
                                             alt="product" />
                                    </div>
                                </td>
                                <td class="border">
                                    {{ area.status == "1" ? "Active" : "Inactive" }}
                                </td>
                                <td class="border">
<!--                                    <button-->
<!--                                        @click="editArea(area)"-->
<!--                                        class="-->
<!--                        bg-white-->
<!--                        hover:bg-gray-100-->
<!--                        text-gray-800-->
<!--                        font-semibold-->
<!--                        py-2-->
<!--                        px-4-->
<!--                        border border-gray-400-->
<!--                        rounded-->
<!--                        shadow-->
<!--                      "-->
<!--                                    >-->
<!--                                        <svg-->
<!--                                            xmlns="http://www.w3.org/2000/svg"-->
<!--                                            class="h-6 w-6 inline"-->
<!--                                            fill="none"-->
<!--                                            viewBox="0 0 24 24"-->
<!--                                            stroke="currentColor"-->
<!--                                        >-->
<!--                                            <path-->
<!--                                                stroke-linecap="round"-->
<!--                                                stroke-linejoin="round"-->
<!--                                                stroke-width="2"-->
<!--                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"-->
<!--                                            />-->
<!--                                        </svg>-->

<!--                                        Edit-->
<!--                                    </button>-->
                                    <button
                                        @click="deleteAmenity(area.id)"
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
    import { defineComponent } from "vue";
    import AppLayout from "@/Layouts/AppLayout.vue";
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
            favourite_areas: [],

        },
        components: {
            AppLayout,
            JetValidationErrors,
            Link
        },
        data() {
            return {
                modal: false,
                editMode: false,
                options: [],
                value: null,
                area_id: "",
                dtRef: null,
                images: [],
                form: this.$inertia.form({
                    area_name: "",
                    images: []
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
            addArea() {
                this.form.post(route("admin.setting.add_favourite_area"), {
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess() {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Area added Successfully",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        this.form.area_name= '';
                        this.form.images= '';
                    },
                    onError() {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                            position: "top-end",
                        });
                    },
                });
                this.form.area_name = "";
                this.form.images = null;
                this.images = null;
                this.closeModal();
            },
            editArea(data) {
                this.area_id = data.id;
                this.form.area_name = data.area_name;
                // this.form.images = data.area.attachments;
                this.editMode = true;
                this.openModal();
            },
            updateArea() {
                this.form.post(route("admin.setting.update_area", this.area_id), {
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess() {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Area updated Successfully",
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
                        });
                    },
                });
                this.closeModal();
            },
            deleteAmenity(area_id) {
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
                        this.form.post(route("admin.setting.delete_area", area_id), {
                            preserveScroll: true,
                            forceFormData: true,
                            onSuccess() {
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: "Area deleted Successfully",
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
                                });
                            },
                        });
                    }
                });
                this.closeModal();
            },
            selectNewPhoto() {
                this.$refs.photo.click();
            },
            remove_image(index) {
                this.images.splice(index, 1);
                this.form.images.splice(index, 1);
            },

            updatePhotoPreview(event) {
                let $that = this;
                for (let i = 0; i < event.target.files.length; i++) {
                    $that.form.images.push(event.target.files[i]);
                    let reader = new FileReader();
                    reader.onload = (image) => {
                        this.images.push(image.target.result);
                    };
                    reader.readAsDataURL(event.target.files[i]);
                }
            },
        },
    });
</script>


