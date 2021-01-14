<template>
    <section :class="{'block': showSidebar, 'hidden': ! showSidebar}" class="xs:hidden ">
        <div class="h-screen fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-green-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
            <div class="flex items-center justify-center mt-8">
                <div class="flex items-center">
                    <svg class="w-7 h-7 text-yellow-300 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-white text-2xl mx-2 font-semibold">Voltcash Stores <sup class="text-xs"></sup></span>
                </div>
            </div>

            <nav class="mt-10">
                <inertia-link
                    class="flex items-center mt-4 py-2 px-6 border-l-4"
                    :class="[$page.currentRouteName === 'stores.index' ? activeClass : inactiveClass]"
                    href="/stores">
                    <svg class="h-6 w-6 text-grey-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                    </svg>
                    <span class="mx-4">Stores</span>
                </inertia-link>
                <inertia-link
                    class="flex items-center mt-4 py-2 px-6 border-l-4"
                    :class="[$page.currentRouteName === 'reports' ? activeClass : inactiveClass]"
                    href="/reports" >
                    <svg class="h-6 w-6 text-grey-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                    </svg>
                    <span class="mx-4">Reports</span>
                </inertia-link>
                <inertia-link
                    class="flex items-center mt-4 py-2 px-6 border-l-4"
                    :class="[$page.currentRouteName === 'shopkeeper' ? activeClass : inactiveClass]"
                    href="/shopkeeper">
                    <svg class="h-6 w-6 text-grey-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                    </svg>
                    <span class="mx-4">Shopkeepers</span>
                </inertia-link>
                <p class="flex items-center mt-4 py-2 px-6 uppercase text-gray-100 font-bold">Settings</p>
                <inertia-link
                    class="flex items-center mt-4 py-2 px-6 border-l-4"
                    :class="[$page.currentRouteName === 'users.index' ? activeClass : inactiveClass]"
                    href="/users">
                    <svg class="h-6 w-6 text-grey-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                    </svg>
                    <span class="mx-4">Users</span>
                </inertia-link>
                <inertia-link
                    class="flex items-center mt-4 py-2 px-6 border-l-4"
                    :class="[$page.currentRouteName === 'profile.show' ? activeClass : inactiveClass]"
                    href="/user/profile">
                    <svg class="h-6 w-6 text-grey-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                    <span class="mx-4">Profile</span>
                </inertia-link>
            </nav>
        </div>
    </section>
</template>

<script>
    export default {
        name: "BackendSidebar",
        props: {
            showSidebar: {
                type: Boolean,
                default: () => false
            }
        },
        data() {
            return {
                activeClass: "hover:bg-green-800 text-gray-100 border-green-100 font-bold shadow-lg ",
                inactiveClass: "border-green-900 text-green-200 hover:bg-green-600 hover:bg-opacity-25 hover:text-gray-100",
                
            }
        },
        
       
    };
</script>
