<template>
<div class="mt-8">
    <jet-label for="nutrition" value="Nutritional Value" class="float-left" />
    <jet-input id="nutrition" type="text" class="mt-1 block w-full" required />
</div>
</template>
<script>
import JetInput from '@/Jetstream/Input'
import JetLabel from '@/Jetstream/Label'
export default {
    components: {
        JetInput,
        JetLabel
    }
}
</script>
