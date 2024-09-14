<script setup>
import { router } from "@inertiajs/vue3";

defineProps({
    todos: Array,
});
</script>

<template>
    <ul class="flex flex-col gap-y-3">
        <li
            v-for="todo in todos"
            :key="todo.id"
            class="flex items-center gap-4 px-3 py-3 bg-base-100 rounded-btn"
        >
            <label class="flex items-center flex-1 gap-3">
                <input
                    type="checkbox"
                    class="checkbox checkbox-primary"
                    :checked="todo.completed"
                    @change="
                        router.patch(
                            route('todos.update', {
                                todo,
                                completed: !todo.completed,
                            })
                        )
                    "
                />
                <span :class="{ completed: todo.completed }">{{
                    todo.title
                }}</span>
            </label>
            <button
                @click="router.delete(route('todos.destroy', todo))"
                class="text-error hover:bg-error hover:border-error btn btn-outline btn-sm"
            >
                Delete
            </button>
        </li>
    </ul>
</template>
