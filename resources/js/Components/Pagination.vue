<template>
    <nav
        class="mt-10 relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
        aria-label="Pagination"
    >
        <inertia-link
            v-for="(link, index) in getLinks"
            :key="index"
            :href="link.url != null ? link.url : 'void:javascript'"
            :class="`relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium hover:bg-gray-50 ${
                link.url === null ? 'bg-gray-400 hover:bg-gray-400' : ''
            } ${link.active ? 'bg-gray-400 hover:bg-gray-600 text-white' : 'text-gray-700'}`"
            v-html="link.label"
        >
        </inertia-link>
    </nav>
</template>

<script>
export default {
    props: {
        links: {
            type: Array,
            required: true
        }
    },
    computed: {
        getLinks() {
            // console.log(this.links.splice(1, this.links.length -2));
            return this.links;
        },
    },
};
</script>
