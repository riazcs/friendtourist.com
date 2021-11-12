<template>
    <frontend-layout title="Login">
        <jet-authentication-card>
            <!-- <template #logo>
                    <jet-authentication-card-logo />
                </template> -->
            <Link :href="route('index')" class="text-center block">
                <img
                    :src="route('index')+'/template/assets/logo-text.png'"
                    class="w-80 inline-block"
                    alt=""
                />
            </Link>
            <jet-validation-errors class="mb-4" />

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <jet-label for="email" value="Email" />
                    <jet-input
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autofocus
                    />
                </div>

                <div class="mt-4">
                    <jet-label for="password" value="Password" />
                    <jet-input
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                    />
                </div>

                <div class="block mt-4 flex justify-between">
                    <label class="flex items-center">
                        <jet-checkbox name="remember" v-model:checked="form.remember" />
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="underline text-sm text-gray-600 hover:text-gray-900"
                    >
                        Forgot your password?
                    </Link>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <Link :href="route('register')"
                          class="
              inline-flex
              items-center
              px-4
              py-2
              bg-gray-800
              border border-transparent
              rounded-md
              font-semibold
              text-xs text-white
              uppercase
              tracking-widest
              hover:bg-gray-700
              active:bg-gray-900
              focus:outline-none
              focus:border-gray-900
              focus:ring
              focus:ring-gray-300
              disabled:opacity-25
              transition
              ml-4
            "
                    >
                        Register
                    </Link>
                    <jet-button
                        class="ml-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Log in
                    </jet-button>
                </div>

                <div class="text-center">
                    <p>Or,</p>
                    <a href="/auth/google">
                        <div class="google-btn inline-block">
                            <div class="google-icon-wrapper">
                                <img
                                    class="google-icon"
                                    src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg"
                                />
                            </div>
                            <p class="btn-text"><b>Sign in with google</b></p>
                        </div>
                    </a>
                </div>
            </form>
        </jet-authentication-card>
    </frontend-layout>
</template>

<script>
import { defineComponent } from "vue";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import FrontendLayout from "../../Layouts/FrontendLayout";

export default defineComponent({
  components: {
      FrontendLayout,
    Head,
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
    Link,
  },

  props: {
    canResetPassword: Boolean,
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        email: "",
        password: "",
        remember: false,
      }),
    };
  },

  methods: {
    submit() {
      this.form
        .transform((data) => ({
          ...data,
          remember: this.form.remember ? "on" : "",
        }))
        .post(this.route("login"), {
          onFinish: () => this.form.reset("password"),
        });
    },
  },
});
</script>

<style lang="scss">
$white: #fff;
$google-blue: #4285f4;
$button-active-blue: #1669f2;

.google-btn {
  width: 200px;
  height: 42px;
  background-color: $google-blue;
  border-radius: 2px;
  box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.25);
  .google-icon-wrapper {
    position: absolute;
    margin-top: 1px;
    margin-left: 1px;
    width: 40px;
    height: 40px;
    border-radius: 2px;
    background-color: $white;
  }
  .google-icon {
    position: absolute;
    margin-top: 11px;
    margin-left: 11px;
    width: 18px;
    height: 18px;
  }
  .btn-text {
    float: right;
    margin: 11px 11px 0 0;
    color: $white;
    font-size: 14px;
    letter-spacing: 0.2px;
  }
  &:hover {
    box-shadow: 0 0 6px $google-blue;
  }
  &:active {
    background: $button-active-blue;
  }

}
</style>
