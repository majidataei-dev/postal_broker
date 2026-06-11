import { defineStore } from "pinia";
import { ShipmentService } from "@/services/shipments";
import type { ShipmentJson } from '@/types/index'

export const useShipmentStore = defineStore('shipment', {
    state: () => ({
        shipments: [] as ShipmentJson[],
        loading: false,
        headers: [
            { title: 'ID', value: 'id', align: 'start' },
            { title: 'Sender', value: 'sender.full_name', align: 'start' },
            { title: 'Receiver', value: 'receiver.full_name', align: 'start' },
            { title: 'Tracking Code', value: 'tracking_code', align: 'start' },
            { title: 'Service Type', value: 'service_type', align: 'start' },
            { title: 'Status', value: 'status', align: 'start' },
            { title: 'Packages', value: 'packages', align: 'start' },
            { title: 'Description', value: 'description', align: 'start' }
        ]

    }),
    getters: {
        shipmentCount: (state) => state.shipments.length,
    },
    actions: {
        // Fetch all shipments from API
        async loadShipments() {
            this.loading = true
            try {
                const { data } = await ShipmentService.fetchShipments();
                if (data) this.shipments = data;
            } catch (err: any) {
                console.error('Error loading shipments:', err.message);
            }
            finally{
                this.loading = false
            }
        },

        // Store a new shipment and add it to state
        async addShipment(payload: ShipmentJson) {
            try {
               await ShipmentService.storeShipment(payload);

               this.loadShipments()
            } catch (err: any) {
                console.error('Error adding shipment:', err.message);
            }
        },
    }
});
