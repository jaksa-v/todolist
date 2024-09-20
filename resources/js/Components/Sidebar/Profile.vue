<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import Modal from "@/Components/Modal.vue";

defineProps({
    closeDrawer: Function,
});

const confirmingLogout = ref(false);

const page = usePage();

const user = computed(() => page.props.auth.user);

const userInitials = computed(() => {
    if (!user.value || !user.value.name) return "JD"; // Fallback
    const nameParts = user.value.name.split(" ");
    return nameParts.map((part) => part[0]).join("");
});
</script>

<template>
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
                    active: page.component === 'Profile/Edit',
                }"
                :href="route('profile.edit')"
                @click="closeDrawer"
            >
                Profile Settings
            </Link>
        </li>
        <li>
            <button @click="confirmingLogout = true">Logout</button>
        </li>
    </ul>

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
</template>
