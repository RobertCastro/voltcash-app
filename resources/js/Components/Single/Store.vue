<template>
    <tr class="hover:bg-gray-100 focus-within:bg-gray-100">
        <td class="border-t px-6 py-4 flex items-center focus:text-indigo-500">
            {{ store.legal_name }}
        </td>
        <td class="border-t">
            {{ formattedDate }}
        </td>
        <td class="border-t text-center md:text-left">
            {{ formattedDate }}
        </td>
        <td class="border-t">
            {{ formattedDate }}
        </td>

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




        <!-- <td class="border-t w-px">
            <inertia-link
                class="px-4 flex items-center"
                :href="route('dashboard.edit', dato.id)"
            >
                <svg
                    class="block w-6 h-6 fill-gray-400"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <polygon points="12.95 10.707 13.657 10 8 4.343 6.586 5.757 10.828 10 6.586 14.243 8 15.657 12.95 10.707" />
                </svg>
            </inertia-link>
        </td> -->
    </tr>
</template>

<script>
    import moment from 'moment';
    export default {
        name: "Store",
        props: {
            store: Object,
        },

        computed: {
            formattedDate() {
                return moment(this.store.updated_at).format('lll');
            }
        },
    }
</script>
