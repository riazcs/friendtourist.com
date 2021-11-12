<template>
    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6" v-if="showPagination">
        <div class="flex-1 flex justify-between sm:hidden">
            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Previous
            </a>
            <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Next
            </a>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{ meta.from }}</span>
                    to
                    <span class="font-medium">{{ meta.to }}</span>
                    of
                    <span class="font-medium">{{ meta.total }}</span>
                    results
                </p>
            </div>
            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <Link
                       aria-current="page"
                       v-for="(link, key) in meta.links"
                       :href="link.url+'&'+query"
                       :key="key"
                       :class="isActive(link)"
                       class="relative inline-flex items-center px-4 py-2 border text-sm font-medium" v-html="link.label">

                    </Link>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";

export default {
    name: "Pagination",
    props:['meta', 'query'],
    components:{Link},
    computed: {
        showPagination() {
            return this.meta.links.length > 3
        }
    },
    methods: {
        isActive(link) {
            return (link.active === true) ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'
        },
        handleNoLink() {
            return false
        }
    }
}
</script>

<style scoped>

</style>
