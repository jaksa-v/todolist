<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import ThemeSwitcher from "@/Components/ThemeSwitcher.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="absolute top-4 right-4">
        <ThemeSwitcher />
    </div>
    <div
        class="flex flex-col items-center min-h-screen pt-6 sm:justify-center sm:pt-0"
    >
        <div>
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 text-gray-500 fill-current" />
            </Link>
        </div>

        <div
            class="w-full px-6 py-4 mt-6 overflow-hidden sm:max-w-md sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
