<template>
<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
    <inertia-link :href="route('guest')" class="text-gray-800 text-sm font-semibold p-3 rounded-md">
        &laquo; Back
    </inertia-link>

    <div class="w-2/3 mx-auto pt-10 pb-10">
        <inertia-link v-show="userRole" :href="route('dashboard.edit', { id: id })" class="bg-gray-400 hover:bg-gray-600 text-white text-sm font-semibold p-3 rounded-md">
            Edit Recipe
        </inertia-link>
        <br /><br />
        <div class="flex">
            <div class="w-5/12 h-100">
                <img class="h-100 rounded-md" :src="`/photo/${photo}`" alt="Recipe photo" />
            </div>
            <div class="w-7/12 p-5">
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                    {{ name }}
                </h2>
                <p class="mt-5 text-sm">{{ description }}</p>
                <p class="mt-5 text-sm text-gray-500 ont-semibold" v-if="mealType">Meal best for <b>{{ mealType }}</b></p>
                <span class="text-gray-500">
                    <p class="text-sm mt-5 mb-5">Estimated Cost:</p>
                    <span class="bg-red-500 rounded-lg p-3 text-white text-lg font-bold" v-if="cost">{{ cost }}</span>
                </span>
                <p class="mt-5 text-sm text-gray-500 ont-semibold" v-if="status">Status: <b class="text-yellow-400">{{ status }}</b></p>
            </div>
        </div>
        <div class="mt-10 flex">
            <div class="w-6/12" v-if="ingredient.length">
                <h3 class="font-semibold text-lg pb-3">
                    Ingredients
                </h3>
                <ul class="list-decimal pl-8">
                    <li class="font-bold pt-2 pb-2 text-gray-800" v-for="(value, index) in ingredient" :key="index">
                        {{ value.quantity }} {{ value.content }}
                    </li>
                </ul>
            </div>
            <div class="w-6/12" v-if="nutrition.length">
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
                            <tr class="text-sm font-normal" v-for="(value, index) in nutrition" :key="index">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        {{ value.content }}
                                    </div>
                                </td>
                                <td class="px-10 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        {{ value.value }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        {{ value.percentage }}
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
                {{ value.title }} &nbsp; {{ value.content }}
            </p>
        </div>
        <div class="mt-8 ml-0 pl-0">
            <div class="mt-4">
                <jet-button class="py-3 px-5 rounded-md text-white bg-red-500 hover:bg-red-300" v-show="!isAdmin && isLoggedIn" @click="deleteRecipe">
                    Delete
                </jet-button>
                <div class="" v-show="isAdmin">
                    <label class="items-center mt-3">
                        <input type="radio" class="form-radio h-5 w-5 text-gray-600" name="status" value="approve" v-model="form.status" :checked="this.status === 'approve'"><span class="ml-2 text-gray-700">Approve</span>
                    </label>
                    <label class="items-center mt-3 pl-5">
                        <input type="radio" class="form-radio h-5 w-5 text-gray-600" name="status" value="reject" v-model="form.status" :checked="this.status === 'reject'"><span class="ml-2 text-gray-700">Reject</span>
                    </label>
                    <p></p>
                    <div v-show="isRejected">
                        <label class="items-center mt-3 text-sm block">Comment </label>
                        <textarea rows="5" v-model="form.comment" class="border-gray-300 w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                    </div>

                    <jet-button @click="changeStatus" class="py-5 px-5 mt-5 rounded-md text-white bg-green-500 hover:bg-green-300">
                        Submit
                    </jet-button>
                    <span class="text-sm text-gray-600 pl-4 pt-3" v-show="isSuccessful">Saved.</span>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import {
    reactive,
    watchEffect,
    ref,
    onMounted
} from "vue";
import DataMixin from '@/Mixins/Helper';
import JetButton from '@/Jetstream/Button'
import {
    Inertia
} from '@inertiajs/inertia'

export default {
    mixins: [DataMixin],
    components: {
        JetButton,
    },
    data() {
        return {
            isSuccessful: false,
        }
    },
    props: {
        recipe: {
            type: Object
        },
        isAdmin: {
            type: Boolean
        },
        isLoggedIn: {
            type: Boolean
        }
    },
    computed: {
        userRole() {
            if (this.isAdmin || !this.isAdmin && this.status === 'approve') {
                return false;
            }
            return true;
        }
    },
    setup(props) {
        const form = reactive({
            status: null,
            comment: null,
            recipeId: props.recipe.data.id ?? null
        })
        const isRejected = ref(null)

        onMounted(() => {
            form.comment = props.recipe.data ? props.recipe.data.comment : null
            if (props.recipe.data.status === 'reject' && form.status === null) {
                isRejected.value = true
            }
        });

        watchEffect(() => {
            if (form.status === 'reject') {
                isRejected.value = true
            } else {
                isRejected.value = false
            }
        });

        const changeStatus = () => {
            form.comment = form.status === 'reject' ? form.comment : null;
            if (form.status === null) {
                return;
            }

            Inertia.post(route('recipe.status'), {
                ...form,
                onSuccess: () => {
                    console.log("success")
                }
            });
        }

        const deleteRecipe = () => {
            const id = props.recipe.data.id;
            if (window.confirm("Are you sure ?")) {
                Inertia.delete(route('recipe.destroy', { id: id }), {
                    onSuccess: () => {
                        console.log("success")
                    }
                });
            }
        }

        return {
            form,
            isRejected,
            changeStatus,
            deleteRecipe
        }
    }
}
</script>
