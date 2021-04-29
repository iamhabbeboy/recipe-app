<template>
<app-layout>
    <template #header>
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
            <inertia-link v-show="!isAdmin" :href="route('dashboard.create')" class=" bg-green-500 text-white text-sm font-semibold p-3 rounded-md">
                Add Recipe
            </inertia-link>
        </div>
    </template>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- <Search /> -->
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
            <!-- {{ recipes }} -->
            <Pagination v-if="getRecipes.length" :links="getPaginationLinks" />
        </div>
    </div>
</app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import DataTable from "@/Components/DataTable";
import Pagination from "@/Components/Pagination";
// import Search from "@/Components/Search";
import {
    Inertia
} from '@inertiajs/inertia'
import {
    reactive
} from "vue";

export default {
    components: {
        AppLayout,
        DataTable,
        Pagination,
    },
    props: {
        recipes: {
            type: Object,
            required: true
        },
        isLoggedIn: {
            type: Boolean
        },
        isAdmin: {
            type: Boolean
        }
    },
    computed: {
        getRecipes() {
            return this.recipes.data || [];
        },
        getPaginationLinks() {
            return this.recipes.meta || [];
        }
    }
}
</script>
