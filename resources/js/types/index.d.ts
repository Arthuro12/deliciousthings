export interface Auth {
    user: User;
}

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
};

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
}

export type ArtisanProfile = {
    name: string;
    companyName: string;
    phone?: string;
    email: string;
    biography: string;
    specialities: Specialitiy[];
    address?: Address | null;
    instagramUrl?: string;
    websiteUrl?: string;
    averageRate: string;
    offersDelivery: boolean;
}

export type Address = {
    street: string;
    houseNumber: string;
    postalCode: string;
    city: string;
    country: string;
    addressLine2?: string;
}

export type Speciality = {
    key: string;
    label: string;
}

export type ClassType = string | Record<string, boolean>;
export type VueClass = ClassType | ClassType[] | VueClass[];
