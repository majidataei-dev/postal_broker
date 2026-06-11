import { useApi } from "@/composables/useApi";

import type { ShipmentJson } from '@/types/index'

export const ShipmentService = {
    async fetchShipments() {
        return await useApi<ShipmentJson>('shipments',{
            method: "get"
        })
    },

    async storeShipment(payload: ShipmentJson) {
        return await useApi<ShipmentJson>('shipments',{
            method: 'post',
            body: payload
        })
    }
}