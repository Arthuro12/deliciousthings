
export interface Auth {
    user: User;
}

export interface User {
    id: number;
    name: string;
    email: string;
    media?: string;
}

export type Address = {
    street: string;
    house_number: string;
    postal_code?: string | null;
    city: string;
    country: string;
    address_line_2: string | null;
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
