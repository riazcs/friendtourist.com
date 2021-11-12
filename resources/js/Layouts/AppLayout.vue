<template>
  <div>
      <Head :title="title" >
          <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
          <link rel="stylesheet" href="/css/app.css">
      </Head>

    <jet-banner />

    <div class="min-h-screen bg-gray-100">
        <admin-navbar></admin-navbar>

      <!-- Page Heading -->
      <header class="bg-white shadow" v-if="$slots.header">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <slot name="header"></slot>
        </div>
      </header>

      <!-- Page Content -->
      <main>
          <alert-message></alert-message>
        <slot></slot>
      </main>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
import JetBanner from "@/Jetstream/Banner.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import AdminNavbar from "../Partials/Admin/AdminNavbar";
import AlertMessage from "../Helpers/AlertMessage";

export default defineComponent({
  props: {
    title: String,
  },

  components: {
      AlertMessage,
    AdminNavbar,
    Head,
    JetApplicationMark,
    JetBanner,
    JetDropdown,
    JetDropdownLink,
    JetNavLink,
    JetResponsiveNavLink,
    Link,
  },

  data() {
    return {
      showingNavigationDropdown: false,
    };
  },

  methods: {
    switchToTeam(team) {
      this.$inertia.put(
        route("current-team.update"),
        {
          team_id: team.id,
        },
        {
          preserveState: false,
        }
      );
    },
  },
});
</script>
