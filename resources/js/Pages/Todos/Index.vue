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
        <div class="py-16">
            <div
                class="flex flex-col max-w-2xl mx-auto sm:px-6 lg:px-8 gap-y-8"
            >
                <div class="prose">
                    <h1>My Inbox</h1>
                </div>

                <div class="flex flex-col gap-y-4">
                    <AddTodo />

                    <TodoList :todos="todos" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
