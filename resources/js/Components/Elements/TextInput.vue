<template>
    <div class="">
        <label
            :class="{ 'text-red-400': error }"
            class="font-bold mb-1 text-gray-700 block"
            :for="id">
            {{ label }}
        </label>
        <input
            :id="id"
            v-bind="$attrs"
            :class="{ 'border-red-400': error }"
            :value="value"
            @input="$emit('input', $event.target.value)"
            class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"/>
        <div v-if="error" class="text-red-500">{{ error }}</div>
    </div>
</template>

<script>
    import FormInput from "../../Mixins/FormInput";
    export default {
        name: "TextInput",
        mixins: [FormInput]
    }
</script>
