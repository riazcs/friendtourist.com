<template>
    <div
        class="left-content-two w-full h-auto p-2 mt-2 rounded-md shadow-lg bg-blue-200">
        <form @submit.prevent="submitSearch">
            <!-- Input Fild -->
            <div class="form-group">
                <label>Destination/property name:</label>
                <div @click.prevent="handleSearch" id="custom-field" style="background-color: #fff; padding: 10px 10px; cursor: pointer;">
                    <h5 style="font-size: 14px; font-weight: 500;">{{ form.area.title }}</h5>
                    <p style="font-size: 12px; font-weight: 400; margin: -5px 0;">{{ form.area.location }}</p>
                </div>
                <!-- select dropdown area-->
                <div id="custom-select" v-show="searchArea"  class="px-2 shadow-lg" style=" z-index: 99; background-color: rgb(255, 255, 255); position: absolute;">
                    <div class="mb-3">
                        <div class="relative d-flex" style="border-bottom: 1px solid rgb(216, 216, 216)">
                            <span class="m-2"><i class="fas fa-search"></i></span>
                            <input
                                @input.prevent="searchQuery($event)"
                                style="height: 40px;"
                                id="myInput"
                                type="text"
                                autocomplete="off"
                                placeholder="Type to Search"
                            />
                        </div>
                    </div>
                    <ul id="myUL" class="p-1 w-100" style="overflow-y: scroll; max-height: 100px;" >
                        <li style="color:#262626; padding: 4px 5px;" class="d-flex justify-content-between align-items-center"
                            v-if="area_search_list && area_search_list.length > 0"
                            v-for="(search_item, index) in area_search_list"
                            :key="index"
                            @click.prevent="selectArea(index)"
                        >
                            <div>
                                <h5 style="font-size: 14px; font-weight: 500;">{{ search_item.title }}</h5>
                                <p style="font-size: 12px; font-weight: 400; margin: 0px 0;">{{ search_item.location}}</p>
                            </div>
                            <div>
                                <p class="text-md font-semibold text-blue-200">{{ search_item.type }}</p>
                            </div>
                        </li>
                        <li v-else style="color:#262626; padding: 4px 5px;" class="d-flex justify-content-between align-items-center">
                            <p>No Result Found</p>
                        </li>


                    </ul>
                </div>
            </div>

            <label for="booking_calender" class="w-full">
                <!-- Input Fild -->
                <div class="form-group pt-1">
                    <label for="booking_calender">Check-in date</label>
                    <div class="w-full h-8 bg-white px-2 flex items-center">{{ form.check_in }}</div>
                </div>

                <!-- Input Fild -->
                <div class="form-group pt-1">
                    <label for="booking_calender">Check-out date</label>
                    <div class="w-full h-8 bg-white px-2 flex items-center">{{ form.check_out }}</div>
                </div>
                <input
                    type="text"
                    class="form-control d-none"
                    id="booking_calender"
                    aria-describedby="emailHelp"
                    placeholder="E.g. Japan, Boston, Europe"
                />
            </label>

            <!-- Input Fild -->
            <div class="form-group">
                <label for="Adult">Adult</label>
                <input
                    type="text"
                    class="form-control"
                    id="Adult"
                    aria-describedby=""
                    placeholder="2 Adult"
                    v-model="form.adult"
                />
            </div>

            <div class="row">
                <div class="col-md-6 pt-1">
                    <!-- Input Fild -->
                    <div class="form-group">
                        <label for="Child">Child</label>
                        <input
                            type="number"
                            min="0"
                            :max="6 * form.rooms"
                            class="form-control"
                            id="Child"
                            aria-describedby=""
                            placeholder="No Child"
                            v-model="form.child"
                        />
                    </div>
                </div>

                <div class="col-md-6 pt-1">
                    <!-- Input Fild -->
                    <div class="form-group">
                        <label for="rooms">Rooms</label>
                        <input
                            type="number"
                            class="form-control"
                            id="rooms"
                            aria-describedby=""
                            placeholder="1 Room"
                            v-model="form.rooms"
                            min="1"
                        />
                    </div>
                </div>

            </div>
            <div class="row">
                <div v-if="form.child > 0" v-for="i in form.child" class="col-md-6 pt-1">
                    <!-- Input Fild -->
                    <div class="form-group">
                        <label for="Child">Child {{ i }} Age</label>
                        <select
                            type="number"
                            min="0"
                            class="form-control"
                            id="Child"
                            aria-describedby=""
                            placeholder="Child Age"
                            required
                            v-model="form.childAges[i-1]"
                        >
                            <option v-for="i in 12" :key="i" :value="i" > {{ i }} </option>
                        </select>
                    </div>
                </div>


            </div>

            <div class="form-group py-2 px-4">
                <button type="submit" class="btn btn-lg btn-warning btn-block w-full">Submit</button>
            </div>
        </form>
    </div>

<!--    <div-->
<!--        class=""-->
<!--        title="Check Location"-->
<!--        style="width: 100%; height: auto; margin-top: 15px"-->
<!--    >-->
<!--        <div class="card bg-light">-->
<!--            <div class="card-header">-->
<!--                <h5>Filter by:</h5>-->
<!--            </div>-->
<!--            <div class="card-body">-->
<!--                <h6 class="card-title">Your budget (per night)</h6>-->

<!--                <span><small>Set your own budget</small></span>-->

