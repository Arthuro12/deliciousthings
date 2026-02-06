<template>
    <div class="address-preview">
        <MapPinIcon class="icon" color="#e680a5" :size="20" />
        <p class="address-preview__details">
            <span v-show="address.address_line_2">{{ address.address_line_2 }}</span>
            <span>{{ `${address.street} ${address.house_number}` }}</span>
            <span>{{ `${address.postal_code} ${address.city} ${address.country}` }}</span>
        </p>
    </div>
</template>

<script setup lang="ts">
import { MapPinIcon } from "lucide-vue-next";

import type { Address } from "@/types/users";

defineProps<{
    address: Address;
}>(); 
</script>

<style scoped lang="scss">
.address-preview {
    display: flex;
    column-gap: 12px;
    align-items: center;

    &__details {
        display: flex;
        flex-direction: column;
    }
}
</style>