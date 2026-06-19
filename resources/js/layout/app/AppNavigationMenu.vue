<template>
    <DropdownMenuRoot :modal="false" v-model:open="menuIsOpen">
        <DropdownMenuTrigger as-child>
            <button
                class="button button--ghost button--medium button--icon-only menu-trigger"
                type="button"
                aria-label="Menü öffnen"
                color="#654f47"
            >
                <Menu 
                    v-if="!menuIsOpen" 
                    class="button__icon" 
                    aria-hidden="true" 
                    color="#654f47"
                />
                <X 
                    v-else 
                    class="button__icon" 
                    aria-hidden="true" 
                    color="#654f47"
                />
                <span class="button__label">Menu</span>
            </button>
        </DropdownMenuTrigger>

        <DropdownMenuPortal>
            <DropdownMenuContent
                class="menu-content"
                :side-offset="10"
                align="start"
            >
                <DropdownMenuItem
                    v-for="item in NAV_MENUS.PUBLIC"
                    :key="item.title"
                    as-child
                >
                    <Link
                        class="menu-link"
                        :class="{ 'is-active': isActive(item.href) }"
                        :href="item.href"
                    >
                        {{ item.title }}
                    </Link>
                </DropdownMenuItem>
            </DropdownMenuContent>
        </DropdownMenuPortal>
    </DropdownMenuRoot>
</template>

<script setup lang="ts">
import { ref, } from "vue";

import { Link, usePage } from "@inertiajs/vue3";

import {
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuPortal,
    DropdownMenuRoot,
    DropdownMenuTrigger,
} from "reka-ui";
import { Menu, X, } from "lucide-vue-next";

import { useCloseOnDekstop, } from "@/composables/use-close-on-dekstop";
import { NAV_MENUS, } from "@/constants";

const page = usePage();
const menuIsOpen = ref(false);
useCloseOnDekstop(menuIsOpen);

const isActive = (href: string) => {
    return page.url === href || page.url.startsWith(`${href}`);
};
</script>
