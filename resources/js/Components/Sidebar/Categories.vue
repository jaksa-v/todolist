<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import { PlusIcon } from "@heroicons/vue/24/outline/index.js";

defineProps({
    closeDrawer: Function,
});

const page = usePage();

const categories = computed(() => page.props.categories);
</script>

<template>
    <div class="flex items-center justify-between">
        <h3>Categories</h3>
        <button>
            <PlusIcon class="size-5 hover:text-primary focus:text-primary" />
        </button>
    </div>
    <ul class="menu">
        <li v-for="category in categories" :key="category.id">
            <Link
                :href="route('category.show', category.slug)"
                @click="closeDrawer"
            >
                {{ category.name }}
            </Link>
        </li>
    </ul>
</template>
