<script setup>
import ThemeSwitcher from "@/Components/ThemeSwitcher.vue";
import { Link, usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import Modal from "@/Components/Modal.vue";

const page = usePage();

const user = computed(() => page.props.auth.user);

const isDrawerOpen = ref(false);
const confirmingLogout = ref(false);

function closeDrawer() {
    setTimeout(() => {
        isDrawerOpen.value = false;
    }, 200);
}

const userInitials = computed(() => {
    if (!user.value || !user.value.name) return "JD"; // Fallback
    const nameParts = user.value.name.split(" ");
    const initials = nameParts.map((part) => part[0]).join("");
    return initials;
});
</script>

<template>
    <div class="min-h-screen">
        <div class="drawer lg:drawer-open">
            <input
                id="my-drawer-2"
                v-model="isDrawerOpen"
                class="drawer-toggle"
                type="checkbox"
            />
            <div
                class="drawer-content flex flex-col items-center justify-center"
            >
                <!-- Page content here -->
                <div
                    class="flex w-full justify-end gap-x-6 pr-4 pt-4 md:pr-6 md:pt-6"
                >
                    <ThemeSwitcher />
                    <label
                        class="btn btn-primary drawer-button lg:hidden"
                        for="my-drawer-2"
                    >
                        Open drawer
                    </label>
                </div>
                <main class="w-full flex-1 px-6 py-4 sm:px-0">
                    <slot />
                </main>
            </div>
            <div class="drawer-side">
                <label
                    aria-label="close sidebar"
                    class="drawer-overlay"
                    for="my-drawer-2"
                ></label>
                <div class="min-h-full w-80 bg-base-200 p-4 text-base-content">
                    <!-- Sidebar content here -->
                    <div class="flex items-center gap-x-4 px-2">
                        <img
                            :src="`https://ui-avatars.com/api/?name=${userInitials}`"
                            alt="avatar"
                            class="h-8 w-8 rounded-full"
                        />
                        <span>{{ user.name }}</span>
                    </div>
                    <ul class="menu">
                        <li>
                            <Link
                                :class="{
                                    active: $page.component === 'Todos/Index',
                                }"
                                :href="route('todos.index')"
                                @click="closeDrawer"
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
                                @click="closeDrawer"
                            >
                                Profile Settings
                            </Link>
                        </li>
                        <li>
                            <button @click="confirmingLogout = true">
                                Logout
                            </button>
                        </li>
                    </ul>
                    <div class="divider" />
                    <div>Categories</div>
                    <div class="divider" />
                    <div>Tags</div>
                </div>
            </div>
        </div>

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
