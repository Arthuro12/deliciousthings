import type { AcceptableValue } from "reka-ui";

export type ClassType = string | Record<string, boolean>;

export type VueClass = ClassType | ClassType[] | VueClass[];

export type SelectValue = AcceptableValue | AcceptableValue[] | undefined;

export type SelectItem = {
    label?: string;
    value?: string;
    [key: string]: any;
};

export type SelectProps = {
    placeholder?: string;
    items: SelectItem[];
    labelProp?: string;
    valueProp?: string;
    multiple?: boolean;
}