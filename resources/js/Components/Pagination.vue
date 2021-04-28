<template>
<nav class="mt-10 relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
    <inertia-link :href="getPreviousLink.url !== null ? getPreviousLink.url : '#'" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
        <span class="sr-only">Previous</span>
        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
    </inertia-link>

    <inertia-link v-for="(link, index) in getLinks" :key="index" :href="link.url != null ? link.url : 'void:javascript'" :class="`relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium hover:bg-gray-50 ${
                link.url === null ? 'bg-gray-400 hover:bg-gray-400' : ''
            } ${link.active ? 'bg-gray-400 hover:bg-gray-600 text-white' : 'text-gray-700'}`" v-html="link.label > getTotalPages ? '...' : link.label">
    </inertia-link>
    <!-- <inertia-link href="#" v-show="getTotalPages > MAX_PAGE_NUMBER" class="relative inline-flex items-center px-2 py-2 border border-gray-300 bg-gray-400 hover:bg-gray-400 text-sm font-medium text-gray-500 hover:bg-gray-50">
        ...
    </inertia-link> -->

    <inertia-link :href="getNextLink.url !== null ? getNextLink.url : '#'" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
        <span class="sr-only">Next</span>
        <!-- Heroicon name: solid/chevron-right -->
        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>
    </inertia-link>
</nav>
</template>

<script>
export default {
    data() {
        return {
            MAX_PAGE_NUMBER: 10
        }
    },
    props: {
        links: {
            type: Array,
            required: true
        }
    },
    computed: {
        getTotalPages() {
            return this.links.total || 0
        },

        getPreviousLink() {
            return this.links.links[0] ?? {};
        },

        getNextLink() {
            let totalPages = this.links.links.length;
            return this.links.links[totalPages-1];
        },

        getLinks() {
            const pageLinks = this.links.links || [];
            const defaultPageNumber = pageLinks.splice(1, pageLinks.length - 2) || [];
            return defaultPageNumber.length > this.MAX_PAGE_NUMBER ? defaultPageNumber.splice(0, this.MAX_PAGE_NUMBER) : defaultPageNumber;
        },
    },
};
</script>
