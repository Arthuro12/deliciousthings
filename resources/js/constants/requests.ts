import type { RequestStep } from "@/types/requests";

export const REQUEST_TOTAL_STEPS = 2;

export const REQUEST_MIN_DESCRIPTION_LENGTH = 20;
export const REQUEST_MAX_DESCRIPTION_LENGTH = 2000;

export const REQUEST_STEPS: { key: RequestStep; label: string }[] = [
    { key: "description", label: "Idee" },
    { key: "preview", label: "Prüfen" },
];

export const REQUEST_CATEGORIES = [
    { value: "cake", label: "Torte" },
    { value: "wedding_cake", label: "Hochzeitstorte" },
    { value: "pastry", label: "Gebäck" },
    { value: "dessert", label: "Dessert" },
    { value: "other", label: "Etwas anderes" },
];

export const REQUEST_FULFILLMENT_METHODS = [
    { value: "pickup", label: "Abholung" },
    { value: "delivery", label: "Lieferung" },
];

export const REQUEST_STYLES = [
    "Elegant",
    "Modern",
    "Minimalistisch",
    "Romantisch",
    "Klassisch",
    "Verspielt",
    "Rustikal",
];
