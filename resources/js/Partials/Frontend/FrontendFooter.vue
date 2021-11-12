<template>
    <footer>
        <div class="container">
            <div class="row gx-5 footer-wrapper">
                <div class="col-md-3 pb-2">
                    <h5>Discover</h5>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="footer-p">
                            <p><a href="">Home</a></p>
                            <p><Link  :href="route('get_policy','terms')">Terms</Link></p>
                            <p><a :href="route('get_policy','career')">Career</a></p>
                        </div>
                        <div class="footer-p">
                            <p><Link  :href="route('get_policy','refund_policy')">Refund Policy</Link></p>
                            <p><Link  :href="route('get_policy','emi_policy')">EMI Policy</Link></p>
                            <p><Link  :href="route('get_policy','privacy_policy')">Privacy Policy</Link></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 pb-2">
                    <h5>Payment Methods</h5>
                    <div class="mt-2">
                        <img src="/template/assets/icon-footer-visa.0cc68109.svg" width="40" alt="">
                        <img src="/template/assets/icon-footer-amex.6eb94277.svg" width="40" alt="">
                        <img src="/template/assets/icon-payment-dbbl.0975a769.svg" width="40" alt="">
                        <img src="/template/assets/icon-footer-mastercard.afdd5b7f.svg" width="40" alt="">
                    </div>
                    <div class="mt-2">
                        <img src="/template/assets/icon-payment-nagad.2e467251.svg" width="40" alt="">
                        <img src="/template/assets/icon-payment-upay.1b608ec0.svg" width="40" alt="">
                        <img src="/template/assets/icon-footer-bkash.a929cde0.svg" width="40" alt="">
                    </div>

                </div>
                <div class="col-md-3 pb-2">
                    <h5>Need Help?</h5>
                    <div class="mt-2 footer-p">
                        <p>We are Always here for you! Knock us on Messenger anytime or Call our Hotline (10AM - 10PM)</p>
                    </div>
                </div>
                <div class="col-md-3 pb-2">
                    <div class="mb-4 footer-p">
                        <h5>Contact</h5>
                        <p>info@xyz.com</p>
                        <p>+88 012345678</p>
                    </div>
                    <div class="footer-icon d-flex">
                        <Link v-if="$page.props.facebook" :href="$page.props.facebook.data"><i class="fab fa-facebook-f"></i></Link>
                        <Link v-if="$page.props.youtube" :href="$page.props.youtube.data"><i class="fab fa-youtube"></i></Link>
                        <Link v-if="$page.props.instagram" :href="$page.props.instagram.data"><i class="fab fa-instagram"></i></Link>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <hr>
            <div class="d-md-flex flex-sm-col justify-content-between">
                <div class="pb-2">
                    <a href="#">
                        <img id="footer-logo" src="/template/assets/logo-text-white.png" height="40" alt="">
                    </a>
                </div>
                <div class="text-md-end footer-p">
                    <p> &copy; Copyright FriendTourist.com</p>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
    import {Link} from "@inertiajs/inertia-vue3";
    import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo";
export default {
    name: "FrontendFooter",
    components: {
        Link,
    },

}
</script>

<style scoped>
img{
    display: inline;
    padding: 2px;
}
#footer-logo{
    width: 20vw;
}
</style>
