<script setup>
import ThemeSwitcher from "@/Components/ThemeSwitcher.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="min-h-screen">
        <div class="absolute flex top-4 right-4 gap-x-6">
            <Link
                :href="route('logout')"
                method="post"
                as="button"
                type="button"
                >Logout</Link
            >

            <ThemeSwitcher />
        </div>
        <!-- Page Content -->
        <main class="px-6 sm:px-0">
            <slot />
        </main>
    </div>
</template>
