<template>
    <div class="request-create">
        <RequestProgress
            :current-step="currentStepNumber"
            :total-steps="REQUEST_TOTAL_STEPS"
        />

        <main class="request-create__content">
            <section
                v-if="step === RequestStep.Description"
                class="request-create__step"
            >
                <header class="request-create__header">
                    <p class="request-create__eyebrow">Deine Anfrage</p>
                    <h1>Erzähl uns von deiner Idee.</h1>
                    <p>
                        Beschreibe einfach, was du suchst. Du musst noch nicht
                        alle Details kennen.
                    </p>
                </header>

                <form
                    class="request-description"
                    @submit.prevent="createRequest"
                >
                    <label
                        for="request-description"
                        class="request-description__label"
                    >
                        Was möchtest du anfertigen lassen?
                    </label>

                    <textarea
                        id="request-description"
                        v-model="description"
                        rows="8"
                        :minlength="REQUEST_MIN_DESCRIPTION_LENGTH"
                        :maxlength="REQUEST_MAX_DESCRIPTION_LENGTH"
                        autofocus
                        class="request-description__textarea"
                        :class="{
                            'request-description__textarea--invalid':
                                description.length > 0 &&
                                !canContinue,
                        }"
                        placeholder="Zum Beispiel: Ich suche eine elegante Hochzeitstorte für etwa 50 Personen im September in Berlin …"
                        @input="descriptionError = ''"
                    />

                    <div class="request-description__meta">
                        <span
                            :class="{
                                'is-invalid':
                                    description.length > 0 && !canContinue,
                            }"
                        >
                            {{ description.length }} /
                            {{ REQUEST_MAX_DESCRIPTION_LENGTH }}
                        </span>

                        <span v-if="description.length < REQUEST_MIN_DESCRIPTION_LENGTH">
                            Mindestens {{ REQUEST_MIN_DESCRIPTION_LENGTH }} Zeichen
                        </span>
                        <span v-else>
                            Gute Grundlage – wir kümmern uns um die Details.
                        </span>
                    </div>

                    <p
                        v-if="descriptionError"
                        class="request-create__error"
                        role="alert"
                    >
                        {{ descriptionError }}
                    </p>

                    <div class="request-create__actions">
                        <button
                            type="submit"
                            class="button button--primary button--lg"
                            :disabled="creating || !canContinue"
                        >
                            <ButtonLoader v-if="creating" />
                            <span>
                                {{ creating ? "Wird analysiert …" : "Weiter" }}
                            </span>
                        </button>
                    </div>
                </form>
            </section>

            <section
                v-else
                class="request-create__step"
            >
                <RequestPreview
                    v-if="request"
                    :request="request"
                    :categories="categories"
                    :occasions="occasions"
                    :fulfillment-methods="fulfillmentMethods"
                    :processing="processing"
                    @edit="qualificationOpen = true"
                    @confirm="confirmRequest"
                    @submit="submitRequest"
                />
            </section>
        </main>

        <RequestQualification
            v-if="request"
            v-model:open="qualificationOpen"
            :request="request"
            :occasions="occasions"
            @saved="handleQualificationSaved"
        />
    </div>
</template>

<script setup lang="ts">
import { computed, ref, watch } from "vue";
import { router, setLayoutProps } from "@inertiajs/vue3";

import ButtonLoader from "@/components/ui/ButtonLoader.vue";
import RequestBuilderLayout from "@/platform/layout/RequestBuilderLayout.vue";
import RequestProgress from "@/platform/components/request/RequestProgress.vue";
import RequestQualification from "@/platform/components/request/RequestQualification.vue";
import RequestPreview from "@/platform/components/request/RequestPreview.vue";
import {
    REQUEST_CATEGORIES,
    REQUEST_FULFILLMENT_METHODS,
    REQUEST_MAX_DESCRIPTION_LENGTH,
    REQUEST_MIN_DESCRIPTION_LENGTH,
    REQUEST_TOTAL_STEPS,
} from "@/constants/requests";
import { RequestStep } from "@/enums/request";
import type {
    RequestData,
    RequestStep as RequestStepType,
} from "@/types/requests";

defineOptions({ layout: RequestBuilderLayout });

interface Props {
    intent?: string;
    request?: RequestData | null;
    initialStep?: string;
    occasions: Array<{ value: string; label: string }>;
}

const props = withDefaults(defineProps<Props>(), {
    intent: "",
    request: null,
    initialStep: "",
});

const request = ref<RequestData | null>(props.request);
const description = ref(props.request?.description ?? props.intent ?? "");
const qualificationOpen = ref(false);
const creating = ref(false);
const processing = ref(false);
const descriptionError = ref("");

const categories = REQUEST_CATEGORIES;
const fulfillmentMethods = REQUEST_FULFILLMENT_METHODS;
const occasions = props.occasions;

const step = ref<RequestStepType>(
    props.request || props.initialStep === "preview"
        ? RequestStep.Preview
        : RequestStep.Description,
);

