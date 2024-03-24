<script setup lang="ts">
import BreadCrumbs from "@/Components/BreadCrumbs.vue";
import CartDialog from "@/Components/CartDialog.vue";
import ContextMenu from "@/Components/ContextMenu.vue";
import Footer from "@/Components/Footer.vue";
import Header from "@/Components/Header.vue";
import ProductQuickView from "@/Components/ProductQuickView.vue";
import ShoppingCartButton from "@/Components/ShoppingCartButton.vue";
import { useBackground } from "@/Composables/background";
import { useCart } from "@/Composables/cart";
import { useContextMenu } from "@/Composables/contextmenu";
import { useQuickView } from "@/Composables/quickview";
import { useUser } from "@/Composables/user";
import NotificationProvider from "@/Pages/Partials/NotificationProvider.vue";

interface Props {
    class?: string;
    showCart?: boolean;
}
const props = withDefaults(defineProps<Props>(), {
    class: "bg-white",
    showCart: true,
});

const { style: contextMenuStyle, x, show: showContextMenu } = useContextMenu();
useBackground();
const { item, showQuickView, hide } = useQuickView();
const { user, role, loggedIn, is } = useUser();
const { items, count, show, open: cartOpen, close } = useCart();
</script>

<template>
    <!-- Header -->
    <Header />

    <!-- BreadCrumbs -->
    <BreadCrumbs />
    <!-- Notificaiton provider for Flash Messages and other Notifications -->
    <NotificationProvider />

    <!-- Product QuickView -->
    <ProductQuickView
        :item="item"
        :open="showQuickView"
        @close="hide"
        class="z-[100]"
    />

    <!-- Cart Dialog -->
    <CartDialog
        v-if="is('customer')"
        :open="cartOpen"
        :items="items"
        @close="close"
        class="z-30"
    />

    <!-- Context Menu -->
    <transition
        enter-from-class="opacity-0"
        enter-active-class="transition duration-200"
        enter-to-class="opacity-100"
    >
        <ContextMenu
            v-if="showContextMenu"
            class="fixed"
            :style="contextMenuStyle"
        >
            <template #body>
                <slot name="contextMenu" />
            </template>
        </ContextMenu>
    </transition>

    <!-- Shopping Cart Butto -->
    <div class="relative" :class="class">
        <!-- Shopping Cart Button -->
        <div class="flex justify-end sticky top-[6rem] right-0 z-20">
            <ShoppingCartButton
                v-if="loggedIn && role === 'customer'"
                @click="show"
                class="lg:hidden shadow-lg mt-5"
                :count="count"
            />
        </div>

        <div>
            <!-- Content -->
            <slot />
        </div>
    </div>

    <!-- Footer -->
    <Footer />
</template>
