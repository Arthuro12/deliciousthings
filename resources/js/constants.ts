import type { NavMenuRecord,  } from "./types/ui";

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
            href: "/projects/explore",
            title: "Projekte entdecken",
        },
        {
            href: "/for-artisans",
            title: "Für Backprofis",
        },
        {
            href: '/about',
            title: 'Über uns',
        },
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