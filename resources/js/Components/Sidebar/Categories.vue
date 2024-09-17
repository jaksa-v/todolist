<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

defineProps({
    closeDrawer: Function,
});

const page = usePage();

const categories = computed(() => page.props.categories);
</script>

<template>
    <ul class="menu">
        <li v-for="category in categories" :key="category.id">
            <Link
                :href="route('category.show', category.id)"
                @click="closeDrawer"
            >
                {{ category.name }}
            </Link>
        </li>
    </ul>
</template>
