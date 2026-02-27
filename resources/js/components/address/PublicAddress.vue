<template>
    <div class="address-preview">
        <MapPinIcon color="#e680a5" :size="20" />
        <p class="address-preview__details">
            <span v-show="address.address_line_2">{{ address.address_line_2 }}</span>
            <span>{{ `${address.street} ${address.house_number}` }}</span>
            <span>{{ `${address.postal_code}, ${address.city}` }}</span>
            <span>{{ address.country }}</span>
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