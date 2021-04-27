<template>
<app-layout>
    <template #header>
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
            <inertia-link :href="route('dashboard.create')" class=" bg-green-500 text-white text-sm font-semibold p-3 rounded-md">
                Add Recipe
            </inertia-link>
        </div>
    </template>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-5 flex flex-row">
                <jet-input id="search" type="text" placeholder="Search" class="mt-1 block" required autofocus />
                <jet-button class="ml-3">
                    Search
                </jet-button>
                <inertia-link :href="route('dashboard.create')" class="text-sm pt-7 pl-3 hover:underline">
                    Advance search
                </inertia-link>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div v-if="!getRecipes.length">
                    <div class="p-5">
                        <h3 class="text-gray-500 text-lg"> No Recipe available </h3>
                    </div>
                </div>
                <div v-else>
                    <DataTable :recipes="getRecipes" />
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
import JetInput from '@/Jetstream/Input'
import DataTable from "@/Components/DataTable";
import JetButton from '@/Jetstream/Button'
import Pagination from "@/Components/Pagination";

export default {
    components: {
        AppLayout,
        DataTable,
        JetInput,
        JetButton,
        Pagination
    },
    props: {
        recipes: {
            type: Object,
            required: true
        }
    },
    computed: {
        getRecipes() {
            return this.recipes.data || [];
        },
        getPaginationLinks() {
            return this.recipes.meta.links || [];
        }
    }
}
</script>
