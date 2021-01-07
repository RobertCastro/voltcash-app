<template>
    <form
        @submit.prevent="$emit('submit')"
        class="bg-white "
    >
    <div class="mb-4">
        <text-input
            label="Name"
            v-model="form.name"
            :error="errors.name"
        />
    </div>
    <div class="mb-4">
        <text-input
            label="Email"
            v-model="form.email"
            :error="errors.email"
        />
    </div>
    <div class="mb-4">
        <text-input
            label="Phone"
            v-model="form.phone"
            :error="errors.phone"
        />
    </div>
    <div class="mb-4">
        <text-input
            label="Password"
            v-model="form.password"
            :error="errors.password"
        />
    </div>
    <div class="mb-4" v-if="this.action = 'new'">
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
        action: ''
    }
}
</script>