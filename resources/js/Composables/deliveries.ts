import { useAxios } from "@vueuse/integrations/useAxios";
import Pusher from "pusher-js";
import { ref } from "vue";
import { useUser } from "./user";

export const useDeliveries = () => {
    const { data } = useAxios("/api/deliveries/", {
        method: "GET",
    });

    const { user } = useUser();
    console.log("data", data.value);
    const available_deliveries = ref([]);
    const current_deliveries = ref([]);

    const pusher = new Pusher("15b522e23411e6ef8cb7", {
        cluster: "ap1",
    });
    var channel = pusher.subscribe("deliveries");

    channel.bind(
        "delivery-accepted",
        function (data: { delivery_id: number; delivery_person_id: number }) {
            const idx = available_deliveries.value.findIndex(
                (deli) => deli.id === data.delivery_id
            );

            const delivery = available_deliveries.value.splice(
                available_deliveries.value.findIndex(
                    (deli) => deli.id === data.delivery_id
                ),
                1
            )[0];

            if (data.delivery_person_id === user.value.id) {
                current_deliveries.value.push(delivery);
            }
        }
    );
    channel.bind("delivery-added", function (delivery: App.Models.Delivery) {
        available_deliveries.value.push(delivery);
    });

    return {
        available_deliveries,
        current_deliveries,
    };
};
