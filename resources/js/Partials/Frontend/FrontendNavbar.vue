<template>
    <nav id="nav-bar" class="sticky-top nav-transparent">
        <div class="menu container  d-flex align-items-center justify-content-between">
            <a href="#logo-color">
                <img id="logo-color" src="template/assets/logo-text.png" width="auto" height="50" alt="">
                <img id="logo-white" src="template/assets/logo-text-white.png" width="auto" height="50" alt="">
            </a>
            <div id="nav-bar-menu" class="d-flex align-items-center nav-bar-menu">
                <div><a href="#"><i class="far fa-building me-2"></i><span>Hotel</span></a></div>
                <div><a href="#"><i class="fas fa-road me-2"></i><span>Tour</span></a></div>
            </div>
            <div v-if="$page.props.user" class="profile-dropdown">
                <div class="dropbtn" style="display:flex; gap: 10px; align-items: center;">
                    <div class="profile-img">
                        <i class="fas fa-user-alt"></i>
                    </div>
                    <div>
                        <i style="color: rgb(211, 211, 211)" class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div id="myDropdown" class="dropdown-content">
                    <Link  @click="this.$inertia.get(route('profile.show'))">
                        <i class="fas fa-user-alt" style="padding-right: 8px  ;"></i>
                        <span>Profile</span>
                    </link>
                    <Link :href="route('user.booking.list')">
                        <i class="fas fa-tag" style="padding-right: 8px  ;"></i>
                        <span>My Booking</span>
                    </link>
                    <Link :href="route('hotel_favourite_list')">
                        <i class="fas fa-heart" style="padding-right: 8px  ;"></i>
                        <span>My favourite list</span>
                    </link>
                    <Link :href="route('user.rating.index')">
                        <i class="far fa-smile" style="padding-right: 8px  ;"></i>
                        <span>My Review list</span>
                    </link>
                    <Link  @click="this.$inertia.post(route('logout'))">
                        <i class="fas fa-sign-out-alt" style="padding-right: 8px  ;"></i>
                        <span>Logout</span>
                    </link>
                </div>
            </div>
            <div v-else class="sign-in">
                <Link :href="route('login')">Sign In</Link>
            </div>
        </div>
    </nav>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";

export default {
    name: "FrontendNavbar",
    // props: {
    //     canLogin: Boolean
    // },
    components:{Link},
    created () {
        window.addEventListener('scroll', this.handleScroll);
    },
    destroyed () {
        window.removeEventListener('scroll', this.handleScroll);
    },
    methods: {
        favourite_list(){
            this.$inertia.get(route("hotel_favourite_list"));
        },
        handleScroll(e){
            let nav = document.getElementById('nav-bar');
            let navBarMenu = document.getElementById('nav-bar-menu');
            let logoColor = document.getElementById('logo-color');
            let logoWhite = document.getElementById('logo-white');
            window.onscroll = function () {
                "use strict";
                if (document.body.scrollTop >= 10 || document.documentElement.scrollTop >= 10 && window.screen.width >= 768) {
                    nav.classList.add("nav-colored");
                    nav.classList.remove("nav-transparent");
                    navBarMenu.classList.remove('nav-bar-menu')
                    logoColor.style.display = "block";
                    logoWhite.style.display = "none";

                }else {
                    if (document.body.scrollTop >= 10 || document.documentElement.scrollTop >= 10 && window.screen.width <= 768) {
                        navBarMenu.classList.add('nav-bar-menu')
                        nav.classList.remove("nav-transparent");
                        nav.classList.add("nav-colored");
                        logoColor.style.display = "block";
                        logoWhite.style.display = "none";
                    } else {
                        navBarMenu.classList.add('nav-bar-menu')
                        nav.classList.add("nav-transparent");
                        nav.classList.remove("nav-colored");
                        logoColor.style.display = "none";
                        logoWhite.style.display = "block";
                    }
                }
            };
        }
    }
}
</script>

<style scoped>
#logo-white{
    display: inline;
    width: 20vw;
}
#logo-color{
    display: none;
    width: 20vw;
}
.profile-dropdown {
    position: relative;
    display: block;
}

.profile-img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    overflow: hidden;
    background-color: rgb(233, 241, 255);
    display: flex;
    justify-content: center;
    align-items: center;
}

.profile-img i {
    font-size: 18px;
    color: #33C2D2;
}

.dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background-color: #ffffff;
    min-width: 160px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    border-radius: 5px;
}

.profile-dropdown:hover .dropdown-content {
    display: block;
}




.dropdown-content a {
    color: rgb(146, 146, 146);
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content i {
    font-size: 12px;
}

.dropdown-content a:hover {
    background-color: rgb(213, 228, 255);
    color: #4f5bff;
}


</style>
