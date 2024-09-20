<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TodoList from "@/Components/TodoList.vue";
import AddTodo from "@/Components/AddTodo.vue";
import { Head } from "@inertiajs/vue3";

defineOptions({ layout: AuthenticatedLayout });

defineProps({
    category: Object,
    todos: Array,
});
</script>

<template>
    <Head :title="category.name" />

    <div class="mx-auto flex max-w-2xl flex-col gap-y-8 sm:px-6 lg:px-8">
        <div class="prose">
            <h1>{{ category.name }}</h1>
        </div>

        <div class="flex flex-col gap-y-4">
            <AddTodo />

            <TodoList :todos="todos" />
        </div>
    </div>
</template>
