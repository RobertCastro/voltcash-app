<template>
    <div class="w-full">
        <label
            :class="{ 'text-red-400': error }"
            class="block text-gray-700 text-sm font-bold mb-2"
            :for="id"
        >
            {{ label }}
        </label>
        <select
            :id="id"
            v-bind="$attrs"
            :class="{ 'border-red-400': error }"
            :value="value"
            @input="$emit('input', $event.target.value)"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        >
        <option>Administrator</option>
        <option>Seller</option>
        <option>Compliance</option>
        </select>
        <div v-if="error" class="text-red-500">{{ error }}</div>
    </div>
</template>

<script>
    import FormInput from "../../Mixins/FormInput";
    export default {
        name: "SelectInput",
        mixins: [FormInput]
    }
</script>
