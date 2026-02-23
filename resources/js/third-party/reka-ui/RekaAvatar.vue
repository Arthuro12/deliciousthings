<template>
    <div>
        <AvatarRoot>
            <AvatarImage 
                class="avatar__image" 
                :src="src" 
                :alt="alt"
            />
            <AvatarFallback class="avatar__fallback">{{ avatarText }}</AvatarFallback>
        </AvatarRoot>
    </div>
</template>

<script setup lang="ts">
import { computed } from "vue";

import { AvatarRoot, AvatarImage, AvatarFallback } from "reka-ui";

import { getNameIntials } from "@/utils/users";
 
const { src, alt = "", name } = defineProps<{
    src: string;
    alt?: string;
    /**
     * The name to use to derive the fallback text.
     */
    name?: string;
}>();

const avatarText = computed(() => getNameIntials(name ?? ""));
</script>

<style scoped lang="scss">
@use "../../../css/abstracts/breakpoints" as breakpoints;

.avatar {
    &__image,
    &__fallback {
        border-radius: 50%;
        width: 100%;
        height: 100%;
        width: 120px;
        height: 120px;

        @include breakpoints.respond-to('medium') {
            width: 200px;
            height: 200px;
        }
    }

    &__fallback {
        font-size: 1.125rem;
        font-weight: 500;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: var(--color-primary-10);
    }
}
</style>