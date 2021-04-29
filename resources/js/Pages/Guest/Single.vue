<template>
<div class=" min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <ShowRecipe :recipe="recipe" />
        </div>
    </div>
</div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetButton from '@/Jetstream/Button'
import ShowRecipe from '@/Components/Show';

export default {
    components: {
        AppLayout,
        JetButton,
        ShowRecipe
    },
    props: {
        recipe: {
            type: Object,
            required: true
        }
    }
}
</script>
