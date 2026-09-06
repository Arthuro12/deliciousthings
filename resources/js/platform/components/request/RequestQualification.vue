<template>
    <DialogRoot v-model:open="isOpen">
        <DialogPortal>
            <DialogOverlay class="request-dialog__overlay" />

            <DialogContent
                class="request-dialog__content"
                :aria-describedby="undefined"
            >
                <div class="request-dialog__header">
                    <div>
                        <DialogTitle class="request-dialog__title">
                            Details bearbeiten
                        </DialogTitle>
                        <DialogDescription class="request-dialog__description">
                            Korrigiere erkannte Angaben oder ergänze nur die
                            Informationen, die für deine Anfrage wichtig sind.
                        </DialogDescription>
                    </div>

                    <DialogClose as-child>
                        <button
                            type="button"
                            class="button button--ghost button--icon button--sm"
                            aria-label="Schließen"
                        >
                            <X :size="18" />
                        </button>
                    </DialogClose>
                </div>

                <form
                    class="request-qualification"
                    @submit.prevent="submit"
                >
                    <div class="request-qualification__summary">
                        <span class="request-qualification__summary-icon">
                            <Sparkles :size="15" />
                        </span>
                        <div>
                            <strong>{{ detectedCount }} Angaben erkannt</strong>
                            <span>Du kannst jede davon korrigieren.</span>
                        </div>
                    </div>

                    <div class="request-qualification__fields">
                        <div class="request-field">
                            <label
                                for="request-category"
                                class="request-field__label"
                            >
                                Kategorie
                            </label>

                            <SelectRoot
                                :model-value="form.category || '__none__'"
                                @update:model-value="setCategory"
                            >
                                <SelectTrigger
                                    id="request-category"
                                    class="request-select__trigger"
                                    aria-label="Kategorie"
                                >
                                    <SelectValue placeholder="Noch nicht erkannt" />
                                </SelectTrigger>

                                <SelectPortal>
                                    <SelectContent
                                        class="request-select__content"
                                        position="popper"
                                    >
                                        <SelectViewport class="request-select__viewport">
                                            <SelectItem
                                                value="__none__"
                                                class="request-select__item"
                                            >
                                                <SelectItemText>
                                                    Noch nicht erkannt
                                                </SelectItemText>
                                            </SelectItem>

                                            <SelectItem
                                                v-for="item in categories"
                                                :key="item.value"
                                                :value="item.value"
                                                class="request-select__item"
                                            >
                                                <SelectItemText>
                                                    {{ item.label }}
                                                </SelectItemText>
                                                <SelectItemIndicator>✓</SelectItemIndicator>
                                            </SelectItem>
                                        </SelectViewport>
                                    </SelectContent>
                                </SelectPortal>
                            </SelectRoot>
                        </div>

                        <div class="request-field">
                            <label
                                for="request-occasion"
                                class="request-field__label"
                            >
                                Anlass
                            </label>

                            <SelectRoot
                                :model-value="form.occasion || '__none__'"
                                @update:model-value="setOccasion"
                            >
                                <SelectTrigger
                                    id="request-occasion"
                                    class="request-select__trigger"
                                    aria-label="Anlass"
                                >
                                    <SelectValue placeholder="Noch nicht sicher" />
                                </SelectTrigger>

                                <SelectPortal>
                                    <SelectContent
                                        class="request-select__content"
                                        position="popper"
                                    >
                                        <SelectViewport class="request-select__viewport">
                                            <SelectItem
                                                value="__none__"
                                                class="request-select__item"
                                            >
                                                <SelectItemText>
                                                    Noch nicht sicher
                                                </SelectItemText>
                                            </SelectItem>

                                            <SelectItem
                                                v-for="item in occasions"
                                                :key="item.value"
                                                :value="item.value"
                                                class="request-select__item"
                                            >
                                                <SelectItemText>
                                                    {{ item.label }}
                                                </SelectItemText>
                                                <SelectItemIndicator>✓</SelectItemIndicator>
                                            </SelectItem>
                                        </SelectViewport>
                                    </SelectContent>
                                </SelectPortal>
                            </SelectRoot>
                        </div>

                        <div class="request-field request-field--half">
                            <label
                                for="request-date"
                                class="request-field__label"
                            >
                                Termin <span>Optional</span>
                            </label>
                            <input
                                id="request-date"
                                v-model="form.event_date"
                                type="date"
                                class="request-field__control"
                            />
                        </div>

                        <div class="request-field request-field--half">
                            <label
                                for="request-time"
                                class="request-field__label"
                            >
                                Uhrzeit <span>Optional</span>
                            </label>
                            <input
                                id="request-time"
                                v-model="form.event_time"
                                type="time"
                                class="request-field__control"
                            />
                        </div>

                        <div class="request-field request-field--half">
                            <label
                                for="request-participants"
                                class="request-field__label"
                            >
                                Personen <span>Optional</span>
                            </label>
                            <input
                                id="request-participants"
                                v-model.number="form.participants"
                                type="number"
                                min="1"
                                max="10000"
                                inputmode="numeric"
                                class="request-field__control"
                                placeholder="z. B. 50"
                            />
                        </div>

                        <div class="request-field request-field--half">
                            <label
                                for="request-location"
                                class="request-field__label"
                            >
                                Ort <span>Optional</span>
                            </label>
                            <input
                                id="request-location"
                                v-model="form.location_text"
                                type="text"
                                maxlength="255"
                                class="request-field__control"
                                placeholder="z. B. Berlin"
                            />
                        </div>

                        <fieldset class="request-fieldset">
                            <legend class="request-field__label">
                                Budget <span>Optional</span>
                            </legend>

                            <div class="request-budget">
                                <label class="request-budget__input">
                                    <span class="request-budget__label">Von</span>
                                    <input
                                        v-model.number="form.budget_min"
                                        type="number"
                                        min="0"
                                        max="99999999.99"
                                        step="1"
                                        inputmode="decimal"
                                        class="request-field__control"
                                        placeholder="z. B. 100"
                                        :disabled="noBudget"
                                        @input="onBudgetInput"
                                    />
                                </label>

                                <span
                                    class="request-budget__separator"
                                    aria-hidden="true"
                                >
                                    –
                                </span>

                                <label class="request-budget__input">
                                    <span class="request-budget__label">Bis</span>
                                    <input
                                        v-model.number="form.budget_max"
                                        type="number"
                                        min="0"
                                        max="99999999.99"
                                        step="1"
                                        inputmode="decimal"
                                        class="request-field__control"
                                        placeholder="z. B. 200"
                                        :disabled="noBudget"
                                        @input="onBudgetInput"
                                    />
                                </label>

                                <span class="request-budget__currency">EUR</span>
                            </div>

                            <label class="request-checkbox">
                                <input
                                    v-model="noBudget"
                                    type="checkbox"
                                    @change="toggleNoBudget"
                                />
                                <span>Ich habe noch kein festes Budget.</span>
                            </label>

                            <p
                                v-if="budgetError"
                                class="request-field__error"
                                role="alert"
                            >
                                {{ budgetError }}
                            </p>
                        </fieldset>

                        <fieldset class="request-fieldset">
                            <legend class="request-field__label">
                                Erhalt <span>Optional</span>
                            </legend>

                            <RadioGroupRoot
                                :model-value="
                                    form.fulfillment_method || '__none__'
                                "
                                class="request-radio-group"
                                aria-label="Erhalt"
                                @update:model-value="setFulfillment"
                            >
                                <RadioGroupItem
                                    value="__none__"
                                    class="request-radio-item"
                                >
                                    <RadioGroupIndicator
                                        class="request-radio-indicator"
                                    />
                                    <span>Noch offen</span>
                                </RadioGroupItem>

                                <RadioGroupItem
                                    v-for="method in fulfillmentMethods"
                                    :key="method.value"
                                    :value="method.value"
                                    class="request-radio-item"
                                >
                                    <RadioGroupIndicator
                                        class="request-radio-indicator"
                                    />
                                    <span>{{ method.label }}</span>
                                </RadioGroupItem>
                            </RadioGroupRoot>
                        </fieldset>

                        <fieldset class="request-fieldset">
                            <legend class="request-field__label">
                                Stil <span>Optional</span>
                            </legend>

                            <div class="request-tags">
                                <label
                                    v-for="style in styles"
                                    :key="style"
                                    class="request-tag"
                                    :class="{
                                        'request-tag--selected':
                                            form.style.includes(style),
                                    }"
                                >
                                    <input
                                        v-model="form.style"
                                        type="checkbox"
                                        :value="style"
                                    />
                                    <span>{{ style }}</span>
                                </label>
                            </div>
                        </fieldset>

                        <div class="request-field">
                            <label
                                for="request-requirements"
                                class="request-field__label"
                            >
                                Weitere Wünsche <span>Optional</span>
                            </label>
                            <textarea
                                id="request-requirements"
                                v-model="form.requirements"
                                rows="4"
                                maxlength="2000"
                                class="request-field__control request-field__control--textarea"
                                placeholder="Besondere Wünsche, Farben, Inspirationen …"
                            />
                        </div>
                    </div>

                    <p
                        v-if="errorMessage"
                        class="request-form-error"
                        role="alert"
                    >
                        {{ errorMessage }}
                    </p>

                    <div class="request-dialog__actions">
                        <DialogClose as-child>
                            <button
                                type="button"
                                class="button button--outline button--md"
                                :disabled="processing"
                            >
                                Abbrechen
                            </button>
                        </DialogClose>

                        <button
                            type="submit"
                            class="button button--primary button--md"
                            :disabled="processing || !isDirty || !!budgetError"
                        >
                            <ButtonLoader v-if="processing" />
                            <span>
                                {{ processing ? "Speichern …" : "Speichern" }}
                            </span>
                        </button>
                    </div>
                </form>
            </DialogContent>
        </DialogPortal>
    </DialogRoot>
