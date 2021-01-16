<template>
    <tr class="hover:bg-gray-100 focus-within:bg-gray-100">
        <td class="border-t px-6 py-4 flex items-center focus:text-indigo-500">
             <button
                class="px-6 py-4 flex items-center focus:text-green-500 cursor-pointer focus:outline-none focus:ring focus:font-bold"
                @click="showModalDetail = true">
            {{ store.legal_name }}
            </button>
        </td>
        <td class="border-t">
            {{ formattedDate }}
        </td>
        <td class="border-t text-center md:text-left">
            
        </td>
        <td class="border-t">
            <span :class="[setColorStatus]" >{{ store.status }}</span>
        </td>

        <td class="border-t w-56">
            <div class="flex justify-center items-center">
                <button
                    @click="sendInfo(store.id)"
                    class="disabled text-xs px-4 py-1 mr-3 rounded-xl shadow-lg bg-indigo-500 font-bold hover:bg-hp-400 text-gray-100 inline-flex items-center">
                Edit
                </button>
                <button
                    class="disabled text-xs px-4 py-1 rounded-xl shadow-lg bg-red-500 font-bold hover:bg-hp-400 text-gray-100 inline-flex items-center"
                    @click="showModalDelete = true" >
                    Delete
                </button>
                <button
                    class="disabled text-xs px-4 py-1 rounded-xl shadow-lg bg-indigo-400 font-bold hover:bg-hp-400 text-gray-100 inline-flex items-center"
                    @click="restore(store)"
                    v-if="store.deleted_at" >
                    Restore
                </button>
                <button
                    class="px-4 flex items-center cursor-pointer"
                    @click="showModalDetail = true"
                    v-if="!store.deleted_at" >
                    <svg
                        class="block w-6 h-6 fill-gray-400"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <polygon points="12.95 10.707 13.657 10 8 4.343 6.586 5.757 10.828 10 6.586 14.243 8 15.657 12.95 10.707" />
                    </svg>
                </button>

            </div>
        </td>
    </tr>
</template>

<script>
    import moment from 'moment';
    export default {
        name: "Store",
        props: {
            store: Object,
        },

        data() {
            return {
                declined: "bg-red-400 rounded text-white p-1 text-xs",
                pending: "bg-purple-400 rounded text-white p-1 text-xs",
                finished: "bg-green-400 rounded text-white p-1 text-xs",
                approved: "bg-blue-400 rounded text-white p-1 text-xs"
            }
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
        },

        computed: {
            formattedDate() {
                return moment(this.store.updated_at).format('lll');
            },
            setColorStatus() {
                let status = this.store.status;
                switch (status) {
                    case 'Declined':
                        return this.declined;
                        break;
                    case 'Pending':
                        return this.pending;
                        break;
                    case 'Finished':
                        return this.finished;
                        break;
                    case 'Approved':
                        return this.approved;
                        break;
                    default:
                        return this.pending;
                }
            }
        },
    }
</script>
