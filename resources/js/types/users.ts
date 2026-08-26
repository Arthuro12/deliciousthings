import { PriceLevel, AddressVisibility, ProjectStatus, CurrencyCode } from "@/enums";

export interface Auth {
    user: User | null;
}

export interface User {
    id: number;
    first_name: string;
    last_name: string;
    full_name: string;
    email: string;
    artisan_profile?: ArtisanProfile;
}

export type Address = {
    id?: number;
    street: string;
    house_number: string;
    postal_code?: string | null;
    city: string;
    country: string;
    address_line_2: string | null;
    lat?: number | null;
    lon?: number | null;
    formatted?: string | null;
    visibility: AddressVisibility;
}

export type Media = {
    category: string | null;
    caption: string | null;
    path: string;
};

export type Image = {
    id?: number;
    url: string;
};

export type BasicProfile = {
    id: number;
    /**
     * The public profile name.
     */
    name: string;
    company_name?: string;
    main_occupation?: string;
    short_description: string | null;
    about: string;
    created_at?: string;
};

export type ArtisanProfile = BasicProfile & {
    medias: Media[];
    baked_goods: BakedGood[];
    dietary_options?: DietaryOption[];
    services?: Service[];
    addresses: Address[];
    first_address?: Address;
    instagram_url?: string;
    website_url?: string;
    average_rate: string;
    price_level?: PriceLevel;
    offers_delivery: boolean;
    pick_up_on_site: boolean;
    user?: User;
};

export type Project = {
    owner_user_id: number;
    name: string;
    status: ProjectStatus;
    description: string | null;
    budget: number | null;
    currency: CurrencyCode;
    event_date: string | null;
    event_time: number | null;
};

export type Message = {
    id?: number;
    artisan_id?: number;
    sender_email: string;
    sender_name: string;
    sent_at: string;
    content: string;
}

export type ArtisanPublicProfile = Omit<ArtisanProfile, "user"> & {
    profile_photo?: Image | null;
    gallery: Image[];
};

export type BakedGood = {
    key: string;
    name: string;
    label: string;
    category: string;
}

export type Service = {
    key: string;
    name: string;
    label: string;
    category: string;
}

export type DietaryOption = {
    key: string;
    name: string;
    label: string;
}

export type GroupedBakedGoods = Record<string, BakedGood[]>;

export type GroupedServices = Record<string, Service[]>;