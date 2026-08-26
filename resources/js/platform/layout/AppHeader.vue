<template>
    <header class="app-header">
        <div class="app-header__inner">
            <Link class="logo" :href="appHomeUrl?.href ?? '/app'">
                <svg class="logo__image" width="448" height="283" viewBox="0 0 448 283" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 278.6C0 277.667 0.8 277.067 2.4 276.8L17.4 274.4C20.2 273.867 22.1333 273.2 23.2 272.4C24.4 271.467 25 270.133 25 268.4V12C25 10.1333 24.4 8.73334 23.2 7.80001C22 6.86668 20.1333 6.13334 17.6 5.6L2 3C0.666667 2.86667 0 2.26668 0 1.20001C0 0.800006 0.2 0.533334 0.6 0.399995C1 0.133332 1.46667 0 2 0H107.2C131.333 0 153.4 3.46667 173.4 10.4C193.4 17.2 210.733 27.3333 225.4 40.8C240.067 54.2667 251.4 70.8 259.4 90.4C267.4 109.867 271.4 132.2 271.4 157.4C271.4 183.4 265.333 205.533 253.2 223.8C241.2 242.067 224.2 256 202.2 265.6C180.333 275.2 154.533 280 124.8 280H2C1.33333 280 0.799999 279.867 0.399999 279.6C0.133333 279.333 0 279 0 278.6ZM124.8 275.8C138.667 275.8 151 271.6 161.8 263.2C172.733 254.8 181.333 241.4 187.6 223C194 204.6 197.2 180.4 197.2 150.4C197.2 126.267 195.067 105.133 190.8 87C186.667 68.7334 180.6 53.4667 172.6 41.2C164.733 28.9334 155.267 19.7333 144.2 13.6C133.267 7.33334 121 4.20001 107.4 4.20001H95.8V268.4C95.8 270.667 96.4667 272.467 97.8 273.8C99.2667 275.133 101.333 275.8 104 275.8H124.8Z" fill="#DF4D69"/>
                    <path d="M313.805 181.79L305.755 180.525C305.295 180.372 304.95 180.18 304.72 179.95C304.567 179.72 304.49 179.452 304.49 179.145C304.49 178.838 304.643 178.57 304.95 178.34C305.257 178.11 305.602 177.995 305.985 177.995H317.83C318.443 177.995 318.98 177.918 319.44 177.765C319.9 177.612 320.437 177.343 321.05 176.96L354.975 154.765C355.282 154.535 355.627 154.343 356.01 154.19C356.47 153.96 356.93 153.845 357.39 153.845C357.697 153.845 357.927 153.998 358.08 154.305C358.31 154.535 358.425 154.88 358.425 155.34C358.425 155.57 358.387 155.915 358.31 156.375C358.233 156.758 358.118 157.295 357.965 157.985L331.4 254.01C329.637 260.22 329.177 264.398 330.02 266.545C330.94 268.692 332.473 269.765 334.62 269.765C336.92 269.765 339.335 268.807 341.865 266.89C344.472 264.973 347.232 261.983 350.145 257.92C350.682 257.153 351.065 256.655 351.295 256.425C351.525 256.195 351.793 256.118 352.1 256.195C352.407 256.195 352.56 256.463 352.56 257C352.56 257.46 352.33 258.15 351.87 259.07C350.183 262.29 347.998 265.318 345.315 268.155C342.708 270.992 339.68 273.483 336.23 275.63C332.78 277.7 328.985 279.31 324.845 280.46C320.705 281.61 316.258 282.185 311.505 282.185C306.292 282.185 302.305 281.342 299.545 279.655C296.862 277.968 295.29 275.323 294.83 271.72C294.37 268.04 294.945 263.402 296.555 257.805L316.105 187.77C316.642 185.777 316.718 184.32 316.335 183.4C316.028 182.48 315.185 181.943 313.805 181.79ZM345.43 180.41L346.81 177.995H369.81C370.807 177.995 371.305 178.378 371.305 179.145C371.305 179.605 371.113 179.95 370.73 180.18C370.347 180.333 369.81 180.41 369.12 180.41H345.43Z" fill="#DF4D69"/>
                    <path d="M388.192 279.655C391.949 279.655 395.13 278.198 397.737 275.285C400.42 272.372 401.762 268.73 401.762 264.36C401.839 261.677 401.34 259.185 400.267 256.885C399.194 254.585 397.469 252.208 395.092 249.755C392.715 247.225 389.61 244.388 385.777 241.245C380.87 237.258 376.769 233.578 373.472 230.205C370.252 226.755 367.875 223.343 366.342 219.97C364.885 216.597 364.31 212.917 364.617 208.93C365.077 203.027 367.224 197.507 371.057 192.37C374.89 187.157 380.219 182.94 387.042 179.72C393.942 176.5 402.145 174.89 411.652 174.89C419.702 174.89 426.372 175.925 431.662 177.995C437.029 179.988 441.054 182.595 443.737 185.815C446.42 188.958 447.839 192.293 447.992 195.82C448.145 199.653 447.264 202.72 445.347 205.02C443.43 207.32 440.977 208.47 437.987 208.47C434.307 208.47 431.24 207.167 428.787 204.56C426.334 201.877 424.302 197.085 422.692 190.185C421.465 185.432 419.817 182.135 417.747 180.295C415.677 178.378 413.07 177.42 409.927 177.42C405.94 177.42 402.644 178.877 400.037 181.79C397.507 184.703 396.204 188.613 396.127 193.52C396.05 196.587 396.587 199.5 397.737 202.26C398.887 204.943 400.995 207.895 404.062 211.115C407.205 214.258 411.652 218.168 417.402 222.845C422.079 226.525 425.797 229.937 428.557 233.08C431.394 236.147 433.349 239.213 434.422 242.28C435.572 245.347 435.84 248.758 435.227 252.515C434.384 258.265 431.815 263.363 427.522 267.81C423.229 272.257 417.632 275.783 410.732 278.39C403.832 280.92 395.897 282.185 386.927 282.185C378.417 282.185 371.402 281.073 365.882 278.85C360.362 276.55 356.299 273.598 353.692 269.995C351.085 266.315 349.782 262.52 349.782 258.61C349.782 255.237 350.587 252.4 352.197 250.1C353.884 247.723 356.299 246.535 359.442 246.535C363.429 246.535 366.534 247.992 368.757 250.905C371.057 253.742 372.974 258.495 374.507 265.165C375.964 270.455 377.727 274.212 379.797 276.435C381.944 278.582 384.742 279.655 388.192 279.655Z" fill="#DF4D69"/>
                </svg>
            </Link>

            <nav
                class="app-header__navigation"
                aria-label="Hauptnavigation"
            >
                <Link
                    v-for="link in mainNavigationLinks"
                    :key="link.title"
                    :href="link.href"
                    class="app-header__navigation-link"
                    :class="{
                        'app-header__navigation-link--active':
                            isActiveLink(link.href),
                    }"
                >
                    <component
                        v-if="link.iconName"
                        :is="NAVIGATION_LINK_ICONS[link.iconName]"
                        :size="20"
                        :stroke-width="1.8"
                    />

                    <span>{{ link.title }}</span>
                </Link>
            </nav>

            <button
                type="button"
                class="app-header__user-button"
                aria-label="Benutzermenü öffnen"
            >
                <CircleUserRound
                    :size="23"
                    :stroke-width="1.7"
                />
            </button>
        </div>
    </header>
