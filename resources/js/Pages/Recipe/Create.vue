<template>
<app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Recipe
        </h2>
    </template>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="w-1/2 mx-auto pt-10 pb-10">
                    <h3 class="font-semibold text-lg pb-5">Add Recipe</h3>
                    <div class="mt-4">
                        <jet-label for="name" value="Name" />
                        <jet-input id="name" type="text" class="mt-1 block w-full" required autofocus />
                    </div>
                    <div class="mt-8">
                        <div class="bg-gray-100 p-8 text-center">
                            <button class="text-sm text-gray-600">
                                Add photo
                            </button>
                        </div>
                    </div>
                    <div class="mt-8">
                        <jet-label for="description" value="Desription" />
                        <textarea id="description" rows="10" class="border-gray-300 w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" ref="input"></textarea>
                    </div>
                    <div class="mt-8">
                        <jet-label for="ingredient" value="Ingredient" class="float-left" />
                        <a href="#" class="float-right text-sm text-gray-700">Add New</a>
                        <jet-input id="ingredient" type="text" class="mt-1 block w-full" required />
                        <div class="mt-2">
                            <div class="flex flex-row">
                                <label class="items-center mt-3">
                                    <input type="radio" class="form-radio h-5 w-5 text-gray-600" name="ingredient_category" checked><span class="ml-2 text-gray-700">Main</span>
                                </label>
                                <label class="items-center mt-3 pl-5">
                                    <input type="radio" class="form-radio h-5 w-5 text-gray-600" name="ingredient_category"><span class="ml-2 text-gray-700">Primary</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8">
                        <jet-label for="cook-time" value="Cook Time" />
                        <div class="flex">
                            <jet-input id="cook-time" type="number" class="mt-1 block" placeholder="Hours" required />
                            <jet-input id="cook-time" type="number" class="mt-1 block ml-3" placeholder="Minutes" required />
                        </div>
                    </div>
                    <div class="mt-8">
                        <jet-label for="instruction" value="Instruction" />
                        <textarea id="instruction" rows="10" class="border-gray-300 w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" ref="input"></textarea>
                    </div>
                    <div class="mt-8">
                        <jet-label for="meal-type" value="Meal Type" />
                        <select id="meal-type" type="text" class="border-gray-300 w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required>
                            <option value="0">Meal Type</option>
                            <option value="breakfast">Breakfast</option>
                            <option value="lunch">Lunch</option>
                            <option value="dinner">Dinner</option>
                        </select>
                    </div>
                    <div class="mt-8">
                        <jet-label for="cost" value="Cost($)" />
                        <jet-input id="cost" type="number" class="mt-1 block w-full" required />
                    </div>
                    <div class="mt-8">
                        <jet-label for="nutrition" value="Nutritional Value" class="float-left" />
                        <a href="#" class="float-right text-sm text-gray-700">Add New</a>
                        <jet-input id="nutrition" type="text" class="mt-1 block w-full" required />
                    </div>
                    <div class="mt-8 ml-0 pl-0">
                        <jet-button class="py-5 px-20">
                            Save
                        </jet-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetInput from '@/Jetstream/Input'
import JetLabel from '@/Jetstream/Label'
import JetButton from '@/Jetstream/Button'

export default {
    components: {
        AppLayout,
        JetInput,
        JetLabel,
        JetButton,
    },
    props: {}
}
</script>
