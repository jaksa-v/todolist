<script setup>
import { router } from "@inertiajs/vue3";
import { ref, nextTick } from "vue";

defineProps({
    todos: Array,
});

const editingId = ref(null);
const editInputRef = ref(null);

function startEdit(id) {
    editingId.value = id;
    nextTick(() => {
        editInputRef.value[0]?.focus();
    });
}

function saveEdit(todo) {
    editingId.value = null;

    router.patch(
        route("todos.update", {
            todo,
            title: todo.title,
        })
    );
}
</script>

<template>
    <ul v-if="todos.length > 0" class="flex flex-col gap-y-3">
        <li
            v-for="todo in todos"
            :key="todo.id"
            class="flex items-center gap-4 px-3 py-3 border border-base-content/20 rounded-btn"
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
                <input
                    v-if="editingId === todo.id"
                    ref="editInputRef"
                    v-model="todo.title"
                    @keyup.enter="saveEdit(todo)"
                    @keyup.esc="editingId = null"
                    class="flex-1 p-0 text-base input input-sm focus:outline-none focus:border-none"
                />
                <span v-else :class="{ 'line-through': todo.completed }">
                    {{ todo.title }}
                </span>
            </label>
            <div class="flex items-center gap-2" v-if="editingId === todo.id">
                <button
                    @click="saveEdit(todo)"
                    class="text-info hover:bg-info hover:border-info btn btn-outline btn-sm"
                >
                    Save
                </button>
                <button
                    @click="editingId = null"
                    class="text-error hover:bg-error hover:border-error btn btn-outline btn-sm"
                >
                    Cancel
                </button>
            </div>
            <div class="flex items-center gap-2" v-else>
                <button
                    @click="startEdit(todo.id)"
                    class="text-info hover:bg-info hover:border-info btn btn-outline btn-sm"
                >
                    Edit
                </button>
                <button
                    @click="router.delete(route('todos.destroy', todo))"
                    class="text-error hover:bg-error hover:border-error btn btn-outline btn-sm"
                >
                    Delete
                </button>
            </div>
        </li>
    </ul>
    <div v-else class="prose">
        <p>No todos found! Type above to create some.</p>
    </div>
</template>
