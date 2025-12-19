import type { Auth } from "./users"; 
import type { FlashMessage } from "./ui";

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    auth: Auth;
    flash: FlashMessage;
};
