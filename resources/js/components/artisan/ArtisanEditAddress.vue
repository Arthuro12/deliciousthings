<template>
    <div class="form__group">
        <AddressForm v-model="address" />
        <slot name="action" :data="{ address }"></slot>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";

import AddressForm from "../addresses/AddressForm.vue";

import type { Address } from "@/types/users";

const props = defineProps<{
    address?: Address;
}>();

const address = ref({...props.address});
</script>