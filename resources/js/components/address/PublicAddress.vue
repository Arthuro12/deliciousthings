<template>
    <div class="address-preview">
        <MapPinIcon class="icon" color="#e680a5" :size="24" />
        <p class="address-preview__details">
            <span class="detail" v-show="address.address_line_2">{{ address.address_line_2 }}</span>
            <span class="detail">{{ `${address.street} ${address.house_number}` }}</span>
            <span class="detail">{{ `${address.postal_code}, ${address.city}` }}</span>
            <span class="detail">{{ address.country }}</span>
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