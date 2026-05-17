<template>
    <NavigationMenuRoot class="navmenu__root">
        <NavigationMenuList class="navmenu__list">
            <NavigationMenuItem class="navmenu__item">
                <NavigationMenuTrigger>
                    <UserIcon color="#e680a5" />
                </NavigationMenuTrigger>

                <NavigationMenuContent
                    class="list-none navmenu__content"
                    as="ul"
                >
                    <template v-if="isAuthenticated">
                        <li class="navmenu__content__item">
                            <LogoutButton class="menu-link menu-link--secondary" />
                        </li>
                    </template>

                    <template v-else>
                        <li class="navmenu__content__item">
                            <NavigationMenuLink 
                                class="menu-link menu-link--primary" 
                                href="/register" 
                                :as="Link">
                                Beitreten
                            </NavigationMenuLink>
                        </li>
                        <li class="navmenu__content__item">
                            <NavigationMenuLink 
                                class="menu-link menu-link--secondary" 
                                href="/login" 
                                :as="Link">
                                Anmelden
                            </NavigationMenuLink>
                        </li>
                    </template>
                </NavigationMenuContent>
            </NavigationMenuItem>
        </NavigationMenuList>
    </NavigationMenuRoot>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

import { 
    NavigationMenuRoot,
    NavigationMenuList,
    NavigationMenuItem,
    NavigationMenuTrigger,
    NavigationMenuContent,
    NavigationMenuLink, 
} from "reka-ui";
import { UserIcon } from "lucide-vue-next";

import LogoutButton from "@/components/auth/LogoutButton.vue";

import { useAuth } from "@/composables/use-auth";

const { isAuthenticated, } = useAuth();
</script>

<style scoped lang="scss">
.navmenu__content__item {
    margin: 8px;
}
</style>