<template>
    <div class="quick-search-filter">
        <DialogRoot>
            <DialogTrigger class="dialog__trigger">
                Jetzt suchen
                <SearchIcon color="#222222" :size="20" />
            </DialogTrigger>

            <DialogPortal>
                <DialogOverlay class="app-overlay dialog-overlay">
                    <div class="content-wrapper">
                        <DialogContent class="dialog__content">
                            <VisuallyHidden>
                                <DialogTitle></DialogTitle>
                            </VisuallyHidden>
                            <div class="content-header">
                                <div class="">
                                    <button 
                                        class="" 
                                        type="button">
                                        <ChefHatIcon color="#49282a" :size="30" />
                                        Konditor:innen
                                    </button>
                                    <button
                                        class="" 
                                        type="button">
                                        <SparklesIcon color="#49282a" :size="30" />
                                        Kreationen
                                    </button>
                                </div>
                                <DialogClose class="dialog__close-button"><XIcon color="#0f0f0f" /></DialogClose>
                            </div>
                        </DialogContent>       
                    </div>
                </DialogOverlay>
            </DialogPortal>
        </DialogRoot>
    </div>
</template>

<script setup lang="ts">
import {
    DialogPortal,
    DialogRoot,
    DialogTrigger,
    DialogTitle,
    DialogClose,
    DialogContent,
    DialogOverlay,
    VisuallyHidden,
} from "reka-ui";
import { SearchIcon, XIcon, SparklesIcon, ChefHatIcon, } from "lucide-vue-next";
</script>

<style scoped lang="scss">
.quick-search-filter {
    --search-button-color: #676767;

    .dialog__trigger {
        font-size: var(--text-base);
        background-color: var(--color-neutral-0);
        color: var(--search-button-color);
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 16px;
        border-radius: 24px;
        gap: 8px;
        width: 100%;
    }

    &__menu {
        display: grid;
        grid-template-columns: repeat(2, 100px);
        column-gap: 4px;

        .menu-button {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    }
}

.content-header {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 9px 20px 0;
}
</style>