<template>
    <backend-layout>
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
                            <tr>
                                <th class="py-2 px-2">Legal name</th>
                                <th class="py-2 px-2">Date update</th>
                                <th class="py-2 px-2">Zip code</th>
                                <th class="py-2 px-2">Status</th>
                            </tr>
                            <store
                                v-for="store in stores.data"
                                :key="store.id"
                                :store="store"
                            />
                        </table>
                    </div>
                    <pagination :links="stores.links" />
                </div>
            </nav>
        </div>
    </backend-layout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout";
    import BackendLayout from "@/Layouts/BackendLayout";
    import Store from "../../Components/Single/Store";
    import Pagination from "../../Components/UI/Pagination";
    export default {
        name: "Stores",
        components: {Pagination, Store, AppLayout, BackendLayout},
        props: {
            stores: Object,
        },
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
