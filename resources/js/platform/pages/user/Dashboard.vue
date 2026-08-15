<template>
    <div>
        <ul>
            <li v-for="url in urls" :key="url.title">
                <a :href="url.href">{{ url.title }}</a>
            </li>
        </ul>
        <h1>Welcome in your Dashboard</h1>
    </div>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

import type { Link as PageLink } from "@/types/ui";

const props = defineProps<{
    urls: PageLink[];
}>();
</script>