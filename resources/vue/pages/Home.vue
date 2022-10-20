<script lang="ts" setup>
import type InventoryMovement from '@/models/InventoryMovement';
import MovementsTable from '@/components/InventoryMovements/Table.vue';
import type {PropType} from 'vue';

defineProps({
    movements: {
        type: Array as PropType<InventoryMovement[]>,
        required: true,
    },
});
</script>

<template>
    <main class="container">
        <MovementsTable :movements="movements" />
    </main>
</template>
