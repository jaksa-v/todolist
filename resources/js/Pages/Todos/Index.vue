<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import TodoList from "@/Components/TodoList.vue";
import AddTodo from "@/Components/AddTodo.vue";

defineProps({
    todos: Array,
});
</script>

<template>
    <Head title="My Todos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-base-content">
                My Inbox
            </h2>
        </template>

        <div class="py-12">
            <div
                class="flex flex-col max-w-2xl mx-auto sm:px-6 lg:px-8 gap-y-4"
            >
                <AddTodo />

                <TodoList :todos="todos" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
