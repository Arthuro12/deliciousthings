<template>
    <div class="app-content-wrapper artisan-requests">
        <Head title="Anfragen von Kunden" />
        <main class="app-content">
            <header class="artisan-requests__header">
                <div>
                    <p class="artisan-requests__eyebrow">Dein Auftragsbereich</p>
                    <h1>Kundenanfragen</h1>
                    <p>Prüfe neue Kreationswünsche und sende eine erste Einschätzung.</p>
                </div>
                <span class="artisan-requests__count">{{ requests.length }} offen</span>
            </header>

            <section v-if="requests.length" class="artisan-request-list">
                <article v-for="request in requests" :key="request.id" class="artisan-request-card">
                    <div class="artisan-request-card__heading">
                        <div>
                            <span class="artisan-request-card__occasion">{{ occasionLabel(request.occasion) }}</span>
                            <h2>{{ request.customer_name || 'Kunde' }} · {{ request.participants ? `${request.participants} Personen` : 'Details offen' }}</h2>
                        </div>
                        <span v-if="request.event_date" class="artisan-request-card__date">{{ formatDate(request.event_date) }}</span>
                    </div>
                    <p class="artisan-request-card__description">{{ request.description }}</p>
                    <dl class="artisan-request-card__details">
                        <div v-if="request.location_text"><dt>Ort</dt><dd>{{ request.location_text }}</dd></div>
                        <div v-if="request.budget_min !== null || request.budget_max !== null"><dt>Budgetrahmen</dt><dd>{{ budgetLabel(request) }}</dd></div>
                        <div v-if="request.fulfillment_method"><dt>Übergabe</dt><dd>{{ request.fulfillment_method }}</dd></div>
                        <div v-if="request.style.length"><dt>Stil</dt><dd>{{ request.style.join(', ') }}</dd></div>
                        <div v-if="request.flavors.length"><dt>Geschmack</dt><dd>{{ request.flavors.join(', ') }}</dd></div>
                    </dl>
                    <p v-if="request.requirements" class="artisan-request-card__requirements"><strong>Hinweise:</strong> {{ request.requirements }}</p>
                    <form class="artisan-response-form" @submit.prevent="sendResponse(request.id, 'responded')">
                        <label :for="`reply-${request.id}`">Deine Antwort an den Kunden</label>
                        <textarea :id="`reply-${request.id}`" v-model="forms[request.id].message" rows="3" minlength="10" maxlength="3000" placeholder="Stelle Rückfragen oder beschreibe, wie du die Idee umsetzen würdest …" required />
                        <p v-if="errors[request.id]" class="artisan-response-form__error" role="alert">{{ errors[request.id] }}</p>
                        <div class="artisan-response-form__actions">
                            <label class="artisan-response-form__quote">Unverbindliche Schätzung <span><input v-model="forms[request.id].quote" type="number" min="0" step="0.01" placeholder="z. B. 180" /> €</span></label>
                            <button type="button" class="button button--outline button--lg" :disabled="busyId === request.id" @click="sendResponse(request.id, 'declined')">Ablehnen</button>
                            <button type="submit" class="button button--primary button--lg" :disabled="busyId === request.id">{{ busyId === request.id ? 'Wird gesendet …' : 'Antwort senden' }}</button>
                        </div>
                    </form>
                </article>
            </section>
            <section v-else class="artisan-requests__empty">
                <h2>Aktuell keine offenen Anfragen</h2>
                <p>Neue Kundenwünsche erscheinen hier. Halte dein Profil und dein Angebot aktuell, damit passende Kunden dich finden.</p>
            </section>
        </main>
    </div>
</template>

