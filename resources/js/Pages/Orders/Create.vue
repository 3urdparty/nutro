<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";

import { computed, reactive, ref } from "vue";

import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ArrowRightCircleIcon } from "@heroicons/vue/24/solid";
import { useForm } from "@inertiajs/inertia-vue3";
import Steps, { type Step } from "./Partials/Steps.vue";

import OrderDetailForm from "./Partials/OrderDetailForm.vue";
import ShippingForm, { type Form } from "./Partials/ShippingForm.vue";

interface Props {
    items: Array<App.Models.FoodItem>;
    addresses: Array<App.Models.Address>;
}

const stepsRef = ref(null);
const index = computed(() => stepsRef.value?.index);
const current = computed(() => stepsRef.value?.current);
const props = withDefaults(defineProps<Props>(), {
    items: () => [],
    addresses: () => [],
});

const form = useForm({
    items: props.items.map((item) => ({
        food_item_id: item.id,
        //@ts-ignore
        quantity: item.listing.quantity,
    })),
    // @ts-ignore
    shipping: {
        address: props.addresses.find((item) => item.is_default)?.id ?? null,
        deliveryType: "normal" as "normal" | "quick" | "speedy",
    } as Form,
});

//@ts-ignore
const steps = reactive({
    "01": {
        name: "Order Details",
        isComplete: () => index.value > 0,
        isValid: () => true,
    },
    "02": {
        name: "Shipping",
        isComplete: () => index.value > 1,
        isValid: () => form.shipping.address && form.shipping.deliveryType,
    },
} as { [key: string]: Step });
const next = () => {
    if (current.value.isComplete()) {
        stepsRef.value.goToNext();
    }
};

const submit = () => {
    form.transform(({ items, shipping }) => {
        return {
            items,
            ...shipping,
        };
    }).post(route("orders.store"));
};
</script>
<template>
    <AppLayout :show-cart="false">
        <div class="p-4">
            <Steps ref="stepsRef" v-model:steps="steps" />
        </div>
        <div>
            <OrderDetailForm
                :items="items"
                v-model="form.items"
                v-if="index === 0"
            />
            <ShippingForm
                :addresses="addresses"
                v-model="form.shipping"
                v-if="index === 1"
            />
        </div>
        <div class="p-4">
            <PrimaryButton
                v-if="index < 1"
                class="w-full py-4 flex justify-center gap-2"
                @click="stepsRef.goToNext()"
                >Continue
                <ArrowRightCircleIcon class="w-5 h-5 text-white" />
            </PrimaryButton>
            <PrimaryButton
                v-else
                class="w-full py-4 flex justify-center gap-2"
                @click="submit"
                >Checkout
                <ArrowRightCircleIcon class="w-5 h-5 text-white" />
            </PrimaryButton>
        </div>
    </AppLayout>
</template>
