<script lang="ts" setup>
import {type PropType, computed} from 'vue';
import type InventoryMovement from '@/models/InventoryMovement';

const props = defineProps({
    availableOnly: {
        type: Boolean,
        default: false,
    },
    movements: {
        type: Array as PropType<InventoryMovement[]>,
        required: true,
    },
});

const columns = computed(() => {
    return props.availableOnly
        ? ['Created At', 'Unit Price', 'Remaining Quantity']
        : ['Created At', 'Quantity', 'Unit Price', 'Total Price', 'Remaining Quantity'];
});

const movements = computed(() => {
    return props.availableOnly
        ? props.movements.filter(m => m.remainingQuantity > 0)
        : props.movements;
});

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
                :class="{
                    'table-danger': movement.quantity < 0,
                    'table-success': movement.remainingQuantity > 0,
                }"
            >
                <td class="text-start">
                    {{ formatDate(movement.createdAt) }}
                </td>

                <td v-if="!availableOnly">
                    {{ formatNumber(movement.quantity) }}
                </td>

                <td>
                    {{ formatNumber(movement.unitPrice) }}
                </td>

                <td v-if="!availableOnly">
                    {{ formatNumber(movement.totalPrice) }}
                </td>

                <td>
                    {{ formatNumber(movement.remainingQuantity) }}
                </td>
            </tr>
        </tbody>
    </table>
</template>
