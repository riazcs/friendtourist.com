<template>
    <frontend-layout>
        <Head title="Register"/>

        <jet-authentication-card>
            <a class="text-center block" href="/">
                <img
                    alt=""
                    class="w-80 inline-block"
                    src="/template/assets/logo-text.png"
                />
            </a>

            <jet-validation-errors class="mb-4"/>

            <form @submit.prevent="submit">
                <div class="mt-4">
                    <jet-label for="phone" value="Mobile Number"/>
                    <div class="grid grid-cols-12">
                        <div class="col-span-2">
                            <jet-input
                                id="phone"
                                v-model="form.country_code"
                                autocomplete="off"
                                class="mt-1 w-full"
                                required
                                type="text"
                            />
                        </div>

                        <div class="col-span-10 ">
                            <jet-input
                                id="phone"
                                v-model="form.phone"
                                autocomplete="off"
                                class="mt-1 w-full"
                                placeholder="Please input your phone number"
                                required
                                type="text"
                            />
                        </div>
                    </div>


                </div>
                <jet-button class="float-right ml-2 my-2"> Send OTP</jet-button>
                <!-- <jet-button class="float-right my-2"> Resend OTP </jet-button> -->
            </form>
        </jet-authentication-card>
    </frontend-layout>
</template>

<script>
import {defineComponent} from "vue";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import {Head, Link} from "@inertiajs/inertia-vue3";
import Swal from "sweetalert2";
import FrontendLayout from "../../Layouts/FrontendLayout";

export default defineComponent({
    components: {
        Head,
        JetAuthenticationCard,
        JetAuthenticationCardLogo,
        JetButton,
        JetInput,
        JetLabel,
        JetValidationErrors,
        FrontendLayout,
        Link,
    },
    props: {
        user_id: "",
    },
    data() {
        return {
            form: this.$inertia.form({
                phone: "",
                country_code: "+88",
                user_id: this.user_id,
            }),
        };
    },

    methods: {
        submit() {
            this.form.get(this.route("send_otp"), {
                onSuccess() {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "OTP Send Successfully",
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
        },
    },
});
</script>
