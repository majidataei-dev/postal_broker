<template>
    <v-dialog v-model="state.dialog" @after-leave="leaveDialog" persistent>
        <!-- this slot use for btn insted of dialog -->
        <template #activator>
            <v-tooltip text="Tooltip">
                <template v-slot:activator="{ props }">
                    <v-btn v-bind="props" @click="state.dialog = true" append-icon="mdi-plus" color="primary" height="100%">user</v-btn>
                </template>
            </v-tooltip>
        </template>
        <v-card class="v-col-12 v-col-lg-5 v-col-md-6 v-col-sm-11 ma-auto pa-0">
            <!-- card dialog -->
            <v-toolbar title="Create new user">
                <v-toolbar-items>
                    <v-btn @click="state.dialog = false" color="error">close dialog</v-btn>
                </v-toolbar-items>
            </v-toolbar>

            <!-- content -->
            <v-card-text>
                <v-row class="ma-0">
                    <v-col cols="12" md="6" class="pa-2">
                        <v-text-field variant="outlined" hide-details label="Fullname" v-model="state.user.full_name" />
                    </v-col>
                    <v-col cols="12" md="6" class="pa-2">
                        <v-text-field variant="outlined" hide-details label="mobile" v-model="state.user.mobile" maxlength="11"   
                        :rules="[
                            v => /^\d*$/.test(v) || 'just number',
                            v => v.length <= 11 || 'must be 11 digit'
                        ]" />
                    </v-col>
                    <v-col cols="12" md="6" class="pa-2">
                        <v-text-field variant="outlined" hide-details label="Postcode" v-model="state.user.zip_code" maxlength="10" />
                    </v-col>
                    <v-col cols="12" class="pa-2">
                        <v-textarea variant="outlined" hide-details label="Address" v-model="state.user.address" />
                    </v-col>
                </v-row>
            </v-card-text>
            <v-card-actions>
                <v-btn block color="primary" @click="saveAll" :disabled="checkInputs" :saving="state.saving">save all</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script setup lang="ts">
import { ref, reactive, computed, onMounted, watch } from 'vue'

import { useUserStore } from '@/store/users'
const userStore = useUserStore()

const state = reactive({
    dialog: false,
    user: {
        full_name:'',
        mobile:'',
        zip_code:'',
        address:''
    },
    saving: false
})

// methods
const saveAll = async () => {
    state.saving = true
    try {
        await userStore.addUser(state.user)
        leaveDialog()
    } catch (error) {
        return error
    } finally {
        state.saving = false
    }
}
const leaveDialog = () => {
    const user = state.user

    user.full_name = '',
    user.mobile = '',
    user.zip_code = '',
    user.address = ''
}

// computeds
const checkInputs = computed(() => {
    const user = state.user

    if (!user.full_name || user.full_name.trim() === '') return true
    if (!user.mobile || user.mobile.trim() === '') return true
    if (!user.zip_code || user.zip_code.trim() === '') return true
    if (!user.address || user.address.trim() === '') return true

    return false
})

</script>

<style lang="scss" scoped>
</style>