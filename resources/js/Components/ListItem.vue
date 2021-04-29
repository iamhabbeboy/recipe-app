<template>
<tr>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10">
                 <img class="h-10 w-10 rounded-full" :src="`/photo/${photo}`" alt="photo" />
            </div>
            <div class="ml-4">
                <div class="text-sm font-medium text-gray-900">
                    {{ name }}
                </div>
                <div class="text-sm text-gray-500">{{ mealType }} </div>
            </div>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-500">
            {{ description }}
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-green-800">
            {{ status }}
        </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ cost }}</td>
    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
        <inertia-link :href="hasLogin ? route('dashboard.show', { dashboard: id }) : route('guest.show', { id: dashboard })" class="text-indigo-600 hover:text-indigo-900">
            View
        </inertia-link>
    </td>
</tr>
</template>

<script>
import DataMixin from "@/Mixins/Helper";
export default {
    mixins: [DataMixin],
    props: {
        recipe: {
            type: Object,
        },
        hasLogin: {
            type: Boolean
        }
    },
}
</script>
