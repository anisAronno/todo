<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
    projects: Object,
    task: Object,
});

const form = useForm({
    name: props.task?.name ?? "",
    priority: props.task?.priority ?? "",
    project_id: props.task?.project_id ?? "",
});

const isEditing = Boolean(props.task?.id);

const handleSubmit = () => {
    if (isEditing) {
        form.put(route("task.update", props.task?.id));
    } else {
        form.post(route("task.store"));
    }
};
</script>

<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
            >
                <form @submit.prevent="handleSubmit">
                    <div class="p-6 space-y-4">
                        <div class="flex flex-col">
                            <label
                                for="name"
                                class="text-sm font-medium text-gray-700 dark:text-gray-300"
                            >
                                Name
                            </label>
                            <input
                                id="name"
                                type="text"
                                v-model="form.name"
                                :class="{ 'border-red-500': form.errors.name }"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded-md dark:text-gray-100"
                                required
                            />
                            <template v-if="form.errors.name">
                                <p class="mt-2 text-sm text-red-500">
                                    {{ form.errors.name }}
                                </p>
                            </template>
                        </div>
                        <div class="flex flex-col">
                            <label
                                for="priority"
                                class="text-sm font-medium text-gray-700 dark:text-gray-300"
                            >
                                Priority
                            </label>
                            <input
                                id="priority"
                                type="number"
                                v-model="form.priority"
                                :class="{
                                    'border-red-500': form.errors.priority,
                                }"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded-md dark:text-gray-100"
                                required
                            />
                            <template v-if="form.errors.priority">
                                <p class="mt-2 text-sm text-red-500">
                                    {{ form.errors.priority }}
                                </p>
                            </template>
                        </div>
                        <div class="flex flex-col">
                            <label
                                for="project_id"
                                class="text-sm font-medium text-gray-700 dark:text-gray-300"
                            >
                                Project
                            </label>
                            <select
                                name="project_id"
                                id="project_id"
                                type="number"
                                v-model="form.project_id"
                                :class="{
                                    'border-red-500': form.errors.priority,
                                }"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded-md dark:text-gray-100 my-5"
                                required
                            >
                                <option value="">Select Project</option>
                                <option
                                    :value="project.id"
                                    v-for="project in projects"
                                    :key="project.id"
                                    :selected="project.id == form?.project_id"
                                >
                                    {{ project.name }}
                                </option>
                            </select>

                            <template v-if="form.errors.project_id">
                                <p class="mt-2 text-sm text-red-500">
                                    {{ form.errors.project_id }}
                                </p>
                            </template>
                        </div>
                    </div>

                    <div
                        class="px-6 py-4 bg-gray-100 dark:bg-gray-700 flex justify-end"
                    >
                        <a
                            :href="route('task.index')"
                            class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600"
                        >
                            Cancel
                        </a>
                        <button
                            type="submit"
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            {{ isEditing ? "Update" : "Create" }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
