<template>
    <frontend-layout title="Hotel List">

        <section>
            <div class="main-content container">
                <section>
<!--                    <div style="width: 100%; height: auto" class="menu-div">-->
<!--                        <ul style="list-style: none" class="d-flex justify-content-start">-->
<!--                            <li style="margin-left: 0px !important">-->
<!--                                <a href="#">Home</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <span><i class="fas fa-angle-right"></i></span>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">Bangladesh</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <span><i class="fas fa-angle-right"></i></span>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">Cox's Bazar</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <span><i class="fas fa-angle-right"></i></span>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a style="text-decoration: none; color: #000" href="#" >-->
<!--                                    Laguna Beach Hotel & Resort (Hotel), Cox's Bazar (Bangladesh) Deals-->
<!--                                </a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </div>-->
                </section>

                <section>
                    <div class="row">
                        <!-- START | Left Side DIV -->
                        <div class="col-md-3 col-sm-12">
                            <filter-form :filter="filter"></filter-form>
                        </div>
                        <!-- END | Left Side DIV -->

                        <!-- START | Right Side DIV -->
                        <div class="col-md-9 col-sm-12">
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-between">
                                    <h4><b><span v-if="filter.area"> {{ filter.area.title }} </span>: {{ hotels.meta.total }} properties found</b></h4>
                                    <div>
                                        <a class="btn btn-primary btn-sm" style="color: white; border-color: #006bb8; float: right" href="#" >Show on map</a>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 price-section-nav justify-content-center">
                                    <ul style="list-style: none; max-width: 540px; border-radius: 3px" class="d-flex justify-content-center" >
                                        <li>
                                            <Link class="rating-price"
                                                  :class="filter.order_by == 'lowest'?'active': ''"
                                                  :href="'?'+this.query+'&order_by=lowest'"
                                            >Lowest Price First</Link>
                                        </li>

                                        <li>
                                            <Link class="rating-price"
                                                  :class="filter.order_by == 'highest'?'active': ''"
                                                  :href="'?'+this.query+'&order_by=highest'"
                                            >Highest Price First</Link>
                                        </li>

                                        <li>
                                            <Link class="rating-price"
                                                  :class="filter.order_by == 'star'?'active': ''"
                                                  :href="'?'+this.query+'&order_by=star'"
                                            >Star Rating</Link>
                                        </li>

                                        <li style="border-right-color: transparent !important">
                                            <Link class="rating-price"
                                                  :class="filter.order_by == 'review'?'active': ''"
                                                  :href="'?'+this.query+'&order_by=review'"
                                            >Top Reviewed</Link>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 " v-for="hotel in hotels.data">
                                    <div style="
                                            padding: 14px;
                                            border-radius: 3px;
                                            width: 100%;
                                            height: 100% !important;"
                                         class="hover-effects  shadow hover:shadow-2xl ">
                                        <div class="custom-deatils">
                                            <div class="left-one">
                                                <img v-if="hotel.attachment" :src="hotel.attachment.file_path" style="width: 100%; height: auto" class="img-thumbnail" />
                                                <div class="text-center" v-if="hotel.schedule.discount_percent > 0">
                                                    <span class="no-class inline-block font-semibold mt-2">{{ hotel.schedule.discount_percent }} % Discount</span>
                                                </div>
                                            </div>
                                            <div class="middle-two">
                                                <div class="card-body p-0">
                                                    <h5 style="margin-bottom: 0px" class="card-title">
                                                        {{ hotel.name }}
                                                        <span style="color: gold">
                                                            <i v-for="index in hotel.no_of_star"
                                                                 :key="index"
                                                                 class="fas fa-star fa-xs" aria-hidden="true"></i>
                                                        </span>
                                                    </h5>
                                                    <p class="card-text"> {{ hotel.area }} , {{ hotel.district.name }} </p>

                                                    <button type="button" class="btn btn-success btn-sm my-2">
                                                        Limited-time Deal
                                                    </button>


                                                    <p style="margin-bottom: 0px; line-height: 15px" class="card-text mt-1 text-gray-500" >
                                                        <div class="my-2" v-for="landmark in hotel.landmarks">
                                                        <i class="fa fa-map-marker"></i>
                                                        <small class="text-muted" >
                                                           {{ landmark.distance }} KM from {{ landmark.name }}
                                                        </small>
                                                        <br>
                                                        </div>
                                                    </p>

                                                    <p class="card-text"></p>
                                                    <span>
                                                        <h6 style="margin-bottom: 0px; color: #00ac23"> FREE cancellation </h6>
                                                        <p></p>
                                                        <p style="margin-bottom: 0px; line-height: 13px" class="card-text" >
                                                            <small class="" style="color: #00ac23" >
                                                                You can cancel later, so lock in this great price today!
                                                            </small>
                                                        </p>
                                                    </span>
                                                    <!-- • No prepayment needed -->
                                                </div>
                                            </div>
                                            <div class="right-three ml-auto">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <h6 class="text-right">
                                                            Very good<br/><small>923 reviews</small>
                                                        </h6>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div style=" width: 37px; height: 37px; padding: 5px; border-top-left-radius: 9px;
                                                                border-top-right-radius: 9px; border-bottom-right-radius: 9px; background-color: #003580; float: right; " >
                                                            <span style=" color: #fff; font-size: 16px; padding: 1px; font-weight: 600;" >8.4</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row ml-auto">
                                                    <div class="col-md-12 pt-0 justify-content-end">
                                                        <div style=" float: right; padding-left: 84px; text-align: right !important; " >
                                                            <p class=""><small>Per Night, {{ hotel.schedule.room.max_guest_allow }} adults, {{ hotel.schedule.room.child_occupancy }} childs </small></p>
                                                            <h5 class=""> BDT<del class="text-sm" v-if="hotel.schedule.discount_percent > 0">  {{ (parseFloat(hotel.schedule.room.rack_price) + parseFloat(hotel.schedule.total_charge)).toFixed(2) }} </del> {{ (parseFloat(hotel.schedule.bar_rate) + parseFloat(hotel.schedule.total_charge)).toFixed(2)  }} </h5>
                                                            <small>Includes taxes and fees</small>
                                                            <Link :href="route('details' , hotel.id) +'?'+ this.query" class="btn btn-primary btn-sm mt-2">See Availability</Link>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <pagination :meta="hotels.meta" :query="query"></pagination>
                        </div>
                        <!-- END | Right Side DIV -->
                    </div>
                </section>
            </div>
        </section>
    </frontend-layout>
</template>

<script>
import FrontendLayout from "../../Layouts/FrontendLayout";
import Pagination from "../../Helpers/Pagination";
import FilterForm from "@/Partials/Frontend/FilterForm";
import {Link} from "@inertiajs/inertia-vue3";


export default {
    name: "HotelList",
    components: {
        FrontendLayout,
        Pagination,
        Link,
        FilterForm,
    },
    props: {
        hotels: [],
        filter:{},
        query: '',
    },
}
</script>

<style src="../../../css/style.css"></style>
<style>
.no-class {
    font-size: 12px;
    line-height: 18px;
    color: #056998;
    background-color: #e0f3f8;
    padding: 5px 10px;
    border-radius: 20px;
}
.rating-price.active{
    color: #fff;
    background-color: #006bb8;
}
</style>
