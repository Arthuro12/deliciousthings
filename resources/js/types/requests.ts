export type RequestStep = "description" | "preview";

export type RequestStatus =
    | "draft"
    | "confirmed"
    | "sent"
    | "responses_pending"
    | "completed"
    | "cancelled"
    // Legacy values kept temporarily so existing rows can still be read.
    | "pending"
    | "matching";

export interface RequestData {
    id: number;
    status: RequestStatus;
    description: string;
    category: string | null;
    occasion: string | null;
    event_date: string | null;
    event_time: string | null;
    participants: number | null;
    location_text: string | null;
    budget_min: number | null;
    budget_max: number | null;
    currency: string;
    fulfillment_method: string | null;
    style: string[];
    flavors: string[];
    requirements: string | null;
}

export interface RequestFormData {
    description: string;
    category: string | null;
    occasion: string | null;
    event_date: string | null;
    event_time: string | null;
    participants: number | null;
    location_text: string;
    budget_min: number | null;
    budget_max: number | null;
    currency: string;
    fulfillment_method: string | null;
    style: string[];
    flavors: string[];
    requirements: string;
}