</template>

<script setup lang="ts">
import { computed, reactive, ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import {
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogOverlay,
    DialogPortal,
    DialogRoot,
    DialogTitle,
    RadioGroupIndicator,
    RadioGroupItem,
    RadioGroupRoot,
    SelectContent,
    SelectItem,
    SelectItemIndicator,
    SelectItemText,
    SelectPortal,
    SelectRoot,
    SelectTrigger,
    SelectValue,
    SelectViewport,
} from "reka-ui";
import { Sparkles, X } from "@lucide/vue";

import ButtonLoader from "@/components/ui/ButtonLoader.vue";
import {
    REQUEST_CATEGORIES,
    REQUEST_FULFILLMENT_METHODS,
    REQUEST_STYLES,
} from "@/constants/requests";
import type { RequestData } from "@/types/requests";

const props = defineProps<{
    open: boolean;
    request: RequestData;
    occasions: Array<{ value: string; label: string }>;
}>();

const emit = defineEmits<{
    "update:open": [value: boolean];
    saved: [request: RequestData];
}>();

const isOpen = computed({
    get: () => props.open,
    set: (value: boolean) => emit("update:open", value),
});

const categories = REQUEST_CATEGORIES;
const fulfillmentMethods = REQUEST_FULFILLMENT_METHODS;
const styles = REQUEST_STYLES;

const form = reactive(createForm(props.request));
const original = ref(snapshotForm(form));
const processing = ref(false);
const errorMessage = ref("");
const noBudget = ref(false);

const isDirty = computed(
    () => JSON.stringify(snapshotForm(form)) !== original.value,
);

const budgetError = computed(() => {
    const min = toNullableNumber(form.budget_min);
    const max = toNullableNumber(form.budget_max);

    if (noBudget.value) return "";

    if (min !== null && max !== null && max < min) {
        return "Das maximale Budget muss mindestens so hoch wie das minimale Budget sein.";
    }

    return "";
});

const detectedCount = computed(
    () =>
        [
            props.request.category,
            props.request.occasion,
            props.request.event_date,
            props.request.event_time,
            props.request.participants,
            props.request.location_text,
            props.request.budget_min,
            props.request.budget_max,
            props.request.fulfillment_method,
            props.request.style?.length ? true : null,
            props.request.requirements,
        ].filter((value) => value !== null && value !== "" && value !== false)
            .length,
);

watch(
    () => props.request,
    (request) => {
        Object.assign(form, createForm(request));
        original.value = snapshotForm(form);
        noBudget.value = false;
    },
    { deep: true },
);

watch(
    () => props.open,
    (open) => {
        if (open) {
            Object.assign(form, createForm(props.request));
            original.value = snapshotForm(form);
            noBudget.value = false;
        }

        errorMessage.value = "";
    },
);

function createForm(request: RequestData) {
    return {
        category: request.category ?? "",
        occasion: request.occasion ?? "",
        event_date: request.event_date ?? "",
        event_time: request.event_time ?? "",
        participants: request.participants,
        location_text: request.location_text ?? "",
        budget_min: request.budget_min,
        budget_max: request.budget_max,
        fulfillment_method: request.fulfillment_method ?? "",
        style: [...(request.style ?? [])],
        requirements: request.requirements ?? "",
    };
}

function snapshotForm(value: ReturnType<typeof createForm>) {
    return JSON.stringify({
        ...value,
        participants: toNullableNumber(value.participants),
        budget_min: toNullableNumber(value.budget_min),
        budget_max: toNullableNumber(value.budget_max),
        style: [...value.style].sort(),
    });
}

function toNullableNumber(value: unknown): number | null {
    if (value === "" || value === null || value === undefined) return null;

    const number = Number(value);
    return Number.isFinite(number) ? number : null;
}

function setCategory(value: string) {
    form.category = value === "__none__" ? "" : value;
}

function setOccasion(value: string) {
    form.occasion = value === "__none__" ? "" : value;
}

function setFulfillment(value: string) {
    form.fulfillment_method = value === "__none__" ? "" : value;
}

function onBudgetInput() {
    if (form.budget_min !== null || form.budget_max !== null) {
        noBudget.value = false;
    }
}

function toggleNoBudget() {
    if (noBudget.value) {
        form.budget_min = null;
        form.budget_max = null;
    }
}

function submit() {
    if (processing.value || !isDirty.value || budgetError.value) return;

    processing.value = true;
    errorMessage.value = "";

    router.patch(
        `/app/requests/${props.request.id}`,
        {
            category: form.category || null,
            occasion: form.occasion || null,
            event_date: form.event_date || null,
            event_time: form.event_time || null,
            participants: toNullableNumber(form.participants),
            location_text: form.location_text.trim() || null,
            budget_min: noBudget.value
                ? null
                : toNullableNumber(form.budget_min),
            budget_max: noBudget.value
                ? null
                : toNullableNumber(form.budget_max),
            currency: props.request.currency || "EUR",
            fulfillment_method: form.fulfillment_method || null,
            style: form.style,
            requirements: form.requirements.trim() || null,
        },
        {
            preserveScroll: true,
            onSuccess: (page) => {
                const updatedRequest =
                    page.props.request as RequestData | null;

                if (updatedRequest) {
                    emit("saved", updatedRequest);
                    isOpen.value = false;
                }
            },
            onError: (errors) => {
                errorMessage.value =
                    Object.values(errors)[0] ??
                    "Bitte überprüfe die Angaben.";
            },
            onFinish: () => {
                processing.value = false;
            },
        },
    );
}
</script>

<style scoped lang="scss">
.request-dialog__overlay {
    position: fixed;
    inset: 0;
    z-index: 40;
    background: rgb(35 24 19 / 45%);
    backdrop-filter: blur(4px);
}

.request-dialog__content {
    position: fixed;
    z-index: 50;
    top: 50%;
    left: 50%;
    width: min(calc(100% - 24px), 720px);
    max-height: min(90dvh, 820px);
    overflow: auto;
    transform: translate(-50%, -50%);
    padding: 24px;
    background: var(--color-neutral-0, #fff);
    border: 1px solid var(--color-chocolate-100);
    border-radius: 20px;
    box-shadow: 0 24px 80px rgb(35 24 19 / 18%);
}

.request-dialog__header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 24px;
}

.request-dialog__title {
    margin: 0 0 7px;
    color: var(--color-chocolate-900);
    font-family: Fraunces, Georgia, serif;
    font-size: 28px;
    line-height: 1.1;
}

.request-dialog__description {
    max-width: 560px;
    color: var(--color-neutral-500);
    font-size: 14px;
    line-height: 1.55;
}

.request-qualification__summary {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    padding: 11px 13px;
    background: var(--color-neutral-100);
    border-radius: 12px;
}

.request-qualification__summary-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    flex: 0 0 auto;
    color: var(--color-brand-primary-600);
    background: var(--color-neutral-0);
    border-radius: 8px;
}

