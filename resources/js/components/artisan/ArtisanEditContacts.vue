<template>
    <div>
        <header>Kontaktdaten</header>
        <TextField 
            type="text" 
            id="phone" 
            label="Telefonnummer (optional)"
            v-model="phone"
        ></TextField>
        <TextField 
            type="text" 
            id="email" 
            label="E-Mail-Adresse"
            v-model="email"
        ></TextField>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";

import TextField from "../presentation/TextField.vue";

const props = defineProps<{
    phone: string;
    email: string;
}>();

const phone = ref(props.phone);
const email = ref(props.email);
</script>