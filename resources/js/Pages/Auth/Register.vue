<template>
    <frontend-layout title="Register" >
        <jet-authentication-card class="py-5">
            <a href="/" class="text-center block">
                <img src="/template/assets/logo-text.png" class="w-80 inline-block" alt="">
            </a>

            <jet-validation-errors class="mb-4" />

            <form @submit.prevent="submit">
                <div>
                    <jet-label for="name" value="Name" />
                    <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                </div>

            <div class="mt-4">
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
            </div>
            <div class="mt-4">
                <jet-label for="phone" value="Phone" />

                <div class="grid grid-cols-12 ">
                    <div class="col-span-2">
                        <jet-input id="country_code" type="text" class="mt-1 block w-full" v-model="form.country_code" required />
                    </div>
                    <div class="col-span-10">
                        <jet-input id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" required />
                    </div>
                </div>

            </div>


                <div class="mt-4">
                    <jet-label for="password" value="Password" />
                    <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <jet-label for="password_confirmation" value="Confirm Password" />
                    <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="mt-4" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                    <jet-label for="terms">
                        <div class="flex items-center">
                            <jet-checkbox name="terms" id="terms" v-model:checked="form.terms" />

                            <div class="ml-2">
                                I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                            </div>
                        </div>
                    </jet-label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                        Already registered?
                    </Link>

                    <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Register
                    </jet-button>
                </div>
                <div class="text-center">
                    <span>Or,</span>
                </div>
                <div class="text-center">
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
    import { defineComponent } from 'vue'
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
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

        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    email: '',
                    phone: '',
                    country_code: "+88",
                    password: '',
                    password_confirmation: '',
                    terms: false,
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('register'), {
                    preserveScroll: true,
                    resetOnSuccess: false,
                })
            }
        }
    })
</script>


<style lang="scss">
$white: #fff;
$google-blue: #4285f4;
$button-active-blue: #1669f2;

.google-btn {
    width: 184px;
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