.request-qualification__summary div {
    display: grid;
    gap: 2px;
}

.request-qualification__summary strong {
    color: var(--color-chocolate-900);
    font-size: 12px;
}

.request-qualification__summary span:not(.request-qualification__summary-icon) {
    color: var(--color-neutral-500);
    font-size: 11px;
}

.request-qualification__fields {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
}

.request-field,
.request-fieldset {
    min-width: 0;
    margin: 0;
    padding: 0;
    border: 0;
}

.request-field--half {
    grid-column: span 1;
}

.request-fieldset {
    grid-column: 1 / -1;
}

.request-field__label {
    display: block;
    margin-bottom: 8px;
    color: var(--color-chocolate-800);
    font-size: 13px;
    font-weight: 650;
}

.request-field__label span {
    margin-left: 4px;
    color: var(--color-neutral-500);
    font-size: 11px;
    font-weight: 400;
}

.request-field__control,
.request-select__trigger {
    width: 100%;
    min-height: 46px;
    padding: 11px 13px;
    color: var(--color-chocolate-900);
    background: var(--color-neutral-0);
    border: 1px solid var(--color-chocolate-200);
    border-radius: 11px;
    outline: none;
    font: inherit;
    font-size: 14px;
    transition: border-color 150ms ease, box-shadow 150ms ease;
}

