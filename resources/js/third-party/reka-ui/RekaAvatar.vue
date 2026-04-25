<template>
    <div>
        <AvatarRoot 
            class="avatar__root"
            :class="{
                'avatar--small': miniature,
            }"
        >
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
    miniature?: boolean;
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
    &__root {
        display: block;
        width: 72px;
        height: 72px;

        &.avatar--small {
            width: 38px;
            height: 38px;

            .avatar__fallback {
                font-size: 0.875rem;
            }
        }

        @include breakpoints.respond-to('medium') {
            width: 160px;
            height: 160px;

            &--small {
                width: 90px;
                height: 90px;
            }
        }
    }

    &__image,
    &__fallback {
        border-radius: 50%;
        width: 100%;
        height: 100%;
    }

    &__image {
        object-fit: cover;
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