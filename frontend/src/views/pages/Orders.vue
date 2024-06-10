<script setup lang="ts">

import UiParentCard from '@/components/shared/UiParentCard.vue';
import OrdersIndex from '@/components/modules/Orders/index.vue';
</script>
<template>
    <v-row>
        <v-col cols="12" md="12">
            <UiParentCard title="Lista de ordens">
                <OrdersIndex/>
            </UiParentCard>
        </v-col>
    </v-row>
</template>