<script setup lang="ts">
import { reactive, ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import Layout from '@/platform/layout/AppLayout.vue';

defineOptions({ layout: Layout });

type ArtisanRequest = { id:number; description:string; occasion:string|null; event_date:string|null; participants:number|null; location_text:string|null; budget_min:number|null; budget_max:number|null; currency:string; fulfillment_method:string|null; style:string[]; flavors:string[]; requirements:string|null; customer_name:string|null };
const props=defineProps<{requests:ArtisanRequest[]}>();
const forms=reactive<Record<number,{message:string;quote:string}>>({});
props.requests.forEach(item=>forms[item.id]={message:'',quote:''});
const errors=reactive<Record<number,string>>({});
const busyId=ref<number|null>(null);
const occasionNames:Record<string,string>={birthday:'Geburtstag',wedding:'Hochzeit',engagement:'Verlobung',baptism:'Taufe','baby-shower':'Baby Shower',anniversary:'Jubiläum',other:'Besonderer Anlass'};
function occasionLabel(value:string|null){return value?occasionNames[value]??'Individuelle Kreation':'Individuelle Kreation';}
function formatDate(value:string){return new Intl.DateTimeFormat('de-DE',{dateStyle:'medium'}).format(new Date(`${value}T00:00:00`));}
function budgetLabel(item:ArtisanRequest){const f=new Intl.NumberFormat('de-DE',{style:'currency',currency:item.currency,maximumFractionDigits:0});if(item.budget_min!==null&&item.budget_max!==null)return `${f.format(item.budget_min)} – ${f.format(item.budget_max)}`;return item.budget_max!==null?`bis ${f.format(item.budget_max)}`:`ab ${f.format(item.budget_min??0)}`;}
function sendResponse(id:number,decision:'responded'|'declined') { const form=forms[id]; if(!form.message.trim()||form.message.trim().length<10){errors[id]='Bitte schreibe mindestens 10 Zeichen als Antwort.';return;} errors[id]='';busyId.value=id;router.patch(`/app/artisan/requests/${id}/respond`,{decision,artisan_response:form.message,quote_amount:decision==='declined'?null:(form.quote||null)},{preserveScroll:true,onError:fieldErrors=>{errors[id]=Object.values(fieldErrors)[0] as string||'Deine Antwort konnte nicht gesendet werden.';},onFinish:()=>busyId.value=null}); }
</script>

<style scoped lang="scss">
.artisan-requests { padding-bottom:calc(var(--space-24) + var(--space-8)); }
.artisan-requests__header { display:flex; justify-content:space-between; align-items:flex-end; gap:var(--space-6); margin-bottom:var(--space-8); }
.artisan-requests__eyebrow { margin:0 0 var(--space-2); color:var(--color-text-brand); font-size:var(--font-size-xs); font-weight:var(--font-weight-bold); letter-spacing:.08em; text-transform:uppercase; }
.artisan-requests__header h1 { margin:0; font-family:var(--font-heading); }
.artisan-requests__header p:last-child { margin:var(--space-3) 0 0; color:var(--color-text-secondary); }
.artisan-requests__count { padding:var(--space-2) var(--space-3); color:var(--badge-text); background:var(--badge-background); border-radius:var(--radius-full); font-size:var(--font-size-sm); white-space:nowrap; }
.artisan-request-list { display:grid; gap:var(--space-5); }
.artisan-request-card { padding:var(--card-padding-lg); background:var(--card-background); border:1px solid var(--card-border); border-radius:var(--card-radius); box-shadow:var(--card-shadow); }
.artisan-request-card__heading { display:flex; justify-content:space-between; align-items:flex-start; gap:var(--space-4); }
.artisan-request-card__occasion { color:var(--color-text-brand); font-size:var(--font-size-xs); font-weight:var(--font-weight-bold); letter-spacing:.06em; text-transform:uppercase; }
.artisan-request-card h2 { margin:var(--space-1) 0 0; font-size:var(--font-size-xl); }
.artisan-request-card__date { color:var(--color-text-secondary); font-size:var(--font-size-sm); white-space:nowrap; }
.artisan-request-card__description { margin:var(--space-4) 0; color:var(--color-text-primary); white-space:pre-line; }
.artisan-request-card__details { display:flex; flex-wrap:wrap; gap:var(--space-4) var(--space-8); margin:0; padding:var(--space-4) 0; border-block:1px solid var(--color-border-subtle); }
.artisan-request-card__details div { min-width:120px; }
.artisan-request-card__details dt { color:var(--color-text-muted); font-size:var(--font-size-xs); }
.artisan-request-card__details dd { margin:var(--space-1) 0 0; color:var(--color-text-primary); font-size:var(--font-size-sm); }
.artisan-request-card__requirements { color:var(--color-text-secondary); font-size:var(--font-size-sm); }
.artisan-response-form { display:grid; gap:var(--space-3); margin-top:var(--space-5); }
.artisan-response-form>label { color:var(--color-text-primary); font-size:var(--font-size-sm); font-weight:var(--font-weight-semibold); }
.artisan-response-form textarea { width:100%; padding:var(--space-4); color:var(--input-text); background:var(--input-background); border:1px solid var(--input-border); border-radius:var(--radius-lg); resize:vertical; font:inherit; }
.artisan-response-form textarea:focus,.artisan-response-form input:focus { outline:2px solid var(--input-border-focus); outline-offset:2px; }
.artisan-response-form__error { margin:0; color:var(--color-text-danger); font-size:var(--font-size-sm); }
.artisan-response-form__actions { display:flex; align-items:flex-end; justify-content:flex-end; gap:var(--space-3); }
.artisan-response-form__quote { display:grid; gap:var(--space-2); margin-right:auto; color:var(--color-text-secondary); font-size:var(--font-size-xs); }
.artisan-response-form__quote span { display:flex; align-items:center; gap:var(--space-2); color:var(--color-text-primary); font-size:var(--font-size-sm); }
.artisan-response-form__quote input { width:130px; padding:var(--space-3); border:1px solid var(--input-border); border-radius:var(--radius-md); }
.artisan-requests__empty { padding:var(--space-16) var(--space-6); text-align:center; background:var(--color-surface-card); border:1px solid var(--color-border-subtle); border-radius:var(--radius-2xl); }
.artisan-requests__empty h2 { margin:0 0 var(--space-2); font-family:var(--font-heading); }
.artisan-requests__empty p { max-width:520px; margin:auto; color:var(--color-text-secondary); }
@media(max-width:700px) { .artisan-requests__header,.artisan-request-card__heading { align-items:flex-start; flex-direction:column; } .artisan-response-form__actions { align-items:stretch; flex-direction:column; } .artisan-response-form__quote { margin:0 0 var(--space-2); } .artisan-response-form__actions button { width:100%; } }
</style>
