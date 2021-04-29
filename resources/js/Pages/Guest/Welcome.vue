<template>
<div class=" min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
    <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        <inertia-link v-if="$page.props.user" href="/dashboard" class="text-sm text-gray-700 underline">
            Dashboard
        </inertia-link>

        <template v-else>
            <inertia-link :href="route('login')" class="text-sm text-gray-700 underline">
                Log in
            </inertia-link>

            <inertia-link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
                Register
            </inertia-link>
        </template>
    </div>
    <div class="py-12 mt-20">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <Search />
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div v-if="!getRecipes.length">
                    <div class="p-5">
                        <h3 class="text-gray-500 text-lg"> No Recipe available </h3>
                    </div>
                </div>
                <div v-else>
                    <DataTable :recipes="getRecipes" :isLoggedIn="isLoggedIn" />
                </div>
            </div>
            <Pagination v-if="getRecipes.length" :links="getPaginationLinks" />
        </div>
    </div>
</div>
</template>

<script>
import DataTable from "@/Components/DataTable";
import Pagination from "@/Components/Pagination";
import Search from "@/Components/Search";

export default {
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        recipes: Array,
        isLoggedIn: Boolean
    },
    components: {
        DataTable,
        Pagination,
        Search
    },
    computed: {
        getRecipes() {
            return this.recipes.data || [];
        },
        getPaginationLinks() {
            return this.recipes.meta;
        }
    }
}
</script>