<!--                <ul style="list-style: none; padding: 0px">-->
<!--                    <li>-->
<!--                        <div-->
<!--                            class="form-check form-check-inline"-->
<!--                            style="padding-top: 10px"-->
<!--                        >-->
<!--                            <input-->
<!--                                class="form-check-input"-->
<!--                                type="checkbox"-->
<!--                                id="inlineCheckbox1"-->
<!--                                value="option1"-->
<!--                            />-->
<!--                            <label class="form-check-label" for="inlineCheckbox1"-->
<!--                            ><small>BDT 0 - BDT 245</small></label-->
<!--                            >-->
<!--                        </div>-->
<!--                    </li>-->

<!--                    <li>-->
<!--                        <div class="form-check form-check-inline">-->
<!--                            <input-->
<!--                                class="form-check-input"-->
<!--                                type="checkbox"-->
<!--                                id="inlineCheckbox1"-->
<!--                                value="option1"-->
<!--                            />-->
<!--                            <label class="form-check-label" for="inlineCheckbox1"-->
<!--                            ><small>BDT 245 - BDT 490</small></label-->
<!--                            >-->
<!--                        </div>-->
<!--                    </li>-->

<!--                    <li>-->
<!--                        <div class="form-check form-check-inline">-->
<!--                            <input-->
<!--                                class="form-check-input"-->
<!--                                type="checkbox"-->
<!--                                id="inlineCheckbox1"-->
<!--                                value="option1"-->
<!--                            />-->
<!--                            <label class="form-check-label" for="inlineCheckbox1"-->
<!--                            ><small>BDT 490 - BDT 735</small></label-->
<!--                            >-->
<!--                        </div>-->
<!--                    </li>-->

<!--                    <li>-->
<!--                        <div class="form-check form-check-inline">-->
<!--                            <input-->
<!--                                class="form-check-input"-->
<!--                                type="checkbox"-->
<!--                                id="inlineCheckbox1"-->
<!--                                value="option1"-->
<!--                            />-->
<!--                            <label class="form-check-label" for="inlineCheckbox1"-->
<!--                            ><small>BDT 735 - BDT 980</small></label-->
<!--                            >-->
<!--                        </div>-->
<!--                    </li>-->

<!--                    <li>-->
<!--                        <div class="form-check form-check-inline">-->
<!--                            <input-->
<!--                                class="form-check-input"-->
<!--                                type="checkbox"-->
<!--                                id="inlineCheckbox1"-->
<!--                                value="option1"-->
<!--                            />-->
<!--                            <label class="form-check-label" for="inlineCheckbox1"-->
<!--                            ><small>BDT 980+</small></label-->
<!--                            >-->
<!--                        </div>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
</template>

<script>
export default {
    name: "FilterForm",
    props:['filter'],
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
                rooms: 1,
                childAges: [],
            }),
            datepicker: {},
            searchArea: false,
            area_search_list : [],

        }
    },
    mounted() {

        let $that = this;
        let today= new Date();
        if (this.filter) {
            if (this.filter.area) {
                this.form.area = this.filter.area;
            }
            if (this.filter.check_in) {
                this.form.check_in = this.filter.check_in;
            }else{
                this.form.check_in = fecha.format(today, "D MMM, YYYY");
            }
            if (this.filter.check_out) {
                this.form.check_out = this.filter.check_out;
            }else{
                let today= new Date();
                this.form.check_out = fecha.format(today.setDate(new Date().getDate() + 1)  , "D MMM, YYYY");
            }
            if (this.filter.adult) {
                this.form.adult = this.filter.adult;
            }
            if (this.filter.child) {
                this.form.child = this.filter.child;
            }
            if (this.filter.childAges) {
                this.form.childAges = this.filter.childAges;
            }
            if (this.filter.rooms) {
                this.form.rooms = this.filter.rooms;
            }
        }

        this.initCalender();

        var ignoreClickOnMeElement = document.getElementById('custom-field');
        var ignoreClickOnMeElement2 = document.getElementById('custom-select');
        document.addEventListener('click', function(event) {
            var isClickInsideElement = ignoreClickOnMeElement.contains(event.target);
            var isClickInsideElement2 = ignoreClickOnMeElement2.contains(event.target);
            if (isClickInsideElement) {
                $that.searchArea = true;
            }
            else if(!isClickInsideElement2) {
                if($that.form.child > $that.form.childAges.length ){
                    $that.searchArea = true;
                    $that.warning = 'Please Insert All The Child Ages';
                }
                else {
                    $that.searchArea = false;
                }

            }
        });

    },
    methods:{
        initCalender(){
            var $that = this;
            var input = document.getElementById('booking_calender');
            this.datepicker = new HotelDatepicker(input, {
                showTopbar: true,
                separator: '/',
                minNights: 1,
                autoClose: true,
                onSelectRange: function() {
                    let selectedDate = input.value.split('/');
                    let startDate = selectedDate[0];
                    let endDate = selectedDate[1];
                    $that.form.check_in = fecha.format(fecha.parse(startDate, 'YYYY-MM-DD'), "D MMM, YYYY");
                    $that.form.check_out = fecha.format(fecha.parse(endDate, 'YYYY-MM-DD'), "D MMM, YYYY");
                }
            });
        },
        submitSearch(){
            this.form.get(route("search.hotels"));
        },
        handleSearch(){
            this.searchArea = true;
        },
        searchQuery(e){
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
            this.searchArea = false;
        },
    }
}
</script>

<style scoped>

</style>
