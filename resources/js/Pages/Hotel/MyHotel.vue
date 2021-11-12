<template>
    <hotel-layout title="My Hotel">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Hotel information
            </h2>
        </template>

        <form action="" @submit.prevent="submit()">
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="flex bg-white p-4 my-4 rounded-md flex-col lg:flex-row">
                    <div class="w-full p-4">
                        <h2 class="font-bold">Property Info</h2>
                        <p>
                            Please provide your property details as accurately as possible.
                            Besides mandatory information, adding a good description and a
                            website will help your guests know more about your property.
                        </p>
                    </div>

                    <div class="w-full p-4">
                        <div class="pb-4">
                            <label for="property_name" class="font-medium pb-2 block"
                            >Name Of Property</label
                            >
                            <input
                                id="property_name"
                                :value="this.hotel.name"
                                disabled
                                type="text"
                                name="default"
                                placeholder=""
                                class="
                  bg-gray-50
                  px-4
                  py-2
                  rounded-lg
                  border border-gray-300
                  focus:outline-none focus:ring-2 focus:ring-gray-200
                  w-full
                "
                            />
                        </div>

                        <div class="pb-4">
                            <h2 class="font-medium pb-2">
                                Property Type <span class="font-bold text-red">*</span>
                            </h2>
                            <!-- dropdown -->
                            <select
                                class="
                  border border-gray-300
                  text-gray-600
                  h-10
                  pl-2
                  pr-2
                  rounded-sm
                  w-full
                  bg-white
                  hover:border-gray-400
                  focus:outline-none
                "
                                v-model="form.property_type"
                            >
                                <option>None</option>
                                <option
                                    v-for="propertyType of propertyTypes"
                                    :value="propertyType.data"
                                    :key="propertyType.id"
                                >
                                    {{ propertyType.data }}
                                </option>
                            </select>
                            <!-- dropdown -->
                        </div>
                        <div class="pb-4 flex">
                            <div class="w-full pr-1">
                                <h2 class="font-medium text-sm pb-2">Total Number of Rooms</h2>
                                <!-- counter -->
                                <div class="custom-number-input h-10 w-32">
                                    <div
                                        class="
                      flex flex-row
                      h-10
                      w-full
                      rounded-lg
                      relative
                      bg-transparent
                      mt-1
                    "
                                    >
                                        <button
                                            data-action="decrement"
                                            class="
                        bg-gray-300
                        text-gray-600
                        hover:text-gray-700 hover:bg-gray-400
                        h-full
                        w-20
                        rounded-l
                        cursor-pointer
                        outline-none
                      "
                                            @click.prevent="decrement('room')"
                                        >
                                            <span class="m-auto text-2xl font-thin">−</span>
                                        </button>
                                        <input min="0"
                                            type="number"
                                            class="
                        appearance-none
                        outline-none
                        focus:outline-none
                        text-center
                        w-full
                        bg-gray-300
                        font-semibold
                        text-md
                        hover:text-black
                        focus:text-black
                        md:text-basecursor-default
                        flex
                        items-center
                        text-gray-700
                        outline-none
                      "
                                            name="custom-input-number"
                                            v-model="form.no_of_rooms"
                                            disabled
                                        />
                                        <button
                                            data-action="increment"
                                            @click.prevent="increment('room')"
                                            class="
                        bg-gray-300
                        text-gray-600
                        hover:text-gray-700 hover:bg-gray-400
                        h-full
                        w-20
                        rounded-r
                        cursor-pointer
                      "
                                        >
                                            <span class="m-auto text-2xl font-thin">+</span>
                                        </button>
                                    </div>
                                </div>
                                <!-- counter -->
                            </div>
                            <div class="w-full">
                                <h2 class="text-sm font-medium pb-2">Total Number of Floors</h2>
                                <!-- counter -->
                                <div class="custom-number-input h-10 w-32">
                                    <div
                                        class="
                      flex flex-row
                      h-10
                      w-full
                      rounded-lg
                      relative
                      bg-transparent
                      mt-1
                    "
                                    >
                                        <button
                                            data-action="decrement"
                                            @click.prevent="decrement('floor')"
                                            class="
                        bg-gray-300
                        text-gray-600
                        hover:text-gray-700 hover:bg-gray-400
                        h-full
                        w-20
                        rounded-l
                        cursor-pointer
                        outline-none
                      "
                                        >
                                            <span class="m-auto text-2xl font-thin">−</span>
                                        </button>
                                        <input
                                            type="number"
                                            class="
                        appearance-none
                        border-opacity-0
                        outline-none
                        focus:outline-none
                        text-center
                        w-full
                        bg-gray-300
                        font-semibold
                        text-md
                        hover:text-black
                        focus:text-black
                        md:text-basecursor-default
                        flex
                        items-center
                        text-gray-700
                        outline-none
                      "
                                            name="custom-input-number"
                                            disabled
                                            v-model="form.no_of_floors"
                                        />
                                        <button
                                            data-action="increment"
                                            @click.prevent="increment('floor')"
                                            class="
                        bg-gray-300
                        text-gray-600
                        hover:text-gray-700 hover:bg-gray-400
                        h-full
                        w-20
                        rounded-r
                        cursor-pointer
                      "
                                        >
                                            <span class="m-auto text-2xl font-thin">+</span>
                                        </button>
                                    </div>
                                </div>
                                <!-- counter -->
                            </div>
                        </div>
                        <div class="pb-4">
                            <label for="description" class="font-medium pb-2 block"
                            >Description</label
                            >
                            <textarea
                                name=""
                                id="description"
                                rows="5"
                                v-model="form.description"
                                class="
                  bg-gray-50
                  px-4
                  py-2
                  rounded-lg
                  border border-gray-300
                  focus:outline-none focus:ring-2 focus:ring-gray-200
                  w-full
                "
                            ></textarea>
                        </div>

                        <div class="pb-4 flex">
                            <div class="w-full pr-1">
                                <h2 class="font-medium text-sm pb-2">Construction Year</h2>
                                <input
                                    type="number"
                                    v-model="form.construction_year"
                                    class="
                    appearance-none
                    px-4
                    py-2
                    rounded-lg
                    border border-gray-300
                    focus:outline-none focus:ring-2 focus:ring-gray-200
                    w-full
                  "
                                    name="custom-input-number"
                                />
                            </div>
                            <div class="w-full">
                                <h2 class="font-medium text-sm pb-2">
                                    License/ Registration Number

                                </h2>
                                <input
                                    disabled
                                    type="text"
                                    v-model="form.license"

                                    class="
                    appearance-none
                    px-4
                    py-2
                    rounded-lg
                    border border-gray-300
                    focus:outline-none focus:ring-2 focus:ring-gray-200
                    w-full
                  "
                                    name="custom-input-number"
                                />
                            </div>
                        </div>
                        <div class="pb-4">
                            <label for="website" class="font-medium pb-2 block"
                            >Website</label
                            >
                            <input
                                id="website"
                                type="url"
                                name="default"
                                placeholder=""
                                v-model="form.website"
                                class="
                  bg-gray-50
                  px-4
                  py-2
                  rounded-lg
                  border border-gray-300
                  focus:outline-none focus:ring-2 focus:ring-gray-200
                  w-full
                "
                            />
                        </div>
                    </div>
                    <!-- room description -->
                </div>

                <div class="flex bg-white p-4 my-4 rounded-md flex-col lg:flex-row">
                    <div class="w-full p-4">
                        <h2 class="font-bold">Property Rating</h2>
                        <p>Please provide your properties start ratings.</p>
                    </div>

                    <div class="w-full p-4">
                        <div class="block">
                            <div class="flex mt-2 justify-center items-center">
                                <div class="mr-4">
                                    <label for="case1" class="block items-center">
                                        <input
                                            id="case1"
                                            type="radio"
                                            class="form-radio appearance-none hidden"
                                            name="no_of_star"
                                            value="1"
                                            v-model="form.no_of_star"
                                        />
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-10 w-10"
                                            :class="form.no_of_star == 1 ? 'rating-color' : ''"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                                            />
                                        </svg>
                                    </label>
                                    <div class="text-center">1</div>
                                </div>
                                <div class="mr-4">
                                    <label class="block items-center">
                                        <input
                                            type="radio"
                                            class="form-radio appearance-none hidden"
                                            name="no_of_star"
                                            value="2"
                                            v-model="form.no_of_star"
                                        />
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-10 w-10"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            :class="form.no_of_star == 2 ? 'rating-color' : ''"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                                            />
                                        </svg>
                                        <div class="text-center">2</div>
                                    </label>
                                </div>
                                <div class="mr-4">
                                    <label class="block items-center">
                                        <input
                                            type="radio"
                                            class="form-radio appearance-none hidden"
                                            name="no_of_star"
                                            v-model="form.no_of_star"
                                            value="3"
                                        />
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-10 w-10"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            :class="form.no_of_star == 3 ? 'rating-color' : ''"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                                            />
                                        </svg>
                                        <div class="text-center">3</div>
                                    </label>
                                </div>
                                <div class="mr-4">
                                    <label class="block items-center">
                                        <input
                                            type="radio"
                                            class="form-radio appearance-none hidden"
                                            name="no_of_star"
                                            v-model="form.no_of_star"
                                            value="4"
                                        />
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-10 w-10"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            :class="form.no_of_star == 4 ? 'rating-color' : ''"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                                            />
                                        </svg>
                                        <div class="text-center">4</div>
                                    </label>
                                </div>
                                <div class="mr-4">
                                    <label class="block items-center">
                                        <input
                                            type="radio"
                                            class="form-radio appearance-none hidden"
                                            name="no_of_star"
                                            v-model="form.no_of_star"
                                            value="5"
                                        />
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-10 w-10"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            :class="form.no_of_star == 5 ? 'rating-color' : ''"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                                            />
                                        </svg>
                                        <div class="text-center">5</div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex bg-white p-4 my-4 rounded-md flex-col lg:flex-row">
                    <div class="w-full p-4">
                        <h2 class="font-bold">Contact Info</h2>
                        <p>
                            Please provide detailed information about existing beds in a room.
                            Do not include extra beds.
                        </p>
                    </div>

                    <div class="w-full p-4">
                        <div class="pb-4 flex">
                            <div class="w-full pr-1">
                                <h2 class="font-medium text-sm pb-2">
                                    First Name <span class="font-bold text-red">*</span>
                                </h2>
                                <input
                                    type="text"
                                    required
                                    v-model="form.contact_first_name"
                                    class="
                    appearance-none
                    px-4
                    py-2
                    rounded-lg
                    border border-gray-300
                    focus:outline-none focus:ring-2 focus:ring-gray-200
                    w-full
                  "
                                    name="custom-input-number"
                                />
                            </div>
                            <div class="w-full">
                                <h2 class="font-medium text-sm pb-2">
                                    Last Name <span class="font-bold text-red">*</span>
                                </h2>
                                <input
                                    type="text"
                                    v-model="form.contact_last_name"
                                    class="
                    appearance-none
                    px-4
                    py-2
                    rounded-lg
                    border border-gray-300
                    focus:outline-none focus:ring-2 focus:ring-gray-200
                    w-full
                  "
                                    name="custom-input-number"
                                />
                            </div>
                        </div>
                        <div class="pb-4">
                            <label for="email" class="font-medium pb-2 block"
                            >Email <span class="font-bold text-red">*</span></label
                            >
                            <input
                                id="email"
                                v-model="form.contact_email"
                                type="email"
                                name="default"
                                placeholder=""
                                class="
                  px-4
                  py-2
                  rounded-lg
                  border border-gray-300
                  focus:outline-none focus:ring-2 focus:ring-gray-200
                  w-full
                "
                            />
                        </div>
                        <div class="pb-4">
                            <label for="phone" class="font-medium pb-2 block"
                            >Phone <span class="font-bold text-red">*</span></label
                            >
                            <input
                                id="phone"
                                type="text"
                                name="default"
                                placeholder=""
                                v-model="form.contact_phone"
                                class="
                  px-4
                  py-2
                  rounded-lg
                  border border-gray-300
                  focus:outline-none focus:ring-2 focus:ring-gray-200
                  w-full
                "
                            />
                        </div>
                        <div class="pb-4">
                            <label for="dept" class="font-medium pb-2 block"
                            >Department Name</label
                            >
                            <input
                                id="dept"
                                type="text"
                                name="default"
                                placeholder=""
                                v-model="form.contact_department_name"
                                class="
                  px-4
                  py-2
                  rounded-lg
                  border border-gray-300
                  focus:outline-none focus:ring-2 focus:ring-gray-200
                  w-full
                "
                            />
                        </div>
                    </div>
                </div>

                <div class="flex bg-white p-4 my-4 rounded-md flex-col lg:flex-row">
                    <div class="w-full p-4">
                        <h2 class="font-bold">Property Address</h2>
                        <p>
                            Please provide detailed information about existing beds in a room.
                            Do not include extra beds.
                        </p>
                    </div>

                    <div class="w-full p-4">
                        <div class="pb-4">
                            <label for="street_address" class="font-medium pb-2 block"
                            >Street Address</label
                            >
                            <input
                                id="street_address"
                                v-model="form.address_line"
                                type="text"
                                name="default"
                                placeholder=""
                                class="
                  px-4
                  py-2
                  rounded-lg
                  border border-gray-300
                  focus:outline-none focus:ring-2 focus:ring-gray-200
                  w-full
                "
                            />
                        </div>
                        <div class="pb-4">
                            <label for="area" class="font-medium pb-2 block"
                            >Area <span class="font-bold text-red">*</span></label
                            >
                            <input
                                id="area"
                                v-model="form.area"
                                type="text"
                                name="default"
                                placeholder=""
                                class="
                  px-4
                  py-2
                  rounded-lg
                  border border-gray-300
                  focus:outline-none focus:ring-2 focus:ring-gray-200
                  w-full
                "
                            />
                        </div>
                        <div class="pb-4 flex">
                            <div class="w-full pr-1">
                                <label for="District" class="font-semibold text-sm pb-2 block"
                                >District </label
                                >
                                <!-- dropdown -->

                                <input
                                    class="
                    border border-gray-300
                    text-gray-600
                    h-10
                    pl-2
                    pr-2
                    rounded-sm
                    w-full
                    bg-white
                    hover:border-gray-400
                    focus:outline-none
                  "
                                    v-model="hotel.district.name"
                                    disabled
                                />
                                <!-- dropdown -->
                            </div>
                            <!--                        <div class="w-full">-->
                            <!--                            <label for="Country" class="font-semibold text-sm pb-2 block">Country/ Region <span class="font-bold text-red">*</span></label>-->
                            <!--                            &lt;!&ndash; dropdown &ndash;&gt;-->
                            <!--                            <select-->
                            <!--                                class="-->
                            <!--                                      border border-gray-300-->
                            <!--                                      text-gray-600-->
                            <!--                                      h-10-->
                            <!--                                      pl-2-->
                            <!--                                      pr-2-->
                            <!--                                      rounded-sm-->
                            <!--                                      w-full-->
                            <!--                                      bg-white-->
                            <!--                                      hover:border-gray-400-->
                            <!--                                      focus:outline-none-->
                            <!--                                    "-->
                            <!--                                id="Country"-->
                            <!--                            >-->
                            <!--                                <option>Single</option>-->
                            <!--                                <option>Double</option>-->
                            <!--                            </select>-->
                            <!--                            &lt;!&ndash; dropdown &ndash;&gt;-->
                            <!--                        </div>-->
                        </div>
                        <div class="pb-4 flex">
                            <div class="w-full pr-1">
                                <h2 class="font-medium text-sm pb-2">Latitude</h2>
                                <input
                                    type="text"
                                    v-model="form.lat"
                                    class="
                    appearance-none
                    px-4
                    py-2
                    rounded-lg
                    border border-gray-300
                    focus:outline-none focus:ring-2 focus:ring-gray-200
                    w-full
                  "
                                    name="custom-input-number"
                                />
                            </div>
                            <div class="w-full">
                                <h2 class="font-medium text-sm pb-2">Longitude</h2>
                                <input
                                    type="text"
                                    v-model="form.lon"
                                    class="
                    appearance-none
                    px-4
                    py-2
                    rounded-lg
                    border border-gray-300
                    focus:outline-none focus:ring-2 focus:ring-gray-200
                    w-full
                  "
                                    name="custom-input-number"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex bg-white p-4 my-4 rounded-md flex-col lg:flex-row">
                    <div class="w-full p-4">
                        <h2 class="font-bold">NearBy Landmark/Terminals</h2>
                        <p>
                            Tell us only about the rack rate for this room. Please DO NOT
                            include extra bed and service charge
                        </p>
                    </div>

                    <div class="w-full p-4">
                        <div
                            class="pb-4"
                            v-for="(nearBy, index) of nearbyList"
                            :key="index"
                        >
                            <div class="pb-4 flex">
                                <div class="w-full pr-1">
                                    <label for="District" class="font-semibold text-sm pb-2 block"
                                    >Nearby Type
                                        <span class="font-bold text-red">*</span></label
                                    >
                                    <!-- dropdown -->
                                    <select
                                        class="
                      border border-gray-300
                      text-gray-600
                      h-10
                      pl-2
                      pr-2
                      rounded-sm
                      w-full
                      bg-white
                      hover:border-gray-400
                      focus:outline-none
                    "
                                        id="District"
                                        v-model="nearbyList[index].type"
                                    >
                                        <option value="1">Landmark</option>
                                        <option value="2">Terminal</option>
                                    </select>
                                    <!-- dropdown -->
                                </div>
                                <div class="w-full">
                                    <label for="Distance" class="font-semibold text-sm pb-2 block"
                                    >Distance (in meter)</label
                                    >
                                    <input
                                        type="number"
                                        step="0.01"
                                        v-model="nearbyList[index].distance"
                                        id="Distance"
                                        class="
                      appearance-none
                      px-4
                      py-2
                      rounded-lg
                      border border-gray-300
                      focus:outline-none focus:ring-2 focus:ring-gray-200
                      w-full
                    "
                                        name="custom-input-number"
                                    />
                                </div>
                            </div>
                            <div class="pb-4">
                                <label for="name" class="font-medium pb-2 block"
                                >Name of Landmark/ Terminal
                                    <span class="font-bold text-red">*</span></label
                                >
                                <input
                                    id="name"
                                    type="text"
                                    name="default"
                                    v-model="nearbyList[index].name"
                                    placeholder=""
                                    class="
                    px-4
                    py-2
                    rounded-lg
                    border border-gray-300
                    focus:outline-none focus:ring-2 focus:ring-gray-200
                    w-full
                  "
                                />
                            </div>
                            <div class="pb-4 text-right">
                                <button
                                    type="button"
                                    class="mr-2 text-md font-semibold text-red-400"
                                    @click.prevent="removeNearBy(index, nearbyList[index].id)"
                                >
                                    <span>-</span> Remove
                                </button>
                            </div>
                        </div>
                        <div class="flex pb-4">
                            <button
                                type="button"
                                class="mr-2 text-md font-semibold text-blue-700"
                                @click.prevent="addNearBy()"
                            >
                                <span>+</span> Add another
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Rate Options -->

                <div
                    class="
            flex
            items-center
            justify-between
            px-4
            py-3
            bg-gray-50
            text-right
            sm:px-6
            shadow
            sm:rounded-bl-md sm:rounded-br-md
          "
                >
                    <jet-validation-errors class="mb-4" />
                    <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                        Saved.
                    </jet-action-message>

                    <jet-button
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        class="bg-green-700"
                    >
                        Update Information
                    </jet-button>
                </div>
            </div>
        </form>
    </hotel-layout>
