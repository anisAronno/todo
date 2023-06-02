<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteForm from "@/Components/DeleteForm.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    tasks: Object,
});
</script>

<template>
    <Head title="Task" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Task
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
                                    :href="route('task.create')"
                                    class="btn btn-primary"
                                >
                                    Create New
                                </Link>
                            </primary-button>
                        </div>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Name
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Priority
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Project
                                </th>
                                <!-- Add more table headers as needed -->
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <template v-if="tasks.length === 0">
                                <tr>
                                    <td
                                        class="px-6 py-4 text-sm text-gray-500"
                                        colspan="3"
                                    >
                                        No tasks found.
                                    </td>
                                </tr>
                            </template>
                            <template v-else>
                                <tr v-for="task in tasks" :key="task.id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ task.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ task.priority }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ task.project?.name }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap flex gap-3"
                                    >
                                        <PrimaryButton>
                                            <a
                                                :href="
                                                    route('task.index', {
                                                        taskId: task.id,
                                                    })
                                                "
                                                class="text-indigo-600 hover:text-indigo-900"
                                            >
                                                View
                                            </a>
                                        </PrimaryButton>
                                        <PrimaryButton>
                                            <a
                                                :href="
                                                    route('task.edit', task.id)
                                                "
                                                class="text-blue-600 hover:text-blue-900 ml-2"
                                            >
                                                Edit
                                            </a>
                                        </PrimaryButton>

                                        <DeleteForm
                                            :data="{
                                                id: task.id,
                                                model: 'task',
                                            }"
                                        ></DeleteForm>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
