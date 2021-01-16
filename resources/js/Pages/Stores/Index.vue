<template>
    <backend-layout>
        <div class="min-h-screen ">
            <div class="">
                <div class="flex flex-wrap sm:flex-no-wrap items-center mb-2">
                    <div class="w-full pb-3 flex flex-col md:flex-row md:justify-between">
                        <!-- Add user button -->
                        <inertia-link
                            v-if="$permissions.can([{name: 'create stores'}])"
                            class="bg-green-500 p-2 hover:bg-green-700 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200"
                            :href="route('stores.create')" >
                            <svg class="h-6 w-6 text-grey-100 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                            </svg>
                            Add Store
                        </inertia-link>
                        <!-- Status -->
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <div class="relative">
                                <select
                                    v-model="formSearch.state"
                                    class="block appearance-none w-full bg-white border border-gray-300 text-gray-400 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-green-700">
                                    <option value="all" selected class="text-gray-700">Filter by state</option>
                                    <option value="Approved" class="text-gray-700">Approved</option>
                                    <option value="Pending" class="text-gray-700">Pending</option>
                                    <option value="Declined" class="text-gray-700">Declined</option>
                                    <option value="Finished" class="text-gray-700">Finished</option>                                    
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
                        <!-- Input search store -->
                        <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                            <input
                                class="appearance-none block w-full bg-white text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-green-700"
                                v-model="formSearch.search"
                                type="text"
                                placeholder="Search store by name"
                            />
                        </div>
                        <!-- Reset -->
                        <button
                            class="bg-indigo-500 hover:bg-indigo-700 text-white py-2 px-3 rounded focus:outline-none focus:ring"
                            type="button"
                            @click="reset">
                            Reset filters
                        </button>
                    </div>
                </div>
                <div class="bg-white rounded">
                    <div class="bg-white rounded shadow overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <tr>
                                <th class="py-2 px-2">Legal Name</th>
                                <th class="py-2 px-2">Date Update</th>
                                <th class="py-2 px-2">Zip Code</th>
                                <th class="py-2 px-2">Status</th>
                                <th class="py-2 px-2">Actions</th>
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
            </div>
        </div>
       

    </backend-layout>
</template>

<script>
    import BackendLayout from "@/Layouts/BackendLayout";
    import Store from "../../Components/Single/Store";
    import Pagination from "../../Components/UI/Pagination";
    import DangerButton from "../../Jetstream/DangerButton";
    import SecondaryButton from "../../Jetstream/SecondaryButton"
    import ActionButton from '../../Components/Elements/ActionButton';
    import debounce from "lodash/debounce";
    import pickBy from "lodash/pickBy";
    import mapValues from "lodash/mapValues";
    
    export default {
        name: "Stores",
        components: {Pagination, Store, BackendLayout, DangerButton, SecondaryButton, ActionButton},
        props: {
            stores: Object,
            errors: Object,
            filters: Object,
        },
        data() {
            return {
                processing: false,
                formSearch: {
                    search: this.filters.search,
                    state: this.filters.state
                }

            }
        },
        watch: {
            formSearch: {
                handler: debounce(function() {
                    let query = pickBy(this.formSearch)
                    this.$inertia.replace(this.route('stores.index', query))
                }, 500),
                deep: true,
            }
        },
        methods: {
           
            cancel() {
                this.processing = false;
            },
            reset() {
                this.formSearch = mapValues(this.formSearch, () => null);
                this.formSearch.state = 'all';
            },
        },
        created: function () {
            
            if (this.filters.state == null) {
                this.formSearch.state = 'all';
            }

        }

    }
</script>
