<template>
    <frontend-layout title="Checkout">
        <div  class="" style="background-color: #EBF0F4;width: auto; height: auto;">
            <div class="container main-content">
                <section>
                    <div style="height: auto;">
                        <div class="row parent-column">
                            <!-- Start | Main Column One-->
                            <div class="col-md-12 col-lg-8">

                                <section class="mb-3" v-if="!$page.props.user">
                                    <div style="width: 100%; height: auto;background-color: #fff; border-radius: 5px;">
                                        <p style="margin-bottom: 0px; padding: 30px;">
                                            <span style="color: rgb(5, 105, 152); font-weight: 600; font-size:15px"><i class="fas fa-user"></i></span>
                                            <span style="color: rgb(5, 105, 152); font-weight: 600; font-size: 15px;">
                                                <Link style="text-decoration: underline;" :href="route('login')">Sign In</Link>
                                            </span>
                                            <span style="font-size: 13px; font-weight: 400; color: rgb(119, 129, 139);">  and friendtourist.com will send your booking confirmation (including the hotel’s contact information) to this.</span>
                                        </p>
                                    </div>
                                </section>
                                <section>
                                    <div style="width: 100%; height: auto; background-color: #fff; border-radius: 5px;">
                                        <h3 style="padding: 10px; font-size: 22px; color: #333; font-weight: 400;padding-left: 15px !important;">Hot Deals</h3>
                                        <div class="" style="padding: 40px; border-top: 1px solid rgba(0,0,0,0.15); border-bottom: 1px solid rgba(0,0,0,0.15); padding-left: 15px !important; padding-top: 10px !important;">
                                            <div class="row" v-if="coupons && coupons.length > 0">
                                                <div class="col-md-6 col-sm-12 col-lg-6 mt-3"
                                                v-for="coupon in coupons">
                                                    <label :for="coupon.coupon_code"
                                                           class="border relative rounded-md shadow-sm p-3 w-full"
                                                           :class="form.coupon_id == coupon.id? 'border-purple-600': ''"
                                                           @click="selectCoupon(coupon)"
                                                    >
                                                        <div class="absolute top-0 right-0" v-if="form.coupon_id == coupon.id">
                                                            <i class="fas fa-check-circle text-xl text-purple-600"></i>
                                                        </div>
                                                        <h3 style="font-size: 17px; font-weight: 600; color: #333;">{{ coupon.coupon_code }}</h3>
                                                        <span style="font-size: 14px; font-weight: 200;">
                                                            Additional {{ coupon.coupon_value }} {{ coupon.discount_type== 2? '%': ''}} discount <br> form {{ coupon.start_date }} to {{ coupon.end_date }}.
                                                        </span> <br>
                                                        <small class="text-blue-600 font-bold">Max limit: {{ coupon.max_limit }}</small>
                                                    </label>
                                                    <input type="radio" :id="coupon.coupon_code" v-model="form.coupon_id" :value="coupon.id" class="hidden">
                                                </div>
                                            </div>
                                        </div>

                                        <div style="width:100%; height:auto; padding: 30px 15px;">
                                            <div class="d-flex justify-content-center">
                                                <div style="padding-right: 10px;width: 70%;">
                                                    <input style="padding: 7px; width: 100%; box-sizing: border-box; border: 1px solid rgba(0,0,0,0.15); border-radius: 3px;" type="text" v-model="form.coupon_code" placeholder="Have a coupon?">
                                                </div>
                                                <div style="width: 30%;">
                                                    <button class="btn " style="background-color: #1c3c6b; color: #fff; border-radius: 3px;">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section>
                                    <div style="width: 100%; height: auto; background-color: #fff; border-radius: 5px; margin-top: 15px;">
                                        <h3 style="padding: 10px; font-size: 22px; color: #333; font-weight: 400;padding-left: 15px !important;">Guest Details</h3>
                                        <div class="cart-padding-test border-top" style="padding:0 20px 20px;">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-lg-12"  v-for="(adult, idx) in parseInt(checkout_data.adult)">
                                                    <div class="form-group">
                                                        <label>Guest {{ adult}} Name <b class="text-danger">*</b> (Adult) </label>
                                                        <input type="text" v-model="form.guests[idx]" class="form-control " :class="form.guests[idx]?'border-green-700': 'border-red-700'" aria-describedby="emailHelp" placeholder="Enter full name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <section>
                                    <div style="width: 100%; height: auto; background-color: #fff; border-radius: 5px; margin-top: 15px;">
                                        <div class="cart-padding-test" style="padding: 20px;padding-top: 10px !important;">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-lg-12 mt-3">

                                                    <div style="width: 100%; height: auto;">
                                                        <div style="width: 100%; height: auto;" class="d-flex justify-content-md-around">
                                                            <div id="payment_method" style="width: 25%; height: auto; padding-right: 15px;">
                                                                <div style="padding: 6px; box-shadow: 0px 1px 4px darkgrey; border-radius: 5px; text-align: center; cursor: pointer; position: relative; width: 100%; overflow: hidden; height: 80px;">
                                                                    <div>
                                                                        <div>
                                                                            <span style="font-size: 18px;"><i class="far fa-credit-card"></i></span>
                                                                        </div>
                                                                        <div><h3 id="" style="font-size: 16px; font-weight: 600; color: #1c3c6b;">Credit/Debit Card</h3></div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div id="payment_method1"  style="width: 25%; height: auto; padding-right: 15px;">
                                                                <div style="padding: 7px; box-shadow: 0px 1px 4px darkgrey; border-radius: 5px; text-align: center; cursor: pointer; position: relative;width: 100%; overflow: hidden; height: 80px;">
                                                                    <div>
                                                                        <div>
                                                                            <span style="font-size: 18px;"><i class="fas fa-mobile-alt"></i></span>
                                                                        </div>
                                                                        <div><h3 style="font-size: 16px; font-weight: 600; color: #1c3c6b;">Mobile Banking</h3></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="payment_method2"  style="width: 25%; height: auto; padding-right: 15px;">
                                                                <div style="padding: 7px; box-shadow: 0px 1px 4px darkgrey;border-radius: 5px; text-align: center; cursor: pointer; position: relative; width: 100%; overflow: hidden; height: 80px;">
                                                                    <div>
                                                                        <div>
                                                                            <span style="font-size: 18px;"><i class="fas fa-globe-asia"></i></span>
                                                                        </div>
                                                                        <div><h3 style="font-size: 16px; font-weight: 600; color: #1c3c6b;">Net Banking</h3></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="payment_method3"  style="width: 25%; height: auto; padding-right: 0px;">
                                                                <div style="padding: 7px; box-shadow: 0px 1px 4px darkgrey; border-radius: 5px; text-align: center; cursor: pointer; position: relative; width: 100%; overflow: hidden; height: 80px;">
                                                                    <div>
                                                                        <div>
                                                                            <span style="font-size: 18px;"><i class="fas fa-home"></i></span>
                                                                        </div>
                                                                        <div><h3 id="h3-tag-mobile-responsive" style="font-size: 16px; font-weight: 600; color: #1c3c6b;">EMI</h3></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div style="width: 100%; height: auto;">
                                                <div style="padding: 40px 40px 100px 40px; text-align: center;">
                                                    <h3 style="font-size: 22px; color: #333; font-weight: 700;">Pay flexibly with EMI</h3>
                                                    <div style="box-shadow:1px 0px 9px #e1e8ee; border: none; padding: 8px; border-radius: 5px; width: 100%;" class="form-group mt-3">
                                                        <select style="border: none;width: 100%;" class="form-control" name="" >
                                                            <option class="d-none" value=""><strong >Select Your Bank</strong></option>
                                                            <option value="">City Bank</option>
                                                            <option value="">DBBL Bank</option>
                                                        </select>
                                                    </div>
                                                    <p style="font-size: 14px; font-weight: 400; margin-top: 10px;">
                                                        By continuing to pay, I understand and agree with <br>the <a href="#">terms and service</a> with Go Zayaan.
                                                    </p>
                                                    <a style="background-color: #FEBB02; color:#1c3c6b;margin-top: 20px;" class="btn btn-sm" href=""><strong>Process to payment</strong></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <!-- End | Main Column One-->
                            <!-- Start | Main Column Two-->
                            <div class="col-md-12 col-lg-4">
                                <section>
                                    <div style="width: 100%; height: auto; margin-bottom: 15px;">
                                        <div style="width:100%; height: auto; background-color:#ECF3FE; border: 10px solid #fff; padding: 10px; border-radius: 5px;">
                                            <p style="font-size: 14px; font-weight: 400; color: #1c3c6b;">
                                                Booking confirmed. Complete payment before time out.
                                            </p>
                                            <div style="width: 100%;">
                                                <h1 style="font-size: 22px; font-weight: 600; color: #1c3c6b;">
                                                    <span style="padding-right:15px">
                                                        <i class="fas fa-clock"></i>
                                                    </span>
                                                    <span>{{ minute<10? '0'+minute: minute }}</span>
                                                    <span>:</span>
                                                    <span>{{ sec <10 ? '0'+sec: sec}}</span>
                                                </h1>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section>
                                    <div style="width: 100%; height: auto; background-color: #fff;border-top-left-radius: 5px;border-top-right-radius: 5px; padding: 20px;">
                                        <div class="d-flex" style="width: 100%; height: auto; border-bottom: 1px solid rgba(0,0,0,0.15); padding-bottom: 15px;">
                                            <div class="flex-fill mobile-and-tab-res-img" style="width: 25%; height: auto;">
                                                <img class="rounded float-right" style="width: 80px; height: 80px; border-radius: 5px;" :src="hotel.attachment.file_path" alt="">
                                            </div>
                                            <div  class="flex-fill" style="width: 75%; height: auto; padding-left: 10px;">
                                                <p style="margin-bottom: 0px; font-size: 15px; font-weight: 400; color: #1c3c6b; text-transform: capitalize;">Hotel</p>
                                                <h3 style="font-size: 16px; line-height: 24px; font-weight: 600;color: #1c3c6b; margin-bottom: 0px;">
                                                    {{ hotel.name }}
                                                </h3>
                                                <p style="margin-bottom: 0px; font-size: .8rem">
                                                    <small>{{ hotel.address_line? hotel.address_line+',': ''}} {{ hotel.area? hotel.area+',': ''}} {{ hotel.district? hotel.district.name: ''}}</small>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="accordion" id="accordionPanelsStayOpenExample">
                                            <div class="accordion-item border-0">
                                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                                    <div class="accordion-button bg-transparent py-0 px-3" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne"></div>
                                                </h2>
                                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body px-0 pb-0">
                                                        <h6 class="font-bold">Fare Summary</h6>
                                                        <div class="d-flex justify-content-between items-end border-bottom mb-3 pb-2">
                                                            <div>
                                                                <small class="text-xs">Check-in</small>
                                                                <p class="font-bold mb-0" style="font-size: .83rem">{{ checkout_data.check_in }}</p>
                                                            </div>
                                                            <div>
                                                                <small class="text-xs">Check-out</small>
                                                                <p class="font-bold mb-0" style="font-size: .83rem">{{ checkout_data.check_out }}</p>
                                                            </div>
                                                            <div>
                                                                <p class="font-bold text-gray-400 mb-0" style="font-size: .83rem">{{ nights }} Night</p>
                                                            </div>
                                                        </div>
                                                        <h6 class="font-bold">Rooms</h6>
                                                        <div class="border-bottom mb-3 pb-2">
                                                            <div
                                                                v-for="room in checkout_data.cart"
                                                                :key="room.room_id"
                                                                class="d-flex justify-content-between"
                                                            >
                                                                <p class="font-bold mb-0 d-flex jus"
                                                                   style="font-size: .83rem">{{ room.room_name }}</p>

                                                                <small class="text-xs">Room: {{ room.room }}</small>
                                                            </div>

                                                        </div>
                                                        <h6 class="font-bold">Guest</h6>
                                                        <div class="d-flex justify-content-between items-end border-bottom pb-2">
                                                            <div>
                                                                <p class="font-bold mb-0" style="font-size: .83rem">Adult: {{ checkout_data.adult }}</p>
                                                            </div>
                                                            <div>
                                                                <p class="font-bold mb-0" style="font-size: .83rem">Child: {{ checkout_data.child }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="d-flex justify-content-between mb-1 mt-4">
                                            <div>
                                                <span style="color: #525252; font-size: 15px; font-weight: 400;">Rack Rate</span>
                                            </div>
                                            <div>
                                                <span style="color: #212529; font-size: 14px; font-weight: 500;"> BDT <span style="color: #212529; font-size: 15px; font-weight: 400;"> {{ form.rack_total.toFixed(2) }}</span></span>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between mb-1" v-if="form.hotel_discount > 0">
                                            <div>
                                                <p style="color: #525252; margin-bottom: 0px; font-size: 15px; font-weight: 400;">Hotel Offer
                                                    <span style="padding: 7px; background-color: #ecf3fe; color: #1c3c6b; font-size: 12px; font-weight: 700; border-radius: 5px;">{{ form.hotel_discount.toFixed(0) }}%</span>
                                                </p>
                                            </div>
                                            <div>
                                                <p style="margin-bottom:0px;color: #29a992; font-size: 14px; font-weight: 500;">
                                                    <span style="font-size: 11px; color: #29a992; margin-right: 5px;">
                                                        <i class="fas fa-minus-circle"></i>
                                                    </span>BDT
                                                    <span style="color: #29a992; font-size: 15px; font-weight: 400;">{{ (form.rack_total - form.sub_total).toFixed(2) }}</span>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between mb-1">
                                            <div>
                                                <span style="color: #525252; font-size: 15px; font-weight: 400;">Sub-Total</span>
                                            </div>
                                            <div>
                                                <span style="color: #212529; font-size: 14px; font-weight: 500;"> BDT <span style="color: #212529; font-size: 15px; font-weight: 400;">{{ form.sub_total.toFixed(2) }}</span></span>
                                            </div>
                                        </div>


                                        <div class="d-flex justify-content-between mb-1">
                                            <div>
                                                <p style="color: #525252; margin-bottom: 0px; font-size: 15px; font-weight: 400;">Vat(15%) + SC ({{ hotel.service_charge }}%)</p>
                                            </div>
                                            <div>
                                                <p style="margin-bottom:0px;color: #212529; font-size: 14px; font-weight: 500;">
                                                    <span style="font-size: 11px; color: #212529; margin-right: 5px;">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </span>BDT
                                                    <span style="color: #212529; font-size: 15px; font-weight: 400;">{{ form.total_charge.toFixed(2) }}</span>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between mb-1" v-if="form.coupon_id">
                                            <div>
                                                <p style="color: #525252; margin-bottom: 0px; font-size: 15px; font-weight: 400;">Hot Deals
                                                    <span style="padding: 7px; background-color: #ecf3fe; color: #1c3c6b; font-size: 12px; font-weight: 700; border-radius: 5px;">{{ form.coupon_code }}</span>
                                                </p>
                                            </div>
                                            <div>

                                                <p style="margin-bottom:0px;color: #29a992; font-size: 14px; font-weight: 500;">
                                                    <span style="font-size: 11px; color: #29a992; margin-right: 5px;">
                                                        <i class="fas fa-minus-circle"></i>
                                                    </span>BDT
                                                    <span style="color: #29a992; font-size: 15px; font-weight: 400;">{{ form.coupon_discount.toFixed(2) }}</span>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between mb-1">
                                            <div>
                                                <p style="color: #525252; margin-bottom: 0px; font-size: 15px; font-weight: 400;">Convenience Fee
                                                    <span style="font-size: 13px; color: #b4a4a4; font-weight: 200;">
                                                        <i class="fas fa-info-circle"></i>
                                                    </span>
                                                </p>
                                            </div>
                                            <div>
                                                <p style="margin-bottom:0px;color: #212529; font-size: 14px; font-weight: 500;">
                                                    <span style="font-size: 11px; color: #212529; margin-right: 5px;">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </span>BDT
                                                    <span style="color: #212529; font-size: 15px; font-weight: 400;">{{ form.convenience_fee.toFixed(2) }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between" style="background-color: #ECF3FE; padding: 15px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                                        <div>
                                            <p style="color: #212529; margin-bottom: 0px; font-size: 17px; font-weight: 600;">You Pay </p>
                                            <p style="font-size: 11px; color: #546378; font-weight: 200;">(for <strong>{{ checkout_data.adult }}</strong> travelers) </p>
                                            <p  v-if="form.total_save> 0" style="margin-bottom: 0px;color: #29a992;font-weight: 400;font-size: 15px;">You Save</p>
                                        </div>
                                        <div>
                                            <p style="margin-bottom:1.2em;color: #212529; font-size: 16px; font-weight: 600;">BDT {{ form.grand_total.toFixed(2) }}</p>
                                            <p  v-if="form.total_save> 0" style="margin-bottom: 0px;color: #29a992;font-weight: 400;font-size: 15px; text-align: end;">BDT {{ form.total_save.toFixed(2) }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div v-if="!$page.props.user">
                                            <Link :href="route('login')" class="btn btn-secondary btn-lg btn-block w-full"> Login for Pay </Link>
                                        </div>
                                        <div v-if="$page.props.user">
                                            <button class="btn btn-primary btn-lg btn-block" id="sslczPayBtn"
                                                    token="if you have any token validation"
                                                    postdata="your javascript arrays or objects which requires in backend"
                                                    order="If you already have the transaction generated for current order"
                                                    :endpoint="route('ssl_pay.ajax')"

                                            > Pay Now
                                            </button>
                                        </div>

                                    </div>
                                </section>
                            </div>
                            <!-- End | Main Column Two-->
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </frontend-layout>
</template>

<script>
import FrontendLayout from "../../Layouts/FrontendLayout";
import Swal from "sweetalert2";
import {Link} from "@inertiajs/inertia-vue3";
import $ from "jquery";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";

export default {
    name: "CheckoutPage",
    components: {
        FrontendLayout,
        Link,
        JetValidationErrors
    },
    props:[
        'checkout_data',
        'nights',
        'hotel',
        'total_charge',
        'total_discount',
        'total_price',
        'rack_total',
        'coupons',
        'convenience_percent'
    ],
    data(){
        return{
            form: {
                hotel_id: this.hotel.id,
                rack_total: this.rack_total,
                hotel_discount: this.total_discount,
                sub_total: this.total_price,
                total_charge: parseInt(this.total_charge),
                total_price: 0,
                grand_total:0,
                convenience_fee: 0,
                coupon_id:'',
                coupon_code: '',
                coupon_discount: 0,
                total_save: 0,
                guests:[],
            },

            minute: 30,
            sec: 0,
        }
    },
    mounted() {
        let $that = this;
        let IntervalId = setInterval(function () {
            $that.sec--;
            if ($that.sec <= 0) {
                $that.sec = 59;
                if ($that.minute <= 0 && $that.sec <= 59) {
                    clearInterval(IntervalId);
                    Swal.fire({
                        title: 'Time Out',
                        text: "Your reservation time is out.",
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $that.$inertia.get(route('index'));
                        }
                    });
                }
                $that.minute--;
            }

        }, 1000);

        this.initSSLCommerce();


        this.form.total_price = Math.ceil((this.form.sub_total + this.form.total_charge));
        this.calculatePrice();

    },
    methods:{
        selectCoupon(coupon){
            this.form.coupon_code = coupon.coupon_code;
            if(coupon.discount_type == 2){
                let discount = parseInt(this.form.total_price *(coupon.coupon_value/100));
                if(discount > coupon.max_limit){
                    discount = coupon.max_limit;
                }
                this.form.coupon_discount = parseInt(discount);
            }else{
                this.form.coupon_discount = parseInt(coupon.coupon_value);
            }

           this.calculatePrice();
        },
        calculatePrice(){
            let gTotal = (this.form.total_price - this.form.coupon_discount);
            this.form.convenience_fee = Math.ceil(gTotal * this.convenience_percent);
            this.form.total_save = Math.ceil((this.form.rack_total - this.form.sub_total) + this.form.coupon_discount);
            this.form.grand_total = Math.ceil(gTotal + this.form.convenience_fee);
        },
        initSSLCommerce(){
            var obj = {};
            obj.coupon_id = this.form.coupon_id;
            obj.guests = this.form.guests;

            $('#sslczPayBtn').prop('postdata', obj);

            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
            tag.parentNode.insertBefore(script, tag);
        }
    }
}
</script>

<style scoped>
.main-content {
    width: 100%;
    height: auto;
    padding: 40px 0;
}

.accordion-button::after {
    width: 25px;
    min-width: 25px;
    height: 25px;
    background-color: #ecf1f9;
    border-radius: 50%;
    position: absolute;
    right: 0;
    cursor: pointer;;
}
.accordion-button::after{
    background-size: 24px;
}
.border-red-700 {
    --tw-border-opacity: 1;
    border-color: rgba(185, 28, 28, var(--tw-border-opacity)) !important;
}
.border-green-700 {
    --tw-border-opacity: 1;
    border-color: rgba(4, 120, 87, var(--tw-border-opacity)) !important;
}
</style>
<style src="../../../css/style.css"></style>