const currentStepNumber = computed(() =>
    step.value === RequestStep.Description ? 1 : 2,
);

const canContinue = computed(() => {
    const value = description.value.trim();
    return (
        value.length >= REQUEST_MIN_DESCRIPTION_LENGTH &&
        value.length <= REQUEST_MAX_DESCRIPTION_LENGTH
    );
});

watch(
    () => props.request,
    (value) => {
        request.value = value;
        if (value) {
            description.value = value.description;
            step.value = RequestStep.Preview;
        }
    },
    { deep: true },
);

setLayoutProps({ onBack: handleBack });

function createRequest() {
    descriptionError.value = "";
    const value = description.value.trim();

    if (!canContinue.value) {
        descriptionError.value =
            "Beschreibe deine Idee mit etwas mehr Details, damit wir sie besser verstehen können.";
        return;
    }

    creating.value = true;

    router.post(
        "/app/requests",
        { description: value },
        {
            preserveScroll: true,
            onSuccess: (page) => {
                const nextRequest = page.props.request as RequestData | null;

                if (nextRequest) {
                    request.value = nextRequest;
                    description.value = nextRequest.description;
                    step.value = RequestStep.Preview;
                }
            },
            onError: (errors) => {
                descriptionError.value =
                    errors.description ??
                    "Die Anfrage konnte nicht erstellt werden.";
            },
            onFinish: () => {
                creating.value = false;
            },
        },
    );
}

function handleQualificationSaved(updatedRequest: RequestData) {
    request.value = updatedRequest;
    qualificationOpen.value = false;
}

function confirmRequest() {
    if (!request.value || processing.value) return;

    processing.value = true;

    router.post(
        `/app/requests/${request.value.id}/confirm`,
        {},
        {
            preserveScroll: true,
            onSuccess: (page) => {
                const updatedRequest = page.props.request as RequestData | null;

                if (updatedRequest) {
                    request.value = updatedRequest;
                }
            },
            onFinish: () => {
                processing.value = false;
            },
        },
    );
}

function submitRequest() {
    if (!request.value || processing.value) return;

    processing.value = true;

    router.post(
        `/app/requests/${request.value.id}/submit`,
        {},
        {
            onSuccess: (page) => {
                const updatedRequest = page.props.request as RequestData | null;

                if (updatedRequest) {
                    request.value = updatedRequest;
                }
            },
            onFinish: () => {
                processing.value = false;
            },
        },
    );
}

function handleBack() {
    if (qualificationOpen.value) {
        qualificationOpen.value = false;
        return;
    }

    if (step.value === RequestStep.Preview) {
        step.value = RequestStep.Description;
        return;
    }

    window.history.back();
}
</script>

<style scoped lang="scss">
.request-create {
    width: min(calc(100% - 32px), 760px);
    margin-inline: auto;
    padding-block: 18px 72px;
}

.request-create__content {
    width: min(100%, 620px);
    margin: 42px auto 0;
}

.request-create__header {
    margin-bottom: 32px;
}

.request-create__eyebrow {
    margin: 0 0 8px;
    color: var(--color-brand-primary-500);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

.request-create__header h1 {
    max-width: 620px;
    margin: 0 0 14px;
    color: var(--color-chocolate-900);
    font-family: Fraunces, Georgia, serif;
    font-size: clamp(2.25rem, 8vw, 3.5rem);
    line-height: 1.02;
    letter-spacing: -0.04em;
}

.request-create__header > p:last-child {
    max-width: 540px;
    margin: 0;
    color: var(--color-neutral-500);
    font-size: 15px;
    line-height: 1.65;
}

.request-description {
    display: grid;
    gap: 12px;
}

.request-description__label {
    color: var(--color-chocolate-800);
    font-size: 14px;
    font-weight: 650;
}

.request-description__textarea {
    width: 100%;
    min-height: 220px;
    padding: 18px;
    resize: vertical;
    color: var(--color-chocolate-900);
    background: var(--color-neutral-0, #fff);
    border: 1px solid var(--color-chocolate-200);
    border-radius: 16px;
    outline: none;
    font: inherit;
    font-size: 16px;
    line-height: 1.6;
    transition: border-color 160ms ease, box-shadow 160ms ease;
}

.request-description__textarea:focus {
    border-color: var(--color-brand-primary-500);
    box-shadow: 0 0 0 3px rgb(0 0 0 / 4%);
}

.request-description__textarea--invalid {
    border-color: var(--color-error-500);
}

.request-description__meta {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    color: var(--color-neutral-500);
    font-size: 12px;
}

.request-description__meta .is-invalid {
    color: var(--color-error-600);
}

.request-create__error {
    margin: 0;
    color: var(--color-error-600);
    font-size: 13px;
}

.request-create__actions {
    display: flex;
    justify-content: flex-end;
    margin-top: 12px;
}

@media (max-width: 600px) {
    .request-create {
        width: min(calc(100% - 24px), 760px);
    }

    .request-create__content {
        margin-top: 32px;
    }

    .request-create__actions button {
        width: 100%;
    }
}
</style>
