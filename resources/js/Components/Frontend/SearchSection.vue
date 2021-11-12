<template>
    <section class="booking-section"
             :class="route().current('index')?'':'p-0'"
    >
        <form @submit.prevent="submitSearch">
            <div class="d-flex justify-content-center flex-wrap">
                <div class="booking-container container"
                     :class="route().current('index')?'':'p-0'"
                >
                    <ul class="nav nav-tabs d-flex justify-content-center" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="hotel-tab" data-bs-toggle="tab" data-bs-target="#hotel" type="button"
                                    role="tab" aria-controls="hotel" aria-selected="false">
                                <i class="far fa-building me-2"></i><span>Hotel</span>
                            </button>
                        </li><li class="nav-item" role="presentation">
                        <button class="nav-link" id="tour-tab" data-bs-toggle="tab" data-bs-target="#tour" type="button"
                                role="tab" aria-controls="tour" aria-selected="false">
                            <i class="fas fa-road me-2"></i><span>Tour</span>
                        </button>
                    </li>
                    </ul>
                    <div class="tab-content-wrapper">
                        <div class="tab-content" id="myTabContent"
                             :class="route().current('index')?'':'tab-shadow'"
                        >
                            <div class="tab-pane fade show active" id="hotel" role="tabpanel" aria-labelledby="hotel-tab">
                                <!-- hotel booking details start -->
                                <div class="booking-wrapper d-flex justify-content-between">

                                    <div id="area" class="booking-details" style="position: relative; cursor: pointer;">
                                        <div @click.prevent="toggleSelectArea()" class="w-full block">
                                            <h5>CITY/HOTEL/RESORT/AREA</h5>
                                            <h2 class="text-sm font-semibold text-blue-900">{{ form.area.title }}</h2>
                                            <p>{{ form.area.location }}</p>
                                        </div>
                                        <div id="custom-select" v-if="areaShow" class="custom-select  bg-white shadow-md w-full block sm:absolute left-0 top-20 rounded-sm p-1" style="z-index: 999999;">
                                            <div class="mb-3 pt-0 relative">
                                                <div class="flex border-grey-light border">
                                                    <input id="areaInput" @input.prevent="searchArea($event)" class="w-full rounded ml-1" type="text" placeholder="Search..." style="border: none; outline:none;box-shadow: none;">
                                                    <button class="bg-grey-lightest border-grey border-l shadow hover:bg-grey-lightest">
                                                            <span class="w-auto flex justify-end items-center text-grey p-2 hover:text-grey-darkest">
                                                              <i class="material-icons text-xs">search</i>
                                                            </span>
                                                    </button>
                                                </div>
                                            </div>
                                            <ul  class="overflow-y-scroll w-full max-h-64 pl-1" >
                                                <li class="p-2 flex items-center justify-between cursor-pointer"
                                                    v-if="area_search_list && area_search_list.length > 0"
                                                    v-for="(search_item, index) in area_search_list"
                                                    :key="index"
                                                    @click.prevent="selectArea(index)"
                                                >
                                                    <div>
                                                        <h2 class="text-sm font-semibold text-blue-900">{{ search_item.title }}</h2>
                                                        <p class="text-sm text-blue-900" v-if="search_item.location">{{ search_item.location}}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-md font-semibold text-blue-200" v-if="search_item.type">{{ search_item.type }}</p>
                                                    </div>
                                                </li>

                                                <li v-else class="p-2 flex items-center justify-between cursor-pointer">
                                                    <div>
                                                        <h2 class="text-sm font-semibold text-blue-900">No result found</h2>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- select div-->

                                    <!--select div-->
                                    <div class="booking-details" >
                                        <label for="calender_booking" class="d-flex justify-content-between">
                                            <div class="booking-details me-2 m-0 border-0" >
                                                <h5>CHECK IN</h5>
                                                <h4>{{ form.check_in }}</h4>
                                            </div>
                                            <div class="booking-details m-0 border-0" >
                                                <h5>CHECK OUT</h5>
                                                <h4>{{ form.check_out }}</h4>
                                            </div>
                                        </label>
                                        <input type="text" id="calender_booking" class="d-none">
                                    </div>

                                    <div class="booking-details flex-sm-grow-1 flex-md-shrink-1" >
                                        <div id="roomsAndGuest">
                                            <h5>GUESTS</h5>
                                            <h4>Guests</h4>
                                            <p><span id="adultTotal">{{ form.adult }}</span> Adults, <span id="childTotal">{{ form.child }}</span> Children</p>
                                        </div>
                                    </div>
                                    <div id="bookingRooms"  v-show="guestMenu"
                                         :class="route().current('index')?'':'top-200'"
                                    >
                                        <div class="d-flex align-items-center justify-content-between mt-3 mb-4">
                                            <div>
                                                <h5>Room</h5>
                                            </div>
                                            <div>
                                                <i class="fas fa-minus" @click.prevent="decrement('room')"></i>
                                                <span id="room">{{ form.rooms }}</span>
                                                <i class="fas fa-plus" @click.prevent="increment('room')"></i>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <h5>Adult</h5>
                                                <p>12 Years+</p>
                                            </div>
                                            <div>
                                                <i class="fas fa-minus" @click.prevent="decrement('adult')"></i>
                                                <span id="adult">{{ form.adult }}</span>
                                                <i class="fas fa-plus" @click.prevent="increment('adult')"></i>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <h5>Child</h5>
                                                <p>0-12 Years</p>
                                            </div>
                                            <div>
                                                <i class="fas fa-minus" @click.prevent="decrement('child')"></i>
                                                <span id="child">{{ form.child }}</span>
                                                <i class="fas fa-plus" @click.prevent="increment('child')"></i>
                                            </div>
                                        </div>
                                        <div v-if="form.child > 0">
                                            <h5 class="mb-1">Ages</h5>
                                            <div class="grid grid-cols-4 gap-1">
                                                <select name="" required id="" v-for="i in form.child" v-model="form.childAges[i-1]" class="form-control">
                                                    <option v-for="age in 12" :value="age">{{ age }} Yr(s)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr />
                                        <p>{{ warning }}</p>
                                        <div class="d-flex align-items-center justify-content-end pb-2">
                                            <div class="done-btn" @click.prevent="hideMyGuest">
                                                Done
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- hotel booking details end -->
                            </div>
                            <div class="tab-pane fade" id="tour" role="tabpanel" aria-labelledby="tour-tab">
                                <div class="location">
                                    <div class="booking-wrapper">
                                        <div class="booking-details">
                                            <h5>LOCATION</h5>
                                            <select class="form-control js-example-tags">
                                                <option selected="selected">Dhaka</option>
                                                <option>Cox's Bazar</option>
                                                <option>Chittagong</option>
                                                <option>Rajshahi</option>
                                                <option>Khulna</option>
                                                <option>Barishal</option>
                                                <option>Syllhet</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button @click.prevent="submitSearch" class="search" >Search</button>
            </div>
        </form>
    </section>
