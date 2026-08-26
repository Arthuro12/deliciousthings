import type { Auth } from "./users"; 
import type { FlashProps, AppLinks } from "./ui";

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    auth: Auth;
    links: AppLinks;
    flash: FlashProps;
};
