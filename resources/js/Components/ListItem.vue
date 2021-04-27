<template>
    <tr>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10">
                    <img
                        class="h-10 w-10 rounded-full"
                        src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60"
                        alt=""
                    />
                </div>
                <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                        {{ name }}
                    </div>
                    <div class="text-sm text-gray-500">Breakfast</div>
                </div>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-500">
                {{ description }}
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <span
                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-green-800"
            >
                {{ status }}
            </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ cost }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <inertia-link :href="route('dashboard.show', { dashboard })" class="text-indigo-600 hover:text-indigo-900">
                View
            </inertia-link>
        </td>
    </tr>
</template>

<script>
export default {
    props: {
        recipe: {
            type: Object,
        }
    },
    computed: {
        name() {
            return this.recipe.name;
        },

        description() {
            return this.recipe ? `${this.recipe.description.substring(0, 50)}...` : 'N/A'
        },
        status() {
            const capitalizeText = this.recipe.status.substring(0, 1).toUpperCase();
            return `${capitalizeText}${this.recipe.status.substring(1)}`;
        },
        cost() {
            const cost = this.recipe.cost || 0;
            return `$${cost}`;
        },
        dashboard() {
            return this.recipe.id;
        }
    }
}
</script>
