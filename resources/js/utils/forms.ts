import { FORM_ERRORS } from "@/constants";

/**
 * Checks if a field has a required type error.
 * 
 * @param error 
 */
export const hasRequiredError = (error: string) => error == FORM_ERRORS.REQUIRED;