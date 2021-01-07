<template>
    <backend-layout>
        <div class="min-h-screen ">
            <div class="">
                <div class="flex flex-wrap sm:flex-no-wrap items-center mb-2">
                    <button
                        v-if="$permissions.can([{name: 'create stores'}])"
                        class="bg-green-500 p-2 hover:bg-green-700 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200 cursor-pointer"
                        @click="showModal = true"
                    >
                    <svg class="h-6 w-6 text-grey-100 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                        Add User
                    </button>
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
    
    export default {
        name: "Users",
        components: {Pagination, User, BackendLayout, DialogModal, DangerButton, SecondaryButton,UserForm, ActionButton},
        props: {
            users: Object,
            errors: Object,
        },
        data() {
            return {
                processing: false,
                showModal: false,
                maxWidth: '3xl',
                showModalEdit: false,
                maxWidthEdit: '2xl',
                form: {
                    id: null,
                    name: null,
                    email: null,
                    phone: null,
                    password: null,
                    rol: null,
                },

            }
        },
        methods: {
            submit() {
                this.processing = true;
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
        }
    }
</script>
