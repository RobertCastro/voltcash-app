<template>
    <div>
        <div v-if="$page.flash.success && show" class="mb-8 flex items-center justify-between bg-green-500 w-full shadow-lg">
            <div class="flex items-center">
                <svg class="ml-4 mr-2 flex-shrink-0 w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <div class="py-4 text-white text-md font-medium">{{ $page.flash.success }}</div>
            </div>
            <button type="button" class="group mr-2 p-2" @click="show = false">
                <svg class="ml-4 mr-2 flex-shrink-0 w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <div v-if="$page.flash.status && show" class="mb-8 flex items-center justify-between bg-indigo-500 w-full shadow-lg">
            <div class="flex items-center">
                <svg class="ml-4 mr-2 flex-shrink-0 w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <div class="py-4 text-white text-md font-medium" v-if="$page.flash.status === 'verification-link-sent'">
                    Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionó durante el registro.
                </div>
                <div class="py-4 text-white text-md font-medium" v-else>
                    {{ $page.flash.status }}
                </div>
            </div>
            <button type="button" class="group mr-2 p-2" @click="show = false">
                <svg class="ml-4 mr-2 flex-shrink-0 w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <div v-if="($page.flash.error || Object.keys($page.errors).length > 0) && show" class="mb-8 flex items-center justify-between bg-red-600 w-full shadow-lg">
            <div class="flex items-center">
                <svg class="ml-4 mr-2 flex-shrink-0 w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                <div v-if="$page.flash.error" class="py-4 text-white text-sm font-medium">{{ $page.flash.error }}</div>
                <div v-else class="py-4 text-white text-md font-medium">
                    <span v-if="Object.keys($page.errors).length === 1">Tienes 1 error en el formulario</span>
                    <span v-else>Tienes {{ Object.keys($page.errors).length }} errores en el formulario</span>
                </div>
            </div>
            <button type="button" class="group mr-2 p-2" @click="show = false">
                <svg class="ml-4 mr-2 flex-shrink-0 w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "FlashMessages",
        data() {
            return {
                show: true,
            }
        },
        watch: {
            '$page.flash': {
                handler() {
                    this.show = true
                },
                deep: true,
            },
        },
    }
</script>
