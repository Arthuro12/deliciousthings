<template>
    <div>
        <ul class="list-none options__tags">
            <li v-for="service in services" :key="service.key">
                <AppTag :text="service.label" />
            </li>
        </ul>
    </div>
</template>

<script setup lang="ts">
import AppTag from "@/components/presentation/AppTag.vue";

import type { Service } from "@/types/users";

const { services, } = defineProps<{
    services: Service[];
}>();
</script>

<style scoped lang="scss">
.options__tags {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}
</style>