</template>

<script>
export default {
    name: "SearchSection",
    data(){
        return{
            form: this.$inertia.form({
                area: {
                    title: "Cox's Bazar",
                    location: 'Bangladesh',
                    type: 'district'
                },
                check_in: '',
                check_out: '',
                adult: 2,
                child: 0,
                children:{},
                rooms: 1,
                childAges:[],
            }),
            guestMenu: false,
            datepicker: null,
            today: new Date(),
            areaShow: false,
            area_search_list:[],
            timeout: {},
            warning: ""
        }
    },
    created() {
        this.form.check_in = fecha.format(this.today, "D MMM, YYYY");
        this.form.check_out = fecha.format(this.today.setDate(this.today.getDate() + 1)  , "D MMM, YYYY");
    },
    mounted() {
        var $that = this;
        var input = document.getElementById('calender_booking');
        this.datepicker = new HotelDatepicker(input, {
            showTopbar: true,
            separator: '/',
            minNights: 1,
            onSelectRange: function() {
                let selectedDate = input.value.split('/');
                let startDate = selectedDate[0];
                let endDate = selectedDate[1];
                $that.form.check_in = fecha.format(fecha.parse(startDate, 'YYYY-MM-DD'), "D MMM, YYYY");
                $that.form.check_out = fecha.format(fecha.parse(endDate, 'YYYY-MM-DD'), "D MMM, YYYY");
            }
        });

        var ignoreClickOnMeElement = document.getElementById('roomsAndGuest');
        var ignoreClickOnMeElement2 = document.getElementById('bookingRooms');
        document.addEventListener('click', function(event) {
            var isClickInsideElement = ignoreClickOnMeElement.contains(event.target);
            var isClickInsideElement2 = ignoreClickOnMeElement2.contains(event.target);
            if (isClickInsideElement) {
                $that.guestMenu = true;
            }
            else if(!isClickInsideElement2) {
                if($that.form.child > $that.form.childAges.length ){
                    $that.guestMenu = true;
                    $that.warning = 'Please Insert All The Child Ages';
                }
                else {
                    $that.guestMenu = false;
                }

            }
        });
    },
    methods:{
        submitSearch(){
            this.form.get(route("search.hotels"));
        },
        decrement(type){
            if(type === 'adult'){
                if(this.form.adult > 1){
                    this.form.adult--;
                }
            }

            if(type === 'room'){
                if(this.form.rooms > 1){
                    this.form.rooms--;
                }
            }

            if(type === 'child'){
                if(this.form.child > 0){
                    this.form.child--;
                }
            }
        },
        increment(type){
            if(type === 'adult'){
                this.form.adult++;
            }

            if(type === 'room'){
                this.form.rooms++;
            }

            if(type === 'child' && this.form.child < this.form.rooms *4){
                this.form.child++;
            }else{

            }
        },
        toggleSelectArea(){
            this.areaShow = !this.areaShow;
            setTimeout(()=>{
                if(this.areaShow && document.getElementById("areaInput")){
                    document.getElementById("areaInput").focus();
                }
            }, 500);
        },
        searchArea(e){
            let $that = this;
            axios.post(route('search.area_info'), {'search_key': e.target.value})
                .then((response) =>{
                    if(response.data.status == 200){
                        console.log(response.data);
                        $that.area_search_list = response.data.data;
                    }else{
                        $that.area_search_list = [];
                    }
                }).catch((error)=>{
                console.log(error);
                $that.area_search_list = [];
            });

        },
        selectArea(idx){
            this.form.area = this.area_search_list[idx];
            this.areaShow = false;
        },
        hideMyGuest(){
            if(this.form.child > this.form.childAges.length ){
                this.guestMenu = true;
                this.warning = 'Please Insert All The Child Ages';
            } else {
                this.guestMenu =  false;
            }
        },
    }
}
</script>

<style scoped>
.tab-shadow{
    -webkit-box-shadow: 5px 6px 20px 6px rgb(0 0 0 / 20%);
    box-shadow: 5px 6px 20px 6px rgb(0 0 0 / 20%);
}
.top-200{
    top: 200px!important;
}
.search:hover {
    background-color: #e3b903;
}
.search {
    padding: 12px 40px;
    background-color: #fccd03;
    display: inline;
    border-radius: 10px;
    z-index: 0;
    font-weight: 700;
    font-size: 16px;
    margin-top: -20px;
    border: none;
    cursor: pointer;
}
</style>
