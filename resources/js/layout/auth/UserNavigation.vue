<template>
    <NavigationMenuRoot class="navmenu__root">
        <NavigationMenuList class="navmenu__list">
            <NavigationMenuItem class="navmenu__item">
                <NavigationMenuTrigger>
                    <UserIcon color="#dc4b82" :size="24" />
                </NavigationMenuTrigger>

                <NavigationMenuContent
                    class="list-none navmenu__content"
                >
                    <template v-if="isAuthenticated">
                        <ul class="content__menu">
                            <li class="content__menu__item">
                                <LogoutButton class="menu-link menu-link--secondary" />
                            </li>
                        </ul>
                    </template>

                    <template v-else>
                        <ul class="content__menu">
                            <li class="content__menu__item">
                                <NavigationMenuLink 
                                    class="menu-link--primary" 
                                    href="/register" 
                                    :as="Link">
                                    Beitreten
                                </NavigationMenuLink>
                            </li>
                            <li class="content__menu__item">
                                <NavigationMenuLink 
                                    class="menu-link--secondary" 
                                    href="/login" 
                                    :as="Link">
                                    Anmelden
                                </NavigationMenuLink>
                            </li>
                        </ul>
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
.content__menu__item {
    margin: 8px;
}
</style>