<script lang="ts" setup>
import {type PropType, ref} from 'vue';
import type InventoryMovement from '@/models/InventoryMovement';
import MovementsTable from '@/components/InventoryMovements/Table.vue';

defineProps({
    movements: {
        type: Array as PropType<InventoryMovement[]>,
        required: true,
    },
});

const availableOnly = ref(false);
</script>

<template>
    <main class="container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a
                    class="nav-link"
                    :class="{active: !availableOnly}"
                    href="#"
                    @click="availableOnly = false"
                >
                    All movements
                </a>
            </li>

            <li class="nav-item">
                <a
                    class="nav-link"
                    :class="{active: availableOnly}"
                    href="#"
                    @click="availableOnly = true"
                >
                    Available units
                </a>
            </li>
        </ul>

        <MovementsTable
            :available-only="availableOnly"
            :movements="movements"
        />
    </main>
</template>
