<script setup>
import ThemeSwitcher from "@/Components/ThemeSwitcher.vue";
import { usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import Profile from "@/Components/Sidebar/Profile.vue";
import Categories from "@/Components/Sidebar/Categories.vue";
import { Bars2Icon } from "@heroicons/vue/24/outline/index.js";

const page = usePage();

const user = computed(() => page.props.auth.user);

const isDrawerOpen = ref(false);

function closeDrawer() {
    setTimeout(() => {
        isDrawerOpen.value = false;
    }, 200);
}
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
                    class="flex w-full items-center justify-end gap-x-6 pr-4 pt-4 md:pr-6 md:pt-6"
                >
                    <ThemeSwitcher />
                    <label class="drawer-button lg:hidden" for="my-drawer-2">
                        <Bars2Icon
                            class="size-6 cursor-pointer hover:text-primary focus:text-primary"
                        />
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
                    <Profile :closeDrawer="closeDrawer" />
                    <div class="divider" />
                    <Categories :closeDrawer="closeDrawer" />
                    <div class="divider" />
                    <div>Tags</div>
                </div>
            </div>
        </div>
    </div>
</template>
