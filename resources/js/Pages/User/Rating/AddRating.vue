<template>
    <frontend-layout title="Booking List">
        <div class="container py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <form action="" @submit.prevent="submit()">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-2 sm:px-6 bg-gray-100">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Review & Rating
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                Please share your review with us for improvement.
                            </p>
                        </div>
                        <div class="border-t border-gray-200">
                            <div class="bg-white border-bottom px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <label class="text-lg font-bold flex items-center">
                                    Overall Hotel Rating <b class="text-lg text-red-700">*</b>
                                </label>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <div class="grid grid-cols-5 gap-4">
                                        <!-- Active: "ring-2 ring-indigo-500" -->
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-red-700 focus:outline-none sm:flex-1 bg-white text-red-600 cursor-pointer"
                                               :class="form.hotel_rating == 1 ? 'opacity-100': 'opacity-50'"
                                               for="hotel_rating1"
                                        >
                                            <input type="radio"  name="hotel_rating" v-model="form.hotel_rating" id="hotel_rating1" value="1" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 47%">1</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-yellow-600 focus:outline-none sm:flex-1 bg-white text-yellow-700 cursor-pointer"
                                               :class="form.hotel_rating == 2 ? 'opacity-100': 'opacity-50'"
                                               for="hotel_rating2"
                                        >
                                            <input type="radio"  name="hotel_rating" v-model="form.hotel_rating" id="hotel_rating2" value="2" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">2</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-yellow-500 focus:outline-none sm:flex-1 bg-white text-yellow-600 cursor-pointer"
                                               :class="form.hotel_rating == 3 ? 'opacity-100': 'opacity-50'"
                                               for="hotel_rating3"
                                        >
                                            <input type="radio"  name="hotel_rating" v-model="form.hotel_rating" id="hotel_rating3" value="3" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">3</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-blue-700 focus:outline-none sm:flex-1 bg-white text-blue-600 cursor-pointer"
                                               :class="form.hotel_rating == 4 ? 'opacity-100': 'opacity-50'"
                                               for="hotel_rating4"
                                        >
                                            <input type="radio"  name="hotel_rating" v-model="form.hotel_rating" id="hotel_rating4" value="4" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">4</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-green-700 focus:outline-none sm:flex-1 bg-white text-green-600 cursor-pointer"
                                               :class="form.hotel_rating == 5 ? 'opacity-100': 'opacity-50'"
                                               for="hotel_rating5"
                                        >
                                            <input type="radio"  name="hotel_rating" v-model="form.hotel_rating" id="hotel_rating5" value="5" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">5</span>
                                            </p>
                                        </label>
                                    </div>
                                </dd>
                            </div>
                            <div class="bg-gray-50 border-bottom px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <label for="review" class="text-lg font-bold flex items-center">
                                    Review/Suggetion <b class="text-lg text-red-700">*</b>
                                </label>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <textarea id="review" v-model="form.review" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Enter your review"></textarea>
                                </dd>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow overflow-hidden sm:rounded-lg my-5">
                        <div class="px-4 py-2 sm:px-6 bg-gray-100">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Specific Service Rating
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                you can give us rating in specific service but it is optional
                            </p>
                        </div>
                        <div class="border-t border-gray-200">
                            <div class="bg-gray-50 border-bottom px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <label class="text-lg font-bold flex items-center">
                                    Staff Rating
                                </label>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <div class="grid grid-cols-5 gap-4">
                                        <!-- Active: "ring-2 ring-indigo-500" -->
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-red-700 focus:outline-none sm:flex-1 bg-white text-red-600 cursor-pointer"
                                               :class="form.staff_rating == 1 ? 'opacity-100': 'opacity-50'"
                                               for="staff_rating1"
                                        >
                                            <input type="radio"  name="staff_rating" v-model="form.staff_rating" id="staff_rating1" value="1" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 47%">1</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-yellow-600 focus:outline-none sm:flex-1 bg-white text-yellow-700 cursor-pointer"
                                               :class="form.staff_rating == 2 ? 'opacity-100': 'opacity-50'"
                                               for="staff_rating2"
                                        >
                                            <input type="radio"  name="staff_rating" v-model="form.staff_rating" id="staff_rating2" value="2" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">2</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-yellow-500 focus:outline-none sm:flex-1 bg-white text-yellow-600 cursor-pointer"
                                               :class="form.staff_rating == 3 ? 'opacity-100': 'opacity-50'"
                                               for="staff_rating3"
                                        >
                                            <input type="radio"  name="staff_rating" v-model="form.staff_rating" id="staff_rating3" value="3" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">3</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-blue-700 focus:outline-none sm:flex-1 bg-white text-blue-600 cursor-pointer"
                                               :class="form.staff_rating == 4 ? 'opacity-100': 'opacity-50'"
                                               for="staff_rating4"
                                        >
                                            <input type="radio"  name="staff_rating" v-model="form.staff_rating" id="staff_rating4" value="4" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">4</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-green-700 focus:outline-none sm:flex-1 bg-white text-green-600 cursor-pointer"
                                               :class="form.staff_rating == 5 ? 'opacity-100': 'opacity-50'"
                                               for="staff_rating5"
                                        >
                                            <input type="radio"  name="staff_rating" v-model="form.staff_rating" id="staff_rating5" value="5" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">5</span>
                                            </p>
                                        </label>
                                    </div>
                                </dd>
                            </div>
                            <div class="bg-white border-bottom px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <label class="text-lg font-bold flex items-center">
                                    Facility Rating
                                </label>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <div class="grid grid-cols-5 gap-4">
                                        <!-- Active: "ring-2 ring-indigo-500" -->
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-red-700 focus:outline-none sm:flex-1 bg-white text-red-600 cursor-pointer"
                                               :class="form.facility_rating == 1 ? 'opacity-100': 'opacity-50'"
                                               for="facility_rating1"
                                        >
                                            <input type="radio"  name="facility_rating" v-model="form.facility_rating" id="facility_rating1" value="1" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 47%">1</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-yellow-600 focus:outline-none sm:flex-1 bg-white text-yellow-700 cursor-pointer"
                                               :class="form.facility_rating == 2 ? 'opacity-100': 'opacity-50'"
                                               for="facility_rating2"
                                        >
                                            <input type="radio"  name="facility_rating" v-model="form.facility_rating" id="facility_rating2" value="2" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">2</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-yellow-500 focus:outline-none sm:flex-1 bg-white text-yellow-600 cursor-pointer"
                                               :class="form.facility_rating == 3 ? 'opacity-100': 'opacity-50'"
                                               for="facility_rating3"
                                        >
                                            <input type="radio"  name="facility_rating" v-model="form.facility_rating" id="facility_rating3" value="3" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">3</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-blue-700 focus:outline-none sm:flex-1 bg-white text-blue-600 cursor-pointer"
                                               :class="form.facility_rating == 4 ? 'opacity-100': 'opacity-50'"
                                               for="facility_rating4"
                                        >
                                            <input type="radio"  name="facility_rating" v-model="form.facility_rating" id="facility_rating4" value="4" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">4</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-green-700 focus:outline-none sm:flex-1 bg-white text-green-600 cursor-pointer"
                                               :class="form.facility_rating == 5 ? 'opacity-100': 'opacity-50'"
                                               for="facility_rating"
                                        >
                                            <input type="radio"  name="facility_rating" v-model="form.facility_rating" id="facility_rating" value="5" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">5</span>
                                            </p>
                                        </label>
                                    </div>
                                </dd>
                            </div>
                            <div class="bg-gray-50 border-bottom px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <label class="text-lg font-bold flex items-center">
                                    Cleanliness Rating
                                </label>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <div class="grid grid-cols-5 gap-4">
                                        <!-- Active: "ring-2 ring-indigo-500" -->
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-red-700 focus:outline-none sm:flex-1 bg-white text-red-600 cursor-pointer"
                                               :class="form.cleanliness_rating == 1 ? 'opacity-100': 'opacity-50'"
                                               for="cleanliness_rating1"
                                        >
                                            <input type="radio"  name="cleanliness_rating" v-model="form.cleanliness_rating" id="cleanliness_rating1" value="1" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 47%">1</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-yellow-600 focus:outline-none sm:flex-1 bg-white text-yellow-700 cursor-pointer"
                                               :class="form.cleanliness_rating == 2 ? 'opacity-100': 'opacity-50'"
                                               for="cleanliness_rating2"
                                        >
                                            <input type="radio"  name="cleanliness_rating" v-model="form.cleanliness_rating" id="cleanliness_rating2" value="2" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">2</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-yellow-500 focus:outline-none sm:flex-1 bg-white text-yellow-600 cursor-pointer"
                                               :class="form.cleanliness_rating == 3 ? 'opacity-100': 'opacity-50'"
                                               for="cleanliness_rating3"
                                        >
                                            <input type="radio"  name="cleanliness_rating" v-model="form.cleanliness_rating" id="cleanliness_rating3" value="3" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">3</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-blue-700 focus:outline-none sm:flex-1 bg-white text-blue-600 cursor-pointer"
                                               :class="form.cleanliness_rating == 4 ? 'opacity-100': 'opacity-50'"
                                               for="cleanliness_rating4"
                                        >
                                            <input type="radio"  name="cleanliness_rating" v-model="form.cleanliness_rating" id="cleanliness_rating4" value="4" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">4</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-green-700 focus:outline-none sm:flex-1 bg-white text-green-600 cursor-pointer"
                                               :class="form.cleanliness_rating == 5 ? 'opacity-100': 'opacity-50'"
                                               for="cleanliness_rating5"
                                        >
                                            <input type="radio"  name="cleanliness_rating" v-model="form.cleanliness_rating" id="cleanliness_rating5" value="5" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <input type="radio" name="size-choice" value="XXS" class="sr-only" aria-labelledby="size-choice-5-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">5</span>
                                            </p>
                                        </label>
                                    </div>
                                </dd>
                            </div>
                            <div class="bg-white border-bottom px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <label class="text-lg font-bold flex items-center">
                                    Comfort Rating
                                </label>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <div class="grid grid-cols-5 gap-4">
                                        <!-- Active: "ring-2 ring-indigo-500" -->
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-red-700 focus:outline-none sm:flex-1 bg-white text-red-600 cursor-pointer"
                                               :class="form.comfort_rating == 1 ? 'opacity-100': 'opacity-50'"
                                               for="comfort_rating1"
                                        >
                                            <input type="radio"  name="comfort_rating" v-model="form.comfort_rating" id="comfort_rating1" value="1" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 47%">1</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-yellow-600 focus:outline-none sm:flex-1 bg-white text-yellow-700 cursor-pointer"
                                               :class="form.comfort_rating == 2 ? 'opacity-100': 'opacity-50'"
                                               for="comfort_rating2"
                                        >
                                            <input type="radio"  name="comfort_rating" v-model="form.comfort_rating" id="comfort_rating2" value="2" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">2</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-yellow-500 focus:outline-none sm:flex-1 bg-white text-yellow-600 cursor-pointer"
                                               :class="form.comfort_rating == 3 ? 'opacity-100': 'opacity-50'"
                                               for="comfort_rating3"
                                        >
                                            <input type="radio"  name="comfort_rating" v-model="form.comfort_rating" id="comfort_rating3" value="3" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">3</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-blue-700 focus:outline-none sm:flex-1 bg-white text-blue-600 cursor-pointer"
                                               :class="form.comfort_rating == 4 ? 'opacity-100': 'opacity-50'"
                                               for="comfort_rating4"
                                        >
                                            <input type="radio"  name="comfort_rating" v-model="form.comfort_rating" id="comfort_rating4" value="4" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">4</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-green-700 focus:outline-none sm:flex-1 bg-white text-green-600 cursor-pointer"
                                               :class="form.comfort_rating == 5 ? 'opacity-100': 'opacity-50'"
                                               for="comfort_rating5"
                                        >
                                            <input type="radio"  name="comfort_rating" v-model="form.comfort_rating" id="comfort_rating5" value="5" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <input type="radio" name="size-choice" value="XXS" class="sr-only" aria-labelledby="size-choice-5-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">5</span>
                                            </p>
                                        </label>
                                    </div>
                                </dd>
                            </div>
                            <div class="bg-gray-50 border-bottom px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <label class="text-lg font-bold flex items-center">
                                    Price Rating
                                </label>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <div class="grid grid-cols-5 gap-4">
                                        <!-- Active: "ring-2 ring-indigo-500" -->
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-red-700 focus:outline-none sm:flex-1 bg-white text-red-600 cursor-pointer"
                                               :class="form.price_rating == 1 ? 'opacity-100': 'opacity-50'"
                                               for="price_rating1"
                                        >
                                            <input type="radio"  name="price_rating" v-model="form.price_rating" id="price_rating1" value="1" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 47%">1</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-yellow-600 focus:outline-none sm:flex-1 bg-white text-yellow-700 cursor-pointer"
                                               :class="form.price_rating == 2 ? 'opacity-100': 'opacity-50'"
                                               for="price_rating2"
                                        >
                                            <input type="radio"  name="price_rating" v-model="form.price_rating" id="price_rating2" value="2" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">2</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-yellow-500 focus:outline-none sm:flex-1 bg-white text-yellow-600 cursor-pointer"
                                               :class="form.price_rating == 3? 'opacity-100': 'opacity-50'"
                                               for="price_rating3"
                                        >
                                            <input type="radio"  name="price_rating" v-model="form.price_rating" id="price_rating3" value="3" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">3</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-blue-700 focus:outline-none sm:flex-1 bg-white text-blue-600 cursor-pointer"
                                               :class="form.price_rating == 4 ? 'opacity-100': 'opacity-50'"
                                               for="price_rating4"
                                        >
                                            <input type="radio"  name="price_rating" v-model="form.price_rating" id="price_rating4" value="4" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">4</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-green-700 focus:outline-none sm:flex-1 bg-white text-green-600 cursor-pointer"
                                               :class="form.price_rating == 5 ? 'opacity-100': 'opacity-50'"
                                               for="price_rating5"
                                        >
                                            <input type="radio"  name="price_rating" v-model="form.price_rating" id="price_rating5" value="5" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">5</span>
                                            </p>
                                        </label>
                                    </div>
                                </dd>
                            </div>
                            <div class="bg-white border-bottom px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <label class="text-lg font-bold flex items-center">
                                    Location Rating
                                </label>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <div class="grid grid-cols-5 gap-4">
                                        <!-- Active: "ring-2 ring-indigo-500" -->
                                        <label for="location1" class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-red-700 focus:outline-none sm:flex-1 bg-white text-red-600 cursor-pointer"
                                               :class="form.location_rating == 1 ? 'opacity-100': 'opacity-50'"
                                        >
                                            <input type="radio"  name="location_rating" v-model="form.location_rating" id="location1" value="1" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 47%">1</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center  hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-yellow-600 focus:outline-none sm:flex-1 bg-white text-yellow-700 cursor-pointer"
                                               for="location2" :class="form.location_rating == 2 ? 'opacity-100': 'opacity-50'"
                                        >
                                            <input type="radio" name="location_rating" value="2" v-model="form.location_rating" id="location2" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">2</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-yellow-500 focus:outline-none sm:flex-1 bg-white text-yellow-600 cursor-pointer"
                                               :class="form.location_rating == 3 ? 'opacity-100': 'opacity-50'"
                                               for="location3"
                                        >
                                            <input type="radio"  name="location_rating" v-model="form.location_rating" id="location3" value="3" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">3</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-blue-700 focus:outline-none sm:flex-1 bg-white text-blue-600 cursor-pointer"
                                               :class="form.location_rating == 4 ? 'opacity-100': 'opacity-50'"
                                               for="location4"
                                        >
                                            <input type="radio"  name="location_rating" v-model="form.location_rating" id="location4" value="4" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">4</span>
                                            </p>
                                        </label>
                                        <label class="group relative p-0 flex items-center justify-center hover:opacity-100 text-sm bg-transparent font-medium uppercase hover:text-green-700 focus:outline-none sm:flex-1 bg-white text-green-600 cursor-pointer"
                                               :class="form.location_rating == 5 ? 'opacity-100': 'opacity-50'"
                                               for="location5"
                                        >
                                            <input type="radio"  name="location_rating" v-model="form.location_rating" id="location5" value="5" class="sr-only" aria-labelledby="size-choice-0-label">
                                            <p>
                                                <i class="far fa-star" style="font-size: 3rem;"></i>
                                                <span class="absolute top-1/4 text-lg" style="left: 45%">5</span>
                                            </p>
                                        </label>
                                    </div>
                                </dd>
                            </div>
                            <div class="px-4 py-3 bg-white text-right sm:px-6 flex items-center justify-between">
                                <jet-validation-errors class="mb-4" />
                                <button type="submit" class="float-right py-2 px-4 border border-transparent shadow-sm text-md font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Save My Rating
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </frontend-layout>
</template>


<script>
import FrontendLayout from "../../../Layouts/FrontendLayout";
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import Swal from "sweetalert2";
export default {
    name: "AddRating",
    components: {
        FrontendLayout,
        JetValidationErrors
    },
    props: [
        'booking_id',
    ],
    data(){
        return{
            form: this.$inertia.form({
                hotel_rating:4,
                staff_rating:0,
                facility_rating:0,
                cleanliness_rating:0,
                comfort_rating:0,
                price_rating:0,
                location_rating:0,
                review:"",
            }),
        }
    },
    methods:{
        submit(){
            this.form.post(route('user.rating.store', this.booking_id),{
                preserveScroll: true,
                onSuccess: () => {
                    this.$inertia.get(route('user.rating.index'));
                },
                onError() {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                        position: "top-end",
                    });
                },
            })

        }
    }
}
</script>

<style scoped>

</style>
