<template>
    <div class="form__group">
        <TextField 
            type="text" 
            id="street" 
            label="Straße"
            v-model="form.street"
        />
        <TextField 
            type="text" 
            id="house-number" 
            label="Hausnummer"
            v-model="form.house_number"
        />
        <TextField 
            type="text" 
            id="address-line-2" 
            label="Adresszusatz (optional)"
            v-model="addressLine2"
        />
        <TextField 
            type="text" 
            id="postal-code" 
            label="PLZ"
            v-model="postalCode"
        />
        <TextField 
            type="text" 
            id="city" 
            label="Ort"
            v-model="form.city"
        />
        <TextField 
            type="text" 
            id="country" 
            label="Land"
            v-model="form.country"
        />
    </div>
</template>

<script setup lang="ts">
import { reactive, ref, watch } from "vue";

import TextField from "../presentation/TextField.vue";

import { defaultAddress } from "@/utils/artisans";
import type { Address } from "@/types/users";

const { address = defaultAddress() } = defineProps<{
    address?: Address;
}>();

const emits = defineEmits<{
    (e: 'update:address', value: Address): void;
}>();

const form = reactive({ ...address });
const postalCode = ref(form.postal_code ?? "");
const addressLine2 = ref(form.address_line_2 ?? "");

watch([postalCode, addressLine2], ([newPostalCode, newAddressLine2]) => {
    form.postal_code = newPostalCode;
    form.address_line_2 = newAddressLine2;
});

watch(
    () => form, 
    (newForm) => {
        emits("update:address", newForm);
    }, 
    { deep: true }
);
</script>

<style scoped lang="scss">
.wrapper {
    display: flex;
    flex-direction: column;
    row-gap: 16px;
}
</style>