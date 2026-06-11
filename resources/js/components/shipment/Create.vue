<template>
    <v-dialog v-model="state.dialog" @after-leave="leaveDialog" persistent>
        <!-- this slot use for btn insted of dialog -->
        <template #activator>
            <v-btn @click="state.dialog = true" append-icon="mdi-plus" color="primary">add new</v-btn>
        </template>
        <v-card class="v-col-12 v-col-lg-5 v-col-md-6 v-col-sm-11 ma-auto pa-0">
            <!-- card dialog -->
            <v-toolbar title="Create new shipment">
                <v-toolbar-items>
                    <v-btn @click="state.dialog = false" color="error">close dialog</v-btn>
                </v-toolbar-items>
            </v-toolbar>

            <!-- content -->
            <v-card-text>
                <v-row class="ma-0">

                    <!-- sender and receiver input -->
                    <v-col cols="12" md="5" class="pa-2">
                        <v-autocomplete label="Sender" v-model="state.shipment.sender_id" :items="useStore.users" item-title="full_name" item-value="id" variant="outlined" hide-details>
                        </v-autocomplete>
                    </v-col>
                    <v-col cols="12" md="7" class="pa-2">
                        <v-autocomplete label="Receiver" v-model="state.shipment.receiver_id" :items="useStore.users" item-title="full_name" item-value="id" variant="outlined" hide-details>
                            <template #append>
                                <!-- new use dialog -->
                                <CreateUser /> 
                            </template>
                        </v-autocomplete>
                    </v-col>

                    <!-- status and service_type -->
                    <v-col cols="12" md="6" class="pa-2">
                        <v-select label="Status" v-model="state.shipment.status" :items="state.status" variant="outlined" hide-details></v-select>
                    </v-col>
                    <v-col cols="12" md="6" class="pa-2">
                        <v-select label="Service Type" v-model="state.shipment.service_type" :items="state.serviceTypes" variant="outlined" hide-details></v-select>
                    </v-col>

                    <!-- package data -->
                    <v-col cols="12" class="pa-2">
                        <v-select label="Packages"  v-model="state.package.package_type" return-object :items="state.packageTypes" item-title="package_type" item-value="id" variant="outlined" hide-details>
                            <template #append>
                                <v-btn icon="mdi-plus" color="primary" rounded @click="savePackage"></v-btn>
                            </template>
                        </v-select>
                    </v-col>
                    <v-col cols="12" md="3" class="pa-2">
                        <v-text-field v-model="state.package.weight" hide-details variant="outlined" label="Weight" suffix="kg" />
                    </v-col>
                    <v-col cols="12" md="3" class="pa-2">
                        <v-text-field v-model="state.package.length" hide-details variant="outlined" label="length" suffix="cm" />
                    </v-col>
                    <v-col cols="12" md="3" class="pa-2">
                        <v-text-field v-model="state.package.width" hide-details variant="outlined" label="width" suffix="cm" />
                    </v-col>
                    <v-col cols="12" md="3" class="pa-2">
                        <v-text-field v-model="state.package.height" hide-details variant="outlined" label="height" suffix="cm" />
                    </v-col>

                    <v-col cols="12" v-if="state.shipment.packages.length > 0" class="px-2 py-0">
                        <v-list bg-color="transparent">
                            <v-list-item v-for="(pkg, idx) in state.shipment.packages" :key="idx">
                                <template #prepend>
                                    <v-icon>mdi-numeric-{{ idx + 1 }}</v-icon>
                                </template>
                                <strong>{{ pkg.package_type }}</strong>: {{ pkg.weight }} kg - {{ pkg.length }}x{{ pkg.width }}x{{ pkg.height }} cm
                            </v-list-item>
                        </v-list>
                    </v-col>

                    <!-- description -->
                    <v-col cols="12" class="pa-2">
                        <v-textarea label="Decription" v-model="state.shipment.description" variant="outlined" hide-details></v-textarea>
                    </v-col>
                </v-row>
            </v-card-text>
            <v-card-actions>
                <v-btn block color="primary" @click="saveAll" :disabled="checkInputs" :loading="state.saving">save all</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script setup lang="ts">
import { reactive, computed, watch } from 'vue'
import { Package, ShipmentJson } from '@/types'

import { useUserStore } from '@/store/users'
const useStore = useUserStore()

import { useShipmentStore } from '@/store/shipment'
const shipmentStore = useShipmentStore()

// componenets
import CreateUser from '@/components/user/Create.vue'

const state = reactive({
   dialog: false,
   shipment: {
        sender_id: '',
        receiver_id: '',
        packages: [] as Package[],
        status: '',
        service_type: '',
        description: ''
   },
    package:{
        weight: '',
        length: '',
        width: '',
        height: '',
        package_type:''
    },
    serviceTypes:[
        'standard',
        'express',
        'priority',
        'international'
    ],
    status:[
        'pending',
        'shipped',
        'delivered'
    ],
   packageTypes:[
        'document',
        'parcel',
        'fragile',
        'perishable',
        'valuable'
    ],
    saving: false
})

// methods
const saveAll = async () => {
    const shipment = state.shipment
    state.saving = true
    try {
        if (shipment.packages.length === 0) {
            alert("Please add at least one package.")
            return
        }
        await shipmentStore.addShipment(shipment)
        leaveDialog()
        
    } catch (error) {
        return error
    }
    finally{
        state.saving = false
    }
}
const leaveDialog = () => {
    const shipment = state.shipment

    shipment.sender_id = '',
    shipment.receiver_id = '',
    shipment.packages = [],
    shipment.status = '',
    shipment.service_type = '',
    shipment.description = ''

    state.dialog = false
}
const savePackage = () => {
    const pkg = state.package
    if (pkg.weight && pkg.height && pkg.length && pkg.width && pkg.package_type) {
        state.shipment.packages.push(pkg)
        state.package = { 
            weight: '', 
            length: '', 
            width: '', 
            height: '',
            package_type: ''
        }
    } else {
        alert('Please fill all package fields')
    }
}

// watchs
watch(
    () => state.dialog,
    async (n, o) => {
        if(n === true)
        await useStore.allUsers()
    }
)

// computeds
const checkInputs = computed(() => {
    const shipment = state.shipment

    if (!shipment.sender_id) return true
    if (!shipment.receiver_id) return true

    if (!shipment.packages || shipment.packages.length === 0) return true

    if (!shipment.status) return true
    if (!shipment.service_type) return true

    if (!shipment.description || shipment.description.trim() === '') return true

    return false
})

</script>

<style lang="scss" scoped>
</style>