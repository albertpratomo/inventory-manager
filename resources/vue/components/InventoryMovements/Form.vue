<script lang="ts" setup>
import {ref} from 'vue';
import {useForm} from '@inertiajs/inertia-vue3';

const mode = ref<'purchase' | 'apply'>('apply');

const form = useForm({
    quantity: 1,
    unitPrice: null,
});
</script>

<template>
    <form class="row row-cols-auto g-2 align-items-end justify-content-end">
        <div>
            <input
                id="purchase"
                v-model="mode"
                class="btn-check"
                name="mode"
                type="radio"
                value="purchase"
            >

            <label
                class="btn btn-outline-success"
                for="purchase"
            >
                Purchase
            </label>
        </div>

        <div>
            <input
                id="apply"
                v-model="mode"
                class="btn-check"
                name="mode"
                type="radio"
                value="apply"
            >

            <label
                class="btn btn-outline-danger"
                for="apply"
            >
                Apply
            </label>
        </div>

        <div class="col-lg-1">
            <label class="small">Quantity</label>

            <input
                v-model="form.quantity"
                class="form-control"
                type="number"
            >
        </div>

        <div
            v-if="mode === 'purchase'"
            class="col-lg-1"
        >
            <label class="small">Unit Price</label>

            <input
                v-model="form.unitPrice"
                class="form-control"
                type="number"
            >
        </div>

        <div class="col">
            <button
                class="btn btn-dark"
                type="submit"
            >
                Submit
            </button>
        </div>
    </form>
</template>
