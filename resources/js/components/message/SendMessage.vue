<template>
    <div class="form__group">
        <TextField 
            id="name"
            type="text" 
            label="Ihr Name" 
            v-model="form.sender_name"
        />
        <TextField 
            id="email"
            type="email" 
            label="Ihre E-Mail-Adresse" 
            v-model="form.sender_email"
        />
        <div>
            <header>Ihre Nachricht</header>
            <SimpleEditor v-model:content="form.content" />
        </div>
        <AppButton
            class="align-end"
            type="button"
            variant="primary"
            size="medium"
            @click="sendMessage"
        >
            <template #text>senden</template>
        </AppButton>
    </div>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
 
import AppButton from "../presentation/AppButton.vue";
import TextField from "../presentation/TextField.vue";
import SimpleEditor from "@/third-party/tiptap/SimpleEditor.vue";

import type { Message, } from "@/types/users";

const { artisanId, } = defineProps<{
    artisanId: number;
}>();

const form = useForm<Message>({
    sender_email: "",
    sender_name: "",
    sent_at: "",
    content: "",
});

function sendMessage(): void {
    form.sent_at = new Date().toISOString();
    form.post(`/artisan/${artisanId.toString()}/messages`);
}
</script>

<style scoped lang="scss">

</style>