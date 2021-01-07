<template>
    <backend-layout>
        <div class="min-h-screen ">
            <div class="">
                <div class="flex flex-wrap sm:flex-no-wrap items-center mb-2">
                    <div class="w-full pb-3 flex flex-col md:flex-row md:justify-between">
                        <!-- Add user button -->
                        <button
                            v-if="$permissions.can([{name: 'create stores'}])"
                            class="w-full md:w-1/6 bg-green-500 p-2 hover:bg-green-700 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200 cursor-pointer"
                            @click="showModal = true">
                        <svg class="h-6 w-6 text-grey-100 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                            Add User
                        </button>
                        <!-- Roles -->
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <div class="relative">
                                <select
                                    v-model="formSearch.roles"
                                    class="block appearance-none w-full bg-white border border-gray-300 text-gray-400 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-green-700">
                                    <option value="all" selected class="text-gray-700">Filter by rol</option>
                                    <option value="administrator" class="text-gray-700">Administrator</option>
                                    <option value="compliance" class="text-gray-700">Compliance</option>
                                    <option value="seller" class="text-gray-700">Seller</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
                        <!-- Input search -->
                        <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                            <input
                                class="appearance-none block w-full bg-white text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-green-700"
                                v-model="formSearch.search"
                                type="text"
                                placeholder="Search user by name"
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
                                <th class="py-2 px-2">Name</th>
                                <th class="py-2 px-2">Rol</th>
                                <th class="py-2 px-2">Email</th>
                                <th class="py-2 px-2">Phone</th>
                                <th class="py-2 px-2">Actions</th>
                            </tr>
                            <user
                                v-for="user in users.data"
                                :key="user.id"
                                :user="user"
                                @openModalEdit="onClickEdit"
                            />
                        </table>
                    </div>
                    <pagination :links="users.links" />
                </div>
            </div>
        </div>
        <!-- New user -->
        <dialog-modal :show="showModal" @close="showModal = false" :maxWidth="maxWidth">
                <template #title>
                    Add new User
                </template>
                 <template #content>
                    <user-form :errors="errors" :form="form" @submit="submit">
                        <template #buttons class="flex">
                            <action-button
                                @click.native="cancel()"
                                class="btn-accions-cancel mr-10"
                                type="button"
                            >
                            Cancel
                            </action-button>
                            <action-button
                                :loading="processing"
                                class="btn-accions-ok"
                                type="submit"
                            >
                            Create User
                            </action-button>
                        </template>
                    </user-form>
                </template>
                 <template #footer>
                </template>
        </dialog-modal>
        <!-- Edit User -->
        <dialog-modal :show="showModalEdit" @close="showModalEdit = false" :maxWidth="maxWidthEdit">
            <template #title>
                Edit user <strong>{{ form.name }}</strong>
            </template>
            <template #content>
                <user-form :errors="errors" :form="form" @submit="update">
                    <template #buttons class="flex">
                        <action-button
                            @click.native="cancel()"
                            class="btn-accions-cancel mr-10"
                            type="button">
                                Cancel
                        </action-button>
                        <action-button
                            :loading="processing"
                            class="btn-accions-ok"
                            type="submit">
                                Update User
                        </action-button>
                    </template>
                </user-form>
            </template>
            <template #footer>
            </template>
        </dialog-modal>
        

    </backend-layout>
</template>

<script>
    import BackendLayout from "@/Layouts/BackendLayout";
    import User from "../../Components/Single/User";
    import Pagination from "../../Components/UI/Pagination";
    import DialogModal from "../../Jetstream/DialogModal";
    import DangerButton from "../../Jetstream/DangerButton";
    import SecondaryButton from "../../Jetstream/SecondaryButton"
    import UserForm from '../../Components/Forms/UserForm';
    import ActionButton from '../../Components/Elements/ActionButton';
    import debounce from "lodash/debounce";
    import pickBy from "lodash/pickBy";
    import mapValues from "lodash/mapValues";
    
    export default {
        name: "Users",
        components: {Pagination, User, BackendLayout, DialogModal, DangerButton, SecondaryButton,UserForm, ActionButton},
        props: {
            users: Object,
            errors: Object,
            filters: Object,
        },
        data() {
            return {
                processing: false,
                showModal: false,
                maxWidth: '3xl',
                showModalEdit: false,
                maxWidthEdit: '2xl',
                option: 'Hola', 
                form: {
                    id: null,
                    name: null,
                    email: null,
                    phone: null,
                    password: null,
                    rol: null,
                },
                formSearch: {
                    search: this.filters.search,
                    roles: this.filters.roles
                }

            }
        },
        watch: {
            formSearch: {
                handler: debounce(function() {
                    let query = pickBy(this.formSearch)
                    this.$inertia.replace(this.route('users.index', query))
                }, 500),
                deep: true,
            }
        },
        methods: {
            submit() {
                this.processing = true;
                console.log(this.form);
                this.$inertia.post(this.route('users.store'), this.form)
                    .then(() => {
                        
                        this.processing = false;
                        this.showModal = false;
                        this.cancel();
                        
                    }).catch(e => {

                        this.processing = false;
                        this.form.name = '';
                        this.form.email = '';
                        this.form.phone = '';
                        this.form.password = '';
                        this.form.rol = '';

                    });
            },
            cancel() {
                this.processing = false;
                this.showModal = false;
                this.showModalEdit = false;
                this.form.name = '';
                this.form.email = '';
                this.form.phone = '';
                this.form.password = '';
                this.form.rol = '';
            },
            onClickEdit(userid) {
                
                let userEdit = this.users.data.find(user => user.id == userid);
                this.form.id = userid;
                this.form.name = userEdit.name;
                this.form.email = userEdit.email;
                this.form.phone = userEdit.phone;
                this.form.rol = userEdit.roles[0].name;
                this.showModalEdit = true;
            },
            update() {
                this.processing = true;
                this.$inertia.put(this.route('users.update', this.form.id), this.form)
                .then(() => {
                    this.showModalEdit = false;
                    this.processing = false;
                })
            },
            reset() {
                this.formSearch = mapValues(this.formSearch, () => null);
                this.formSearch.roles = 'all';
            },
        },
        created: function () {
            
            if (this.filters.roles == null) {
                this.formSearch.roles = 'all';
            }

        }

    }
</script>
