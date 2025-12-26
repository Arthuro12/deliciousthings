<template>
    <div class="form__group">
        <TextField 
            type="text" 
            id="street" 
            label="Straße"
            v-model="address.street"
        />
        <TextField 
            type="text" 
            id="house-number" 
            label="Hausnummer"
            v-model="address.house_number"
        />
        <TextField 
            type="text" 
            id="address-line-2" 
            label="Adresszusatz"
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
            v-model="address.city"
        />
        <TextField 
            type="text" 
            id="country" 
            label="Land"
            v-model="address.country"
        />
    </div>
</template>

<script setup lang="ts">
import { ref, watch } from "vue";

import TextField from "../presentation/TextField.vue";

import { defaultAddress } from "@/utils/artisans";
import type { Address } from "@/types/users";

const address = defineModel<Address>("address", {
    default: defaultAddress(),
    required: false
});
address.value = { ...address.value };

const postalCode = ref(address.value.postal_code ?? "");
const addressLine2 = ref(address.value.address_line_2 ?? "");

watch([postalCode, addressLine2], ([newPostalCode, newAddressLine2]) => {
    address.value.postal_code = newPostalCode;
    address.value.address_line_2 = newAddressLine2;
});
</script>

<style scoped lang="scss">
.wrapper {
    display: flex;
    flex-direction: column;
    row-gap: 16px;
}
</style>