</template>

<script setup lang="ts">
import { computed } from "vue";

import { Link, usePage } from "@inertiajs/vue3";

import { 
    CircleUserRound,
} from "@lucide/vue";

import { NAVIGATION_LINK_ICONS } from "@/constants";
import type { AppLinks } from "@/types/ui";

const props = defineProps<{
    links: AppLinks;
}>();

const page = usePage();

const appHomeUrl = props.links.user.find(link => link.title == "Startseite");

const mainNavigationLinks = computed(() => {
    return props.links.user.filter(link => !["Profil"].includes(link.title));
});

function isActiveLink(url: string): boolean {
    return page.url === new URL(url).pathname;
}
</script>

<style scoped lang="scss">
.app-header {
    position: sticky;
    z-index: 3;
    top: 0;

    width: 100%;

    border-bottom: 1px solid var(--color-chocolate-100, #f4e8df);

    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
}

.app-header__inner {
    display: flex;
    align-items: center;
    justify-content: space-between;

    width: 100%;
    max-width: 90rem;
    height: var(--space-16);

    margin-inline: auto;
    padding-inline: 20px;

    @media (min-width: 768px) {
        padding-inline: 32px;
    }
}

.logo {
    position: relative;
    z-index: 1;
}

.app-header__navigation {
    display: none;

    @media (min-width: 768px) {
        position: absolute;
        display: flex;
        gap: 4px;
        justify-content: center;
        align-items: center;
        left: 50%;
        transform: translateX(-50%);
        width: 100%;
    }
}

.app-header__navigation-link {
    position: relative;

    display: inline-flex;
    gap: 8px;
    align-items: center;

    height: 44px;

    padding-inline: 14px;

    color: var(--color-neutral-500);
    border-radius: 999px;

    font-size: 14px;
    font-weight: 500;

    text-decoration: none;

    transition:
        color 140ms ease,
        background-color 140ms ease;
}

.app-header__navigation-link:hover,
.app-header__navigation-link--active {
    color: var(--color-brand-primary-500);
    background-color: var(--color-brand-primary-50);
}

.app-header__user-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    width: 42px;
    height: 42px;

    padding: 0;

    color: var(--color-chocolate-700, #563d33);
    background: #fff;

    border: 1px solid var(--color-chocolate-200, #e8d5c8);
    border-radius: 50%;

    cursor: pointer;

    transition:
        background-color 140ms ease,
        border-color 140ms ease,
        transform 100ms ease;

    -webkit-tap-highlight-color: transparent;
}

.app-header__user-button:hover {
    background: var(--color-chocolate-50, #fbf6f2);
    border-color: var(--color-chocolate-300, #d8b9a6);
}

.app-header__user-button:active {
    transform: scale(0.96);
}
</style>