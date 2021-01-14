<template>
    <header class="flex justify-between items-center py-4 px-6 bg-white border-b-2 border-grey-200">
        <div class="flex items-center">
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center content-start">
              <button @click="toggleSidebar" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                  <path :class="{'hidden': showingNavigation, 'inline-flex': ! showingNavigation }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                  <path :class="{'hidden': ! showingNavigation, 'inline-flex': showingNavigation }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
        </div>
        <div class="flex items-center">
            <button class="flex mx-4 text-gray-600 focus:outline-none">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>

            <div class="relative">
                <button
                    @click="dropdownOpen = !dropdownOpen"
                    class="relative z-10 block h-8 w-8 rounded-full overflow-hidden shadow focus:outline-none" >
                    <img
                        class="h-full w-full object-cover shadow-2xl"
                        :src="$page.user.profile_photo_url"
                        :alt="$page.user.name"
                        :title="$page.user.name"
                    />
                </button>
                <div
                    v-show="dropdownOpen"
                    @click="dropdownOpen = false"
                    class="fixed inset-0 h-full w-full z-10" >
                </div>

                <div
                    v-show="dropdownOpen"
                    class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl z-20" >
                    <inertia-link
                        :href="route('profile.show')"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-600 hover:text-white" >
                        Profile
                    </inertia-link>
                    <a
                        href="#"
                        @click="logout"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-600 hover:text-white" >
                    Logout
                    </a>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
    export default {
        name: "BackendHeader",
        props: {
            user: Object
        },
        data() {
            return {
                dropdownOpen: false,
                showingNavigation: true,
            }
        },
        methods: {
            logout() {
                axios.post('/logout').then(response => {
                    window.location = '/login';
                })
            },
            toggleSidebar() {
              this.showingNavigation = !this.showingNavigation;
              this.$emit('toggleSidebar', this.showingNavigation);
            },
    
        },
        created() {
            if (screen.width < 801){
                this.toggleSidebar();
            } 
        }

    };
</script>
