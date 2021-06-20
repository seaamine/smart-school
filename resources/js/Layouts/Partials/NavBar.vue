<template>
    <nav class="flex items-center content-center items-stretch justify-between h-10">
        <ul class="flex flex-warp content-center items-center">
            <li class="lg:hidden mr-4">
                <button class="" @click="$emit('toggle-sidebar', 0.1)"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg></button>
            </li>

            <li class="hidden lg:list-item">
                <inertia-link class="flex items-center"   :href="route('home')">
                    <img class="mr-2" style="width: 45px; height: 45px;" width="45" height="45" :src="$page.props.appUrl+'/images/logo.png'">
                    <span style=" margin: auto 0px auto 0;" class="text-primary-500 align-middle font-semibold text-xl">Smart School</span>
                </inertia-link>

            </li>
        </ul>
        <div>
            <Menu>
                <MenuButton class="relative flex content-center">
                    <div class="text-right mr-3 flex flex-col">
                        <p class="font-semibold">{{ $page.props.user.name }}</p>
                        <span class="text-sm leading-3">{{ $page.props.user.role }}</span>
                    </div>
                    <span>
                        <img style="width: 40px; height: 40px" :src="$page.props.user.photo_url">
                    </span>
                </MenuButton>
                <MenuItems as="ul" class="bg-white w-52 bg-clip-padding rounded border border-gray-800 border-opacity-5 absolute top-16 left-auto right-0 z-10">
                    <MenuItem as="li" v-slot="{ active }">
                        <inertia-link :href="route('logout')" method="post"  :class='{ "bg-primary-100": active }' class="w-auto flex items-center dropdown-item" >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </inertia-link>
                    </MenuItem>
                </MenuItems>
            </Menu>
        </div>
    </nav>
</template>

<script>
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";

export default {
    name: "NavBar",
    components: {
        Menu,
        MenuButton,
        MenuItems,
        MenuItem,
    },
}
</script>

<style scoped>
    a.dropdown-item:active{
        background-color: #9e95f5;
    }
</style>
