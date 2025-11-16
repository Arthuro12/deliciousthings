<template>
    <div>
        <button class="toggle-button" type="button" @click="formIsVisible = !formIsVisible">Standort (Optional)</button>
        <div class="wrapper">
            <TextField 
                type="text" 
                id="street" 
                label="Straße"
                v-model:model="address.street"
            />
            <TextField 
                type="text" 
                id="house-number" 
                label="Hausnummer"
                v-model:model="address.houseNumber"
            />
            <TextField 
                type="text" 
                id="address-line-2" 
                label="Adresszusatz"
                v-model:model="addressLine2"
            />
            <TextField 
                type="text" 
                id="postal-code" 
                label="PLZ"
                v-model:model="postalCode"
            />
            <TextField 
                type="text" 
                id="city" 
                label="Ort"
                v-model:model="address.city"
            />
            <TextField 
                type="text" 
                id="country" 
                label="Land"
                v-model:model="address.country"
            />
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, watch } from "vue";

import TextField from "../presentation/TextField.vue";

import type { Address } from "@/types/users";
import { defaultAddress } from "@/utils/artisans";

const formIsVisible = ref(false);

const address = defineModel<Address>("address", {
    default: defaultAddress(),
    required: false
});

const addressLine2 = ref(address.value.addressLine2 ?? "");
const postalCode = ref(address.value.postalCode ?? "");

watch([postalCode, addressLine2], ([newPostalCode, newAddressLine2]) => {
    address.value.postalCode = newPostalCode;
    address.value.addressLine2 = newAddressLine2;
});
</script>

<style scoped>
.wrapper, .row {
    display: flex;
    flex-direction: column;
}

.wrapper {
    row-gap: 20px;
}

.row {
    row-gap: 16px;
}

.toggle-button {
    margin-bottom: 16px;
}
</style>