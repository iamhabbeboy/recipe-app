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
                <form method="POST" enctype="multipart/form-data" @submit.prevent="submitForm">
                    <div class="w-1/2 mx-auto pt-10 pb-10">
                        <h3 class="font-semibold text-lg pb-5">Add Recipe</h3>
                        <div class="mt-4">
                            <jet-label for="name" value="Name" />
                            <jet-input type="text" class="mt-1 block w-full" required v-model="form.name" />
                        </div>
                        <div class="mt-8">
                            <div class="bg-gray-100 p-8 text-center">
                                <img :src="photoUrl" v-show="photoUrl" class="rounded-md w-50 h-50 object-cover h-48 mx-auto object-center" />
                                <br />
                                <div class="flex justify-center">
                                    <img src="/camera.svg" width="50" height="50" class="pr-3 opacity-25" />
                                    <button class="text-sm text-gray-600 block" @click="uploadPhoto">
                                        Add photo
                                    </button>
                                    <input type="file" class="hidden" ref="photo" @change="onFileChange" />
                                </div>
                            </div>
                        </div>
                        <div class="mt-8">
                            <jet-label for="description" value="Desription" />
                            <textarea v-model="form.description" required rows="5" class="border-gray-300 w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                        </div>

                        <jet-button type="button" class="float-right text-sm mt-3 text-gray-700" style="background-color: transparent;text-transform:capitalize" @click="addIngredient">
                            Add New
                        </jet-button>
                        <!-- <Ingredient v-for="(ingredient, index) in ingredientComponent" :index="index" :key="index" @model="ingredienttesting" /> -->
                        <div class="mt-8" v-for="(ingredient, index) in form.ingredient" :key="index">
                            <jet-label :for="`ingredient${index}`" value="Ingredient" class="float-left" />
                            <jet-input :id="`ingredient${index}`" type="text" class="mt-1 block w-full" required v-model="form.ingredient[index].title" />
                            <div class="mt-2">
                                <div class="flex flex-row">
                                    <label class="items-center mt-3">
                                        <input type="radio" required class="form-radio h-5 w-5 text-gray-600" :name="`ingredient${index}`" v-model="form.ingredient[index].category" value="main"><span class="ml-2 text-gray-700">Main</span>
                                    </label>
                                    <label class="items-center mt-3 pl-5">
                                        <input type="radio" class="form-radio h-5 w-5 text-gray-600" :name="`ingredient${index}`" v-model="form.ingredient[index].category" value="primary"><span class="ml-2 text-gray-700">Primary</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8">
                            <jet-label for="instruction" value="Instruction" />
                            <textarea id="instruction" required rows="5" class="border-gray-300 w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="form.instruction"></textarea>
                        </div>
                        <div class="mt-8">
                            <jet-label for="meal-type" value="Meal Type" />
                            <select id="meal-type" v-model="form.meal_type" class="border-gray-300 w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required>
                                <option value="0">Meal Type</option>
                                <option value="breakfast">Breakfast</option>
                                <option value="lunch">Lunch</option>
                                <option value="dinner">Dinner</option>
                            </select>
                        </div>
                        <div class="mt-8">
                            <jet-label for="cost" value="Cost($)" />
                            <jet-input id="cost" type="number" class="mt-1 block w-full" required v-model="form.cost" />
                        </div>
                        <jet-button type="button" class="float-right text-sm mt-3 text-gray-700" style="background-color: transparent;text-transform:capitalize" @click="addNutrition">
                            Add New
                        </jet-button>
                        <!-- <Nutrition v-for="(nutrition, index) in nutritionComponent" :index="index" :key="index" /> -->
                        <div class="mt-8" v-for="(nutrition, index) in form.nutrition" :key="index">
                            <jet-label :for="`nutrition${index}`" value="Nutritional Value" class="float-left" />
                            <jet-input :id="`nutrition${index}`" type="text" class="mt-1 block w-full" required v-model="form.nutrition[index].title" />
                        </div>
                        <div class="mt-8 ml-0 pl-0">
                            <jet-button class="py-5 px-20" type="submit">
                                Save
                            </jet-button>
                        </div>
                    </div>
                </form>
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
import DataMixin from '@/Mixins/Helper';
import Ingredient from "@/Components/Ingredient";
import Nutrition from "@/Components/Nutrition";
import {
    watchEffect
} from "vue"
import {
    Inertia
} from '@inertiajs/inertia'

export default {
    mixins: [DataMixin],
    components: {
        AppLayout,
        JetInput,
        JetLabel,
        JetButton,
        // Ingredient,
        Nutrition
    },
    props: {
        recipe: {
            type: Object
        }
    },
    data() {
        return {
            photoUrl: null,
            form: this.$inertia.form({
                name: '',
                description: '',
                cost: '',
                meal_type: '',
                instruction: '',
                ingredient: [{
                    title: '',
                    category: ''
                }],
                nutrition: [{
                    title: ''
                }],
            })
        }
    },
    mounted() {
        this.form.name = this.name
        this.form.description = this.description
    },
    methods: {
        uploadPhoto() {
            this.$refs.photo.click();
        },
        onFileChange(e) {
            const file = e.target.files[0];
            this.photoUrl = URL.createObjectURL(file);
        },
        addIngredient() {
            this.form.ingredient.push({
                title: '',
                category: ''
            })
        },
        addNutrition() {
            this.form.nutrition.push({
                title: ''
            })
        },
        submitForm(e) {
            const file = this.$refs.photo.files[0];
            if (!file) {
                alert("Please upload a photo");
                return;
            }
            const formData = new FormData();
            formData.append('photo', file);
            formData.append('name', this.form.name);
            formData.append('cost', this.form.cost);
            formData.append('description', this.form.description);
            formData.append('meal_type', this.form.meal_type);
            formData.append('instruction', this.form.instruction);
            formData.append('ingredient', JSON.stringify(this.form.ingredient));
            formData.append('nutrition', JSON.stringify(this.form.nutrition));

            Inertia.post(route('recipe.create'), formData
                //    onSuccess: () => console.log("Hello world")
            );
        },
    },
}
</script>
