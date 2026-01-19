<template>
    <RekaDialog title="Kontaktformular">
        <template #trigger>
            <AppButton
                type="button"
                layout="text"
                variant="primary"
            >
                <template #text>Kontakt aufnehmen</template>
            </AppButton>
        </template>
        <template #default>
            <div class="contact-artisan-form">
                <TextField 
                    type="text" 
                    label="Ihr Name" 
                    v-model="form.sender_name"
                />
                <TextField 
                    type="email" 
                    label="Ihre E-Mail-Adresse (optional)" 
                    v-model="form.sender_email"
                />
                <AppTextArea 
                    label="Ihre Nachricht" 
                    rows="7"
                    v-model="form.content" 
                />
            </div>
        </template>
        <template #actions>
            <div class="dialog-actions">
                <AppButton
                    type="button"
                    layout="text"
                    variant="primary"
                    @click="sendMessage"
                >
                    <template #text>Nachricht senden</template>
                </AppButton>
            </div>
        </template>
    </RekaDialog>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

import AppButton from "../presentation/AppButton.vue";
import TextField from "../presentation/TextField.vue";
import AppTextArea from "../presentation/AppTextArea.vue";
import RekaDialog from "@/third-party/reka-ui/RekaDialog.vue";

import type { Message } from "@/types/users";

const form = useForm<Message>({
    sender_email: "",
    sender_name: "",
    sent_at: "",
    content: "",
});

function sendMessage() {
    form.sent_at = new Date().toISOString();
    form.post("/artisan/messages");
}
</script>

<style scoped lang="scss">
@use '../../../css/abstracts/breakpoints' as breakpoints;

.contact-artisan-form {
    display: flex;
    flex-direction: column;
    row-gap: 16px;
    min-width: 300px;
    max-width: 700px;
    margin: 24px 0;

    @include breakpoints.respond-to('medium') {
        min-width: 600px;
        max-width: 800px;
    }
}

.dialog-actions {
    display: flex;
    justify-content: end;
    margin-top: 24px;
}
</style>
