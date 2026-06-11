// composables/useApi.ts
import useToast from '@/composables/useToast'
const toast = useToast()

const baseUrl = 'http://postal_broker.test/api/'

export async function useApi<T = any>(
    endpoint: string,
    { method = 'GET', body = null }: { method?: string; body?: any } = {}
): Promise<{ data?: T; meta?: any; error?: any }> {
    try {
        const url = `${baseUrl}${endpoint}`

        const headers: HeadersInit = {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        }

        const options: RequestInit = {
            method,
            headers,
            body: body ? JSON.stringify(body) : undefined,
        }

        const response = await fetch(url, options)
        const result = await response.json()

        if (!response.ok) {
            // Combine message and field errors
            const errorMessage = result.message || "Request failed"
            const fieldErrors = result.errors || {}

            // Show toast for general message
            toast.error({ title: "Error", message: errorMessage })

            // Optionally show each field error as individual toasts
            Object.entries(fieldErrors).forEach(([field, errors]: any) => {
                errors.forEach((errMsg: string) => {
                    toast.error({ title: field, message: errMsg })
                })
            })

            return { error: { message: errorMessage, fields: fieldErrors } }
        }

        // Success message
        if (result.message) {
            toast.success({ title: "Success", message: result.message })
        }

        return { data: result.data, meta: result.meta }

    } catch (error: any) {
        toast.error({ title: "Unexpected Error", message: error.message || "Something went wrong" })
        return { error }
    }
}
