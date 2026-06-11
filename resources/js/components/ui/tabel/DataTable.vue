<template>
    <div>
        <v-text-field v-model="state.search" placeholder="Search" variant="outlined" density="compact" hide-details class="my-3">
            <template v-slot:append>
                <v-btn color="primary" height="100%" prepend-icon="mdi-magnify" class="text-capitalize" :loading="state.searching">Search</v-btn>
            </template>
        </v-text-field>
        <v-data-table :search="state.search" :items="props.items" :headers="props.headers" fixed-header hide-default-footer density="comfortable" :loading="props.loading" class="w-100">
            <template v-slot:item.row="{ item }">
                <small>{{ item.row + 1 }}</small>
            </template>
            <template v-for="(_, name) in $slots" v-slot:[name]="{ item }">
                <slot :name="name" :item="item" />
            </template>
            <template v-slot:loading>
                <v-skeleton-loader type="table-row@10" />
            </template>
        </v-data-table>
    </div>
</template>

<script setup>
import { reactive, watch } from 'vue'

    const props = defineProps(['items', 'headers', 'loading'])
    const state = reactive({
        search:'',
        searching: false,
    })

</script>

<style lang="scss" scoped>

</style>