<script setup lang="ts">

import UiParentCard from '@/components/shared/UiParentCard.vue';
import ProductsIndex from '@/components/modules/Products/index.vue';
</script>
<template>
    <v-row>
        <v-col cols="12" md="12">
            <UiParentCard title="Lista de produtos">
                <ProductsIndex/>
            </UiParentCard>
        </v-col>
    </v-row>
</template>
