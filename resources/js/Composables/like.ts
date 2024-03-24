import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";
export const useLike = (item: App.Models.FoodItem) => {
    const isLiked = ref(!!item.like);
    const likeItem = (item: App.Models.FoodItem) => {
        isLiked.value = true;
        Inertia.post(
            route("products.likes.store", {
                product: item.slug,
            }),
            {
                preserveScroll: true,
            }
        );
    };

    const dislikeItem = (item: any) => {
        isLiked.value = false;
        Inertia.delete(
            route("products.likes.destroy", {
                product: item.slug,
                like: item.like.id,
            }),
            {
                preserveScroll: true,
            }
        );
    };

    const toggleLike = (item: App.Models.FoodItem) => {
        console.log(item.like);
        if (item.like) dislikeItem(item);
        else likeItem(item);
    };
    return {
        likeItem,
        toggleLike,
        isLiked,
    };
};
