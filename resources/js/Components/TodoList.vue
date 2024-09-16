<script setup>
import { router } from "@inertiajs/vue3";
import { nextTick, ref } from "vue";
import Modal from "@/Components/Modal.vue";

defineProps({
    todos: Array,
});

const editingId = ref(null);
const editInputRef = ref(null);
const confirmingTodoDeletion = ref(null);

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
        }),
    );
}

function deleteTodo() {
    router.delete(route("todos.destroy", confirmingTodoDeletion.value));
    confirmingTodoDeletion.value = null;
}
</script>

<template>
    <ul v-if="todos.length > 0" v-auto-animate class="flex flex-col gap-y-3">
        <li
            v-for="todo in todos"
            :key="todo.id"
            class="flex items-center gap-4 rounded-btn border border-base-content/20 px-3 py-3"
        >
            <label class="flex flex-1 items-center gap-3">
                <input
                    :checked="todo.completed"
                    class="checkbox-primary checkbox"
                    type="checkbox"
                    @change="
                        router.patch(
                            route('todos.update', {
                                todo,
                                completed: !todo.completed,
                            }),
                        )
                    "
                />
                <input
                    v-if="editingId === todo.id"
                    ref="editInputRef"
                    v-model="todo.title"
                    class="input input-sm w-full flex-1 p-0 text-base focus:border-none focus:outline-none"
                    @keyup.enter="saveEdit(todo)"
                    @keyup.esc="editingId = null"
                />
                <span v-else :class="{ 'line-through': todo.completed }">
                    {{ todo.title }}
                </span>
            </label>
            <div v-if="editingId === todo.id" class="flex items-center gap-2">
                <button
                    class="btn btn-outline btn-info btn-sm"
                    @click="saveEdit(todo)"
                >
                    Save
                </button>
                <button
                    class="btn btn-outline btn-error btn-sm"
                    @click="editingId = null"
                >
                    Cancel
                </button>
            </div>
            <div v-else class="flex items-center gap-2">
                <button
                    class="btn btn-outline btn-info btn-sm"
                    @click="startEdit(todo.id)"
                >
                    Edit
                </button>
                <button
                    class="btn btn-outline btn-error btn-sm"
                    @click="confirmingTodoDeletion = todo"
                >
                    Delete
                </button>
            </div>
        </li>
    </ul>
    <div v-else class="prose">
        <p>No todos found! Type above to create some.</p>
    </div>

    <!-- Deletion Modal -->
    <Modal
        :show="confirmingTodoDeletion !== null"
        @close="confirmingTodoDeletion = null"
    >
        <div class="p-6">
            <h2 class="text-lg font-medium">
                Are you sure you want to delete this todo?
            </h2>

            <div class="mt-6 flex justify-end gap-4">
                <button class="btn" @click="confirmingTodoDeletion = null">
                    Cancel
                </button>

                <button class="btn btn-error" @click="deleteTodo">
                    Delete Todo
                </button>
            </div>
        </div>
    </Modal>
</template>
