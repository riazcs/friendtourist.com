<template>
    <div class="d-flex justify-content-between w-full p-2 my-3 mr-4 shadow-md" style="background-color: rgba(225,232,238,.2);">
        <div class="flex-fill" style="text-align: left;">
            <h3 style="font-size: 19px; font-weight: 600; color: #333; margin-bottom: 20px;"> Option {{ index+1 }}</h3>
            <p style="color: #5d6974; font-size: 14px; margin:0px;">
                {{ schedule.refundable? 'Refundable': 'Non Refundable'}}
                <span><i class="fas fa-info-circle"></i></span>
            </p>
            <p style="color: #5d6974; font-size: 14px; margin:0px;">
                <span style="padding-right: 5px;">
                    <i class="fas fa-user-friends"></i>
                </span>
                {{ room.adult_occupancy }} , {{ room.child_occupancy }}
            </p>
            <p style="color: #5d6974; font-size: 14px;" v-if="schedule.board_type != 0">
                <span style="padding-right: 5px;">
                    <i class="fas fa-coffee"></i>
                </span>
                {{ schedule.board_label }}
            </p>
            <ul style="color: #5d6974; font-size: 14px;padding-left: 23px;">
                <li>Free cancellation</li>
            </ul>
        </div>
        <div class="flex-fill" style="text-align: right;">
            <h3 style="font-size: 19px; font-weight: 600; color: #333; margin-bottom: 20px;">
                BDT <del style="color: #5d6974;"  v-if="schedule.discount_percent > 0">{{ room.rack_price }}</del>
                {{ schedule.bar_rate }}
            </h3>
            <p style="color: #5d6974; font-size: 14px; margin:0px;">+ BDT {{ (schedule.service_charge+schedule.total_tax).toFixed(0) }}.00 VAT & Charges</p>
            <p style="color: #5d6974; font-size: 14px; margin:0px;">for per Night</p>
            <p v-if="schedule.discount_percent > 0" class="my-3"> <span style="padding: 3px 5px; background-color: #E1F3F8; border-radius: 25px; color: #0071c2; font-size: 14px;">{{ schedule.discount_percent }}% off</span></p>
<!--            <ul style="list-style: none; color: #0071c2; font-size: 14px;">-->
<!--                <li>*Additional 5% discount on selected payment methods.</li>-->
<!--            </ul>-->

            <form action="" @submit.prevent="addRoom()" v-if="!isAdded">
                <div class="d-flex justify-content-end" style="width: 100%;">
                    <div class="d-flex justify-content-end" style="padding: 0px 10px;">
                        <div style="width: 45px !important;
                                          height: 45px !important;">
                            <button type="button" class="cart-button2-style" @click.prevent="decrement()">
                                <i class="fas fa-minus-circle"></i>
                            </button>
                        </div>

                        <div style="width: 29px; height: 45px;">
                            <span id="output-area" style="padding: 10px 10px !important; font-size: 19px ; font-weight: 600; color: #333;">{{ form.room }}</span>
                        </div>

                        <div>
                            <button type="button" class="cart-button1-style"  @click.prevent="increment()">
                                <span><i class="fas fa-plus-circle"></i></span>
                            </button>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary btn-sm"> Select room</button>
                    </div>
                </div>
                <p v-if="message" class="text-red-600" v-html="message"></p>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "RoomOptionItem",
    props:['schedule', 'room', 'index', 'cart', 'room_qty'],
    data(){
        return{
            form: {
                room_id: this.room.id,
                schedule_id: this.schedule.id,
                room_name: this.room.room_name,
                bar_rate: parseFloat(this.schedule.bar_rate),
                rack_price: parseInt(this.room.rack_price),
                room: this.room_qty,
                max_allow: this.room.max_guest_allow,
            },
            message: '',
            isAdded: false,
        }
    },
    methods:{
        addRoom(){
            this.cart.push(this.form);
            // this.$emit('roomAdd', this.form)
        },
        decrement(){
            if(this.form.room > 1){
                this.form.room--;
            }
        },
        increment(){
            this.form.room++;
        },
    },
    computed:{
        checkCart(){
            return JSON.parse(JSON.stringify(this.cart))
        }
    },
    watch:{
        checkCart:{
            handler(newVal, oldVal){
                if (newVal !== oldVal){
                    this.isAdded = false;
                    if (this.cart && this.cart.length > 0){
                        this.cart.forEach((item) =>{
                            if (item.room_id == this.room.id){
                                this.isAdded = true;
                            }
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
