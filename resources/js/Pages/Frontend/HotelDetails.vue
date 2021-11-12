<template>
    <frontend-layout title="Hotel Details">

        <section>
            <div id="myNav" class="overlay">
                <a href="javascript:void(0)" class="closebtn" @click="closeNav()">&times;</a>
                <div class="overlay-content text-center">
                    <lightgallery
                        :settings="{ speed: 500, plugins: plugins }"
                        :onInit="onInit"
                        :onBeforeSlide="onBeforeSlide"
                        class="grid grid-cols-3 "
                    >
                        <a v-for="attachment in hotel.attachments"
                            data-lg-size="1406-1390"
                            class="gallery-item inline-block"
                            :data-src="attachment.file_path"
                            data-sub-html=""
                        >
                            <img
                                class="img-responsive inline-block"
                                :src="attachment.file_path"
                            />
                        </a>

                        <template v-for="room in hotel.rooms">
                            <template v-for="image in room.attachments">


                        <a
                            class="gallery-item"
                            data-lg-size="1406-1390"
                            :data-src="image.file_path"
                            data-sub-html=""
                        >
                            <img
                                class="img-responsive inline-block"
                                :src="image.file_path"
                            />
                        </a>
                                </template>
                            </template>
                    </lightgallery>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="menu-div" style="width: 100%; height: auto;">
                            <ul class="d-flex justify-content-start mb-0" style="list-style: none;">
                                <li>
                                    <a href="#">Home</a>
                                </li>
                                <li>
                                    <span><i class="fas fa-angle-right"></i></span>
                                </li>
                                <li>
                                    <a href="#">Bangladesh</a>
                                </li>
                                <li>
                                    <span><i class="fas fa-angle-right"></i></span>
                                </li>
                                <li>
                                    <a href="#">Cox's Bazar</a>
                                </li>
                                <li>
                                    <span><i class="fas fa-angle-right"></i></span>
                                </li>
                                <li>
                                    <a href="#" style="text-decoration: none; color: #000;">{{ hotel.name }} (Hotel), Cox's Bazar
                                        (Bangladesh) Deals</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex">
                            <div id="left-side-content-main" class="flex-fill" style="width: 25%;">
                                <div class="row">
                                    <div class="col-12">
                                        <div style="width: 100%; height: 40px; background-color: #EBF3FF; border-radius: 3px;">
                                            <p style="font-size: 13px; font-weight: 600; text-align: center; padding-top: 10px;">Search Rooms</p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <FilterForm :filter="filter"></FilterForm>
                                    </div>
                                    <div class="col-12">
                                        <div class="iframe-locaiotn" style="width:100%; height: 145px; margin-top: 15px;" title="Check Location">
                                            <iframe
                                                allowfullscreen=""
                                                height="170"
                                                loading="lazy"
                                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118830.24477524596!2d91.93286108443685!3d21.451043355932732!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30adc7ea2ab928c3%3A0x3b539e0a68970810!2sCox&#39;s%20Bazar!5e0!3m2!1sen!2sbd!4v1632740949392!5m2!1sen!2sbd"
                                                style="width: 100%; height: 100%; border-color: transparent !important; border: 1px; margin-top: 10px;"
                                                width="283">
                                            </iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="right-side-content-main " class="flex-fill" style="width: 75%; padding-left: 20px;">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="right-side-content-element" style="width: 100%; height: 40px; background-color: #EBF3FF; box-shadow: 0px 1px 2px rgb(185, 183, 183);">
                                            <ul class="d-flex justify-content-around" style="width: 100%; height: 100%; list-style: none; padding-left: 0px! important;">
                                                <li style="width: 100%; padding-top: 5px; border-right: 2px solid #FFF; text-align: center;">
                                                    <a href="#info_and_price" style=" text-decoration:none; color: #0071c2; font-weight: 700; font-size: 13px;width: 100%; height: auto;">Info & Price</a>
                                                </li>
                                                <li style="width: 100%; padding-top: 5px; border-right: 2px solid #FFF; text-align: center;">
                                                    <a href="#facilities_smooth"  style="width: 100%; height: auto; text-decoration:none; color: #0071c2; font-weight: 700; font-size: 13px;">Facilities</a>
                                                </li>
                                                <li style="width: 100%; padding-top: 5px; border-right: 2px solid #FFF; text-align: center;">
                                                    <a href="#house_rules" style="width: 100%; height: auto; text-decoration:none; color: #0071c2; font-weight: 700; font-size: 13px;">House rules</a>
                                                </li>
                                                <li style="width: 100%; padding-top: 5px; text-align: center;">
                                                    <a href="#guest_review" style="width: 100%; height: auto; text-decoration:none; color: #0071c2; font-weight: 700; font-size: 13px;">
                                                        <span class="dispaly-phone-none">Guests</span> reviews(14)
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex items-center">
                                                <div class="flex-fill">
                                                    <h1 style="font-size:28px; font-weight: 700; color: #262626;">
                                                    <span class="badge badge-secondary"  style="font-size: 10px !important; font-weight: 400; background-color: #aeaeae; color: #FFF; vertical-align: middle; ">
                                                        {{ hotel.property_type }}
                                                    </span>
                                                        {{ hotel.name }}
                                                    </h1>
                                                </div>
                                                <div class="flex-fill ">
                                                <span class="pl-2 d-flex"
                                                      style="color: #FEBB02; font-size: 11px; font-weight: 400; ">
                                                    <span v-for="index in hotel.no_of_star" class="flex-fill">
                                                        <i class="fas fa-star text-xl" style="vertical-align: bottom !important;"></i>
                                                    </span>
                                                </span>
                                                </div>
                                            </div>
                                            <div id="none-dispay-reserveoff" class="d-flex">
                                                <div v-if="$page.props.user" class="flex-fill" @click="makeFavourite($page.props.user.id)">
                                                    <span style="font-size: 23px; color: #0071c2; padding: 0px 8px;" :style="is_favourite == true ?'color: #C22C30':'color: #0071c2'">
                                                        <i :class="is_favourite == true ?'fa fa-heart':'far fa-heart'"></i>
                                                    </span>
                                                </div>
                                                <div v-else class="flex-fill" @click="makeFavourite(id = 0)">
                                                    <span style="font-size: 23px; padding: 0px 8px; color: #0071c2">
                                                        <i class="far fa-heart"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-fill">
                                                    <span style="font-size: 23px; color: #0071c2; padding: 0px 8px;">
                                                        <i class="fas fa-share-alt-square"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-fill">
                                                    <a class="btn btn-primary btn-sm" href="#info_and_price"
                                                       style="border-radius: 2px !important;">Reserve</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between my-1">
                                            <p style="margin: 0px;">
                                                <span style="font-size: 20px; color: #0071c2;"> <i class="fas fa-map-marker-alt"></i> </span>
                                                <span style="font-size: 15px; font-weight: 300; cursor:help;"> {{ hotel.area }}, {{ hotel.district.name }}</span>
                                            </p>
                                            <a href="#"
                                               style="color: #0071c2; font-weight: 600; font-size: 14px; cursor: pointer;"
                                               title="Cox's Bazar Hotel & Resort - Check location">Good location – show map</a>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="images-main-div">
                                            <div class="images-sub1">
                                                <div class="images-sub1-left" v-if="hotel.attachments[2]" :style='"background-image: url("+ hotel.attachments[2].file_path +")"'></div>
                                                <div class="images-sub1-right" v-if="hotel.attachments[1]" :style='"background-image: url("+ hotel.attachments[1].file_path +")"'></div>
                                            </div>
                                            <div class="images-sub2" v-if="hotel.attachments[0]" :style='"background-image: url("+ hotel.attachments[0].file_path +")"'></div>
                                            <div class="images-sub3">
                                                <div class="images-sub3-one" v-if="hotel.rooms[0]" :style='"background-image: url("+ hotel.rooms[0].attachment.file_path +")"'></div>
                                                <div class="images-sub3-two" v-if="hotel.rooms[1]" :style='"background-image: url("+ hotel.rooms[1].attachment.file_path +")"'></div>
                                                <div class="images-sub3-two" v-else-if="hotel.rooms[0]" :style='"background-image: url("+ hotel.rooms[0].attachments[1].file_path +")"'></div>

                                                <div class="images-sub3-three" v-if="hotel.rooms[2]" :style='"background-image: url("+ hotel.rooms[2].attachment.file_path +")"'></div>
                                                <div class="images-sub3-two" v-else-if="hotel.rooms[0]" :style='"background-image: url("+ hotel.rooms[0].attachments[1].file_path +")"'></div>

                                                <div class="images-sub3-four" v-if="hotel.rooms[3]" :style='"background-image: url("+ hotel.rooms[3].attachment.file_path +")"'></div>
                                                <div class="images-sub3-two" v-else-if="hotel.rooms[1]" :style='"background-image: url("+ hotel.rooms[1].attachments[1].file_path +")"'></div>

                                                <div v-if="hotel.attachments[4]" :style='"background-image: url("+ hotel.attachments[4].file_path +")"' class="images-sub3-four text-white  flex justify-center items-center text-2xl" @click="openNav()"> <span class="align-middle inline-block">See More+ </span> </div>
                                                <div v-else-if="hotel.attachments[0]" :style='"background-image: url("+ hotel.attachments[0].file_path +")"' class="images-sub3-four text-white  flex justify-center items-center text-2xl" @click="openNav()"> <span class="align-middle inline-block">See More+ </span> </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex" style="width:100%; height: auto; padding-top: 24px !important" id="facilities_smooth" >
                                            <div class="flex-fill" style="width: 70%; height: auto; padding-right: 15px;">
                                                <p style="font-size: 15px; font-weight: 400; line-height: 30px; color: #262626;" v-html="hotel.description"></p>

                                                <div style="width: 100%; height: auto;">
                                                    <h3 style="font-size: 16px; " class="font-bold">Most popular facilities</h3>
                                                </div>

                                                <div class="" style="width: 100%; height: auto;">
                                                    <div class="row pl-2 pr-2 ">
                                                        <div class="col-4 py-1" v-for="facility in hotel.facilities">
                                                            <p class="mr-2">
                                                                <span style="color: #008009; font-weight: 200; font-size: 15px;"> <i class="fas fa-dot-circle mr-2"></i> </span>
                                                                <span style="font-size: 14px;" class="pr-2"> {{ facility.name }} </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-fill" style="width: 30%; height: auto;">
                                                <div id="breakfast-info" style="width: 100%; height: 150px; background-color: #EBF3FF; padding: 12px; border-radius: 3px;">
                                                    <p style="color: #838383; font-weight: 500; font-size: 16px;">Nearest landmark</p>
                                                    <p v-if="landmark" id="breakfast-info-prara" style="color: #262626; font-weight: 400; font-size: 14px;">{{ landmark.name }}</p>
                                                    <a class="btn btn-primary btn-block mt-5" href="#landmarkShow" style="background-color: #0071c2; color: #fff;">Show More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <h3 style="color: #333;" class="mb-3">Availability</h3>
                                        <div class="" style="width: 100%; height: auto;">
                                            <div class="d-flex" style="width:100%; min-height: 120px; border: 1px solid rgba(0, 0, 0, 0.15); padding: 12px;">
                                                <div class="flex-fill" style="width: 25%; height: 100%; padding-right: 5px;">
                                                    <p style="font-size: 14px; font-weight: 700; color: #333;">Check-in date</p>
                                                    <h3 style="font-size: 16px; color: #0071c2; font-weight: 700;">{{ filter.check_in}}</h3>
                                                    <p style="font-size: 14px; color: #6b6b6b; font-weight: 400;margin-bottom: 0px;">From {{ hotel.check_in_time }}</p>
                                                </div>
                                                <div class="flex-fill" style="width: 25%; height: 100%; border-left: 1px solid rgba(0, 0, 0, 0.15); padding-left: 10px;">
                                                    <p style="font-size: 14px; font-weight: 700; color: #333;"> Check-out date</p>
                                                    <h3 style="font-size: 16px; color: #0071c2; font-weight: 700;">{{ filter.check_out}}</h3>
                                                    <p style="font-size: 14px; color: #6b6b6b; font-weight: 400;margin-bottom: 0px;">From {{ hotel.check_out_time }}</p>
                                                </div>
                                                <div class="flex-fill" style="width: 25%; height: 100%;">
                                                    <p style="font-size: 14px; font-weight: 700; color: #333;">Guest</p>
                                                    <h3 style="font-size: 16px; color: #0071c2; font-weight: 700;">{{ filter.adult }} Adult</h3>
                                                    <h3 style="font-size: 16px; color: #0071c2; font-weight: 700;">{{ filter.child }} Child</h3>
                                                </div>
                                                <div id="change-search-id" class="flex-fill tabmoood-flex" style="width: 25%;
                                           height: 100%;
                                           padding: 32px 16px;">
                                                    <a id="srarch-button-off" @click.prevent="openModal()" class="btn btn-primary btn-block" href="#"
                                                       style="border-radius: 2px"><span>Change</span> Search</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div v-for="(room , increment)  in hotel.rooms"
                             :key="increment" id="info_and_price"
                             class="d-flex">
                            <room-item
                                :room="room"
                                :cart="cart"
                                :room_qty="filter.rooms"
                            ></room-item>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="w-full" style="border-bottom: 1px solid rgba(0,0,0,0.15)">
                            <h3 class="mb-2" style="font-size: 24px; color: #262626; font-weight: 700;" id="landmarkShow">Closest Landmarks</h3>
                            <div class="d-flex justify-content-between p-3" v-for="landmark in hotel.landmarks" style="border: 1px solid rgba(0,0,0,0.15);">
                                <div >
                                    <h3 style="font-size: 15px; color: #262626;"> Place: {{ landmark.name }}</h3>
                                    <p style="font-size: 14px; margin-bottom: 0px; color: #6b6b6b;">
                                        <span>
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span> Distance: {{ landmark.distance  }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div id="guest_review" class="d-flex justify-content-between pt-4">
                            <div>
                                <h3 style="font-size: 24px; color: #262626; font-weight: 700;" class="mb-2">Guest reviews</h3>

                                <div class="d-flex justify-content-start">
                                    <div style="    width: 37px;
                                        height: 37px;
                                        padding: 5px;
                                        border-top-left-radius: 9px;
                                        border-top-right-radius: 9px;
                                        border-bottom-right-radius: 9px;
                                        background-color: #003580;">
                                        <span style="color: #fff; font-size: 16px; padding: 1px; font-weight: 600;">6.4</span>
                                    </div>
                                    <div style="padding: 6px;">
                                        <span>
                                            <span style="font-size: 17px; color: #333; font-weight: 600;">Pleasant</span>
                                          · <span style="font-size: 17px; color: #6b6b6b; font-weight: 500;">14 reviews</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="w-full h-auto">
                            <h3 class="mb-2" style="font-size: 17px; color: #262626; font-weight: 700;">Guest Categories:</h3>
                            <div class="d-flex">
                                <!-- Start | First Side Div For Guest Review -->
                                <div class="flex-fill">
                                    <div class="d-flex">
                                        <div class="flex-fill" style="width: 80%; height: auto; padding: 0px; padding-left: 0px !important;">
                                            <span style="font-size: 14px; font-weight: 400;color: #333;">Staff</span>
                                            <div class="progress" style="height: 10px; border-radius: 3px;">
                                                <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar" role="progressbar" style="width: 70%; background-color: #003580; height: 10px;"></div>
                                            </div>
                                        </div>
                                        <div class="flex-fill" style="width: 20%;padding-top: 15px; ">
                                            <span style="font-size: 13px; color: #838383; padding-left: 11px; font-weight: 600;">7.5</span>
                                        </div>
                                    </div>

                                    <div class="d-flex mt-4">
                                        <div class="flex-fill" style="width: 80%; height: auto; padding: 0px; padding-left: 0px !important;">
                                            <span style="font-size: 14px; font-weight: 400;color: #333;">Comfort</span>
                                            <div class="progress" style="height: 10px;border-radius: 3px;">
                                                <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="85" class="progress-bar" role="progressbar"
                                                     style="width: 85%; background-color: #003580; height: 10px;"
                                                ></div>
                                            </div>
                                        </div>

                                        <div class="flex-fill" style="width: 20%;padding-top: 15px;">
                                            <span style="font-size: 13px; color: #838383;  padding-left: 11px; font-weight: 600;">7.7</span>
                                        </div>

                                    </div>
                                </div>
                                <!-- Ent | Middle Side Div For Guest Review -->


                                <!-- Start | Middle Side Div For Guest Review -->
                                <div class="flex-fill">
                                    <div class="d-flex">
                                        <div class="flex-fill" style="width: 80%; height: auto; padding: 0px; padding-left: 0px !important;">
                                            <span style="font-size: 14px; font-weight: 400;color: #333;"> Facilities</span>
                                            <div class="progress" style="height: 10px; border-radius: 3px;">
                                                <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar"
                                                     role="progressbar" style="width: 70%; background-color: #003580; height: 10px;"></div>
                                            </div>
                                        </div>
                                        <div class="flex-fill" style="width: 20%;padding-top: 15px;">
                                            <span style="font-size: 13px; color: #838383; padding-left: 11px; font-weight: 600;">7.5</span>
                                        </div>
                                    </div>

                                    <div class="d-flex mt-4">
                                        <div class="flex-fill" style="width: 80%; height: auto; padding: 0px; padding-left: 0px !important;">
                                            <span style="font-size: 14px; font-weight: 400;color: #333;"> Money
                                                <span style="color: #008009; font-size: 13px; font-weight: 200;"><i class="fas fa-arrow-up"></i></span>
                                            </span>
                                            <div class="progress" style="height: 10px;border-radius: 3px;">
                                                <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="85" class="progress-bar"
                                                     role="progressbar" style="width: 85%; background-color: #008009; height: 10px;"></div>
                                            </div>
                                        </div>

                                        <div class="flex-fill" style="width: 20%;padding-top: 15px;">
                                            <span style="font-size: 13px; color: #838383;  padding-left: 11px; font-weight: 600;">7.7</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- End | Middle Side Div For Guest Review -->


                                <!-- Start Right Side Div For Guest Review -->
                                <div class="flex-fill">
                                    <div class="d-flex">
                                        <div class="flex-fill" style="width: 80%; height: auto; padding: 0px; padding-left: 0px !important;">
                                            <span style="font-size: 14px; font-weight: 400;color: #333;"> Cleanliness</span>
                                            <div class="progress" style="height: 10px; border-radius: 3px;">
                                                <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar"
                                                     role="progressbar" style="width: 70%; background-color: #003580; height: 10px;"></div>
                                            </div>
                                        </div>
                                        <div class="flex-fill" style="width: 20%;padding-top: 15px;">
                                            <span style="font-size: 13px; color: #838383; padding-left: 11px; font-weight: 600;">7.5</span>
                                        </div>
                                    </div>

                                    <div class="d-flex mt-4">
                                        <div class="flex-fill" style="width: 80%; height: auto; padding: 0px; padding-left: 0px !important;">
                                            <span style="font-size: 14px; font-weight: 400;color: #333;"> Location</span>
                                            <div class="progress" style="height: 10px;border-radius: 3px;">
                                                <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="85" class="progress-bar"
                                                     role="progressbar" style="width: 85%; background-color: #003580; height: 10px;"></div>
                                            </div>
                                        </div>

                                        <div class="flex-fill" style="width: 20%;padding-top: 15px;">
                                            <span style="font-size: 13px; color: #838383; padding-left: 11px; font-weight: 600;">7.7</span>
                                        </div>
                                    </div>
                                </div>
                                <!--End Right Side Div for Guest Review -->
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <h3 style="font-size: 24px; color: #262626; font-weight: 700;" class="pt-3 mb-2">House rules</h3>
                        <div class="progress-bar-span" style="width: 100%; height: auto;background-color: #EBF3FF; padding: 15px;">
                            <!-- Start Row ONE -->
                            <div class="d-flex " style="width: 100%; height: auto; padding-top: 10px;">
                                <div class="flex-fill" style="width: 20%; height: auto;">
                                    <p><span style="padding-right: 10px;"><i class="far fa-calendar-alt"></i></span>Check-in</p>
                                </div>
                                <div class="flex-fill" style="width: 80%; height: auto;">
                                    <div> {{ hotel.check_in_time }} </div>
                                    <p style="margin-top: 10px; font-weight: 400;font-size: 14px; color: #6b6b6b;">
                                        Guests are required to show valid identity of booking during check in
                                    </p>
                                </div>
                            </div>
                            <!-- End Row ONE -->
                            <!-- Start Row two -->
                            <div class="d-flex " style="width: 100%; height: auto; padding-top: 10px;">
                                <div class="flex-fill" style="width: 20%; height: auto;">
                                    <p><span style="padding-right: 10px;"><i class="far fa-calendar-alt"></i></span>Check-out</p>
                                </div>
                                <div class="flex-fill" style="width: 80%; height: auto;">
                                    <div id="full-div-percent"> {{ hotel.check_out_time }} </div>
                                </div>
                            </div>
                            <!-- End Row two -->
                            <!-- Start Row Three -->
                            <div class="d-flex" style="width: 100%; height: auto; padding-top: 25px;">
                                <div class="flex-fill" style="width: 20%; height: auto;">
                                    <p><span style="padding-right: 10px;"><i class="fas fa-info-circle"></i></span>Cancellation</p>
                                </div>
                                <div class="flex-fill" style="width: 80%; height: auto;">
                                    <ul v-if="hotel.cancels && hotel.cancels.length > 0">
                                        <li v-for="cancel in hotel.cancels">
                                            {{ cancel.percent }} % Cancellation charge for cancel in {{ cancel.hour }} hour
                                        </li>
                                    </ul>
                                    <p v-if="!hotel.cancels && hotel.cancels.length <= 0">
                                        No Cancellation Charge
                                    </p>
                                </div>
                            </div>
                            <!-- End Row Three -->
                            <!-- Start Row Four -->
                            <div class="d-flex" style="width: 100%; height: auto; padding-top: 25px;">
                                <div class="flex-fill" style="width: 20%; height: auto;">
                                    <p><span style="padding-right: 10px;"><i class="fas fa-restroom"></i></span>Children & Beds</p>
                                </div>
                                <div class="flex-fill" style="width: 80%; height: auto;">
                                    <p v-if="hotel.child_policy === 1">  Child of any age are allowed! No Additional Charge child below 6 years </p>
                                    <p v-else>  Child are not allowed!  </p>
                                </div>
                            </div>
                            <!-- End Row Four -->

                            <!-- Start Row Six -->
                            <div class="d-flex" style="width: 100%; height: auto; padding-top: 25px;">
                                <div class="flex-fill" style="width: 20%; height: auto;">
                                    <p>
                                        <span style="padding-right: 10px;"><i class="fas fa-paw"></i></span>
                                        Pet
                                    </p>
                                </div>
                                <div class="flex-fill" style="width: 80%; height: auto;">
                                    <p v-if="hotel.pet_policy === 1" style="font-size: 15px; color: #262626;">
                                        Pets are allowed.
                                    </p>
                                    <p v-else style="font-size: 15px; color: #262626;">
                                        Pets are not allowed.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div style="width: 100%;height: auto;" v-if="hotel.faqs && hotel.faqs.length > 0">
                            <div class="d-flex" style="width: 100%;height: auto;">
                                <div class="flex-fell" style="width: 30%; height: auto; background-color: #EBF3FF; padding: 25px;">
                                    <h3 style="font-size: 23px; font-weight: 600; color: #262626;">FAQs about Laguna Beach Hotel & Resort </h3>
                                </div>
                                <div class="flex-fell" style="width: 70%; height: auto;">
                                    <span aria-label="Question Accordions" class="accordion-span clearfix mt-0">
                                        <div class="container" style="padding: 0px !important;">
                                            <div id="accordionExample" class="accordion">
                                                <div class="accordion-item"
                                                     v-for="(faq, idx) in hotel.faqs"
                                                >
                                                    <h2 id="headingOne" class="accordion-header">
                                                        <button :aria-controls="'collapse_'+idx" aria-expanded="true" class="accordion-button"
                                                                :data-bs-target="'#collapse_'+idx" data-bs-toggle="collapse" type="button">
                                                            {{ faq.question }}
                                                        </button>
                                                    </h2>
                                                    <div :id="'collapse_'+idx" aria-labelledby="headingOne" class="accordion-collapse collapse"
                                                         :class="idx === 0? 'show': ''"
                                                         data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            {{ faq.answer }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer-cart-section
            :cart="cart"
            :filter="filter"
            :hotel_id="hotel.id"
        ></footer-cart-section>
        <availability-search-modal
            :filter="filter"
        ></availability-search-modal>
    </frontend-layout>
</template>

<script>
import FrontendLayout from "../../Layouts/FrontendLayout";
import FilterForm from "@/Partials/Frontend/FilterForm";
import Swal from "sweetalert2";
import RoomItem from "../../Components/Frontend/RoomItem";
import FooterCartSection from "../../Components/Frontend/FooterCartSection";
import AvailabilitySearchModal from "../../Components/Frontend/AvailabilitySearchModal";
import Lightgallery from 'lightgallery/vue';
import lgZoom from 'lightgallery/plugins/zoom';
import lgVideo from 'lightgallery/plugins/video';

export default {
    name: "HotelDetails.vue",
    components: {
        AvailabilitySearchModal,
        FooterCartSection,
        RoomItem,
        FrontendLayout,
        FilterForm,
        Lightgallery

    },
    props: [
        'hotel',
        'landmark',
        'is_favourite',
        'filter'
    ],
    data() {
        return {
            form: this.$inertia.form({
                hotel_id: this.hotel.id,
            }),
            cart: [],
            plugins: [lgZoom, lgVideo],
        };
    },
    methods:{
        makeFavourite(user_id){
            if(this.$page.props.user){
                if(this.is_favourite == false){
                    this.form.post(route("make_favourite",user_id), {
                        preserveScroll: true,
                        forceFormData: true,
                        onSuccess() {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: "Added to favourite list successfully",
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
                                position: "top-end"
                            });
                            this.is_favourite = true;
                        },
                    });
                }else{
                    this.form.post(route("make_un_favourite",this.hotel.id), {
                        preserveScroll: true,
                        forceFormData: true,
                        onSuccess() {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: "Remove from favourite list added successfully",
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
                                position: "top-end"
                            });
                            this.is_favourite = true;
                        },
                    });
                }
            }else{
                this.form.post(route("make_favourite",user_id), {
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess() {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "You are not login. Please login first!",
                            position: "top-end"
                        });
                    },
                });
            }
        },
        openModal(){
            const modal_overlay = document.querySelector("#modal_overlay_search");
            const modal = document.querySelector("#modal_search");
            const modalCl = modal.classList;
            let overlayCl = modal_overlay;

            overlayCl.classList.remove("hidden");
            setTimeout(() => {
                modalCl.remove("opacity-0");
                modalCl.remove("-translate-y-full");
                modalCl.remove("scale-150");
            }, 100);
        },
        openNav(){
            document.getElementById("myNav").style.height = "100%";
        },
        closeNav(){
            document.getElementById("myNav").style.height = "0%";
        },
        onInit: () => {
            console.log('lightGallery has been initialized');
        },
        onBeforeSlide: () => {
            console.log('calling before slide');
        },
    }
}
</script>

<style src="../../../css/style.css"></style>
<style>
.overlay {
    height: 0%;
    width: 100%;
    position: fixed;
    z-index: 1000;
    top: 0;
    left: 0;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0, 0.9);
    overflow-y: hidden;
    transition: 0.5s;
}

.overlay-content{
    margin-top: 20px;
}
.overlay a {

    padding: 8px;
    text-decoration: none;
    font-size: 36px;
    color: #818181;
    transition: 0.3s;
}

.overlay a:hover, .overlay a:focus {
    color: #f1f1f1;
}

.overlay .closebtn {
    position: absolute;
    top: 20px;
    right: 45px;
    font-size: 60px;
}

@media screen and (max-height: 450px) {
    .overlay {overflow-y: auto;}
    .overlay a {font-size: 20px}
    .overlay .closebtn {
        font-size: 40px;
        top: 15px;
        right: 35px;
    }
}



@import 'lightgallery/css/lightgallery.css';
@import 'lightgallery/css/lg-thumbnail.css';
@import 'lightgallery/css/lg-zoom.css';
</style>

