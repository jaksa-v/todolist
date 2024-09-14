<script setup>
import { router } from "@inertiajs/vue3";
import { ref } from "vue";

const newTodo = ref("");
</script>

<template>
    <form
        @submit.prevent="
            router.post(
                route('todos.store'),
                { title: newTodo },
                { onSuccess: () => (newTodo = '') }
            )
        "
        class="flex justify-center gap-3"
    >
        <input
            v-model="newTodo"
            placeholder="Add a new task"
            class="w-full input input-bordered"
        />
        <button class="btn btn-primary">Add</button>
    </form>
</template>
