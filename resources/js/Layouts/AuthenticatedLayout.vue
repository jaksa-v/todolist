<script setup>
import ThemeSwitcher from "@/Components/ThemeSwitcher.vue";
import Sidebar from "@/Components/Sidebar.vue";
</script>

<template>
    <div class="flex min-h-screen">
        <div class="absolute right-4 top-4 flex gap-x-6">
            <ThemeSwitcher />
        </div>
        <Sidebar />
        <!-- Page Content -->
        <main class="flex-1 px-6 sm:px-0">
            <slot />
        </main>
    </div>
</template>
