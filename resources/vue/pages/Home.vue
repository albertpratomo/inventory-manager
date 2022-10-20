<script lang="ts" setup>
import {type PropType, computed, ref} from 'vue';
import {formatNumber, formatPrice} from '@/helpers';
import type InventoryMovement from '@/models/InventoryMovement';
import MovementForm from '@/components/InventoryMovements/Form.vue';
import MovementsTable from '@/components/InventoryMovements/Table.vue';

const props = defineProps({
    movements: {
        type: Array as PropType<InventoryMovement[]>,
        required: true,
    },
});

const availableOnly = ref(false);

const availableMovements = computed(() => props.movements.filter(m => m.remainingQuantity > 0));

const totalAvailableQuantity = computed(() => availableMovements.value.reduce(
    (total, movement) => total + movement.remainingQuantity,
    0,
));

const totalAvailableValuation = computed(() => availableMovements.value.reduce(
    (total, movement) => total + movement.remainingQuantity * movement.unitPrice,
    0,
));
</script>

<template>
    <main class="container py-4">
        <MovementForm />

        <ul class="nav nav-tabs mt-2">
            <li class="nav-item">
                <a
                    class="nav-link"
                    :class="{active: !availableOnly}"
                    href="#"
                    @click="availableOnly = false"
                >
                    All Movements
                </a>
            </li>

            <li class="nav-item">
                <a
                    class="nav-link"
                    :class="{active: availableOnly}"
                    href="#"
                    @click="availableOnly = true"
                >
                    Available Units
                </a>
            </li>
        </ul>

        <MovementsTable
            :available-only="availableOnly"
            :movements="movements"
        />

        <table class="text-end fw-bold ms-auto">
            <tr>
                <td>
                    Total Available Quantity:
                </td>

                <td>
                    {{ formatNumber(totalAvailableQuantity) }}
                </td>
            </tr>

            <tr>
                <td>
                    Total Available Valuation:
                </td>

                <td class="ps-4">
                    {{ formatPrice(totalAvailableValuation) }}
                </td>
            </tr>
        </table>
    </main>
</template>
