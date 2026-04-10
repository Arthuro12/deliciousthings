<template>
    <AppLayout>
        <Head>
            <title>Konditoreien & Bäckereien: Handwerk erleben</title>
            <meta name="description" content="Bringen Sie Ihre Handwerkskunst ans Licht. Verbinden Sie sich mit Liebhaber:innen, die es kaum erwarten können, Ihre Backwaren zu genießen. Jetzt Teil werden!" />
        </Head>

        <main class="home-page">
            <div>   
                <section class="hero-section"> 
                    <h2 class="title">Gewinnen Sie lokale Kund:innen ohne Aufwand.</h2> 
                    <h3 class="subtitle">Erweitern Sie Ihre Klientel und zeigen Sie Ihre Kreationen.</h3>                   
                    <div>
                        <a 
                            v-show="!isAuthenticated"
                            class="cta-link cta-link--primary"
                            href="/register" 
                            target="_blank"
                        >
                            Profil erstellen
                            <ChevronRightIcon :size="20" />
                        </a>
                        <a 
                            class="cta-link"
                            :class="{ 
                                'cta-link--neutral': !isAuthenticated,
                                'cta-link--primary': isAuthenticated 
                            }" 
                            href="/search" 
                            target="_blank"
                        >
                            Anbietende entdecken
                            <ChevronRightIcon :size="20" />
                        </a>
                    </div>
                </section>
                <section class="how-it-works-section">
                    <h1 class="title">So funktioniert es</h1>
                    <div>
                        <ul class="how-it-works__steps">
                            <li class="how-it-works__step">
                                <div class="icon-wrapper">
                                    <UserPlusIcon color="#e680a5" :size="40" />
                                </div>
                                <p>Einfache Registrierung</p>
                            </li>
                            <li class="how-it-works__step">
                                <div class="icon-wrapper"><RocketIcon color="#e680a5" :size="40" /></div>
                                <p>Profil erstellen und veröffentlichen</p>
                            </li>
                            <li class="how-it-works__step">
                                <div class="icon-wrapper"><MessageCircleIcon color="#e680a5" :size="40" /></div>
                                <p>Anfragen von KundInnen bekommen</p>
                            </li>
                        </ul>
                    </div>
                </section>
                <section class="advantages-section">
                    <h2 class="title">Ihre Vorteile</h2>
                    <div>
                        <ul class="advantages">
                            <li class="advantage">
                                <span class="advantages-highlight">1</span>
                                <p>Sofortige lokale Sichtbarkeit</p>
                            </li>
                            <li class="advantage">
                                <span class="advantages-highlight">2</span>
                                <p>Kostenlose Nutzung zum Start</p>
                            </li>
                            <li class="advantage">
                                <span class="advantages-highlight">3</span>
                                <p>Kein Vertragszwang</p>
                            </li>
                            <li class="advantage">
                                <span class="advantages-highlight">4</span>
                                <p>Direkte Nachrichten von Kunden</p>
                            </li>
                        </ul>
                    </div>
                </section>
            </div>
        </main>
    </AppLayout>
</template>

<script setup lang="ts">
import { Head } from "@inertiajs/vue3";

import { 
    ChevronRightIcon, 
    UserPlusIcon, 
    RocketIcon, 
    MessageCircleIcon,
} from "lucide-vue-next";

import AppLayout from "@/layout/AppLayout.vue";

import { useAuth } from "@/composables/use-auth";
import { usePageDbClick } from "@/composables/use-page-db-click";

const { isAuthenticated } = useAuth();
usePageDbClick();
</script>

<style scoped lang="scss">
@use '../../css/abstracts/breakpoints' as breakpoints; 
@use '../../css/components/buttons' as buttons;

ul li {
    list-style: none;
}

.home-page {
    --title-font-weight: 600;
    --title-font-size: 2.5rem;
    --subtitle-font-size: 1.5rem;
    --subtitle-font-weight: 500;
    --cta-background-color-secondary: #fff3;

    .icon-wrapper {
        background: var(--color-primary-10);
        padding: 1rem;
        border-radius: 50%;
        display: inline-flex;
    }

    .title {
        font-size: var(--title-font-size);
        font-weight: var(--title-font-weight);
        color: var(--color-neutral-0);
        text-align: center;
        width: 100%;
    }

    .subtitle {
        font-size: var(--subtitle-font-size);
        font-weight: var(--subtitle-font-weight);
        color: var(--color-neutral-0);
        text-align: center;
    }

    .hero-section {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        row-gap: 24px;
        background-image: linear-gradient(to top, rgba(0,0,0,0.25), rgba(0,0,0,0.25), transparent), url("../../images/butter-cream.webp");
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        padding: 18px;
        min-height: 85vh;

        .cta-link {
            font-weight: 600;
            display: flex;
            justify-content: center;
            align-items: center;
            column-gap: 12px;
            border-radius: 5px;
            padding: 14px 24px;
            margin-top: 24px;

            &--primary {
                color: var(--color-primary-0);
                background-color: var(--color-primary-50);
            }

            &--neutral {
                color: var(--color-neutral-0);
                background-color: var(--cta-background-color-secondary);
            }
        }
    }

    .how-it-works-section {
        background-color: var(--color-secondary-10);
        padding: 54px 0;

        > .title {
            color: var(--color-secondary-50);
            padding: 0 18px;
        }

        .how-it-works {
            &__steps {
                display: flex;
                flex-direction: column;
                justify-content: center;
                flex-wrap: wrap;
                gap: 30px;
                margin: 30px 0;
            }

            &__step {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 12px;
            }

            @include breakpoints.respond-to('large') {
                &__steps {
                    flex-direction: row;
                }
            }
        }
    }

    .advantages-section {
        padding: 54px 32px;

        > .title {
            color: var(--color-neutral-50);
        }

        .advantages {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(126px, 1fr));
            gap: 30px;
            margin: 30px;
        }

        .advantage {
            display: flex;
            flex-direction: column;
            gap: 12px;

            > .advantages-highlight {
                font-size: 2rem;
                font-weight: 700;
                color: var(--color-primary-0);
                background-color: var(--color-primary-50);
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 1rem;
                border-radius: 50%;
                width: 50px;
                height: 50px;
            }
        }
    }
}
</style>