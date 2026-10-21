<template>
    <div class="app-content-wrapper requests-page">
        <Head title="Meine Anfragen" />
        <main class="app-content">
            <header class="requests-page__header">
                <div>
                    <p class="requests-page__eyebrow">Deine Kreationen</p>
                    <h1>Anfragen</h1>
                    <p class="requests-page__intro">Hier behältst du deine individuellen Wünsche und die Antworten der Backprofis im Blick.</p>
                </div>
                <Link href="/app/requests/create" class="button button--primary button--lg">Neue Anfrage</Link>
            </header>

            <section v-if="requests.length" class="request-list" aria-label="Deine Anfragen">
                <article v-for="request in requests" :key="request.id" class="request-card">
                    <div class="request-card__top">
                        <div>
                            <span class="request-card__occasion">{{ occasionLabel(request.occasion) }}</span>
                            <h2>{{ titleFor(request.description) }}</h2>
                        </div>
                        <span class="request-status" :class="`request-status--${request.status}`">{{ statusLabel(request.status) }}</span>
                    </div>
                    <p class="request-card__description">{{ request.description }}</p>
                    <div class="request-card__meta">
                        <span v-if="request.event_date">Termin: {{ formatDate(request.event_date) }}</span>
                        <span v-if="request.participants">{{ request.participants }} Personen</span>
                        <span v-if="request.artisan_name">Für {{ request.artisan_name }}</span>
                    </div>
                    <div v-if="request.artisan_response" class="request-card__response">
                        <div class="request-card__response-heading">
                            <strong>Antwort von {{ request.artisan_name || 'deinem Backprofi' }}</strong>
                            <strong v-if="request.quote_amount !== null">{{ formatPrice(request.quote_amount, request.currency) }}</strong>
                        </div>
                        <p>{{ request.artisan_response }}</p>
                    </div>
                    <div class="request-card__actions">
                        <Link v-if="['draft', 'confirmed'].includes(request.status)" class="button button--outline button--lg" :href="`/app/requests/create?request_id=${request.id}&step=preview`">Anfrage fortsetzen</Link>
                        <button v-if="request.status === 'responded'" class="button button--primary button--lg" :disabled="busyId === request.id" @click="transitionRequest(request.id, 'complete')">{{ busyId === request.id ? 'Wird gespeichert …' : 'Als abgeschlossen markieren' }}</button>
                        <button v-if="!['completed', 'cancelled'].includes(request.status)" class="button button--ghost button--lg" :disabled="busyId === request.id" @click="transitionRequest(request.id, 'cancel')">Stornieren</button>
                    </div>
                </article>
            </section>

            <section v-else class="requests-empty">
                <div class="requests-empty__icon">✦</div>
                <h2>Deine nächste Idee beginnt hier</h2>
                <p>Beschreibe deine Wunschkreation und teile Anlass, Termin und Stil. Backprofis können dir anschließend antworten.</p>
                <Link href="/app/requests/create" class="button button--primary button--lg">Kreation anfragen</Link>
            </section>
        </main>
    </div>
</template>

<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import Layout from '@/platform/layout/AppLayout.vue';

defineOptions({ layout: Layout });

type RequestItem = {
    id: number; status: string; description: string; occasion: string | null;
    event_date: string | null; participants: number | null; location_text: string | null;
    quote_amount: number | null; currency: string; artisan_response: string | null;
    artisan_name: string | null; created_at: string | null;
};

defineProps<{ requests: RequestItem[] }>();
const busyId = ref<number | null>(null);
function transitionRequest(id: number, action: 'complete' | 'cancel') {
    if (action === 'cancel' && !window.confirm('Möchtest du diese Anfrage wirklich stornieren?')) return;
    busyId.value = id;
    router.post('/app/requests/' + id + '/' + action, {}, { preserveScroll: true, onFinish: () => busyId.value = null });
}

