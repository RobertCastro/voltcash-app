<template>
    <form
        @submit.prevent="$emit('submit')"
        class="bg-gray-100 "
    >
    <div class="mb-4 flex justify-between flex-row">
        <text-input
            label="Name"
            v-model="form.name"
            :error="errors.name"
            class="w-1/2 m-5"
        />
        <text-input
            label="Email"
            v-model="form.email"
            :error="errors.email"
            class="w-1/2 m-5"
        />
    </div>
    <div class="mb-4 flex justify-between flex-row">
        <text-input
            label="Phone"
            v-model="form.phone"
            :error="errors.phone"
            class="w-1/2 m-5"
        />
   
        <text-input
            label="Password"
            v-model="form.password"
            :error="errors.password"
            class="w-1/2 m-5"
        />
    </div>
    <div class="mb-4">
        <select-input
            label="Rol"
            v-model="form.rol"
            :error="errors.rol"
        />
    </div>
    <div class="px-8 py-4 border-t border-gray-200 flex justify-end items-center">
       <slot name="buttons" />
    </div>
    </form>
</template>


<script>
import TextInput from "../Elements/TextInput"
import TextAreaInput from "../Elements/TextAreaInput"
import SelectInput from "../Elements/SelectInput"

export default {
    
    name: "UserForm",
    components: {
        TextInput, TextAreaInput, SelectInput
    },
    props: {
        errors: Object,
        form: Object,
    }
}
</script>