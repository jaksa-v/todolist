<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { Head } from "@inertiajs/vue3";

defineOptions({ layout: AuthenticatedLayout });

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile" />

    <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
        <div class="border border-base-content/20 p-4 sm:rounded-lg sm:p-8">
            <UpdateProfileInformationForm
                :must-verify-email="mustVerifyEmail"
                :status="status"
                class="max-w-xl"
            />
        </div>

        <div class="border border-base-content/20 p-4 sm:rounded-lg sm:p-8">
            <UpdatePasswordForm class="max-w-xl" />
        </div>

        <div class="border border-base-content/20 p-4 sm:rounded-lg sm:p-8">
            <DeleteUserForm class="max-w-xl" />
        </div>
    </div>
</template>
