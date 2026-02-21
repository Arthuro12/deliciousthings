import type { AcceptableValue } from "reka-ui";

export type ClassType = string | Record<string, boolean>;

export type VueClass = ClassType | ClassType[] | VueClass[];

export type ToastSeverityType = "info" | "success" | "error";

export type FlashSession = Record<ToastSeverityType, string>;

export type FlashToast = {
    severity: ToastSeverityType;
    message: string;
};

export type FlashProps = FlashSession | FlashToast;

export type FileValue = File[] | File | null;

export type SelectValue = AcceptableValue | AcceptableValue[] | undefined;

export type SelectItem = AcceptableValue | {
    label?: string;
    value?: string;
    [key: string]: any;
};

export type SelectProps = {
    placeholder?: string;
    showItemIndicator?: boolean;
    items: SelectItem[];
    labelProp?: string;
    valueProp?: string;
    multiple?: boolean;
}

export type SelectGroupProps = {
    placeholder?: string;
    showItemIndicator?: boolean;
    groups: Record<string, SelectItem[]>;
    labelProp?: string;
    valueProp?: string;
    multiple?: boolean;
};