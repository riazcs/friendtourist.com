<template>
    <div class="nav-span">
        <div class="nav-container">
            <div class="nav-extend">
                <Link :href="route('index')">
                <div>
                    <img :src="route('index')+'/template/assets/logo-text.png'" style=" width: auto; height: 50px;" alt="logo" />
                </div>
                </Link>
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
                <div v-else class="sign-in-extend">
                    <Link :href="route('login')">Sign In</Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";
export default {
    name: "FrontendHeaderFixed",
    components: {
        Link,
    }

}
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Lato:wght@100;300;700&display=swap");
/* *,
*::after,
*::before {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
    color: #262626;
    font-family: "Poppins", sans-serif;
    font-size: 15px;
    font-weight: 1.5em;
    margin: 0;
  } */
.nav-extend link {
    color:  #1c3c6b;
    text-decoration: none;
    display: inline-block ;
}

.nav-extend {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
}

.nav-container {
    padding: 0 10px;
    margin: 0 auto;
}

.nav-span {

    width: 100%;
    background-color: #fff;
    box-shadow: 0 10px 6px -6px rgba(0, 0, 0, 0.2);
}

.sign-in-extend a {
    padding: 14px 40px;
    background-color: #fccd03;
    border-radius: 5px;
    font-weight: 700;
    font-size: 16px;
    border: none;
    cursor: pointer;
    align-items: center;
    justify-content: center;
    display: inline;
    text-decoration: none;
    color: #000!important;
}

.sign-in-extend a:hover {
    background-color: #e0b700;
}

.nav-menu-extend {
    display: flex;
    font: 16px;
    margin-left: -56px;
    color: #1c3c6b;

}

.nav-menu-item {
    padding: 10px 34px;
}



.nav-menu-item a {
    color: #1c3c6b;
}

.nav-menu-item i{
    margin-right: 10px;
}

.nav-menu-item span {
    font-size: 18px;
    font-weight: 700;
}

.nav-menu-item a:hover {
    color: #1f56a8;
}
@media (min-width: 1200px) {
    .nav-container {
        max-width: 1070px;
    }
}

@media (max-width: 768px) {
    .nav-menu-extend {
        display: none;
    }
}

@media (max-width: 440px) {
    .sign-in-extend a {
        padding: 10px 12px;
        background-color: #fccd03;
        border-radius: 5px;
        font-weight: 700;
        font-size: 14px;
        border: none;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        display: inline-block;
        text-decoration: none;
        color: #000!important;
    }
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


