<template>
<app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </template>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-5">
                <a href="#" class="bg-gray-900 text-white text-sm font-semibold p-3 rounded-md"> Add Recipe</a>
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
        </div>
    </div>
</app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'
import DataTable from "@/Components/DataTable";

export default {
    components: {
        AppLayout,
        DataTable,
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
        }
    }
}
</script>
