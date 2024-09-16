<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import TodoList from "@/Components/TodoList.vue";
import AddTodo from "@/Components/AddTodo.vue";

defineOptions({ layout: AuthenticatedLayout });

defineProps({
    todos: Array,
});
</script>

<template>
    <Head title="My Todos" />

    <div class="mx-auto flex max-w-2xl flex-col gap-y-8 sm:px-6 lg:px-8">
        <div class="prose">
            <h1>My Inbox</h1>
        </div>

        <div class="flex flex-col gap-y-4">
            <AddTodo />

            <TodoList :todos="todos" />
        </div>
    </div>
</template>
