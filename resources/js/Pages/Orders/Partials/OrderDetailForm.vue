<script setup lang="ts">
const selectedAddress = ref(null);
import Card from "@/Components/Card.vue";
import { removeItem } from "@/Components/CartDialog.vue";
import CartItem from "@/Components/CartItem.vue";
// import ItemSelectButton from "@/Components/ItemSelectButton.vue";
import ItemSelectButton from "@/Components/ItemSelectButton.vue";
import { useVModel } from "@vueuse/core";
import { computed, ref } from "vue";
interface Props {
    items: Array<App.Models.FoodItem>;
    modelValue: Array<Object>;
}

interface Emits {
    (
        e: "update:modelValue",
        value: Array<{ food_item_id: number; quantity: number }>
    ): boolean;
}

const emits = defineEmits<Emits>();
const props = defineProps<Props>();
const selected = useVModel(props, "modelValue", emits);
const selectAll = () => {
    selected.value = props.items.map((item) => ({
        food_item_id: item.id,
        quantity: item.cart_item.quantity,
    }));
};
const unselectAll = () => {
    selected.value = [];
};

const checked = computed({
    // getter
    get() {
        return (
            selected.value.length === props.items.length &&
            selected.value.length > 0
        );
    },
    // setter
    set(checked) {
        if (checked) selectAll();
        else unselectAll();
    },
});
</script>
<template>
    <div class="mt-8 mx-4 pb-4">
        <Card>
            <template #header>
                <div class="flex justify-between">
                    <h3 class="text-lg leading-6 font-semibold text-gray-900">
                        Order Details
                    </h3>

                    <ItemSelectButton v-model="checked" />
                </div>
            </template>

            <template #content>
                <div class="flow-root">
                    <ul
                        role="list"
                        class="-my-6 divide-y divide-gray-200"
                        v-if="items && items.length > 0"
                    >
                        <label
                            class="flex items-center gap-4 sm:gap-3"
                            v-for="item in items"
                            :key="item.id"
                        >
                            <input
                                :value="{
                                    food_item_id: item.id,
                                    quantity: item.listing.quantity,
                                }"
                                v-model="selected"
                                type="checkbox"
                                class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded"
                            />

                            <CartItem
                                :item="item"
                                class="w-full"
                                @remove="removeItem(item.cart_item.id)"
                            ></CartItem>
                        </label>
                    </ul>
                    <div v-else class="flex-col flex items-center">
                        <div class="flex gap-2 justify-center text-slate-500">
                            <ShoppingCartIcon class="w-6" />
                            <p class="text-center font-sora">
                                Your cart is empty
                            </p>
                        </div>

                        <Link
                            :href="route('products.index')"
                            class="bg-blue-400 w-fit p-2 text-white rounded-md active:ring-offset-bg-white active:ring-offset-2 ring-2 hover:bg-blue-500 mt-4"
                        >
                            Continue Shopping
                        </Link>
                    </div>
                </div>
            </template>
        </Card>
    </div>
</template>
