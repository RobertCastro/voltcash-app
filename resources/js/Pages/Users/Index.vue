<template>
    <backend-layout>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-wrap sm:flex-no-wrap items-center mb-2">
                        <inertia-link
                            v-if="$permissions.can([{name: 'create stores'}])"
                            class="bg-green-500 p-2 hover:bg-green-700 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200"
                            :href="route('stores.create')"
                        >
                        <svg class="h-6 w-6 text-grey-100 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                            <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                        </svg>
                            Add User
                        </inertia-link>
                    </div>
                    <div class="bg-white rounded shadow overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <tr>
                                <th class="py-2 px-2">Name</th>
                                <th class="py-2 px-2">Last Update</th>
                                <th class="py-2 px-2">Email</th>
                                <th class="py-2 px-2">Actions</th>
                            </tr>
                            <user
                                v-for="user in users.data"
                                :key="user.id"
                                :user="user"
                            />
                        </table>
                    </div>
                    <pagination :links="users.links" />
                </div>
            </nav>
        </div>
    </backend-layout>
</template>

<script>
    import BackendLayout from "@/Layouts/BackendLayout";
    import User from "../../Components/Single/User";
    import Pagination from "../../Components/UI/Pagination";
    export default {
        name: "Users",
        components: {Pagination, User, BackendLayout},
        props: {
            users: Object,
        },
    }
</script>
