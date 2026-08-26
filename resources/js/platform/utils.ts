import { usePage } from "@inertiajs/vue3";

export function isActiveLink(url: string): boolean {
    const page = usePage();
    return page.url === new URL(url).pathname;
}