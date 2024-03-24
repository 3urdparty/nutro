/**
 * This file is auto generated using 'php artisan typescript:generate'
 *
 * Changes to this file will be lost when the command is run again
 */

declare namespace App.Models {
    export interface Cart {
        id: number;
        created_at: string | null;
        updated_at: string | null;
        customer_id: number;
        customer?: App.Models.Customer | null;
        food_items?: Array<App.Models.FoodItem> | null;
        food_items_count?: number | null;
    }

    export interface Order {
        id: number;
        created_at: string | null;
        updated_at: string | null;
        customer_id: number;
        status: string;
        items?: Array<App.Models.FoodItem> | null;
        payment?: App.Models.Payment | null;
        customer?: App.Models.Customer | null;
        delivery?: App.Models.Delivery | null;
        items_count?: number | null;
        readonly order_number?: any;
        readonly subtotal?: number;
        readonly hash?: string;
    }

    export interface Review {
        id: number;
        created_at: string | null;
        updated_at: string | null;
        reviewable_type: string;
        reviewable_id: number;
        customer_id: number;
        body: string;
        rating: number;
        title: string;
        reviewable?: any | null;
        customer?: App.Models.Customer | null;
    }

    export interface Delivery {
        id: number;
        created_at: string | null;
        updated_at: string | null;
        from_first_line_address: string;
        from_second_line_address: string;
        from_state: string;
        from_city: string;
        from_postcode: string;
        from_country: string;
        from_latitude: number;
        from_longitude: number;
        to_first_line_address: string;
        to_second_line_address: string;
        to_state: string;
        to_city: string;
        to_postcode: string;
        to_country: string;
        to_latitude: number;
        to_longitude: number;
        order_id: number;
        delivery_person_id: number | null;
        status: string;
        delivered_at: string | null;
        order?: App.Models.Order | null;
        readonly minimum_distance?: number;
        readonly maximum_distance?: number;
        readonly from?: any;
        readonly to?: any;
    }

    export interface Vendor {
        id: number;
        created_at: string | null;
        updated_at: string | null;
        name: string;
        user_id: number;
        cover_image_url: string | null;
        logo_url: string | null;
        description: string | null;
        open_time: number | null;
        close_time: number | null;
        phone_number: string | null;
        website_url: string | null;
        instagram_handle: string | null;
        facebook_url: string | null;
        twitter_handle: string | null;
        email: string | null;
        slug: string;
        food_items?: Array<App.Models.FoodItem> | null;
        user?: App.Models.User | null;
        reviews?: Array<App.Models.Review> | null;
        food_items_count?: number | null;
        reviews_count?: number | null;
        readonly is_open?: boolean;
    }

    export interface Address {
        id: number;
        created_at: string | null;
        updated_at: string | null;
        first_line_address: string;
        second_line_address: string;
        state: string;
        city: string;
        postcode: string;
        country: string;
        is_default: boolean;
        name: string;
        customer_id: number;
        customer?: App.Models.Customer | null;
        orders?: Array<App.Models.Order> | null;
        orders_count?: number | null;
    }

    export interface CartItem {
        id: number;
        created_at: string | null;
        updated_at: string | null;
        cart_id: number;
        food_item_id: number;
        quantity: number;
        cart?: App.Models.Cart | null;
        food_item?: App.Models.FoodItem | null;
    }

    export interface OrderItem {}

    export interface User {
        id: number;
        name: string;
        email: string;
        email_verified_at: string | null;
        password: string | null;
        two_factor_secret: string | null;
        two_factor_recovery_codes: string | null;
        two_factor_confirmed_at: string | null;
        remember_token: string | null;
        profile_photo_path: string | null;
        created_at: string | null;
        updated_at: string | null;
        date_of_birth: string;
        phone_number: string;
        is_admin: boolean;
        role: string;
        customer?: App.Models.Customer | null;
        delivery_person?: App.Models.DeliveryPerson | null;
        vendor?: App.Models.Vendor | null;
        readonly profile_photo_url?: any;
        readonly get_photo_url?: any;
    }

    export interface Deal {
        id: number;
        created_at: string | null;
        updated_at: string | null;
    }

    export interface Like {
        id: number;
        created_at: string | null;
        updated_at: string | null;
        likeable_type: string;
        likeable_id: number;
        user_id: number;
        likeable?: any | null;
    }

    export interface Payment {
        id: number;
        created_at: string | null;
        updated_at: string | null;
        order_id: number;
        amount: number;
        order?: App.Models.Order | null;
    }

    export interface ConnectedAccount {
        id: number;
        user_id: number;
        provider: string;
        provider_id: string;
        name: string | null;
        nickname: string | null;
        email: string | null;
        telephone: string | null;
        avatar_path: string | null;
        token: string;
        secret: string | null;
        refresh_token: string | null;
        expires_at: string | null;
        created_at: string | null;
        updated_at: string | null;
        user?: App.Models.User | null;
    }

    export interface Customer {
        id: number;
        created_at: string | null;
        updated_at: string | null;
        user_id: number;
        first_line_address: string;
        second_line_address: string;
        city: string;
        postcode: string;
        state: string;
        country: string;
        dietary_restrictions: string;
        track_location: boolean;
        cart?: App.Models.Cart | null;
        user?: App.Models.User | null;
        addresses?: Array<App.Models.Address> | null;
        orders?: Array<App.Models.Order> | null;
        reviews?: Array<App.Models.Review> | null;
        addresses_count?: number | null;
        orders_count?: number | null;
        reviews_count?: number | null;
    }

    export interface Invoice {
        id: number;
        created_at: string | null;
        updated_at: string | null;
    }

    export interface Membership {}

    export interface DeliveryPerson {
        id: number;
        created_at: string | null;
        updated_at: string | null;
        user_id: number;
        user?: App.Models.User | null;
        deliveries?: Array<App.Models.Delivery> | null;
        deliveries_count?: number | null;
    }

    export interface FoodItem {
        id: number;
        created_at: string | null;
        updated_at: string | null;
        vendor_id: number;
        name: string;
        slug: string;
        servings: number;
        quantity: number;
        unit: string;
        protein: number;
        carbohydrates: number;
        calcium: number;
        calories: number;
        dietary_restriction: string;
        short_description: string;
        long_description: string;
        category: string;
        image_url: string | null;
        secondary_image_url: string | null;
        tertiary_image_url: string | null;
        quaternary_image_url: string | null;
        price: number;
        units: number;
        old_price: number | null;
        likes?: Array<App.Models.Like> | null;
        vendor?: App.Models.Vendor | null;
        reviews?: Array<App.Models.Review> | null;
        orders?: Array<App.Models.Order> | null;
        likes_count?: number | null;
        reviews_count?: number | null;
        orders_count?: number | null;
        readonly like?: any | null;
        readonly is_liked?: boolean;
        readonly reviews_avg_rating?: number;
        readonly reviews_count?: number;
        readonly discount?: number | null;
    }

    export interface Notification {
        id: number;
        created_at: string | null;
        updated_at: string | null;
    }

    export interface Recipe {
        id: number;
        created_at: string | null;
        updated_at: string | null;
        name: string;
        description: string | null;
        image_url: string | null;
        slug: string;
    }

}
