import { useApi } from "@/composables/useApi";
import type { PackagesJson } from '@/types/index'


export const PackagesServices = {
    async fetchPackages(){
        return await useApi<PackagesJson>('packages',{
            method: 'get'
        })
    }
}