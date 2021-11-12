<template>
    <div v-if="$page.props.flash.success || $page.props.flash.error">
        <action-message :on="$page.props.flash.success">
            <div class="bg-green-300 border-t-4 border-green-500 rounded-b text-white px-4 py-3 mx-6 mt-3 shadow-md" role="alert">
                <div class="flex items-center">
                    <div class="py-1 w-8"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                    <div class="text-left flex-grow font-bold">{{ $page.props.flash.success}}</div>
                    <button type="button" class="close text-right w-5" aria-label="Close" @click.prevent="closeAlertMsg">
                        <span aria-hidden="true" class="text-white font-weight-bold">&times;</span>
                    </button>
                </div>
            </div>
        </action-message>
        <action-message :on="$page.props.flash.error">
            <div class="bg-red-300 border-t-4 border-red-500 rounded-b text-white px-4 py-3 mx-6 mt-3 shadow-md" role="alert">
                <div class="flex items-center">
                    <div class="py-1 w-8"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                    <div class="text-left flex-grow"> {{ $page.props.flash.error}}</div>
                    <button type="button" class="close w-5" data-dismiss="modal" @click.prevent="closeAlertMsg">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </action-message>
        <action-message :on="$page.props.flash.warning">
            <div class="bg-yellow-300 border-t-4 border-yellow-500 rounded-b text-white px-4 py-3 mx-6 mt-3 shadow-md" role="alert">
                <div class="flex items-center">
                    <div class="py-1 w-8"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                    <div class="text-left flex-grow">{{ $page.props.flash.warning}}</div>
                    <button type="button" class="close w-5" data-dismiss="modal" @click.prevent="closeAlertMsg">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </action-message>

<!--        <div class="bg-yellow-300 border-t-4 border-yellow-500 rounded-b text-white px-4 py-3 mx-6 mt-3 shadow-md" role="alert">-->
<!--            <div class="flex">-->
<!--                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>-->
<!--                <div>-->
<!--                    <p class="font-bold">Our privacy policy has changed</p>-->
<!--                    <p class="text-sm">Make sure you know how these changes affect you.</p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</template>

<script>
import ActionMessage from "@/Jetstream/ActionMessage";
export default {
    name: "AlertMessage",
    components:{
        ActionMessage,
    },
    methods:{
        closeAlertMsg: function () {
            this.$page.props.flash.success = null;
            this.$page.props.flash.error = null;
        }
    },
    watch:{
        '$page.props.flash':{
            handler(newVal, oldVal){
                if (newVal !== oldVal){
                    setTimeout(()=>{
                        this.closeAlertMsg();
                    },2000);
                }
            }
        }
    }
}
</script>

<style scoped>

</style>