</template>

<script>
import HotelLayout from "@/Layouts/HotelLayout";
import JetButton from "@/Jetstream/Button.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import Swal from "sweetalert2";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import Multiselect from "@vueform/multiselect";

export default {
    name: "MyHotel",
    components: {
        HotelLayout,
        JetActionMessage,
        JetButton,
        JetInputError,
        JetValidationErrors,
        Multiselect,
    },
    props: ["hotel", "districts", "propertyTypes"],
    data() {
        return {
            form: this.$inertia.form({
                property_type: "",
                no_of_rooms: 1,
                no_of_floors: 1,
                description: "",
                construction_year: "",
                license: "",
                website: "",
                no_of_star: "1",
                contact_first_name: "",
                contact_last_name: "",
                contact_email: "",
                contact_phone: "",
                contact_designation: "",
                contact_department_name: "",
                address_line: "",
                area: "",
                lon: "",
                lat: "",
                district_id: "",
                landmarks: [],
                deleted_landmarks: [],
            }),
            nearbyList: [],
        };
    },

    mounted() {
        this.form.property_type = this.hotel.property_type;
        this.form.no_of_rooms = this.hotel.no_of_rooms ? this.hotel.no_of_rooms : 1;
        this.form.no_of_floors = this.hotel.no_of_floors
            ? this.hotel.no_of_floors
            : 1;
        this.form.description = this.hotel.description;
        this.form.construction_year = this.hotel.construction_year;
        this.form.license = this.hotel.license;
        this.form.website = this.hotel.website;
        this.form.no_of_star = this.hotel.no_of_star;
        this.form.contact_first_name = this.hotel.contact_first_name;
        this.form.contact_last_name = this.hotel.contact_last_name;
        this.form.contact_email = this.hotel.contact_email;
        this.form.contact_phone = this.hotel.contact_phone;
        this.form.contact_designation = this.hotel.contact_designation;
        this.form.contact_department_name = this.hotel.contact_department_name;
        this.form.address_line = this.hotel.address_line;
        this.form.area = this.hotel.area;
        this.form.lon = this.hotel.lon;
        this.form.lat = this.hotel.lat;
        this.form.district_id = this.hotel.district_id;

        if (this.hotel.landmarks && this.hotel.landmarks.length > 0) {
            this.hotel.landmarks.forEach((landmark) => {
                let nearBy = {
                    id: landmark.id,
                    type: landmark.type,
                    distance: landmark.distance,
                    name: landmark.name,
                };
                this.nearbyList.push(nearBy);
            });
        } else {
            this.addNearBy();
        }
    },
    methods: {
        addNearBy() {
            let nearBy = {
                id: null,
                type: 1,
                distance: "",
                name: "",
            };
            this.nearbyList.push(nearBy);
        },
        removeNearBy(index, id) {
            if (id != null) {
                this.form.deleted_landmarks.push(id);
            }
            this.nearbyList.splice(index, 1);
        },
        decrement(type) {
            if (type === "room") {
                if (this.form.no_of_rooms > 0) {
                    this.form.no_of_rooms--;
                }
            }

            if (type === "floor") {
                if (this.form.no_of_floors > 0) {
                    this.form.no_of_floors--;
                }
            }
        },
        increment(type) {
            if (type === "room") {
                this.form.no_of_rooms++;
            }

            if (type === "floor") {
                this.form.no_of_floors++;
            }
        },
        submit() {
            this.form
                .transform((data) => ({
                    ...data,
                    landmarks: this.nearbyList ? this.nearbyList : [],
                }))
                .post(route("hotel.my_hotel.update", this.hotel.id), {
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess: () => {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Hotel updated successfully",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    },
                    onError: () => {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                            position: "top-end",
                            footer: '<a href="">Scroll up on the modal to see the issue!</a>',
                        });
                    },
                });
        },
    },
};
</script>

<style scoped>
.rating-color {
  color: #0981bb;
  fill: #0981bb;
}
</style>
<style src="@vueform/multiselect/themes/default.css"></style>
