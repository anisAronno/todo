<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteForm from "@/Components/DeleteForm.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    projects: Object,
});
</script>

<template>
    <Head title="Project" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Project
            </h2>
        </template>
        <div class="sm:flex sm:items-center relative my-5">
            <div
                class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none space-x-1 sm:space-x-2 space-y-2 sm:space-y-0 absolute right-5 top-1"
            >
                <primary-button>
                    <Link
                        :href="route('project.create')"
                        class="btn btn-primary"
                    >
                        Create New
                    </Link>
                </primary-button>
                <primary-button>
                    <Link
                        :href="route('project.index')"
                        class="btn btn-primary"
                    >
                        View All
                    </Link>
                </primary-button>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Name
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
                            <template v-if="projects.length === 0">
                                <tr>
                                    <td
                                        class="px-6 py-4 text-sm text-gray-500"
                                        colspan="2"
                                    >
                                        No projects found.
                                    </td>
                                </tr>
                            </template>
                            <template v-else>
                                <tr
                                    v-for="project in projects"
                                    :key="project.id"
                                >
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ project.name }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap flex gap-3"
                                    >
                                        <PrimaryButton>
                                            <a
                                                :href="
                                                    route('project.index', {
                                                        projectId: project.id,
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
                                                    route(
                                                        'project.edit',
                                                        project.id
                                                    )
                                                "
                                                class="text-blue-600 hover:text-blue-900 ml-2"
                                            >
                                                Edit
                                            </a>
                                        </PrimaryButton>
                                        <DeleteForm
                                            :data="{
                                                id: project.id,
                                                model: 'project',
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
