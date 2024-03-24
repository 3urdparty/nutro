<template>
    <div class="min-h-[100vh] flex bg-white">
        <div
            class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24"
        >
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <div>
                        <slot name="logo" />
                    </div>
                    <slot name="header" />
                </div>

                <div class="mt-8">
                    <div class="mt-6">
                        <slot />
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden lg:block relative w-0 flex-1">
            <img
                class="absolute inset-0 h-full w-full object-cover"
                src="/images/jimmy-dean-Yn0l7uwBrpw-unsplash.jpg"
                alt=""
            />
            <div class="bg-blue-400 opacity-30 w-full h-full"></div>
        </div>
    </div>

    <!-- <div>
            <slot name="logo" />
        </div>

        <slot name="header"> </slot>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg bg-[#FBFCFF]"
        >
            <slot />
        </div> -->
</template>
