export type ClassType = string | Record<string, boolean>;

export type VueClass = ClassType | ClassType[] | VueClass[];

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
}