.request-field__control:focus,
.request-select__trigger:focus-visible {
    border-color: var(--color-brand-primary-500);
    box-shadow: 0 0 0 3px rgb(0 0 0 / 4%);
}

.request-field__control:disabled {
    color: var(--color-neutral-500);
    background: var(--color-neutral-100);
    cursor: not-allowed;
}

.request-field__control--textarea {
    min-height: 100px;
    resize: vertical;
}

.request-field__error {
    margin: 8px 0 0;
    color: var(--color-error-600);
    font-size: 12px;
}

.request-select__trigger {
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
    text-align: left;
}

.request-select__content {
    z-index: 100;
    min-width: var(--reka-select-trigger-width);
    overflow: hidden;
    padding: 5px;
    background: var(--color-neutral-0);
    border: 1px solid var(--color-chocolate-100);
    border-radius: 11px;
    box-shadow: 0 12px 35px rgb(35 24 19 / 12%);
}

.request-select__item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    min-height: 38px;
    padding: 8px 10px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    outline: none;
}

.request-select__item[data-highlighted] {
    background: var(--color-neutral-100);
}

.request-budget {
    display: grid;
    grid-template-columns: minmax(0, 1fr) auto minmax(0, 1fr) auto;
    align-items: end;
    gap: 8px;
}

