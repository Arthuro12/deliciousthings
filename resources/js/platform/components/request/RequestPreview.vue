<template>
    <section class="request-preview" aria-labelledby="request-preview-title">
        <header class="request-preview__header">
            <p class="request-preview__eyebrow">Schritt 2 · Prüfen</p>
            <h1 id="request-preview-title">So haben wir deine Idee verstanden.</h1>
            <p>
                Wir haben deine Beschreibung in einen klaren Brief übersetzt.
                Prüfe die Angaben und ändere nur, was nicht stimmt.
            </p>
        </header>

        <article class="request-brief">
            <div class="request-brief__top">
                <div>
                    <span class="request-brief__status">
                        <CheckCircle2 :size="16" />
                        {{ statusLabel }}
                    </span>
                    <p class="request-brief__helper">
                        {{ detectedCount }} von {{ totalFields }} Angaben erkannt
                    </p>
                </div>

                <button
                    type="button"
                    class="button button--ghost button--sm"
                    @click="$emit('edit')"
                >
                    Bearbeiten
                </button>
            </div>

            <div class="request-brief__idea">
                <span class="request-preview__label">Deine Beschreibung</span>
                <blockquote>{{ request.description }}</blockquote>
            </div>

            <div class="request-brief__grid">
                <article
                    v-for="field in visibleFields"
                    :key="field.key"
                    class="request-brief__item"
                >
                    <span class="request-brief__icon">
                        <component :is="field.icon" :size="17" />
                    </span>

                    <div>
                        <span>{{ field.label }}</span>
                        <strong>{{ field.value }}</strong>
                    </div>
                </article>
            </div>

            <div
                v-if="request.style?.length"
                class="request-brief__section"
            >
                <span class="request-preview__label">Stil</span>
                <div class="request-tags">
                    <span
                        v-for="style in request.style"
                        :key="style"
                        class="request-tag"
                    >
                        {{ style }}
                    </span>
                </div>
            </div>

            <div
                v-if="request.requirements"
                class="request-brief__section"
            >
                <span class="request-preview__label">Weitere Wünsche</span>
                <p>{{ request.requirements }}</p>
            </div>
        </article>

        <div
            v-if="missingFields.length"
            class="request-preview__missing"
        >
            <div class="request-preview__missing-icon">
                <Sparkles :size="17" />
            </div>

            <div class="request-preview__missing-copy">
                <strong>Ein paar Angaben fehlen noch</strong>
                <p>{{ missingFields.join(" · ") }}</p>
            </div>

            <button
                type="button"
                class="button button--ghost button--sm"
                @click="$emit('edit')"
            >
                Ergänzen
            </button>
        </div>

        <div class="request-preview__notice">
            <Info :size="18" :stroke-width="1.8" />
            <p v-if="isDraft">
                Du kannst die Anfrage noch bearbeiten. Erst mit deiner Bestätigung
                wird sie für den nächsten Schritt freigegeben.
            </p>
            <p v-else>
                Deine Angaben sind bestätigt. Mit „Anfrage senden“ gibst du sie
                für die Vermittlung an passende Backprofis frei.
            </p>
        </div>

        <div class="request-preview__actions">
            <button
                type="button"
                class="button button--outline button--lg"
                :disabled="processing"
                @click="$emit('edit')"
            >
                Bearbeiten
            </button>

            <button
                v-if="isDraft"
                type="button"
                class="button button--primary button--lg"
                :disabled="processing"
                @click="$emit('confirm')"
            >
                <ButtonLoader v-if="processing" />
                <span>
                    {{ processing ? "Wird bestätigt …" : "Anfrage bestätigen" }}
                </span>
            </button>

            <button
                v-else
                type="button"
                class="button button--primary button--lg"
                :disabled="processing"
                @click="$emit('submit')"
            >
                <ButtonLoader v-if="processing" />
                <span>
                    {{ processing ? "Wird gesendet …" : "Anfrage senden" }}
                </span>
            </button>
        </div>
    </section>
</template>

<script setup lang="ts">
import { computed } from "vue";
import {
    CalendarDays,
    CakeSlice,
    CheckCircle2,
    Info,
    MapPin,
    PartyPopper,
    Sparkles,
    Truck,
    Users,
    WalletCards,
} from "@lucide/vue";

