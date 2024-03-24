<script setup lang="ts">
import Page from "@/Components/Page.vue";
import ProductSection from "@/Components/ProductSection.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import type { Paginated } from "@/Types/Laravel";
import { useUrlSearchParams } from "@vueuse/core";
import { provide, type InjectionKey } from "vue";
interface Props {
    canLogin: Boolean;
    canRegister: Boolean;
    foodItems: Paginated<App.Models.FoodItem>;
    vendors: Array<App.Models.Vendor>;
}
const props = defineProps<Props>();
provide("canLogin", props.canLogin);
provide("canRegister", props.canRegister);
provide(VendorsInjectionKey, props.vendors);
const params = useUrlSearchParams("history");
// @ts-ignore
import * as changeCase from "change-case";
</script>

<template>
    <AppLayout class="bg-slate-50">
        <Page>
            <div>
                <ProductSection :vendors="vendors" :items="foodItems.data">
                    <template v-if="params.search" #header>
                        <div>
                            <h1 class="text-3xl font-bold">
                                Search results for
                            </h1>
                            <h
                                class="text-blue-500/80 text-xl font-medium ml-1 truncate"
                            >
                                "{{ params.search }}"
                            </h>
                        </div>
                    </template>
                    <template #footer>
                        <Pagination v-bind="foodItems" />
                    </template>
                </ProductSection>
            </div>
        </Page>
    </AppLayout>
</template>

<script lang="ts">
export const VendorsInjectionKey = Symbol("VENDORS") as InjectionKey<
    Array<App.Models.Vendor>
>;
</script>
