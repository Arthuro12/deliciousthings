import { 
    CircleUserRound,
    Folder,
    House,
    Mail,
    MessageSquare,
} from "@lucide/vue";

import type { NavMenuRecord, NavigationLinkIcons  } from "./types/ui";

export const NAVIGATION_LINK_ICONS: NavigationLinkIcons = {
    "circle-user-round": CircleUserRound,
    "folder": Folder,
    "house": House,
    "mail": Mail,
    "message-square": MessageSquare,
};

export const BUTTON_CLASSES = Object.freeze({
    LAYOUTS: {
        text: "button--text",
        icon: "button--icon",
        "with-icon": "button--with-icon",
    },
    VARIANTS: {
        primary: "button--primary",
        secondary: "button--secondary",
        tertiary: "button--tertiary",
    },
    SIZES: {
        small: "button--small",
        medium: "button--medium",
        large: "button--large",
    },
});

export const LINK_CLASSES = Object.freeze({
    VARIANTS: {
        primary: "link--primary",
        secondary: "link--secondary",
        tertiary: "link--tertiary",
    },
    SIZES: {
        medium: "link--medium",
    },
});

export const BREAKPOINTS = {
    SMALL_DEVICE: 640,
    MEDIUM_DEVICE: 768,
    LARGE_DEVICE: 1024,
    EXTRA_LARGE: 1280,
};

export const NAV_MENUS: NavMenuRecord = {
    PUBLIC: [
        {
            href: "/inspirations",
            title: "Inspirationen",
        },
        // {
        //     href: "/projects/explore",
        //     title: "Projekte entdecken",
        // },
        // {
        //     href: "/for-artisans",
        //     title: "Für Backprofis",
        // },
        // {
        //     href: '/about',
        //     title: 'Über uns',
        // },
        // {
        //     href: '/artisans',
        //     title: 'Konditoreien',
        // },
        // {
        //     href: '/creations',
        //     title: 'Kreationen',
        // },
    ],
    USER: [
        {
            class: "button button--ghost button--medium button--full button--text-only",
            href: '/login',
            title: 'Anmelden', 
        },
        {
            class: "button button--primary button--medium button--full button--text-only",
            href: '/register',
            title: 'Beitreten', 
        },
    ],
};

export const FORM_ERRORS = Object.freeze({
    REQUIRED: `Bitte füllen sie dieses Feld aus.`
});

export const BAKED_GOODS = {
    CATEGORY: {
        "breads_and_rolls": "Brot und Brötchen",
        "pastries": "Konditorei",
        "viennoiserie": "Feingebäck",
        "chocolate": "Schokolade",
        "fried_sweet_pastries": "Frittiertes / Süßes Gebäck",
    },
};

export const SERVICES_CATEGORIES = {
    pastry_shop: "Konditorei",
    bakery: "Bäckerei",
    catering: "Catering",
};

export const OCCASIONS = [
    {
        key: "birthday",
        value: "birthday",
        label: "Geburtstag",
    },
    {
        key: "wedding",
        value: "wedding",
        label: "Hochzeit",
    },
    {
        key: "engagement",
        value: "engagement",
        label: "Verlobung",
    },
    {
        key: "baptism",
        value: "baptism",
        label: "Taufe",
    },
    {
        key: "baby-shower",
        value: "baby-shower",
        label: "Baby Shower",
    },
    {
        key: "anniversary",
        value: "anniversary",
        label: "Jubiläum",
    },
    {
        key: "graduation",
        value: "graduation",
        label: "Abschluss",
    },
    {
        key: "retirement",
        value: "retirement",
        label: "Ruhestand",
    },
    {
        key: "christmas",
        value: "christmas",
        label: "Weihnachten",
    },
    {
        key: "easter",
        value: "easter",
        label: "Ostern",
    },
    {
        key: "valentines-day",
        value: "valentines-day",
        label: "Valentinstag",
    },
    {
        key: "corporate-event",
        value: "corporate-event",
        label: "Firmenfeier",
    },
    {
        key: "housewarming",
        value: "housewarming",
        label: "Einweihung",
    },
];

/**
 * Available style for custom creation. If none is specified, the user 
 * can indicate that they need recommendation.
 */
export const STYLES = [
    {
        key: "classic",
        value: "classic",
        label: "Klassisch",
    },
    {
        key: "elegant",
        value: "elegant",
        label: "Elegant",
    },
    {
        key: "modern",
        value: "modern",
        label: "Modern",
    },
    {
        key: "minimalist",
        value: "minimalist",
        label: "Minimalistisch",
    },
    {
        key: "romantic",
        value: "romantic",
        label: "Romantisch",
    },
    {
        key: "playful",
        value: "playful",
        label: "Verspielt",
    },
    {
        key: "luxurious",
        value: "luxurious",
        label: "Luxuriös",
    },
    {
        key: "rustic",
        value: "rustic",
        label: "Rustikal",
    },
    {
        key: "natural",
        value: "natural",
        label: "Natürlich",
    },
    {
        key: "boho",
        value: "boho",
        label: "Boho",
    },
    {
        key: "vintage",
        value: "vintage",
        label: "Vintage",
    },
    {
        key: "floral",
        value: "floral",
        label: "Floral",
    },
    {
        key: "whimsical",
        value: "whimsical",
        label: "Märchenhaft",
    },
    {
        key: "colorful",
        value: "colorful",
        label: "Bunt",
    },
    {
        key: "pastel",
        value: "pastel",
        label: "Pastell",
    },
];