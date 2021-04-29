<template>
    <nav class="flex items-stretch justify-between h-8">
        <ul>
            <li>
                <button class="md:hidden"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg></button>
            </li>
        </ul>
        <div>
            <Menu>
                <MenuButton class="relative">Mohamed Amine</MenuButton>
                <MenuItems as="ul" class="bg-white w-52 bg-clip-padding rounded border border-gray-800 border-opacity-5 absolute top-12 left-auto right-0">
                    <MenuItem as="li" v-slot="{ active }">
                        <a :class='{ "bg-primary-100": active }' class="w-auto flex items-center dropdown-item" href="/account-settings">
                            Profile
                        </a>
                    </MenuItem>
                    <MenuItem as="li" v-slot="{ active }">
                        <a :class='{ "bg-primary-100": active }'  class="w-auto flex items-center dropdown-item" href="/account-settings">
                            Settings
                        </a>
                    </MenuItem>
                    <MenuItem as="li" v-slot="{ active }">
                        <a :class='{ "bg-primary-100": active }' class="w-auto flex items-center dropdown-item" href="/account-settings">
                            Logout
                        </a>
                    </MenuItem>
                    <MenuItem as="li" disabled>
                        <span class="opacity-75">Invite a friend (coming soon!)</span>
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
