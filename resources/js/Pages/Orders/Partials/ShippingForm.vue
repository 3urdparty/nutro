<script setup lang="ts">
export type Form = {
    address: App.Models.Address;
    deliveryType: "normal" | "quick" | "speedy";
};
interface Props {
    modelValue: Form;
    addresses: App.Models.Address[];
}
interface Emits {
    (e: "update:modelValue", value: Form): boolean;
}
const emits = defineEmits<Emits>();
const props = defineProps<Props>();
const form = useVModel(props, "modelValue", emits);
import Card from "@/Components/Card.vue";
import { useVModel } from "@vueuse/core";
import AddressSelect from "./AddressSelect.vue";
import DeliveryTypeSelect from "./DeliveryTypeSelect.vue";
</script>
<template>
    <div class="mt-8 mx-4 pb-4 space-y-10">
        <Card>
            <template #header>
                <div class="flex justify-between">
                    <h3 class="text-lg leading-6 font-semibold text-gray-900">
                        Address
                    </h3>
                    <Button
                        class="rounded px-2 bg-blue-500 border-white border text-white shadow-sm"
                    >
                        New
                    </Button>
                </div>
            </template>

            <template #content>
                <AddressSelect v-model="form.address" :addresses="addresses" />
            </template>
        </Card>
        <Card>
            <template #header>
                <h3 class="text-lg leading-6 font-semibold text-gray-900">
                    Delivery Type
                </h3>
            </template>

            <template #content>
                <DeliveryTypeSelect v-model="form.deliveryType" />
            </template>
        </Card>
    </div>
</template>
