<template>
    <hotel-layout title="My Hotel">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Policies
            </h2>
        </template>

        <form action="" @submit.prevent="submit()">
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="flex bg-white p-4 my-4 rounded-md flex-col lg:flex-row">
                    <div class="w-full p-4">
                        <h2 class="font-bold">Cancellation Policy</h2>
                        <p>
                            Guests will see these policies when they will search for
                            properties. Policies should be written very clearly and
                            specifically so that guest can understand easily.
                        </p>
                    </div>

                    <div class="w-full p-4">
                        <div class="pb-4" v-for="(nearBy, index) of cancelList" :key="index">
                            <div class="pb-4 flex">
                                <div class="w-full pr-1">
                                    <label for="District" class="font-semibold text-sm pb-2 block">Time <span class="font-bold text-red">*</span></label>
                                    <!-- dropdown -->
                                    <select class="border border-gray-300 text-gray-600 h-10 pl-2 pr-2 rounded-sm w-full bg-white hover:border-gray-400 focus:outline-none"  id="District"  v-model="cancelList[index].hour">
                                        <option value="12">Within 12 hours</option>
                                        <option value="24">Within 24 hours</option>
                                        <option value="48">Within 48 hours</option>
                                        <option value="72">Within 72 hours</option>
                                        <option value="168">Within 7 days</option>
                                        <option value="360">Within 15 days</option>
                                        <option value="720">Within 30 days</option>
                                    </select>
                                    <!-- dropdown -->
                                </div>
                                <div class="w-full">
                                    <label for="Distance" class="font-semibold text-sm pb-2 block">Cancelation Charge(in %)</label>
                                    <input type="number" step="0.01" v-model="cancelList[index].percent" id="Distance" class="appearance-none px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 w-full"  name="custom-input-number"/>
                                </div>
                            </div>

                            <div class="pb-4 text-right">
                                <button
                                    type="button"
                                    class="mr-2 text-md font-semibold text-red-400"
                                    @click.prevent="removeCancel(index, cancelList[index].id)">
                                    <span>-</span> Remove
                                </button>
                            </div>
                        </div>
                        <div class="flex pb-4">
                            <button
                                type="button"
                                class="mr-2 text-md font-semibold text-blue-700"
                                @click.prevent="addCancel()"
                            >
                                <span>+</span> Add another
                            </button>
                        </div>
                    </div>
                    <!-- room description -->
                </div>
                <div class="flex bg-white p-4 my-4 rounded-md flex-col lg:flex-row">
                    <div class="w-full p-4">
                        <h2 class="font-bold">House Rules</h2>
                        <p>Please write your house rules as clearly as possible.</p>
                    </div>

                    <div class="w-full p-4">
                        <div class="pb-4">
                            <label for="street_address" class="font-medium pb-2 block" >House Rules</label>
                            <textarea v-model="form.rules" id="w3review"  rows="4" class=" appearance-none px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 w-full"></textarea>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-x-4">
                    <div class="flex bg-white p-4 mb-4 rounded-md flex-col lg:flex-row">
                        <div class="w-full p-4">
                            <h2 class="font-bold">Check-in</h2>
                            <p>Please provide your expected check in time.</p>
                        </div>

                        <div class="w-full p-4">
                            <div class="pb-4 flex">
                                <div class="w-full pr-1">
                                    <h2 class="font-medium text-sm pb-2">From</h2>
                                    <input type="time" v-model="form.check_in_from" class=" appearance-none px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 w-full" name="custom-input-number"/>
                                </div>
                                <div class="w-full">
                                    <h2 class="font-medium text-sm pb-2">To</h2>
                                    <input type="time" v-model="form.check_in_to" class=" appearance-none px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 w-full" name="custom-input-number"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex bg-white p-4 mb-4 rounded-md flex-col lg:flex-row">
                        <div class="w-full p-4">
                            <h2 class="font-bold">Check-out</h2>
                            <p>Please provide your expected check out time.</p>
                        </div>

                        <div class="w-full p-4">
                            <div class="pb-4 flex">
                                <div class="w-full pr-1">
                                    <h2 class="font-medium text-sm pb-2">From</h2>
                                    <input type="time" v-model="form.check_out_from" class="appearance-none px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 w-full" name="custom-input-number"/>
                                </div>
                                <div class="w-full">
                                    <h2 class="font-medium text-sm pb-2">To</h2>
                                    <input type="time" v-model="form.check_out_to" class=" appearance-none px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 w-full" name="custom-input-number"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-x-4">
                    <div
                        class=" flex bg-white p-4 mb-4 rounded-md flex-col lg:flex-row w-full"
                    >
                        <div class="w-full p-4">
                            <h2 class="font-bold">Child Policy</h2>
                            <p>Do you allow childs? Yes, No</p>
                        </div>

                        <div class="w-full p-4">
                            <div class="pb-4 flex">
                                <div class="w-full pr-1">
                                    <span> <input type="radio" v-model="form.child_policy" :checked="form.child_policy == 1" value="1" class="m-3"
                                                  name="yes_no"/>Yes</span>
                                </div>
                                <div class="w-full">
                                    <span> <input type="radio" v-model="form.child_policy" :checked="form.child_policy == 0" value="0" class="m-3"
                                                  name="yes_no"/>No</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class=" flex bg-white p-4 mb-4 rounded-md flex-col lg:flex-row w-full"
                    >
                        <div class="w-full p-4">
                            <h2 class="font-bold">Pet Policy</h2>
                            <p>Do you allow pets? Yes, No</p>
                        </div>

                        <div class="w-full p-4">

                            <div class="pb-4 flex">
                                <div class="w-full pr-1">
                                    <span> <input type="radio" value="1" v-model="form.pet_policy" :checked="form.pet_policy == 1" class="m-3" name="yes_no_pet"/>Yes</span>
                                </div>
                                <div class="w-full">
                                    <span> <input type="radio" value="0" class="m-3"  :checked="form.pet_policy == 0" v-model="form.pet_policy"
                                                  name="yes_no_pet"/>No</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="flex flex-col md:flex-row gap-x-4">
                    <div class="flex w-full bg-white p-4 mb-4 rounded-md flex-col lg:flex-row">
                        <div class="w-full p-4">
                            <h2 class="font-bold">Service Charge</h2>
                            <p>Please enter the service charge percentage. Enter "0", if you dont take service charge.
                                This will shown to guest payment generation.</p>
                        </div>

                        <div class="w-full p-4">
                            <div class="pb-4 flex">
                                <div class="w-full pr-1">
                                    <h2 class="font-medium text-sm pb-2">Service Charge (%)</h2>
                                    <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                                        <div class="flex -mr-px">
                                            <span class="flex items-center leading-normal bg-grey-lighter rounded rounded-r-none border border-r-0 border-grey-light px-3 whitespace-no-wrap text-grey-dark text-sm">%</span>
                                        </div>
                                        <input type="number" v-model="form.service_charge" step="0.01" max="100" min="0" class="flex-shrink flex-grow flex-auto leading-normal border border-gray-300 w-px flex-1 h-10  rounded-lg rounded-l-none px-3 relative focus:border-blue focus:shadow" placeholder="Username">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex w-full bg-white p-4 mb-4 rounded-md flex-col lg:flex-row">
                        <div class="w-full p-4">
                            <h2 class="font-bold">Extra Bed </h2>
                            <p>Please enter the cost for extra bed. This will be shown to your guests when payment
                                information generated.</p>
                        </div>

                        <div class="w-full p-4">
                            <div class="pb-4 flex">
                                <div class="w-full pr-1">
                                    <h2 class="font-medium text-sm pb-2">Extra Bed Charge</h2>
                                    <input type="number" v-model="form.extra_bed_charge" class=" appearance-none px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 w-full" name="custom-input-number"/>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <!-- Rate Options -->

                <div
                    class=" flex items-center justify-between px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md"
                >
                    <jet-validation-errors class="mb-4"/>
                    <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                        Saved.
                    </jet-action-message>

                    <jet-button
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        class="bg-green-700"
                    >
                        Update Information
                    </jet-button>
                </div>
            </div>
        </form>
    </hotel-layout>
