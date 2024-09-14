<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { ref } from "vue";
import Todo from "@/Components/Todo.vue";

defineProps({
    todos: Array,
});

const newTodo = ref("");
</script>

<template>
    <Head title="My Todos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Todos
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Add Todo -->
                <form
                    @submit.prevent="
                        router.post(
                            route('todos.store'),
                            { title: newTodo },
                            { onSuccess: () => (newTodo = '') }
                        )
                    "
                    class="flex justify-center gap-4"
                >
                    <input v-model="newTodo" placeholder="Add a new task" />
                    <button>Add</button>
                </form>

                <!-- Todo List -->
                <ul>
                    <Todo v-for="todo in todos" :todo="todo" :key="todo.id" />
                </ul>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