import ButtonLoader from "@/components/ui/ButtonLoader.vue";
import type { RequestData } from "@/types/requests";

const props = defineProps<{
    request: RequestData;
    categories: Array<{ value: string; label: string }>;
    occasions: Array<{ value: string; label: string }>;
    fulfillmentMethods: Array<{ value: string; label: string }>;
    processing?: boolean;
}>();

defineEmits<{
    edit: [];
    confirm: [];
    submit: [];
}>();

const isDraft = computed(() => props.request.status === "draft");

const statusLabel = computed(() =>
    isDraft.value ? "Entwurf bereit" : "Angaben bestätigt",
);

const categoryLabel = computed(
    () =>
        props.categories.find(
            (item) => item.value === props.request.category,
        )?.label ??
        props.request.category ??
        "",
);

const occasionLabel = computed(
    () =>
        props.occasions.find(
            (item) => item.value === props.request.occasion,
        )?.label ??
        props.request.occasion ??
        "",
);

const fulfillmentLabel = computed(
    () =>
        props.fulfillmentMethods.find(
            (item) => item.value === props.request.fulfillment_method,
        )?.label ??
        props.request.fulfillment_method ??
        "",
);

const formattedDate = computed(() => {
    if (!props.request.event_date) return "";

    return new Intl.DateTimeFormat("de-DE", {
        dateStyle: "long",
    }).format(new Date(`${props.request.event_date}T00:00:00`));
});

const formattedBudget = computed(() => {
    const min = props.request.budget_min;
    const max = props.request.budget_max;

    if (min === null && max === null) return "";

    const formatter = new Intl.NumberFormat("de-DE", {
        style: "currency",
        currency: props.request.currency || "EUR",
        maximumFractionDigits: 0,
    });

    if (min !== null && max !== null) {
        return `${formatter.format(min)} – ${formatter.format(max)}`;
    }

    if (max !== null) return `bis ${formatter.format(max)}`;
    return `ab ${formatter.format(min as number)}`;
});

const allFields = computed(() => [
    {
        key: "category",
        label: "Kreation",
        value: categoryLabel.value,
        present: Boolean(props.request.category),
        icon: CakeSlice,
    },
    {
        key: "occasion",
        label: "Anlass",
        value: occasionLabel.value,
        present: Boolean(props.request.occasion),
        icon: PartyPopper,
    },
    {
        key: "event_date",
        label: "Termin",
        value: formattedDate.value,
        present: Boolean(props.request.event_date),
        icon: CalendarDays,
    },
    {
        key: "participants",
        label: "Für",
        value: props.request.participants
            ? `${props.request.participants} Personen`
            : "",
        present: Boolean(props.request.participants),
        icon: Users,
    },
    {
        key: "location_text",
        label: "Ort",
        value: props.request.location_text ?? "",
        present: Boolean(props.request.location_text),
        icon: MapPin,
    },
    {
        key: "budget",
        label: "Budget",
        value: formattedBudget.value,
        present:
            props.request.budget_min !== null ||
            props.request.budget_max !== null,
        icon: WalletCards,
    },
    {
        key: "fulfillment_method",
        label: "Erhalt",
        value: fulfillmentLabel.value,
        present: Boolean(props.request.fulfillment_method),
        icon: Truck,
    },
]);

const visibleFields = computed(() =>
    allFields.value.filter((field) => field.present),
);

const totalFields = computed(() => allFields.value.length);

const detectedCount = computed(
    () => visibleFields.value.length + (props.request.style?.length ? 1 : 0),
);

const missingFields = computed(() =>
    allFields.value
        .filter((field) => !field.present)
        .map((field) => field.label),
);
</script>

<style scoped lang="scss">
.request-preview {
    width: 100%;
}

.request-preview__header {
    margin-bottom: 28px;
}

