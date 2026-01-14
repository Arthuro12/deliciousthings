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
                <TextField type="text" label="Ihr Name" />
                <TextField type="email" label="Ihre E-Mail-Adresse" />
                <AppTextArea label="Ihre Nachricht" rows="7" />
            </div>
        </template>
        <template #actions>
            <div class="dialog-actions">
                <AppButton
                    type="button"
                    layout="text"
                    variant="primary"
                >
                    <template #text>Nachricht senden</template>
                </AppButton>
            </div>
        </template>
    </RekaDialog>
</template>

<script setup lang="ts">
import AppButton from "../presentation/AppButton.vue";
import TextField from "../presentation/TextField.vue";
import AppTextArea from "../presentation/AppTextArea.vue";
import RekaDialog from "@/third-party/reka-ui/RekaDialog.vue";
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
