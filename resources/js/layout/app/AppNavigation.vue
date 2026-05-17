<template>
    <NavigationMenuRoot class="navmenu__root">
        <NavigationMenuList class="list-none navmenu__list">
            <NavigationMenuItem class="navmenu__item">
                <NavigationMenuTrigger>
                    <MenuIcon color="#e680a5" :size="24" />
                </NavigationMenuTrigger>
                <NavigationMenuContent 
                    class="list-none navmenu__content"
                    as="ul"
                >
                    <li>
                        <NavigationMenuLink 
                            class="menu-link" 
                            href="/artisans" 
                            :as="Link">
                            Konditor:innen
                        </NavigationMenuLink>
                    </li>
                    <li>
                        <NavigationMenuLink 
                            class="menu-link" 
                            href="/creations" 
                            :as="Link">
                            Kreationen
                        </NavigationMenuLink>
                    </li>
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
import { MenuIcon, } from "lucide-vue-next";
</script>