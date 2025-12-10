export interface Auth {
    user: User;
}

export interface User {
    id: number;
    first_name: string;
    last_name: string;
    email: string;
    media?: string;
    artisan_profile?: ArtisanProfile;
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

export type DietType = {
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
    id?: number;
    username: string;
    company_name: string;
    main_occupation: string;
    e164phone?: string;
    email: string;
    short_description: string | null;
    about: string;
    medias: Media[];
    specialities: Speciality[];
    diet_types: DietType[];
    addresses: Address[];
    first_address?: Address;
    instagram_url?: string;
    website_url?: string;
    average_rate: string;
    offers_delivery: boolean;
    pick_up_on_site: boolean;
}
