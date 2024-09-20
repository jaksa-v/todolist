<script setup>
import { Link, router, usePage } from "@inertiajs/vue3";
import { computed, nextTick, ref } from "vue";
import {
    CheckIcon,
    PlusIcon,
    XMarkIcon,
} from "@heroicons/vue/24/outline/index.js";

defineProps({
    closeDrawer: Function,
});

const page = usePage();

const categories = computed(() => page.props.categories);

const showAddCategory = ref(false);
const addCategoryInput = ref(null);
const newCategory = ref(null);

function toggleAddCategory() {
    showAddCategory.value = true;
    nextTick(() => {
        addCategoryInput.value?.focus();
    });
}
</script>

<template>
    <div class="flex items-center justify-between">
        <h3>Categories</h3>
        <button>
            <PlusIcon
                class="size-5 hover:text-primary focus:text-primary"
                @click="toggleAddCategory"
            />
        </button>
    </div>
    <ul class="menu">
        <li v-for="category in categories" :key="category.id">
            <Link
                :href="route('category.show', category.slug)"
                class="flex items-center justify-between"
            >
                <span @click="closeDrawer">{{ category.name }}</span>
            </Link>
        </li>
    </ul>
    <form
        v-if="showAddCategory"
        class="flex justify-center gap-3 px-5"
        @submit.prevent="
            router.post(route('category.store'), { name: newCategory });
            showAddCategory = false;
            newCategory = null;
        "
    >
        <input
            ref="addCategoryInput"
            v-model="newCategory"
            class="input input-sm input-bordered w-full"
            placeholder="Add a new category"
        />
        <button type="submit">
            <CheckIcon
                class="size-5 hover:stroke-2 hover:text-primary focus:stroke-2 focus:text-primary"
            />
        </button>
        <button>
            <XMarkIcon
                class="size-5 hover:stroke-2 hover:text-error focus:stroke-2 focus:text-error"
                @click="
                    showAddCategory = false;
                    newCategory = null;
                "
            />
        </button>
    </form>
</template>
