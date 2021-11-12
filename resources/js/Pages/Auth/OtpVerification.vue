<template>
    <frontend-layout title="Otp Verification">
        <jet-authentication-card>
            <a class="text-center block" href="/">
                <img
                    alt=""
                    class="w-80 inline-block"
                    :src="route('index')+'/template/assets/logo-text.png'"
                />
            </a>

            <jet-validation-errors class="mb-4"/>

            <form @submit.prevent="submit">
                <div class="mt-4">
                    <jet-label for="otp" value="OTP Code"/>
                    <jet-input
                        v-model="form.otp"
                        autocomplete="off"
                        class="mt-1 block w-full"
                        placeholder="Please give OTP code"
                        required
                        type="text"
                    />
                </div>
                <jet-button class="float-right ml-2 my-2" type="submit"> Verify OTP</jet-button>
                <jet-button class="float-right my-2" @click.prevent="resend">
                    Resend OTP
                </jet-button>
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
        Link

    },
    props: {
        phone: "",
    },
    data() {
        return {
            form: this.$inertia.form({
                otp: "",
                phone: this.phone,
            }),
        };
    },

    methods: {
        submit() {
            this.form.get(route("match-otp"));
        },
        resend() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You wont be sent it again in 2 minutes!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Send It'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .post(route('resend.otp'))
                        .then((response) => {
                            console.log(response);
                            if (response.data.key === "success") {
                                Swal.fire(
                                    'OTP Sent!',
                                    'A New Code Has Been Sent',
                                    'success'
                                )
                            } else {
                                Swal.fire({
                                    title: 'Please Complete 2 miniutes wait time before sent again!',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    }
                                })
                            }

                        })
                        .catch((error) => {
                            alert(error);
                        });


                }
            })
        }
    },
});
</script>
