<script setup lang="ts">
import { reactive } from "vue";

interface Props {
    variant: "minimal" | "full";
    editable: boolean;
}
const props = withDefaults(defineProps<Props>(), {
    variant: "full",
    editable: true,
});

interface NutritionalLabel {
    name: string;
    value: string;
    percent?: string;
    types?: NutritionalLabel[];
}
const items = [];
const secondary = [
    { name: "Vitamin A", value: "10%" },
    { name: "Vitamin C", value: "0%" },
    { name: "Calcium", value: "10%" },
    { name: "Iron", value: "6%" },
];
const tertiary = [
    {
        name: "Total Fat",
        lessThan: "65g",
        unit: "g",
        moreThan: "80g",
        calories: "Less than",
    },
    {
        name: "Saturated Fat",

        unit: "g",
        lessThan: "20g",
        moreThan: "25g",
        calories: "Less than",
    },
    {
        name: "Cholesterol",
        unit: "g",
        lessThan: "300mg",
        moreThan: "300mg",
        calories: "Less than",
    },
    {
        name: "Sodium",
        unit: "g",
        lessThan: "2,400mg",
        moreThan: "2,400mg",
        calories: "Less than",
    },
    {
        name: "Total Carbohydrate",
        unit: "g",
        lessThan: "300g",
        moreThan: "375g",
        calories: "Less than",
    },
    {
        name: "Dietary Fiber",
        unit: "g",
        lessThan: "25g",
        moreThan: "30g",
        calories: "Less than",
    },
];

const label = reactive({
    calories: { total: 200, fromFat: 120 },
    nutrients: [
        {
            name: "Total Fat",
            value: 14,
            unit: "g",
            percent: "22%",
            types: [
                {
                    name: "Saturated Fat",
                    value: 9,
                    unit: "g",
                    percent: "45%",
                },
                { name: "Trans Fat", value: 0, unit: "g" },
            ],
        },
        { name: "Cholesterol", value: 55, unit: "mg", percent: "18%" },
        { name: "Sodium", value: 40, unit: "mg", percent: "2%" },
        {
            name: "Total Carbohydrate",
            value: 14,
            unit: "g",
            percent: "6%",
            types: [
                {
                    name: "Dietary Fiber",
                    value: 1,
                    unit: "g",
                    percent: "4%",
                },
                { name: "Sugars", value: 14, unit: "g" },
            ],
        },
        { name: "Protein", value: 3 },
    ],
});
</script>
<template>
    <section class="border border-black p-1 bg-white max-w-[500px] px-2">
        <header class="border-b-[10px] pt-1 mt-1 pb-1 border-black">
            <h1 class="font-bold text-3xl mt-1">Nutrition Facts</h1>
            <p>Serving Size 1/2 cup (about 82g)</p>
            <p>Serving Per Container 8</p>
        </header>
        <table class="border-collapse w-full">
            <thead>
                <tr
                    class="font-normal text-left px-2 border-t whitespace-nowrap"
                >
                    <th
                        colspan="3"
                        class="text-xs font-normal text-left px-2 border-t border-black whitespace-nowrap"
                    >
                        Amount Per Serving
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr
                    class="font-normal text-left px-2 border-t whitespace-nowrap border-black"
                >
                    <th
                        colspan="2"
                        class="font-normal text-left border-t whitespace-nowrap border-black"
                    >
                        <b>Calories</b>
                        <input
                            class="focus:ring-0 border-none text-md w-24"
                            v-model="label.calories.total"
                            type="number"
                            :disabled="!editable"
                        />
                    </th>
                    <td class="font-normal border-t whitespace-nowrap text-end">
                        <span class="hidden sm:block"> Calories from </span>
                        Fat
                        <input
                            class="focus:ring-0 border-none px-0 text-md w-14"
                            v-model="label.calories.fromFat"
                            type="number"
                            :disabled="!editable"
                        />
                    </td>
                </tr>
                <tr
                    class="font-normal text-left px-2 border-t-4 whitespace-nowrap border-black"
                >
                    <td colspan="3" class="text-sm text-right font-semibold">
                        % Daily Value*
                    </td>
                </tr>
                <template v-for="item in label.nutrients">
                    <tr class="border-t border-black">
                        <th
                            colspan="2"
                            class="text-left font-normal whitespace-nowrap"
                        >
                            <span class="font-bold"> {{ item.name }} </span>
                            <input
                                class="focus:ring-0 border-none px-0 text-md w-6 text-end py-0"
                                v-model="item.value"
                                :disabled="!editable"
                            />

                            {{ item.unit }}
                        </th>
                        <td class="pl-4 text-end font-semibold">
                            {{ item.percent }}
                        </td>
                    </tr>

                    <tr
                        v-for="subItem in item.types"
                        class="border-t border-black"
                    >
                        <th
                            colspan="2"
                            class="text-left pl-4 font-normal whitespace-nowrap"
                        >
                            <span class="font-bold">
                                {{ subItem.name }}
                            </span>
                            <input
                                class="focus:ring-0 border-none px-0 text-md w-6 text-end py-0"
                                v-model="subItem.value"
                                :disabled="!editable"
                            />
                            {{ subItem.unit }}
                        </th>
                        <td class="font-semibold text-end">
                            {{ subItem.percent }}
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>

        <table class="w-full border-t-[10px]" v-if="variant === 'full'">
            <tbody>
                <tr class="border-b border-black" v-for="item in secondary">
                    <td colspan="2">{{ item.name }} {{ item.value }}</td>
                    <td>Vitamin C 0%</td>
                </tr>
                <tr class="border-b border-black">
                    <td colspan="2">Calcium 10%</td>
                    <td>Iron 6%</td>
                </tr>
            </tbody>
        </table>

        <p class="text-xs text-black" v-if="variant === 'full'">
            * Percent Daily Values are based on a 2,000 calorie diet. Your daily
            values may be higher or lower depending on your calorie needs:
        </p>

        <table class="w-full text-xs" v-if="variant === 'full'">
            <thead>
                <tr>
                    <td colspan="2" class="text-left"></td>
                    <th class="text-left">Calories:</th>
                    <th class="text-left">2,000</th>
                    <th class="text-left">2,500</th>
                </tr>
            </thead>
            <tbody class="border-t-8 border-black">
                <tr v-for="item in tertiary">
                    <th colspan="2" class="text-left font-medium">
                        {{ item.name }}
                    </th>
                    <td>{{ item.calories }}</td>
                    <td>{{ item.lessThan }}</td>
                    <td>{{ item.moreThan }}</td>
                </tr>
            </tbody>
        </table>

        <p class="text-xs border-t border-black mt-1 pt-2">
            Calories per gram:
        </p>
        <p class="text-xs text-center font-medium">
            Fat 9 &bull; Carbohydrate 4 &bull; Protein 4
        </p>
    </section>
</template>
