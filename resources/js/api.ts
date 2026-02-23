import type { Response } from "@/types/api";

/**
 * Sends a GET request to retrieve data from server.
 */
export async function get<T>(url: string): Promise<Response<T>> {
    let error = null;
    let data = null;

    try {
        const response = await fetch(url);
        if (response.status == 200) {
            const json = await response.json();
            data = json.data;
        }
    } catch (err: any) {
        error = err;
    }

    return {
        data,
        error
    };
}