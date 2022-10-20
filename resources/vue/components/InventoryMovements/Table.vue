<script lang="ts" setup>
import type InventoryMovement from '@/models/InventoryMovement';
import type {PropType} from 'vue';

defineProps({
    movements: {
        type: Array as PropType<InventoryMovement[]>,
        required: true,
    },
});

const columns = [
    'Created At',
    'Quantity',
    'Unit Price',
    'Total Price',
    'Remaining Quantity',
];

const formatDate = (value: string) => (new Date(value)).toLocaleString('en-NZ');

const formatNumber = (value: number) => new Intl.NumberFormat('en-NZ').format(value);
</script>

<template>
    <table class="table table-hover table-responsive align-middle text-end">
        <thead>
            <tr>
                <th
                    v-for="(column, i) in columns"
                    :key="i"
                    :class="{'text-start': i === 0}"
                >
                    {{ column }}
                </th>
            </tr>
        </thead>

        <tbody>
            <tr
                v-for="movement in movements"
                :key="movement.id"
                :class="{'table-danger': movement.quantity < 0}"
            >
                <td class="text-start">
                    {{ formatDate(movement.createdAt) }}
                </td>

                <td>
                    {{ formatNumber(movement.quantity) }}
                </td>

                <td>
                    {{ formatNumber(movement.unitPrice) }}
                </td>

                <td>
                    {{ formatNumber(movement.totalPrice) }}
                </td>

                <td>
                    {{ formatNumber(movement.remainingQuantity) }}
                </td>
            </tr>
        </tbody>
    </table>
</template>
