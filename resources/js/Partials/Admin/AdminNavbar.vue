<template>
    <nav class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <Link :href="route('dashboard')">
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
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
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
                            :href="route('admin.hotel.index')"
                            :active="route().current('admin.hotel.index')"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Hotels

                        </jet-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <jet-nav-link
                            :href="route('admin.amenity.index')"
                            :active="route().current('admin.amenity.index')"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"
                                />
                            </svg>
                            Amenity
                        </jet-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <jet-nav-link
                            :href="route('admin.setting.index')"
                            :active="route().current('admin.setting.index')"
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
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                            </svg>
                            Settings
                        </jet-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <jet-nav-link
                            :href="route('admin.faq.index')"
                            :active="route().current('admin.faq.index')"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                            </svg>
                            FAQ
                        </jet-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <jet-nav-link
                            :href="route('admin.user.user_list')"
                            :active="route().current('admin.user.user_list')"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Users
                        </jet-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <jet-nav-link
                            :href="route('admin.blog.index')"
                            :active="route().current('admin.blog.index')"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Blog
                        </jet-nav-link>
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <div class="ml-3 relative">
                        <!-- Teams Dropdown -->
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="ml-3 relative">
                        <jet-dropdown align="right" width="48">
                            <template #trigger>
                                <button
                                    v-if="$page.props.jetstream.managesProfilePhotos"
                                    class="
                    flex
                    text-sm
                    border-2 border-transparent
                    rounded-full
                    focus:outline-none focus:border-gray-300
                    transition
                  "
                                >
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

                                <!--                                <jet-dropdown-link-->
                                <!--                                    :href="route('api-tokens.index')"-->
                                <!--                                    v-if="$page.props.jetstream.hasApiFeatures"-->
                                <!--                                >-->
                                <!--                                    API Tokens-->
                                <!--                                </jet-dropdown-link>-->

                                <div class="border-t border-gray-100"></div>

                                <!-- Authentication -->
                                <form @submit.prevent="logout">
                                    <jet-dropdown-link as="button"> Log Out </jet-dropdown-link>
                                </form>
                            </template>
                        </jet-dropdown>
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
        </div>

        <!-- Responsive Navigation Menu -->
        <div
            :class="{
                block: showingNavigationDropdown,
                hidden: !showingNavigationDropdown,
            }"
            class="sm:hidden"
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

                    <jet-responsive-nav-link
                        :href="route('api-tokens.index')"
                        :active="route().current('api-tokens.index')"
                        v-if="$page.props.jetstream.hasApiFeatures"
                    >
                        API Tokens
                    </jet-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" @submit.prevent="logout">
                        <jet-responsive-nav-link as="button">
                            Log Out
                        </jet-responsive-nav-link>
                    </form>

                    <!-- Team Management -->
                    <template v-if="$page.props.jetstream.hasTeamFeatures">
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">Manage Team</div>

                        <!-- Team Settings -->
                        <jet-responsive-nav-link
                            :href="route('teams.show', $page.props.user.current_team)"
                            :active="route().current('teams.show')"
                        >
                            Team Settings
                        </jet-responsive-nav-link>

                        <jet-responsive-nav-link
                            :href="route('teams.create')"
                            :active="route().current('teams.create')"
                            v-if="$page.props.jetstream.canCreateTeams"
                        >
                            Create New Team
                        </jet-responsive-nav-link>

                        <div class="border-t border-gray-200"></div>

                        <!-- Team Switcher -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Switch Teams
                        </div>

                        <template v-for="team in $page.props.user.all_teams" :key="team.id">
                            <form @submit.prevent="switchToTeam(team)">
                                <jet-responsive-nav-link as="button">
                                    <div class="flex items-center">
                                        <svg
                                            v-if="team.id == $page.props.user.current_team_id"
                                            class="mr-2 h-5 w-5 text-green-400"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                            ></path>
                                        </svg>
                                        <div>{{ team.name }}</div>
                                    </div>
                                </jet-responsive-nav-link>
                            </form>
                        </template>
                    </template>
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
  name: "AdminNavbar",
  components: {
    Head,
    JetDropdown,
    JetDropdownLink,
    JetNavLink,
    JetResponsiveNavLink,
    Link,
  },
  methods: {
    logout() {
      this.$inertia.post(route("logout"));
    },
  },
};
</script>

<style scoped>
</style>
