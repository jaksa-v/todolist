<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import { computed, ref } from "vue";

const page = usePage();

const user = computed(() => page.props.auth.user);

const userInitials = computed(() => {
    if (!user.value || !user.value.name) return "JD"; // Fallback
    const nameParts = user.value.name.split(" ");
    const initials = nameParts.map((part) => part[0]).join("");
    return initials;
});

const confirmingLogout = ref(false);
</script>

<template>
    <div
        class="hidden w-64 border-r border-base-content/20 px-6 py-16 md:flex md:flex-col"
    >
        <div class="flex items-center gap-x-4">
            <img
                :src="`https://ui-avatars.com/api/?name=${userInitials}`"
                alt="avatar"
                class="h-8 w-8 rounded-full"
            />
            <span>{{ user.name }}</span>
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
                    <button @click="confirmingLogout = true">Logout</button>
                </li>
            </ul>
        </div>
        <div class="divider" />
        <div>Categories</div>
        <div class="divider" />
        <div>Tags</div>

        <!-- Logout Modal -->
        <Modal :show="confirmingLogout" @close="confirmingLogout = false">
            <div class="p-6">
                <h2 class="text-lg font-medium">
                    Are you sure you want to log out?
                </h2>

                <div class="mt-6 flex justify-end gap-4">
                    <button class="btn" @click="confirmingLogout = null">
                        Cancel
                    </button>

                    <Link
                        :href="route('logout')"
                        as="button"
                        class="btn btn-primary"
                        method="post"
                        type="button"
                    >
                        Logout
                    </Link>
                </div>
            </div>
        </Modal>
    </div>
</template>
