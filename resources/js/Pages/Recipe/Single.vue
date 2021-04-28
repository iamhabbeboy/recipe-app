<template>
<app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </template>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="w-2/3 mx-auto pt-10 pb-10">
                    <inertia-link :href="route('dashboard.edit', 3)" class="bg-gray-400 hover:bg-gray-600 text-white text-sm font-semibold p-3 rounded-md">
                        Edit Recipe
                    </inertia-link>
                    <br /><br />
                    <div class="flex">
                        <div class="w-5/12 h-100">
                            <img class="h-100 rounded-md" src="https://images.unsplash.com/photo-1518779578993-ec3579fee39f?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80" alt="" />
                        </div>
                        <div class="w-7/12 p-5">
                            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                                {{ name }}
                            </h2>
                            <p class="mt-5 text-sm">{{ description }}</p>
                            <p class="mt-5 text-sm text-gray-500 ont-semibold">Cook Time: 3hours 30mins</p>
                            <p class="mt-5 text-sm text-gray-500 ont-semibold" v-if="mealType">Meal best for <b>{{ mealType }}</b></p>
                            <span class="text-gray-500">
                                <p class="text-sm mt-5 mb-5">Estimated Cost:</p>
                                <span class="bg-red-500 rounded-lg p-3 text-white text-lg font-bold" v-if="cost">{{ cost }}</span>
                            </span>
                            <p class="mt-5 text-sm text-gray-500 ont-semibold" v-if="status">Status: <b class="text-yellow-400">{{ status }}</b></p>
                        </div>
                    </div>
                    <div class="mt-10 flex">
                        <div class="w-6/12" v-if="instruction.length">
                            <h3 class="font-semibold text-lg pb-3">
                                Ingredients
                            </h3>
                            <ul class="list-decimal pl-8">
                                <li class="font-bold pt-2 pb-2 text-gray-800" v-for="(value, index) in instruction" :key="index">
                                    {{ value.ingredient.quantity }} {{ value.ingredient.content }}
                                </li>
                            </ul>
                        </div>
                        <div class="w-6/12" v-if="instruction.length">
                            <h3 class="font-semibold text-lg pb-3">
                                Nutritional Value
                            </h3>
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Nutrition
                                            </th>
                                            <th scope="col" class="px-10 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Value
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                &nbsp;
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-sm font-normal" v-for="(value, index) in instruction" :key="index">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    {{ value.nutrition.content }}
                                                </div>
                                            </td>
                                            <td class="px-10 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                     {{ value.nutrition.value }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                     {{ value.nutrition.percentage }}
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10" v-if="instruction.length">
                        <h3 class="font-semibold text-lg pb-3">
                            Instructions
                        </h3>
                        <p v-for="(value, index) in instruction" :key="index">
                            {{ value.procedure.title }} &nbsp; {{ value.procedure.content }}
                        </p>
                    </div>
                    <div class="mt-8 ml-0 pl-0">
                        <div class="mt-2">
                            <div class="flex flex-row">
                                <!-- <jet-button class="py-5 px-20 bg-red-500 hover:bg-red-300" >
                                        Delete
                                    </jet-button> -->
                                <label class="items-center mt-3">
                                    <input type="radio" class="form-radio h-5 w-5 text-gray-600" name="ingredient_category" checked><span class="ml-2 text-gray-700">Approve</span>
                                </label>
                                <label class="items-center mt-3 pl-5">
                                    <input type="radio" class="form-radio h-5 w-5 text-gray-600" name="ingredient_category"><span class="ml-2 text-gray-700">Reject</span>
                                </label>

                                <jet-button class="py-5 px-20 ml-3 bg-green-500 hover:bg-green-300">
                                    Submit
                                </jet-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetButton from '@/Jetstream/Button'
import DataMixin from '@/Mixins/Helper';

export default {
    mixins: [DataMixin],
    components: {
        AppLayout,
        JetButton
    },
    props: {
        recipe: {
            type: Object,
            required: true
        }
    }
}
</script>
