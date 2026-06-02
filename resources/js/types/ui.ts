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

export type HelperTextProps = {
    variant: "default" | "error";
    text: string;
};

export type FileValue = File[] | File | null;

export type SelectValue = AcceptableValue | AcceptableValue[] | undefined;

export type SelectItem = AcceptableValue | {
    label?: string;
    value?: string;
    [key: string]: any;
};

export type SelectValueOption = {
    /**
     * The element the select value wrapper should be rendered as.
     */
    as?: string;
};

export type SelectProps = {
    label?: string;
    placeholder?: string;
    showItemIndicator?: boolean;
    items: SelectItem[];
    labelProp?: string;
    valueProp?: string;
    multiple?: boolean;
    selectValueOption?: SelectValueOption;
}

export type SelectGroupProps = {
    label?: string;
    placeholder?: string;
    showItemIndicator?: boolean;
    groups: Record<string, SelectItem[]>;
    labelProp?: string;
    valueProp?: string;
    multiple?: boolean;
    selectValueOption?: SelectValueOption;
};

export type Checkbox = {
    as?: string;
    id?: string;
    name?: string;
    label?: string;
    value?: AcceptableValue;
};

export type Radio = {
    id?: string;
    value: AcceptableValue;
    name?: string;
    label: string;
};

export type Link = {
    href: string;
    title: string;
};