<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineOptions({ layout: AuthenticatedLayout });

defineProps({
    category: Object,
});
</script>

<template>
    <div>
        {{ category.name }}
    </div>
</template>
