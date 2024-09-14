<script setup>
import { router } from "@inertiajs/vue3";

defineProps({
    todo: Object,
});
</script>

<template>
    <li>
        <label>
            <input
                type="checkbox"
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
            <span :class="{ completed: todo.completed }">{{ todo.title }}</span>
        </label>
        <button @click="router.delete(route('todos.destroy', todo))">
            Delete
        </button>
    </li>
</template>
