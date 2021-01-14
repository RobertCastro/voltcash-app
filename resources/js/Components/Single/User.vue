<template>
    <tr class="hover:bg-gray-100 focus-within:bg-gray-100">
        <td class="border-t">
            <button
                class="px-6 py-4 flex items-center focus:text-green-500 cursor-pointer focus:outline-none focus:ring focus:font-bold "
                @click="showModalDetail = true"
                v-if="!user.deleted_at && $permissions.can([{name: 'show stores'}, {name: 'show own stores', owner: user.user_id}])" >
            {{ user.name }}
            </button>
            <p class="px-6 py-4 flex items-center " v-else >
            {{ user.name }}
            </p>
        </td>
        <td class="border-t">
            {{ user.roles[0].name }}
        </td>
        <td class="border-t text-center md:text-left">
            {{ user.email }}
        </td>
        <td class="border-t text-center md:text-left">
            {{ user.phone }}
        </td>

        <td class="border-t w-56">
            <div class="flex justify-center items-center">
                <button
                    @click="sendInfo(user.id)"
                    class="disabled text-xs px-4 py-1 mr-3 rounded-xl shadow-lg bg-indigo-500 font-bold hover:bg-hp-400 text-gray-100 inline-flex items-center"
                    v-if="!user.deleted_at && $permissions.can([{name: 'update stores'}, {name: 'update own stores', owner: user.user_id}])"
                >
                Edit
                </button>
                <button
                    class="disabled text-xs px-4 py-1 rounded-xl shadow-lg bg-red-500 font-bold hover:bg-hp-400 text-gray-100 inline-flex items-center"
                    v-if="!user.deleted_at && $permissions.can([{name: 'delete stores'}, {name: 'delete own stores', owner: user.user_id}]) && $page.user.name != user.name"
                    @click="showModalDelete = true" >
                    Delete
                </button>
                <button
                    class="disabled text-xs px-4 py-1 rounded-xl shadow-lg bg-indigo-400 font-bold hover:bg-hp-400 text-gray-100 inline-flex items-center"
                    v-if="user.deleted_at && $permissions.can([{name: 'restore stores'}, {name: 'restore own stores', owner: user.user_id}])"
                    @click="restore(user)">
                    Restore
                </button>
                <button
                    class="px-4 flex items-center cursor-pointer"
                    @click="showModalDetail = true"
                    v-if="!user.deleted_at && $permissions.can([{name: 'show stores'}, {name: 'show own stores', owner: user.user_id}])" >
                    <svg
                        class="block w-6 h-6 fill-gray-400"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <polygon points="12.95 10.707 13.657 10 8 4.343 6.586 5.757 10.828 10 6.586 14.243 8 15.657 12.95 10.707" />
                    </svg>
                </button>
            </div>
        </td>

        <!-- Delete user -->
        <confirmation-modal :show="showModalDelete" @close="showModalDelete = false">
            <template #title>
                Deleted user
            </template>
            <template #content>
                Are you sure you want to delete the data?
            </template>
            <template #footer>
                <secondary-button @click.native="showModalDelete = false">
                    Cancel
                </secondary-button>
                <danger-button @click.native="remove(user)" class="ml-2" :class="{ 'opacity-25': processing }" :disabled="processing">
                    Delete
                </danger-button>
            </template>
        </confirmation-modal>
        <!-- Detail user --> 
        <dialog-modal :show="showModalDetail" @close="showModalDetail = false" :maxWidth="maxWidthDetail">
            <template #title>
                Detail user <strong>{{user.name}}</strong>
            </template>
            <template #content>
            </template>
            <template #footer>
            </template>
        </dialog-modal>
        
    </tr>
</template>

<script>
    import moment from 'moment';
    import ConfirmationModal from "../../Jetstream/ConfirmationModal";
    import SecondaryButton from "../../Jetstream/SecondaryButton";
    import DangerButton from "../../Jetstream/DangerButton";
    import DialogModal from "../../Jetstream/DialogModal";
    import UserForm from '../../Components/Forms/UserForm';

    export default {
        name: "User",
        components: {SecondaryButton, ConfirmationModal, DangerButton, DialogModal, UserForm},
        
        props: {
            user: Object,
            errors: Object,
        },

        data() {
            return {
                showModalDelete: false,
                showModalDetail: false,
                processing: false,
                maxWidthDetail: '2xl',
            }
        },

        methods: {
            remove(user) {
                const formData = new FormData;
                formData.append("_method", "DELETE");
                this.$inertia.post(this.route("users.destroy", user.id), formData)
                    .then(() => {})
            },
            restore(user) {
                const formData = new FormData;
                formData.append("_method", "PUT");
                this.$inertia.post(this.route("users.restore", user.id), formData)
                    .then(() => {})
            },
            cancel() {
                this.processing = false;
                this.showModalEdit = false;
                this.form.name = '';
                this.form.email = '';
                this.form.phone = '';
                this.form.password = '';
                this.form.rol = '';
            },
            sendInfo(userid) {
                console.log(userid)
                this.$emit('openModalEdit', userid)
            }
        },

        computed: {
            formattedDate() {
                return moment(this.user.updated_at).format('lll');
            },

        },
    }
</script>
