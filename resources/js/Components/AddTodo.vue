<script setup>
import { router, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const newTodo = ref("");

const page = usePage();

const category = page.props.category;
</script>

<template>
    <form
        class="flex justify-center gap-3"
        @submit.prevent="
            router.post(
                route('todos.store'),
                { title: newTodo, category_id: category.id },
                { onSuccess: () => (newTodo = '') },
            )
        "
    >
        <input
            v-model="newTodo"
            class="input input-bordered w-full"
            placeholder="Add a new task"
        />
        <button class="btn btn-primary">Add</button>
    </form>
</template>
