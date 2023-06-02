<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteForm from "@/Components/DeleteForm.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Link } from "@inertiajs/vue3";

import Form from "./Form.vue";

defineProps({
    projects: Object,
    task: Object,
});
</script>

<template>
    <Head title="Edit" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Edit Task
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg relative"
                >
                    <div class="flex justify-items-end my-5">
                        <div class="absolute right-5 top-0">
                            <primary-button>
                                <Link
                                    :href="route('task.index')"
                                    class="btn btn-primary"
                                >
                                    View All
                                </Link>
                            </primary-button>
                        </div>
                    </div>
                    <Form :projects="projects" :task="task"></Form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
