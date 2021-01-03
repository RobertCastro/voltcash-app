<template>
    <app-layout>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-wrap sm:flex-no-wrap items-center mb-2">
                        <inertia-link
                            v-if="$permissions.can([{name: 'create stores'}])"
                            class="bg-indigo-500 p-2 hover:bg-indigo-700 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200"
                            :href="route('stores.create')"
                        >
                            Create Store
                        </inertia-link>
                    </div>
                    <div class="bg-white rounded shadow overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr>
                                    <th class="py-2 px-2">Creation date</th>
                                    <th class="py-2 px-2">Date update</th>
                                    <th class="py-2 px-2">Zip code</th>
                                    <th class="py-2 px-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="store in stores.data" :key="store.id">
                                    <td class="border-t py-3 px-3">
                                        <a href="" class="text-center font-medium whitespace-no-wrap">
                                            {{ store.legal_name }}
                                        </a>
                                    </td>
                                    <td class="border-t">
                                        <a href="" class="text-center font-medium whitespace-no-wrap">
                                            {{ store.updated_at }}
                                        </a>
                                    </td>
                                    <td class="border-t">{{ store.created_at }}</td>
                                    <td class="border-t w-56">
                                        <div class="flex justify-center items-center">
                                            <inertia-link
                                                :href="route('stores.show', store.id)"
                                                class="disabled text-xs px-4 py-2 rounded-full bg-gray-200 hover:bg-hp-400 hover:text-black text-gray-800 inline-flex items-center"
                                                v-if="!store.deleted_at && $permissions.can([{name: 'show stores'}, {name: 'show own stores', owner: store.user_id}])"
                                            >
                                                Detalle
                                            </inertia-link>
                                            <inertia-link
                                                :href="route('stores.edit', store.id)"
                                                class="disabled text-xs px-4 py-2 rounded-full bg-gray-200 hover:bg-hp-400 hover:text-black text-gray-800 inline-flex items-center"
                                                v-if="!store.deleted_at && $permissions.can([{name: 'update stores'}, {name: 'update own stores', owner: store.user_id}])"
                                            >
                                                Editar
                                            </inertia-link>
                                            <button
                                                class="text-xs px-4 py-2 rounded-full bg-red-200 hover:bg-hp-400 hover:text-black text-gray-800 inline-flex items-center"
                                                v-if="!store.deleted_at && $permissions.can([{name: 'delete stores'}, {name: 'delete own stores', owner: store.user_id}])"
                                                @click="remove(store)"
                                            >
                                                Borrar
                                            </button>
                                            <button
                                                class="text-xs px-4 py-2 rounded-full bg-red-200 hover:bg-hp-400 hover:text-black text-gray-800 inline-flex items-center"
                                                v-if="store.deleted_at && $permissions.can([{name: 'restore stores'}, {name: 'restore own stores', owner: store.user_id}])"
                                                @click="restore(store)"
                                            >
                                                Restaurar
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </nav>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout";
    export default {
        name: "Stores",
        components: {AppLayout},
        props: ["stores"],
        methods: {
            remove(store) {
                const formData = new FormData;
                formData.append("_method", "DELETE");
                this.$inertia.post(this.route("stores.destroy", store.id), formData)
                    .then(() => {})
            },
            restore(store) {
                const formData = new FormData;
                formData.append("_method", "PUT");
                this.$inertia.post(this.route("stores.restore", store.id), formData)
                    .then(() => {})
            }
        }
    }
</script>
