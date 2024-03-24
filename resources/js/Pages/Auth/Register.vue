<script setup>
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import DateInput from "@/Components/DateInput.vue";
import Divider from "@/Components/Divider.vue";
import EmailInput from "@/Components/EmailInput.vue";
import InputError from "@/Components/InputError.vue";
import InputGroup from "@/Components/InputGroup.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PhoneInput from "@/Components/PhoneInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { useCssVar } from "@vueuse/core";
import NewPasswordInput from "./NewPasswordInput.vue";
const form = useForm({
    first_name: "",
    last_name: "",
    date_of_birth: "",
    email: "",
    password: "",
    password_confirmation: "",
    terms: false,
    phone_number: "",
});
const background = useCssVar("--bg-color");

background.value = "white";

const submit = () => {
    console.log(form.password);
    console.log(form.password_confirmation);
    if (form.password !== form.password_confirmation) {
        form.errors.password = "The password confirmation does not match.";
        return;
    }
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="Register" />

    <AuthenticationCard>
        <template #header>
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                Register a new account
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Or
                {{ " " }}
                <a
                    href="#"
                    class="font-medium text-brand-400 hover:text-brand-500"
                >
                    get started with Nutro today
                </a>
            </p>
        </template>
        <template #logo>
            <AuthenticationCardLogo class="w-16 h-16" />
        </template>

        <form @submit.prevent="submit">
            <div>
                <InputGroup>
                    <TextInput
                        id="name"
                        v-model="form.first_name"
                        placeholder="John"
                        type="text"
                        class="w-full"
                        required
                        autofocus
                        autocomplete="name"
                    >
                        <template #label>
                            <InputLabel value="First Name" class="pl-3 pt-1" />
                        </template>
                    </TextInput>
                    <TextInput
                        id="name"
                        v-model="form.last_name"
                        placeholder="Doe"
                        type="text"
                        class="w-full"
                        required
                        autofocus
                        autocomplete="name"
                    >
                        <template #label>
                            <InputLabel value="Last Name" class="pl-3 pt-1" />
                        </template>
                    </TextInput>
                </InputGroup>
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel value="Date of birth" />
                <DateInput v-model="form.date_of_birth" />
            </div>
            <div class="mt-4">
                <InputLabel value="Phone Number" />
                <PhoneInput v-model="form.phone_number" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <EmailInput
                    id="email"
                    v-model="form.email"
                    placeholder="john.doe@gmail.com"
                    type="email"
                    class="block w-full"
                    required
                    autocomplete="username"
                />
                <InputError
                    class="mt-2"
                    :message="form.errors.email || $page.props.errors.email"
                />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <NewPasswordInput
                    v-model="form.password"
                    v-model:confirm="form.password_confirmation"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError
                    class="mt-2"
                    :message="
                        form.errors.password || $page.props.errors.password
                    "
                />
                <!-- <InputError
                    class="mt-2"
                    :message="
                        form.errors.password || $page.props.errors.password
                    "
                /> -->
            </div>

            <div
                v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
                class="mt-4"
            >
                <InputLabel for="terms">
                    <div class="flex items-center">
                        <Checkbox
                            id="terms"
                            v-model:checked="form.terms"
                            name="terms"
                            required
                        />

                        <div class="ms-2">
                            I agree to the
                            <a
                                target="_blank"
                                :href="route('terms.show')"
                                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800"
                                >Terms of Service</a
                            >
                            and
                            <a
                                target="_blank"
                                :href="route('policy.show')"
                                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800"
                                >Privacy Policy</a
                            >
                        </div>
                    </div>
                    <InputError class="mt-2" :message="form.errors.terms" />
                </InputLabel>
            </div>
            <Divider class="py-4">
                <span
                    class="text-sm whitespace-nowrap text-slate-400 text-medium"
                    >Or Continue with</span
                >
            </Divider>

            <Link :href="route('oauth.redirect', 'google')">
                <SecondaryButton class="w-full my-1 py-2 justify-center gap-2">
                    <svg
                        width="31"
                        height="30"
                        viewBox="0 0 31 30"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M27.7569 12.5519H26.75V12.5H15.5V17.5H22.5644C21.5338 20.4106 18.7644 22.5 15.5 22.5C11.3581 22.5 8 19.1419 8 15C8 10.8581 11.3581 7.5 15.5 7.5C17.4119 7.5 19.1513 8.22125 20.4756 9.39937L24.0112 5.86375C21.7787 3.78312 18.7925 2.5 15.5 2.5C8.59688 2.5 3 8.09688 3 15C3 21.9031 8.59688 27.5 15.5 27.5C22.4031 27.5 28 21.9031 28 15C28 14.1619 27.9137 13.3438 27.7569 12.5519Z"
                            fill="#FFC107"
                        />
                        <path
                            d="M4.44116 9.18188L8.54804 12.1938C9.65929 9.4425 12.3505 7.5 15.4999 7.5C17.4118 7.5 19.1512 8.22125 20.4755 9.39937L24.0112 5.86375C21.7787 3.78312 18.7924 2.5 15.4999 2.5C10.6987 2.5 6.53491 5.21062 4.44116 9.18188Z"
                            fill="#FF3D00"
                        />
                        <path
                            d="M15.5 27.4999C18.7287 27.4999 21.6625 26.2643 23.8806 24.2549L20.0118 20.9812C18.7568 21.9318 17.1968 22.4999 15.5 22.4999C12.2487 22.4999 9.48808 20.4268 8.44808 17.5337L4.37183 20.6743C6.44058 24.7224 10.6418 27.4999 15.5 27.4999Z"
                            fill="#4CAF50"
                        />
                        <path
                            d="M27.7569 12.5519H26.75V12.5H15.5V17.5H22.5644C22.0694 18.8981 21.17 20.1037 20.01 20.9819L20.0119 20.9806L23.8806 24.2544C23.6069 24.5031 28 21.25 28 15C28 14.1619 27.9137 13.3438 27.7569 12.5519Z"
                            fill="#1976D2"
                        />
                    </svg>

                    Continue with Google
                </SecondaryButton>
            </Link>

            <SecondaryButton
                class="w-full text-center my-1 py-2 justify-center gap-2"
            >
                <svg
                    width="30"
                    height="30"
                    viewBox="0 0 30 30"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M26.25 23.125C26.25 24.8512 24.8512 26.25 23.125 26.25H6.875C5.14938 26.25 3.75 24.8512 3.75 23.125V6.875C3.75 5.14875 5.14938 3.75 6.875 3.75H23.125C24.8512 3.75 26.25 5.14875 26.25 6.875V23.125Z"
                        fill="#3F51B5"
                    />
                    <path
                        d="M21.48 15.625H19.375V23.75H16.25V15.625H14.375V13.125H16.25V11.6188C16.2513 9.42625 17.1619 8.125 19.745 8.125H21.875V10.625H20.4456C19.44 10.625 19.375 11 19.375 11.7019V13.125H21.875L21.48 15.625Z"
                        fill="white"
                    />
                </svg>
                Continue with Facebook
            </SecondaryButton>
            <SecondaryButton class="w-full my-1 py-2 justify-center gap-2">
                <svg
                    width="23"
                    height="26"
                    viewBox="0 0 23 26"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M22.5 18.9833C21.8999 20.3161 21.6108 20.9118 20.839 22.088C19.7584 23.7316 18.2343 25.784 16.3515 25.7971C14.6753 25.8123 14.2426 24.7035 11.9663 24.7231C9.69213 24.7339 9.21816 25.8188 7.53973 25.8014C5.65474 25.784 4.21329 23.936 3.13274 22.2945C0.110682 17.6919 -0.208917 12.2957 1.65867 9.42579C2.98055 7.39079 5.0699 6.19502 7.03315 6.19502C9.03336 6.19502 10.29 7.29296 11.9424 7.29296C13.5469 7.29296 14.5231 6.19284 16.8364 6.19284C18.5844 6.19284 20.4324 7.14512 21.7543 8.78877C17.4321 11.1586 18.1343 17.331 22.5 18.9833ZM15.0797 4.35569C15.921 3.27514 16.5602 1.75107 16.3276 0.19873C14.9557 0.292219 13.3512 1.1684 12.4142 2.3033C11.5641 3.33819 10.8596 4.87314 11.1336 6.35808C12.6316 6.40591 14.1817 5.51233 15.0797 4.35569Z"
                        fill="black"
                    />
                </svg>

                Continue with LinkedIn
            </SecondaryButton>
            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800"
                >
                    Already registered?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