const occasions: Record<string, string> = {
    birthday: 'Geburtstag', wedding: 'Hochzeit', engagement: 'Verlobung', baptism: 'Taufe',
    'baby-shower': 'Baby Shower', anniversary: 'Jubiläum', graduation: 'Abschluss', other: 'Besonderer Anlass',
};
const statuses: Record<string, string> = {
    draft: 'Entwurf', confirmed: 'Bestätigt', sent: 'Wird geprüft', responded: 'Antwort erhalten',
    declined: 'Abgelehnt', completed: 'Abgeschlossen', cancelled: 'Storniert',
};
function occasionLabel(value: string | null) { return value ? occasions[value] ?? 'Individuelle Kreation' : 'Individuelle Kreation'; }
function statusLabel(value: string) { return statuses[value] ?? value; }
function titleFor(value: string) { return value.length > 76 ? `${value.slice(0, 73).trim()}…` : value; }
function formatDate(value: string) { return new Intl.DateTimeFormat('de-DE', { dateStyle: 'medium' }).format(new Date(`${value}T00:00:00`)); }
function formatPrice(value: number, currency: string) { return new Intl.NumberFormat('de-DE', { style: 'currency', currency }).format(value); }
</script>

<style scoped lang="scss">
.requests-page { padding-bottom: calc(var(--space-24) + var(--space-8)); }
.requests-page__header { display:flex; align-items:flex-end; justify-content:space-between; gap:var(--space-6); margin-bottom:var(--space-8); }
.requests-page__eyebrow { margin:0 0 var(--space-2); color:var(--color-text-brand); font-size:var(--font-size-xs); font-weight:var(--font-weight-bold); letter-spacing:.08em; text-transform:uppercase; }
.requests-page__header h1 { margin:0; color:var(--color-text-primary); font-family:var(--font-heading); }
.requests-page__intro { max-width:600px; margin:var(--space-3) 0 0; color:var(--color-text-secondary); }
.request-list { display:grid; gap:var(--space-4); }
.request-card { padding:var(--card-padding-lg); background:var(--card-background); border:1px solid var(--card-border); border-radius:var(--card-radius); box-shadow:var(--card-shadow); }
.request-card__top,.request-card__response-heading { display:flex; justify-content:space-between; align-items:flex-start; gap:var(--space-4); }
.request-card__occasion { color:var(--color-text-brand); font-size:var(--font-size-xs); font-weight:var(--font-weight-semibold); text-transform:uppercase; letter-spacing:.06em; }
.request-card h2 { margin:var(--space-1) 0 0; font-size:var(--font-size-xl); }
.request-card__description { margin:var(--space-4) 0; color:var(--color-text-secondary); }
.request-card__meta { display:flex; flex-wrap:wrap; gap:var(--space-4); color:var(--color-text-muted); font-size:var(--font-size-sm); }
.request-status { flex:0 0 auto; padding:var(--space-2) var(--space-3); color:var(--badge-text); background:var(--badge-background); border:1px solid var(--badge-border); border-radius:var(--radius-full); font-size:var(--font-size-xs); font-weight:var(--font-weight-semibold); }
.request-status--responded { color:var(--badge-success-text); background:var(--badge-success-background); }
.request-status--declined,.request-status--cancelled { color:var(--color-text-muted); background:var(--color-background-muted); }
.request-card__actions { display:flex; flex-wrap:wrap; justify-content:flex-end; gap:var(--space-3); margin-top:var(--space-5); }
.request-card__response { margin-top:var(--space-5); padding:var(--space-4); background:var(--color-background-warm); border-radius:var(--radius-lg); }
.request-card__response-heading { color:var(--color-text-primary); font-size:var(--font-size-sm); }
.request-card__response p { margin:var(--space-2) 0 0; color:var(--color-text-secondary); white-space:pre-line; }
.requests-empty { display:grid; justify-items:center; padding:var(--space-16) var(--space-6); text-align:center; background:var(--color-surface-card); border:1px solid var(--color-border-subtle); border-radius:var(--radius-2xl); }
.requests-empty__icon { display:grid; place-items:center; width:56px; height:56px; color:var(--color-brand-primary-600); background:var(--color-brand-primary-50); border-radius:var(--radius-full); font-size:28px; }
.requests-empty h2 { margin:var(--space-5) 0 var(--space-2); font-family:var(--font-heading); }
.requests-empty p { max-width:520px; margin:0 0 var(--space-6); color:var(--color-text-secondary); }
@media(max-width:640px) { .requests-page__header { align-items:flex-start; flex-direction:column; } .request-card__top { flex-direction:column; } .request-card__actions { flex-direction:column; } .request-card__actions .button { width:100%; } }
</style>