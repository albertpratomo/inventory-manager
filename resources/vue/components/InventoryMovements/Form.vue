<script lang="ts" setup>
import {ref} from 'vue';
import {useForm} from '@inertiajs/inertia-vue3';

const mode = ref<'purchase' | 'apply'>('apply');

const form = useForm({
    quantity: null,
    unitPrice: null,
});

const submit = () => {
    form
        .transform((data) => {
            let quantity = Math.abs(data.quantity);

            if (mode.value === 'purchase') {
                return {
                    quantity,
                    unitPrice: data.unitPrice ? data.unitPrice * 100 : null,
                };
            } else {
                return {
                    quantity: -1 * quantity,
                    unitPrice: null,
                };
            }
        })
        .post('/inventory-movements', {
            onSuccess: () => form.reset(),
        });
};
</script>

<template>
    <form
        class="row row-cols-md-auto g-2 align-items-end justify-content-end"
        @submit.prevent="submit"
    >
        <div class="col-12">
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

            <input
                id="apply"
                v-model="mode"
                class="btn-check"
                name="mode"
                type="radio"
                value="apply"
            >

            <label
                class="btn btn-outline-danger ms-2"
                for="apply"
            >
                Apply
            </label>
        </div>

        <div class="col-12 col-md-2 col-lg-1">
            <label class="small">Quantity</label>

            <input
                v-model="form.quantity"
                class="form-control"
                min="1"
                type="number"
            >
        </div>

        <div
            v-if="mode === 'purchase'"
            class="col-12 col-md-2 col-lg-1"
        >
            <label class="small">Unit Price</label>

            <input
                v-model="form.unitPrice"
                class="form-control"
                min="1"
                step="any"
                type="number"
            >
        </div>

        <div class="col-12 col-md-auto">
            <button
                class="w-100 btn btn-dark"
                :disabled="form.quantity === 0"
                type="submit"
            >
                <span
                    v-if="form.processing"
                    class="spinner-border spinner-border-sm"
                />

                Submit
            </button>
        </div>
    </form>

    <div v-if="form.hasErrors">
        <div
            v-for="(error, key) in form.errors"
            :key="key"
            class="text-end small text-danger"
        >
            {{ error }}
        </div>
    </div>
</template>
