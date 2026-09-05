<template>
    <nav
        class="request-progress"
        aria-label="Fortschritt der Anfrage"
    >
        <!-- Mobile -->
        <div class="request-progress__mobile">
            <span class="request-progress__step">
                Schritt {{ currentStep }} von {{ totalSteps }}
            </span>

            <span class="request-progress__label">
                {{ currentStepLabel }}
            </span>
        </div>

        <!-- Desktop -->
        <ol class="request-progress__desktop">
            <template
                v-for="(step, index) in steps"
                :key="step.key"
            >
                <li
                    class="request-progress__item"
                    :class="{
                        'request-progress__item--active':
                            index + 1 === currentStep,
                        'request-progress__item--completed':
                            index + 1 < currentStep,
                    }"
                >
                    <span class="request-progress__number">
                        <Check
                            v-if="index + 1 < currentStep"
                            :size="14"
                            :stroke-width="2.2"
                        />

                        <span v-else>
                            {{ String(index + 1).padStart(2, "0") }}
                        </span>
                    </span>

                    <span class="request-progress__text">
                        {{ step.label }}
                    </span>
                </li>

                <li
                    v-if="index < steps.length - 1"
                    class="request-progress__connector"
                    aria-hidden="true"
                >
                    <span
                        class="request-progress__line"
                        :class="{
                            'request-progress__line--completed':
                                index + 1 < currentStep,
                        }"
                    />
                </li>
            </template>
        </ol>

        <!-- Mobile progress bar -->
        <div
            class="request-progress__bar"
            aria-hidden="true"
        >
            <span
                :style="{
                    width: `${progressPercentage}%`,
                }"
            />
        </div>
    </nav>
</template>

<script setup lang="ts">
import { computed } from "vue";
import { Check } from "@lucide/vue";
import {
    REQUEST_STEPS,
    REQUEST_TOTAL_STEPS,
} from "@/constants/requests";

const props = withDefaults(
    defineProps<{
        currentStep: number;
        totalSteps?: number;
    }>(),
    {
        totalSteps: REQUEST_TOTAL_STEPS,
    },
);

const steps = REQUEST_STEPS;

const currentStepLabel = computed(() => {
    return (
        steps[props.currentStep - 1]?.label ??
        ""
    );
});

const progressPercentage = computed(() => {
    if (props.totalSteps <= 1) {
        return 100;
    }

    return (
        ((props.currentStep - 1) /
            (props.totalSteps - 1)) *
        100
    );
});
</script>

<style scoped lang="scss">
.request-progress {
    width: min(100%, 600px);
    margin-inline: auto;
}

/* --------------------------------------------------
   Mobile
-------------------------------------------------- */

.request-progress__mobile {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 12px;

    @media (min-width: 768px) {
        display: none;
    }
}

.request-progress__step {
    color: var(--color-chocolate-700);
    font-size: 13px;
    font-weight: 600;
    line-height: 1.4;
}

.request-progress__label {
    color: var(--color-chocolate-800);
    font-size: 14px;
    font-weight: 700;
    line-height: 1.4;
}

/* --------------------------------------------------
   Desktop
-------------------------------------------------- */

.request-progress__desktop {
    display: none;
    align-items: center;
    width: 100%;
    margin: 0;
    padding: 0;
    list-style: none;

    @media (min-width: 768px) {
        display: flex;
    }
}

.request-progress__item {
    display: flex;
    flex: 0 0 auto;
    align-items: center;
    color: var(--color-neutral-500);
    font-size: 14px;
    font-weight: 500;
    line-height: 1.4;

    span {
        font: inherit;
    }
}

.request-progress__item--active {
    color: var(--color-brand-primary-600);
    font-weight: 700;
}

.request-progress__item--completed {
    color: var(--color-chocolate-700);
    font-weight: 600;
}

.request-progress__number {
    display: inline-flex;
    flex: 0 0 auto;
    align-items: center;
    justify-content: center;

    width: 40px;
    height: 40px;

    color: var(--color-neutral-500);
    background: var(--color-neutral-0);
    border: 1px solid var(--color-chocolate-200);
    border-radius: 50%;

    font-size: 11px;
    font-weight: 700;
}

.request-progress__item--active
    .request-progress__number {
    color: var(--color-neutral-0);
    background: var(--color-brand-primary-500);
    border-color: var(--color-brand-primary-500);
}

.request-progress__item--completed
    .request-progress__number {
    color: var(--color-neutral-0);
    background: var(--color-chocolate-700);
    border-color: var(--color-chocolate-700);
}

.request-progress__text {
    margin-left: 8px;
    white-space: nowrap;
}

/*
 * The connector is the flexible part of the stepper.
 * It absorbs all remaining horizontal space.
 */
.request-progress__connector {
    display: flex;
    flex: 1 1 auto;
    align-items: center;
    min-width: 32px;
}

.request-progress__line {
    display: block;
    width: 100%;
    height: 1px;
    margin-inline: 16px;
    background: var(--color-chocolate-200);
}

.request-progress__line--completed {
    background: var(--color-chocolate-700);
}

/* --------------------------------------------------
   Mobile progress bar
-------------------------------------------------- */

.request-progress__bar {
    overflow: hidden;
    width: 100%;
    height: 2px;
    background: var(--color-chocolate-100);

    @media (min-width: 768px) {
        display: none;
    }
}

.request-progress__bar span {
    display: block;
    height: 100%;
    background: var(--color-brand-primary-500);
    transition: width 200ms ease;
}
</style>