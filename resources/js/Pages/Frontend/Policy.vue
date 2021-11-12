<template>
    <frontend-layout>
            <div class="container">
                <div v-if="policy.name">
                    <h5 v-if="policy.name == 'refund_policy'" class="text-5xl my-5">Refund Policy</h5>
                    <h5 v-if="policy.name == 'emi_policy'" class="text-5xl my-5">EMI Policy</h5>
                    <h5 v-if="policy.name == 'privacy_policy'" class="text-5xl my-5">Privacy Policy</h5>
                    <h5 v-if="policy.name == 'terms'" class="text-5xl my-5">Terms</h5>
                    <h5 v-if="policy.name == 'career'" class="text-5xl my-5">Career</h5>
                    <p class="mb-10" v-html="policy.data"></p>
                </div>
                <div v-else>No Terms and Policies.</div>
        </div>
    </frontend-layout>
</template>

<script>
    import FrontendLayout from "../../Layouts/FrontendLayout";
    import FilterForm from "@/Partials/Frontend/FilterForm";
    export default {
        name: "Policy.vue",
        components: {
            FrontendLayout,
            FilterForm
        },
        props: [
            'policy',
        ],
        data() {
            return {
                form: this.$inertia.form({
                }),
            };
        },
        methods:{
        }
    }
</script>