.request-preview__eyebrow {
    margin: 0 0 8px;
    color: var(--color-brand-primary-500);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

.request-preview__header h1 {
    margin: 0 0 14px;
    color: var(--color-chocolate-900);
    font-family: Fraunces, Georgia, serif;
    font-size: clamp(2rem, 7vw, 3rem);
    line-height: 1.05;
    letter-spacing: -0.035em;
}

.request-preview__header > p {
    max-width: 560px;
    margin: 0;
    color: var(--color-neutral-500);
    font-size: 15px;
    line-height: 1.6;
}

.request-brief {
    overflow: hidden;
    background: var(--color-neutral-0, #fff);
    border: 1px solid var(--color-chocolate-100);
    border-radius: 20px;
    box-shadow: 0 8px 30px rgb(54 36 29 / 4%);
}

.request-brief__top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 16px;
    padding: 16px 20px;
    border-bottom: 1px solid var(--color-chocolate-100);
}

.request-brief__status {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: var(--color-brand-primary-600);
    font-size: 12px;
    font-weight: 700;
}

.request-brief__helper {
    margin: 4px 0 0;
    color: var(--color-neutral-500);
    font-size: 11px;
}

.request-brief__idea {
    padding: 22px 20px;
}

.request-preview__label {
    display: block;
    margin-bottom: 8px;
    color: var(--color-neutral-500);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
}

.request-brief__idea blockquote {
    margin: 0;
    color: var(--color-chocolate-900);
    font-size: 15px;
    line-height: 1.65;
}

.request-brief__grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    border-top: 1px solid var(--color-chocolate-100);
}

.request-brief__item {
    display: flex;
    align-items: flex-start;
    gap: 11px;
    padding: 17px 20px;
    border-bottom: 1px solid var(--color-chocolate-100);
}

.request-brief__item:nth-child(odd) {
    border-right: 1px solid var(--color-chocolate-100);
}

.request-brief__icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    flex: 0 0 auto;
    color: var(--color-brand-primary-600);
    background: var(--color-brand-primary-50);
    border-radius: 9px;
}

.request-brief__item div {
    display: grid;
    gap: 3px;
    min-width: 0;
}

.request-brief__item div > span {
    color: var(--color-neutral-500);
    font-size: 11px;
}

.request-brief__item strong {
    color: var(--color-chocolate-900);
    font-size: 14px;
    line-height: 1.35;
}

.request-brief__section {
    padding: 18px 20px;
    border-top: 1px solid var(--color-chocolate-100);
}

.request-brief__section > p {
    margin: 0;
    color: var(--color-chocolate-800);
    font-size: 14px;
    line-height: 1.55;
}

.request-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 7px;
}

.request-tag {
    display: inline-flex;
    padding: 6px 10px;
    color: var(--color-brand-primary-600);
    background: var(--color-brand-primary-50);
    border-radius: 999px;
    font-size: 12px;
}

.request-preview__missing {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 14px;
    padding: 14px 16px;
    background: var(--color-neutral-100);
    border-radius: 14px;
}

.request-preview__missing-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    flex: 0 0 auto;
    color: var(--color-brand-primary-600);
    background: var(--color-neutral-0, #fff);
    border-radius: 9px;
}

.request-preview__missing-copy {
    min-width: 0;
}

.request-preview__missing-copy strong {
    display: block;
    color: var(--color-chocolate-900);
    font-size: 13px;
}

.request-preview__missing-copy p {
    margin: 3px 0 0;
    color: var(--color-neutral-500);
    font-size: 12px;
    line-height: 1.45;
}

.request-preview__missing .button {
    margin-left: auto;
    flex: 0 0 auto;
}

.request-preview__notice {
    display: flex;
    gap: 10px;
    align-items: flex-start;
    margin-top: 16px;
    padding: 14px 16px;
    color: var(--color-chocolate-700);
    background: var(--color-chocolate-50);
    border-radius: 12px;
}

.request-preview__notice svg {
    flex: 0 0 auto;
    margin-top: 1px;
}

.request-preview__notice p {
    margin: 0;
    font-size: 13px;
    line-height: 1.5;
}

.request-preview__actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 24px;
}

@media (max-width: 600px) {
    .request-brief__grid {
        grid-template-columns: 1fr;
    }

    .request-brief__item:nth-child(odd) {
        border-right: 0;
    }

    .request-preview__missing {
        align-items: flex-start;
    }

    .request-preview__missing .button {
        margin-left: auto;
    }

    .request-preview__actions {
        flex-direction: column-reverse;
    }

    .request-preview__actions .button {
        width: 100%;
    }
}
</style>
