export interface Auth {
    user: User;
}

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
};

export type Address = {
    street: string;
    houseNumber: string;
    postalCode?: string | null;
    city: string;
    country: string;
    addressLine2: string | null;
}

export type Speciality = {
    key: string;
    name: string;
    label: string;
}

export type Media = {
    category: string | null;
    caption: string | null;
    path: string;
};

export interface User {
    id: number;
    name: string;
    email: string;
    media?: string;
}

export type ArtisanProfile = {
    username: string;
    company_name: string;
    e164phone?: string;
    email: string;
    biography: string;
    medias: Media[];
    specialities: Speciality[];
    address?: Address;
    instagram_url?: string;
    website_url?: string;
    average_rate: string;
    offers_delivery: boolean;
}

export type ClassType = string | Record<string, boolean>;
export type VueClass = ClassType | ClassType[] | VueClass[];