</template>

<script>
import HotelLayout from "@/Layouts/HotelLayout";
import JetButton from "@/Jetstream/Button.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import Swal from "sweetalert2";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import Multiselect from "@vueform/multiselect";

export default {
    name: "MyHotel",
    components: {
        HotelLayout,
        JetActionMessage,
        JetButton,
        JetInputError,
        JetValidationErrors,
        Multiselect,
    },
    props: ["hotel"],
    data() {
        return {
            form: this.$inertia.form({
                id: "",
                rules: "",
                cancels: [],
                deleted_cancels: [],
                check_in_from: "",
                check_in_to: "",
                check_out_to: "",
                check_out_from: "",
                child_policy: "",
                pet_policy: "",
                service_charge: 0,
                extra_bed_charge: 0
            }),
            cancelList: [],
        };
    },

    mounted() {
        this.form.id = this.hotel.id;
        this.form.rules = this.hotel.rules;
        this.form.check_in_from = this.hotel.check_in_from ? this.hotel.check_in_from : "";
        this.form.check_in_to = this.hotel.check_in_to ? this.hotel.check_in_to : "";
        this.form.check_out_from = this.hotel.check_out_from ? this.hotel.check_out_from : "";
        this.form.check_out_to = this.hotel.check_out_to ? this.hotel.check_out_to : "";
        this.form.child_policy = this.hotel.child_policy ? this.hotel.child_policy : "";
        this.form.pet_policy = this.hotel.pet_policy ? this.hotel.pet_policy : "";
        this.form.service_charge = this.hotel.service_charge ? this.hotel.service_charge : "";
        this.form.extra_bed_charge = this.hotel.extra_bed_charge ? this.hotel.extra_bed_charge : "";

        if (this.hotel.cancels && this.hotel.cancels.length > 0) {
            this.hotel.cancels.forEach((cancel) => {
                let cancelT = {
                    id: cancel.id,
                    hour: cancel.hour,
                    percent: cancel.percent,
                };
                this.cancelList.push(cancelT);
            });
        } else {
            this.addCancel();
        }
    },
    methods: {
        addCancel() {
            let cancelP = {
                id: null,
                hour: "",
                percent: "",
            };
            this.cancelList.push(cancelP);
        },
        removeCancel(index, id) {
            if (id != null) {
                this.form.deleted_cancels.push(id);
            }
            this.cancelList.splice(index, 1);
        },

        submit() {
            this.form
                .transform((data) => ({
                    ...data,
                    cancels: this.cancelList && this.cancelList.length > 0 && this.cancelList[0].hour && this.cancelList[0].percent ? this.cancelList : [],
                }))
                .post(route("hotel.policy.update", this.hotel.id), {
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess: () => {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Hotel updated successfully",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    },
                    onError: () => {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                            position: "top-end",
                            footer: '<a href="">Scroll up on the modal to see the issue!</a>',
                        });
                    },
                });
        },
    },
};
</script>

<style scoped>
.rating-color {
    color: #0981bb;
    fill: #0981bb;
}
</style>
<style src="@vueform/multiselect/themes/default.css"></style>
