<template>
<div class="mb-5 flex flex-row">
    <jet-input id="search" type="text" placeholder="Search recipe name, meal type, ..." v-model="form.search" class="mt-1 block" required autofocus />
    <select class="ml-3 rounded-md border-gray-300" v-model="form.searchBy">
        <option value="0">Search By </option>
        <option value="meal_type">Meal Type</option>
        <option value="ingredient">Ingredient</option>
        <option value="nutrition">Nutrition</option>
        <option value="cost">Cost price</option>
    </select>
    <jet-button class="ml-3" @click="searchMeal">
        Search
    </jet-button>
</div>
</template>

<script>
import {
    reactive
} from "vue";
import JetInput from '@/Jetstream/Input'
import JetButton from '@/Jetstream/Button'
import {
    Inertia
} from '@inertiajs/inertia'

export default {
    components: {
        JetInput,
        JetButton,
    },
    setup() {
        const form = reactive({
            search: null,
            searchBy: null
        })

        const searchMeal = () => {
            const input = form.search
            if (input === null) {
                return;
            }
            Inertia.visit('/', {
                method: 'get',
                data: form,
            })
        }

        return {
            form,
            searchMeal
        }
    },
}
</script>
