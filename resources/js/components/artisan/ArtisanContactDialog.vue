<template>
    <RekaDialog :title="`Anfrage an ${artisan.name}`">
        <template #trigger>
            <RekaDialogTrigger class="button button--primary button--medium button--with-icon">
                <MessageCirclePlusIcon :size="18" />
                Anfrage senden
            </RekaDialogTrigger>
        </template>
        <template #default>
            <div class="contact-artisan-form">
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
                    <RichTextEditor v-model:content="form.content" />
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
    </RekaDialog>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

import { MessageCirclePlusIcon } from "lucide-vue-next";
 
import AppButton from "../presentation/AppButton.vue";
import TextField from "../presentation/TextField.vue";
import RekaDialog from "@/third-party/reka-ui/RekaDialog.vue";
import RekaDialogTrigger from "@/third-party/reka-ui/RekaDialogTrigger.vue";
import RichTextEditor from "@/third-party/tiptap/RichTextEditor.vue";

import type { ArtisanPublicProfile, Message } from "@/types/users";

const { artisan, } = defineProps<{
    artisan: ArtisanPublicProfile;
}>();

const form = useForm<Message>({
    sender_email: "",
    sender_name: "",
    sent_at: "",
    content: "",
});

function sendMessage(): void {
    form.sent_at = new Date().toISOString();
    form.post(`/artisan/${artisan.id}/messages`);
}
</script>

<style scoped lang="scss">
@use '../../../css/abstracts/breakpoints' as breakpoints;

.contact-artisan-form {
    display: flex;
    flex-direction: column;
    row-gap: 16px;
    margin: 24px 0;
}
</style>
