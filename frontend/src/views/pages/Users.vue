<script setup lang="ts">

import UiParentCard from '@/components/shared/UiParentCard.vue';
import UsersIndex from '@/components/modules/Users/index.vue';
</script>
<template>
    <v-row>
        <v-col cols="12" md="12">
            <UiParentCard title="Lista de ordens">
                <UsersIndex/>
            </UiParentCard>
        </v-col>
    </v-row>
</template>
