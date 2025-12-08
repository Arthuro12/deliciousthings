<template>
    <div>
        <button 
            class="toggle-button" 
            type="button" @click="formIsVisible = !formIsVisible"
        >
            Standort (optional)
            <MinusIcon v-show="formIsVisible" />
            <PlusIcon v-show="!formIsVisible" />
        </button>
        <div class="wrapper" v-show="formIsVisible">
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
    </div>
</template>

<script setup lang="ts">
import { ref, watch } from "vue";

import { PlusIcon, MinusIcon } from "lucide-vue-next";

import TextField from "../presentation/TextField.vue";

import { defaultAddress } from "@/utils/artisans";
import type { Address } from "@/types/users";

const formIsVisible = ref(false);

const address = defineModel<Address>("address", {
    default: defaultAddress(),
    required: false
});

const postalCode = ref(address.value.postal_code ?? "");
const addressLine2 = ref(address.value.address_line_2 ?? "");

watch([postalCode, addressLine2], ([newPostalCode, newAddressLine2]) => {
    address.value.postal_code = newPostalCode;
    address.value.address_line_2 = newAddressLine2;
});
</script>

<style scoped lang="scss">
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
    display: flex;
    justify-content: space-between;
    align-items: center;
    column-gap: 12px;
    color: var(--color-neutral-50);
    padding: 6px;
    margin-bottom: 16px;
    width: 100%;

    &:hover {
        background-color: var(--color-primary-10);
        border-radius: 5px;
    }
}
</style>