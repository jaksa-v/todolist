<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="hidden w-64 border-r border-base-content/20 px-6 py-16 md:flex md:flex-col"
    >
        <div class="flex items-center gap-x-4">
            <img
                alt="avatar"
                class="h-8 w-8 rounded-full"
                src="https://ui-avatars.com/api/?name=John+Doe"
            />
            <span>John Doe</span>
        </div>
        <div>
            <ul class="menu px-0">
                <li>
                    <Link
                        :class="{
                            active: $page.component === 'Todos/Index',
                        }"
                        :href="route('todos.index')"
                    >
                        Inbox
                    </Link>
                </li>
                <li>
                    <Link
                        :class="{
                            active: $page.component === 'Profile/Edit',
                        }"
                        :href="route('profile.edit')"
                        >Profile Settings
                    </Link>
                </li>
                <li>
                    <Link
                        :href="route('logout')"
                        as="button"
                        method="post"
                        type="button"
                    >
                        Logout
                    </Link>
                </li>
            </ul>
        </div>
        <div class="divider" />
        <div>Categories</div>
        <div class="divider" />
        <div>Tags</div>
    </div>
</template>
