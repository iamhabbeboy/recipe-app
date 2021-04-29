<template>
<div class="mt-8">
    <jet-label :for="`ingredient${index}`" value="Ingredient" class="float-left" />
    <jet-input :id="`ingredient${index}`" type="text" class="mt-1 block w-full" required v-model="form.ingredient[index].title" />
    <div class="mt-2">
        <div class="flex flex-row">
            <label class="items-center mt-3">
                <input type="radio" class="form-radio h-5 w-5 text-gray-600" :name="`ingredient${index}`" v-model="form.ingredient[index].category" value="main"><span class="ml-2 text-gray-700">Main</span>
            </label>
            <label class="items-center mt-3 pl-5">
                <input type="radio" class="form-radio h-5 w-5 text-gray-600" :name="`ingredient${index}`" v-model="form.ingredient[index].category" value="primary"><span class="ml-2 text-gray-700">Primary</span>
            </label>
        </div>
    </div>
</div>
</template>

<script>
import JetInput from '@/Jetstream/Input'
import JetLabel from '@/Jetstream/Label'
import {
    reactive,
    ref,
    onMounted
} from "vue";

export default {
    components: {
        JetInput,
        JetLabel
    },
    props: {
        index: Number
    },
    data() {
        return {
            form: {
                ingredient: [{
                    title: '',
                    category: ''
                }]
            }
        }
    },
    mounted() {
        this.$emit('model', this.form)
    }
    // setup(props, {
    //     emit
    // }) {
    //     const form = reactive({
    //         title: null,
    //         category: null
    //     })

    //     onMounted(() => {
    //         emit('model', ingredient)
    //     })
    //     return {
    //         ingredient
    //     }
    // }
}
</script>
