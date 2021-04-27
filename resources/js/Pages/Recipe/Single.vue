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
              <h3>Single page</h3>
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
