<template>
    <hotel-layout title="Hotel Image">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Choose rooms and upload specific photos</h2>
                <Link
                    :href="route('hotel.rooms.index')"
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
                </Link>
            </div>
        </template>
        <div  v-if="hotel && hotel.rooms" class="max-w-7xl mx-auto pt-7 pb-3 sm:px-6 lg:px-8">
            <div class="bg-white p-4  rounded-md flex-col lg:flex-row">
                <jet-nav-link class="py-2 mb-2 px-3 mx-1 text-sm rounded-lg border hover:border-transparent focus:border-4 hover:bg-blue-800 hover:text-white"
                    v-for="(room, index) of hotel.rooms" :key="index"
                       :href="route('hotel.get_room_photos',[this.hotel.id, room.id])"
                       :active="route().current('hotel.get_room_photos',[this.hotel.id, room.id])"
                >
            {{room.room_name}}
                </jet-nav-link>
            </div>
        </div>
        <form action="" @submit.prevent="submit()">
            <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
                <div class="bg-white p-4  rounded-md flex-col lg:flex-row">
                    <div class="grid lg:grid-cols-6">
                        <div v-if="rooms && rooms.attachments" class="mx-1 mb-2 rounded-lg shadow-lg relative"
                             v-for="(attachment, index) of rooms.attachments"
                             :key="index"
                        >
                            <img class="w-full h-48 rounded-lg"
                                 :src="attachment.file_path"
                                 alt="product" />

                            <svg @click.prevent="delete_image(attachment.id, index)" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-500 absolute right-0 top-0 pr-1 " viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>

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
                        <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg w-full">
                            <label for="file" class="w-full h-48 block flex items-center justify-center" >
                                <input type="file" id="file" ref="photo" class="hidden" @change="updatePhotoPreview($event)" >
                                <button
                                    type="button"
                                    class="
                                        py-1
                                        px-2
                                        bg-blue-800
                                        text-gray-100
                                         text-md
                                        rounded-lg
                                        focus:border-4
                                        border-blue-300
                                        hover:bg-blue-500
                                      "
                                    @click="selectNewPhoto"
                                >
                                    + Select Image
                                </button>
                            </label>
                        </div>

                    </div>
                </div>
                <div class="flex items-center justify-between px-4 py-3 bg-gray-200 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    <jet-validation-errors class="mb-4" />
                    <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                        Saved.
                    </jet-action-message>

                    <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="bg-green-700">
                        Update Photo
                    </jet-button>
                </div>
            </div>
        </form>
    </hotel-layout>
</template>

<script>
    import HotelLayout from "@/Layouts/HotelLayout";
    import {Link} from "@inertiajs/inertia-vue3";
    import JetButton from '@/Jetstream/Button.vue';
    import JetActionMessage from '@/Jetstream/ActionMessage.vue';
    import Swal from "sweetalert2";
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
    import $ from "jquery";
    import JetNavLink from "@/Jetstream/NavLink.vue";
    export default{
        name: "UploadImage",
        props: ['hotel', 'rooms'],
        components: {
            HotelLayout,
            Link,
            JetActionMessage,
            JetButton,
            JetValidationErrors,
            JetNavLink
        },
        data() {
            return {
                form: this.$inertia.form({
                    images: [],
                    room_id: '',
                    hotel_id: this.hotel?this.hotel.id:'',
                }),
                room_id: '',
                images: [],
                activeButton: false
            };
        },
        mounted: function () {
            this.form.room_id = window.location.href.split('/').pop();
            //this.getRoomPhotos (this.hotel.id);
        },
        methods: {
            submit() {
                this.form.post(route("hotel.upload_room_photos"), {
                    forceFormData: true,
                    preserveScroll: true,
                    onSuccess: () => {
                        this.clearPhotoFileInput();
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Images uploaded successfully",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    },
                });
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
            // delete_image(id, index) {
            //     this.attachments.splice(index, 1);
            //     // this.$inertia.delete(route("current-user-photo.destroy"), {
            //     //     preserveScroll: true,
            //     //     onSuccess: () => {
            //     //         this.photoPreview = null;
            //     //         this.clearPhotoFileInput();
            //     //     },
            //     // });
            // },

            clearPhotoFileInput() {
                if (this.$refs.photo?.value) {
                    this.$refs.photo.value = null;
                }
                this.form.reset();
                this.images.length = 0;
                this.images = [];
            },
            getRoomPhotos(roomId) {
                this.activeButton = true;
                this.form.room_id= roomId;
                this.$inertia.get(route("hotel.get_room_photos",[this.hotel.id,roomId]), {
                        // preserveScroll: true,
                        onSuccess: () => {

                        },
                    });
            },
            delete_image(id) {
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
                        this.form.post(route("hotel.photos.destroy", id), {
                            preserveScroll: true,
                            forceFormData: true,
                            onSuccess() {
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: "Image deleted Successfully",
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
                    }
                });
            },
        },
    };
</script>



