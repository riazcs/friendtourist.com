<template>
    <section>
        <div style="position: fixed; bottom: 0; z-index: 1; width: 100%;">
            <div id="checkout-paddding-r" class="d-flex justify-content-between" style="background-color: #056998; padding: 11px 78px;">
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-x-2">
                    <template v-if="cart && cart.length > 0">
                        <div class="w-full"
                             v-for="(item, idx) in cart"
                             :key="idx"
                        >
                            <div style="height: auto; border: 1px dashed #fff; border-radius: 3px; text-align: center !important;color: #fff; position: relative; padding: 0px;" class="alert alert-dismissible">
                                <div style="width:100%; height: auto;padding:10px;">
                                    <h3 class="text-uppercase" style="text-align:left; color: #fff; font-size: 16px; font-weight: 500;">{{ item.room_name }}</h3>
                                    <div class="flex justify-between items-center">
                                        <p class="mb-0 mr-6" style="font-size: 11px; font-weight: 300;">Room(s): {{ item.room }}</p>
                                        <p style="margin-bottom: 0px; font-size: 14px; font-weight: bold;">BDT: {{ item.rack_price }}</p>
                                    </div>
                                </div>

                                <button @click.prevent="removeItem(idx)" style="position: absolute; top: 0; color: #fff; right: 0; font-weight: 100; font-size: 14px; padding: 0 5px; border: none; background: transparent;" type="button" class="close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </template>
                    <template v-if="can_guest_allow <= 0 || !can_check_out">
                        <div class="w-full">
                            <div style="height: auto; border: 1px dashed red; border-radius: 3px; text-align: center !important;color: #fff; position: relative; padding: 0px;" class="alert alert-dismissible" role="alert">
                                <div style="width:100%; height: auto;padding: 10px; ">
                                    <h3 class="text-uppercase" style="text-align:left; color: #fff; font-size: 16px; font-weight: 700;">ADD ROOM</h3>
                                    <div class="flex justify-between items-center">
                                        <p class="mr-5" style="margin-bottom: 0px; font-size: 11px; font-weight: 300;">Add more room for extra guest</p>
                                    </div>
                                </div>

                                <button style="position: absolute; top: 0; color: #fff; right: 0; font-weight: 100; font-size: 14px; padding: 0 5px; border: none; background: transparent;" type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>

                <div id="card_checkout_right">
                    <div style="width:100%; height: auto; text-align: right !important;color: #fff;">
                        <p style="margin-bottom: 0px; font-size: 15px; font-weight: 200;">Total</p>
                        <h3 style="color: #fff; font-size: 16px; font-weight: 500;">BDT
                            <del v-if="form.rack_total > form.total_price" class="mr-2">{{ form.rack_total}}</del>
                            {{ form.total_price }}
                        </h3>
                        <button type="button" :disabled="can_guest_allow <= 0 || !can_check_out" @click.prevent="checkout" style="padding: 3px 40px;" class="btn btn-light btn-lg" >Next</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Swal from "sweetalert2";

export default {
    name: "FooterCartSection",
    props:['cart', 'filter', 'hotel_id'],
    data(){
        return{
            form: this.$inertia.form({
                cart: [],
                hotel_id:this.hotel_id,
                total_price: 0.00,
                rack_total: 0.00,
                check_in: '',
                check_out: '',
                adult: 1,
                child: 0
            }),
            can_guest_allow: 0,
        }
    },
    methods:{
        removeItem(idx){
            this.cart.splice(idx,1);
        },
        checkout(){
            if(!this.cart || this.cart.length <= 0){
                Swal.fire({
                    icon: "error",
                    title: "Ops!",
                    text: "Please Select Room.",
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1500,
                });
                return false;
            }
            this.form.transform((data) => ({
                ...data,
                check_in: this.filter.check_in,
                check_out: this.filter.check_out,
                adult: this.filter.adult,
                child: this.filter.child,
            })).post(route('store.cart'),{
                preserveScroll: true,
                onError() {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                        position: "top-end",
                    });
                },
            });
        }
    },
    computed:{
        checkCart(){
            return JSON.parse(JSON.stringify(this.cart))
        },
        can_check_out(){
            return (this.can_guest_allow >= +this.form.adult);
        }
    },
    watch:{
        checkCart:{
            handler(newVal, oldVal){
                if (newVal !== oldVal){
                    if (this.cart && this.cart.length > 0){
                        this.form.cart = this.cart;
                        this.cart.forEach((item) =>{
                            this.form.rack_total += (item.rack_price * item.room);
                            this.form.total_price += (item.bar_rate * item.room);
                            this.can_guest_allow += (item.max_allow * item.room);
                        });
                    }
                }
            }
        }
    }
}
</script>

<style scoped>

</style>