.request-budget__input {
    display: grid;
    gap: 5px;
    min-width: 0;
}

.request-budget__label {
    color: var(--color-neutral-500);
    font-size: 11px;
}

.request-budget__separator {
    padding-bottom: 14px;
    color: var(--color-neutral-500);
}

.request-budget__currency {
    padding-bottom: 14px;
    color: var(--color-neutral-500);
    font-size: 13px;
}

.request-checkbox {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 10px;
    color: var(--color-neutral-500);
    font-size: 13px;
    cursor: pointer;
}

.request-checkbox input,
.request-tag input {
    accent-color: var(--color-brand-primary-500);
}

.request-radio-group {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.request-radio-item {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    min-height: 42px;
    padding: 0 13px;
    color: var(--color-chocolate-800);
    background: var(--color-neutral-0);
    border: 1px solid var(--color-chocolate-200);
    border-radius: 10px;
    cursor: pointer;
    font-size: 13px;
}

.request-radio-item[data-state="checked"] {
    color: var(--color-brand-primary-600);
    border-color: var(--color-brand-primary-400);
    background: var(--color-brand-primary-50);
}

.request-radio-indicator {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: currentColor;
}

.request-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 7px;
}

.request-tag {
    position: relative;
}

.request-tag input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.request-tag span {
    display: inline-flex;
    padding: 8px 11px;
    color: var(--color-chocolate-700);
    background: var(--color-neutral-100);
    border: 1px solid transparent;
    border-radius: 999px;
    cursor: pointer;
    font-size: 12px;
    transition: border-color 150ms ease, background-color 150ms ease;
}

.request-tag--selected span {
    color: var(--color-brand-primary-600);
    background: var(--color-brand-primary-50);
    border-color: var(--color-brand-primary-200);
}

.request-form-error {
    margin: 18px 0 0;
    color: var(--color-error-600);
    font-size: 13px;
}

.request-dialog__actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 24px;
    padding-top: 18px;
    border-top: 1px solid var(--color-chocolate-100);
}

@media (max-width: 620px) {
    .request-dialog__content {
        width: min(calc(100% - 16px), 720px);
        max-height: 94dvh;
        padding: 18px;
    }

    .request-qualification__fields {
        grid-template-columns: 1fr;
    }

    .request-field--half,
    .request-fieldset {
        grid-column: 1;
    }

    .request-budget {
        grid-template-columns: minmax(0, 1fr) auto minmax(0, 1fr);
    }

    .request-budget__currency {
        grid-column: 1 / -1;
        padding: 0;
    }

    .request-radio-group {
        flex-direction: column;
    }

    .request-radio-item {
        width: 100%;
    }

    .request-dialog__actions {
        flex-direction: column-reverse;
    }

    .request-dialog__actions .button {
        width: 100%;
        min-height: 46px;
    }
}
</style>
