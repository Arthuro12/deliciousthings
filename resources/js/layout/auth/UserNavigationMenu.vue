<template>
    <div>
        <DropdownMenuRoot :modal="false" v-model:open="menuIsOpen">
            <DropdownMenuTrigger as-child>
                <button
                    class="button button--ghost button--medium button--icon-only menu-trigger"
                    type="button"
                    aria-label="Benutzermenü öffnen"
                >
                    <CircleUserRound 
                        class="button__icon" 
                        aria-hidden="true"
                        color="#654f47"
                    />
                    <span class="button__label">Benutzermenü</span>
                </button>
            </DropdownMenuTrigger>

            <DropdownMenuPortal>
                <DropdownMenuContent
                    class="menu-content menu-content"
                    :side-offset="10"
                    align="end"
                >
                    <DropdownMenuGroup class="menu-group">
                        <DropdownMenuItem v-if="isAuthenticated" as-child>
                            <LogoutButton />
                        </DropdownMenuItem>

                        <template v-else>
                            
                            <DropdownMenuItem 
                                v-for="item in NAV_MENUS.USER"
                                :key="item.title"
                                as-child>
                                <Link
                                    :class="item.class"
                                    :href="item.href"
                                >
                                    <span class="button__label">{{ item.title }}</span>
                                </Link>
                            </DropdownMenuItem>
                        </template>
                    </DropdownMenuGroup>
                </DropdownMenuContent>
            </DropdownMenuPortal>
        </DropdownMenuRoot>
    </div>
</template>

<script setup lang="ts">
import { ref, } from "vue";

import { Link, } from "@inertiajs/vue3";

import {
    DropdownMenuContent,
    DropdownMenuGroup,
    DropdownMenuItem,
    DropdownMenuPortal,
    DropdownMenuRoot,
    DropdownMenuTrigger,
} from "reka-ui";
import { CircleUserRound, } from "lucide-vue-next";

import LogoutButton from "@/components/auth/LogoutButton.vue";

import { useAuth, } from "@/composables/use-auth";
import { useCloseOnDekstop, } from "@/composables/use-close-on-dekstop";
import { NAV_MENUS } from "@/constants";

const { isAuthenticated } = useAuth();
const menuIsOpen = ref(false);
useCloseOnDekstop(menuIsOpen);
</script>
