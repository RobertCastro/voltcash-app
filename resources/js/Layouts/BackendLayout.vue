<template>
    <div class="flex h-screen bg-gray-100 font-roboto">
        <backend-sidebar :showSidebar="sidebar" />
        <div class="flex-1 flex flex-col overflow-hidden">
            <backend-header @toggleSidebar="toggleSidebar" />

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <flash-messages />
                <div class="container mx-auto px-6 py-8">
                    <slot />
                </div>
            </main>
        </div>

        <!-- Modal Portal -->
        <portal-target name="modal" multiple>
        </portal-target>

    </div>
</template>
<script>
    import BackendSidebar from "../Components/Backend/Sidebar";
    import BackendHeader from "../Components/Backend/Header";
    import FlashMessages from "../Components/UI/FlashMessages";
    export default {
        name: "BackendLayout",
        components: {FlashMessages, BackendHeader, BackendSidebar},
        data() {
            return {
                sidebar: true,
            }
        },
        methods: {
            toggleSidebar(toggleData) {
                this.sidebar = toggleData;
                // console.log(this.sidebar)
            }
        }
    }
</script>
