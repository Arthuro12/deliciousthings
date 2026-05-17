<template>
    <RekaDialog 
        content-class="contact-artisan-dialog"
        :title="`Anfrage an ${artisan.name}`"
        description="Senden Sie eine Frage oder eine Vorbestellung"
    >
        <template #trigger>
            <RekaDialogTrigger class="button button--primary button--medium button--with-icon">
                <MessageCirclePlusIcon :size="18" />
                Anfrage senden
            </RekaDialogTrigger>
        </template>
        <template #default>
            <ArtisanContactTabs class="contact-tabs">
                <template #question>
                    <SendMessage class="send-message-form" :artisan-id="artisan.id" />
                </template>

                <template #preOrder>
                    <PreOrderForm :artisan />
                </template>
            </ArtisanContactTabs>
        </template>
    </RekaDialog>
</template>

<script setup lang="ts">
import { MessageCirclePlusIcon } from "lucide-vue-next";
 
import RekaDialog from "@/third-party/reka-ui/RekaDialog.vue";
import RekaDialogTrigger from "@/third-party/reka-ui/RekaDialogTrigger.vue";
import ArtisanContactTabs from "./ArtisanContactTabs.vue";
import PreOrderForm from "./PreOrderForm.vue";
import SendMessage from "../message/SendMessage.vue";

import type { ArtisanPublicProfile, } from "@/types/users";

const { artisan, } = defineProps<{
    artisan: ArtisanPublicProfile;
}>();
</script>

<style scoped lang="scss">
@use '../../../css/abstracts/breakpoints' as breakpoints;

.send-message-form {
    margin: 24px 0;
}

.contact-tabs {
    margin-top: 14px;
    padding: 0 24px;
    // max-height: 560px;
    // overflow-y: scroll;
}
</style>
