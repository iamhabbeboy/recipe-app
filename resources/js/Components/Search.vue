<template>
<div class="mb-5 flex flex-row">
    <jet-input id="search" type="text" placeholder="Search recipe name, meal type, ..." v-model="form.search" class="mt-1 block" required autofocus />
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

export default {
    components: {
        JetInput,
        JetButton,
    },
    setup() {
        const form = reactive({
            search: null,
        })

        const searchMeal = () => {
            const input = form.search
            if (input === null) {
                return;
            }
            Inertia.get('/search', form)
        }

        return {
            form,
            searchMeal
        }
    },
}
</script>
