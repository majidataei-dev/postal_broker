<template>
    <div class="Welcome">
        <!-- <img src="../../../public/postal_borker.png" alt=""> -->
        <img src="https://picsum.photos/1920/1080" alt="">
        <v-toolbar title="Tracking Shipments" rounded color="surface">
            <v-toolbar-items>
                <!-- add new shipment dialog -->
                <NewShipment />
            </v-toolbar-items>
        </v-toolbar>

        <!-- data-table for show all shipments -->
        <DataTable :items="store.shipments" :headers="store.headers" :loading="store.loading" class="w-100">
            <template v-slot:item.packages="{ item }">
                <slot :item="item" :name="item" class="d-flex align-center">
                    <ol>
                        <li v-for="(pkg, idx) in item.packages" :key="idx">{{ pkg.package_type }}</li>
                    </ol>
                </slot>
            </template>

            <template v-slot:item.service_type="{ item }">
                <v-chip :color="getServiceTypeColor(item.service_type)" variant="flat" size="small" class="text-capitalize">
                    {{ item.service_type }}
                </v-chip>
            </template>

            <template v-slot:item.status="{ item }">
            <v-chip :color="getStatusColor(item.status)" variant="flat" size="small" class="text-capitalize">
                {{ item.status }}
            </v-chip>
            </template>
        </DataTable>
    </div>
</template>

<script setup lang="ts">
import { onMounted, reactive } from 'vue';
import { useShipmentStore } from '@/store/shipment';
const store = useShipmentStore()

// components
import NewShipment from '@/components/shipment/Create.vue'
import DataTable from '@/components/ui/tabel/DataTable.vue';

const state = reactive({
    tab: 0,
})
const getServiceTypeColor = (type: string) => {
    switch (type) {
        case 'standard':
            return 'grey'
        case 'express':
            return 'blue'
        case 'priority':
            return 'orange'
        case 'international':
            return 'purple'
        default:
            return 'grey'
    }
}

const getStatusColor = (status: string) => {
    switch (status) {
        case 'pending':
            return 'grey'
        case 'shipped':
            return 'blue'
        case 'delivered':
            return 'green'
        default:
            return 'grey'
  }
}
onMounted(async() =>{
    await store.loadShipments()
})
</script>

<style lang="scss" scoped>
.Welcome {
    display: flex;
    position: relative;
    flex-direction: column;
    align-items: center;
    padding: 5% 15%;
    img{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        object-fit: cover;
        opacity: .3;
    }
}
</style>