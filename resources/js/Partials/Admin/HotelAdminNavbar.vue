import Swal from "sweetalert2";
<template>
    <nav class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <Link :href="route('hotel.dashboard')">
                            <img
                                :src="route('index') + '/template/assets/logo-text.png'"
                                class="w-60 inline-block"
                                alt=""
                            />
                        </Link>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <jet-nav-link
                            :href="route('hotel.dashboard')"
                            :active="route().current('hotel.dashboard')"
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
                                    d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"
                                />
                            </svg>
                            Dashboard
                        </jet-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <jet-nav-link
                            :href="route('hotel.reservation.index')"
                            :active="route().current('hotel.reservation.index')"
                        >
                            <i class="fad fa-tasks text-xl mr-1"></i>
                            Reservation
                        </jet-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <jet-nav-link
                            :href="route('hotel.schedules.index')"
                            :active="route().current('hotel.schedules.index')"
                        >

                            <i class="fad fa-calendar-alt text-xl mr-1"></i>
                            Calender & Rates
                        </jet-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex items-center">
                        <jet-dropdown align="right" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button
                                        type="button"
                                        class=" inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition"
                                    >
                                          <i class="fad fa-hotel text-xl mr-1"></i>
                                          My Hotel
                                        <svg
                                            class="ml-2 -mr-0.5 h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                          <path
                                              fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"
                                          />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>

                                <jet-dropdown-link :href="route('hotel.my_hotel')">
                                    Basic Info
                                </jet-dropdown-link>

                                <jet-dropdown-link :href="route('hotel.amenity.create')">
                                    Amenity
                                </jet-dropdown-link>
                                <div class="border-t border-gray-100"></div>

                                <jet-dropdown-link :href="route('hotel.photos.create', 'hotel')">
                                    Hotel Images
                                </jet-dropdown-link>

                                <div class="border-t border-gray-100"></div>
                                <jet-dropdown-link :href="route('hotel.policy.index')">
                                    Policy
                                </jet-dropdown-link>

                                <div class="border-t border-gray-100"></div>
                                <jet-dropdown-link :href="route('hotel.faq.index')">
                                    FAQ
                                </jet-dropdown-link>

                            </template>
                        </jet-dropdown>
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex items-center">
                        <jet-dropdown align="right" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button @click="get_hotel_room_id"
                                        type="button"
                                        class=" inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition"
                                    >
                                       <svg
                                           xmlns="http://www.w3.org/2000/svg"
                                           class="h-6 w-6 mr-1"
                                           fill="none"
                                           viewBox="0 0 24 24"
                                           stroke="currentColor"
                                       >
                                           <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                           />
                                       </svg>
                                          Room
                                        <svg
                                            class="ml-2 -mr-0.5 h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor">
                                          <path
                                              fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"
                                          />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>

                                <jet-dropdown-link :href="route('hotel.rooms.index')">
                                    My Rooms
                                </jet-dropdown-link>
                                <div class="border-t border-gray-100"></div>

                                <jet-dropdown-link @click="get_room_images">
                                    Room Images
                                </jet-dropdown-link>

                            </template>
                        </jet-dropdown>
                    </div>
                </div>
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <div class="ml-3 relative">
                        <button
                            v-if="$page.props.user.user_type == $page.props.roles.admin"
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
                                bg-red-600
                                text-base
                                font-medium
                                text-white
                                hover:bg-red-700
                                focus:outline-none
                                focus:ring-2
                                focus:ring-offset-2
                                focus:ring-red-500
                                sm:ml-3 sm:w-auto sm:text-sm
                              "
                        >
                            Back to admin
                        </button>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="ml-3 relative">
                        <jet-dropdown align="right" width="48">
                            <template #trigger>
                                <button
                                    v-if="$page.props.jetstream.managesProfilePhotos"
                                    class=" flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition" >
                                    <img
                                        class="h-8 w-8 rounded-full object-cover"
                                        :src="$page.props.user.profile_photo_url"
                                        :alt="$page.props.user.name"
                                    />
                                </button>

                                <span v-else class="inline-flex rounded-md">
                                <button
                                    type="button"
                                    class="
                                      inline-flex
                                      items-center
                                      px-3
                                      py-2
                                      border border-transparent
                                      text-sm
                                      leading-4
                                      font-medium
                                      rounded-md
                                      text-gray-500
                                      bg-white
                                      hover:text-gray-700
                                      focus:outline-none
                                      transition
                                    "
                                >
                                    {{ $page.props.user.name }}

                                    <svg
                                        class="ml-2 -mr-0.5 h-4 w-4"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                      <path
                                          fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"
                                      />
                                    </svg>
                                </button>
                            </span>
                            </template>

                            <template #content>
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Account
                                </div>

                                <jet-dropdown-link :href="route('profile.show')">
                                    Profile
                                </jet-dropdown-link>
                                <div class="border-t border-gray-100"></div>

                                <!-- Authentication -->
                                <form @submit.prevent="logout">
                                    <jet-dropdown-link as="button"> Log Out </jet-dropdown-link>
                                </form>
                            </template>
                        </jet-dropdown>
                    </div>
                </div>
            </div>


            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button
                    @click="showingNavigationDropdown = !showingNavigationDropdown"
                    class="
                          inline-flex
                          items-center
                          justify-center
                          p-2
                          rounded-md
                          text-gray-400
                          hover:text-gray-500 hover:bg-gray-100
                          focus:outline-none focus:bg-gray-100 focus:text-gray-500
                          transition
                        "
                    >
                    <svg
                        class="h-6 w-6"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            :class="{
                              hidden: showingNavigationDropdown,
                              'inline-flex': !showingNavigationDropdown,
                            }"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                        <path
                            :class="{
                              hidden: !showingNavigationDropdown,
                              'inline-flex': showingNavigationDropdown,
                            }"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div
            class="sm:hidden"
            :class="{
                block: showingNavigationDropdown,
                hidden: !showingNavigationDropdown,
              }"
        >
            <div class="pt-2 pb-3 space-y-1">
                <jet-responsive-nav-link
                    :href="route('dashboard')"
                    :active="route().current('dashboard')"
                >
                    Dashboard
                </jet-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div
                        v-if="$page.props.jetstream.managesProfilePhotos"
                        class="flex-shrink-0 mr-3"
                    >
                        <img
                            class="h-10 w-10 rounded-full object-cover"
                            :src="$page.props.user.profile_photo_url"
                            :alt="$page.props.user.name"
                        />
                    </div>

                    <div>
                        <div class="font-medium text-base text-gray-800">
                            {{ $page.props.user.name }}
                        </div>
                        <div class="font-medium text-sm text-gray-500">
                            {{ $page.props.user.email }}
                        </div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <jet-responsive-nav-link
                        :href="route('profile.show')"
                        :active="route().current('profile.show')"
                    >
                        Profile
                    </jet-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" @submit.prevent="logout">
                        <jet-responsive-nav-link as="button">
                            Log Out
                        </jet-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink.vue";

export default {
    name: "HotelAdminNavbar",
    components: {
        Head,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
        Link,
    },
    data(){
        return{
            hotelId: '',
            roomId: '',
            showingNavigationDropdown: false,
        }
    },
    methods: {
        logout() {
            this.$inertia.post(route("logout"));
        },
        get_hotel_room_id() {
            axios.get(route('hotel.get_hotel_room_id',this.$page.props.user.id)).then(
                result => {
                    this.roomId = result.data.room_id;
                    this.hotelId = result.data.result.id;
                },
                error => {
                    console.error(error);
                }
            );

        },
        get_room_images(){
            if(this.hotelId && this.roomId){
                this.$inertia.get(route('hotel.get_room_photos',[this.hotelId,this.roomId]));
            }else{
                this.$inertia.get(route('hotel.get_room_photos',[this.hotelId,0]), {
                    preserveScroll: true,
                    forceFormData: true,
                    onError() {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Please create hotel room first.",
                            position: "top-end",
                        });
                    },
                });
            }
        }
    },
};
</script>

<style scoped>
</style>
