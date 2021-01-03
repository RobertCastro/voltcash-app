<template>
    <div class="mt-6 flex flex-wrap">
        <template v-for="(link, key) in links">
            <div
                v-if="!link.url"
                :key="key"
                class="mr-1 mb-1 px-4 py-3 text-sm border rounded text-gray-500"
            >
                {{ link.label }}
            </div>
            <inertia-link
                v-else
                :key="key"
                class="mr-1 mb-1 px-4 py-3 text-sm border rounded focus:border-green-500 focus:text-green-500"
                :class="{ 'bg-green-600 text-white': link.active }"
                :href="link.url"
            >
                {{ link.label }}
            </inertia-link>
        </template>
    </div>
</template>

<script>
    export default {
        name: "Pagination",
        props: {
            links: Array
        }
    }
</script>
