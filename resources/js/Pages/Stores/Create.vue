<template>
    <backend-layout>
        <div class="flex justify-center pb-6">
            <h3 class=" text-3xl text-green-600">Create store <strong class="font-black"> {{ form.legal_name }} </strong></h3>
        </div>
        <div class="steps">
            <ul class="flex justify-evenly">
                <li>1</li>
                <li>2</li>
                <li class="active">3</li>
                <li>4</li>
                <li>5</li>
            </ul>
        </div>
        <store-form :errors="errors" :form="form" @submit="submit">

        </store-form>
    </backend-layout>
</template>

<script>
import BackendLayout from "@/Layouts/BackendLayout";
import StoreForm from '../../Components/Forms/StoreForm.vue';

export default {
    name: "Create",
    components: {BackendLayout, StoreForm},
    props: {        
        errors: Object,
    },
    data() {
        return {
            processing: false,
            legal_name: '',
            form: {
                legal_name: null
            }
        }
        
    },
    methods: {
        submit() {
                this.processing = true;
        }
    }
}
</script>