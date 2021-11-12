<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="container mx-auto px-3">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-4 px-4 mb-5">
                    <div class="grid grid-cols-3 gap-4 md:grid-cols-4 lg:grid-cols-4">
                        <div class="w-full">
                            <div class="bg-green-600 border rounded shadow p-2">
                                <div class="flex flex-row items-center">
                                    <div class="flex-shrink pl-1 pr-4">
                                        <i class="fas fa-hotel fa-2x fa-fw fa-inverse"></i>
                                    </div>
                                    <div class="flex-1 text-right">
                                        <h5 class="text-white">Hotel Rating</h5>
                                        <h3 class="text-white text-3xl"> {{  rating.hotel_rating_count && rating.hotel_rating_count>0?(rating.total_hotel_rating / rating.hotel_rating_count).toFixed(1) : 0.0}} ({{ rating.hotel_rating_count}}) </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="bg-green-600 border rounded shadow p-2">
                                <div class="flex flex-row items-center">
                                    <div class="flex-shrink pl-1 pr-4">
                                        <i class="fad fa-person-carry fa-2x fa-fw fa-inverse"></i>
                                    </div>
                                    <div class="flex-1 text-right">
                                        <h5 class="text-white">Staff Rating</h5>
                                        <h3 class="text-white text-3xl"> {{  rating.staff_rating_count && rating.staff_rating_count>0?(rating.total_staff_rating / rating.staff_rating_count).toFixed(1) : 0.0}} ({{ rating.staff_rating_count}}) </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="bg-green-600 border rounded shadow p-2">
                                <div class="flex flex-row items-center">
                                    <div class="flex-shrink pl-1 pr-4">
                                        <i class="fas fa-wifi fa-2x fa-fw fa-inverse"></i>
                                    </div>
                                    <div class="flex-1 text-right">
                                        <h5 class="text-white">Facility Rating</h5>
                                        <h3 class="text-white text-3xl"> {{  rating.facility_rating_count && rating.facility_rating_count>0?(rating.total_facility_rating / rating.facility_rating_count).toFixed(1) : 0.0}} ({{ rating.facility_rating_count}}) </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="bg-green-600 border rounded shadow p-2">
                                <div class="flex flex-row items-center">
                                    <div class="flex-shrink pl-1 pr-4">
<!--                                        <i class="fas fa-hand-sparkles"></i>-->
                                        <i class="fas fa-hand-sparkles fa-2x fa-fw fa-inverse "></i>
                                    </div>
                                    <div class="flex-1 text-right">
                                        <h5 class="text-white">Cleanl Rating</h5>
                                        <h3 class="text-white text-3xl"> {{  rating.cleanliness_rating_count && rating.cleanliness_rating_count>0?(rating.total_cleanliness_rating / rating.cleanliness_rating_count).toFixed(1) : 0.0}} ({{ rating.cleanliness_rating_count}}) </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="bg-green-600 border rounded shadow p-2">
                                <div class="flex flex-row items-center">
                                    <div class="flex-shrink pl-1 pr-4">
                                        <i class="fas fa-bed fa-2x fa-fw fa-inverse"></i>
                                    </div>
                                    <div class="flex-1 text-right">
                                        <h5 class="text-white">Comfort Rating</h5>
                                        <h3 class="text-white text-3xl"> {{  rating.comfort_rating_count && rating.comfort_rating_count>0?(rating.total_comfort_rating / rating.comfort_rating_count).toFixed(1) : 0.0}} ({{ rating.comfort_rating_count}}) </h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full">
                            <div class="bg-green-600 border rounded shadow p-2">
                                <div class="flex flex-row items-center">
                                    <div class="flex-shrink pl-1 pr-4">
                                        <i class="fas fa-hand-holding-usd fa-2x fa-fw fa-inverse"></i>
                                    </div>
                                    <div class="flex-1 text-right">
                                        <h5 class="text-white">Price Rating</h5>
                                        <h3 class="text-white text-3xl"> {{  rating.price_rating_count && rating.price_rating_count>0?(rating.total_price_rating / rating.price_rating_count).toFixed(1) : 0.0}} ({{ rating.price_rating_count}}) </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="bg-green-600 border rounded shadow p-2">
                                <div class="flex flex-row items-center">
                                    <div class="flex-shrink pl-1 pr-4">
                                        <i class="fas fa-street-view fa-2x fa-fw fa-inverse"></i>
                                    </div>
                                    <div class="flex-1 text-right">
                                        <h5 class="text-white">Location Rating</h5>
                                        <h3 class="text-white text-3xl"> {{  rating.location_rating_count && rating.location_rating_count>0?(rating.total_location_rating / rating.location_rating_count).toFixed(1) : 0.0}} ({{ rating.location_rating_count}}) </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="bg-green-600 border rounded shadow p-2">
                                <div class="flex flex-row items-center">
                                    <div class="flex-shrink pl-1 pr-4">
                                        <i class="fas fa-star fa-2x fa-fw fa-inverse"></i>
                                    </div>
                                    <div class="flex-1 text-right">
                                        <h5 class="text-white">Overall Rating</h5>
                                        <h3 class="text-white text-3xl"> {{  rating.total_rating && rating.total_rating>0 ? (((rating.total_hotel_rating+rating.total_staff_rating+ rating.total_facility_rating +rating.total_cleanliness_rating+ rating.total_comfort_rating+ rating.total_price_rating+rating.total_location_rating)/5) / rating.total_rating).toFixed(1) : 0.0}} ({{ rating.total_rating}}) </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <welcome />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/HotelLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";

export default{
    name: 'HotelDashboard',
    props: ['rating'],
    components: {
        AppLayout,
        Welcome,
    },
};
</script>

