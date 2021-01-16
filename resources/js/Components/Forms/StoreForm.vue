<template>
    <form
        @submit.prevent="$emit('submit')"
        class="">

        <div class="mb-4">
            <text-input
                label="Legal Name"
                v-model="form.legal_name"
                :error="errors.legal_name"
            />
        </div>

    </form>

</template>


<script>
import BackendLayout from "@/Layouts/BackendLayout";
import TextInput from "../Elements/TextInput"
export default {
    name: "StoreForm",
    components: {BackendLayout, TextInput},
    props: {
        errors: Object,
        form: Object,
    }
    
    
}
</script>