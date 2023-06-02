<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
    project: Object,
});

const form = useForm({
    name: props.project?.name ?? "",
});

const isEditing = Boolean(props.project?.id);

const handleSubmit = () => {
    if (isEditing) {
        form.put(route("project.update", props.project.id));
    } else {
        form.post(route("project.store"));
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
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 rounded-md"
                                required
                            />
                            <template v-if="form.errors.name">
                                <p class="mt-2 text-sm text-red-500">
                                    {{ errors.name }}
                                </p>
                            </template>
                        </div>
                    </div>

                    <div
                        class="px-6 py-4 bg-gray-100 dark:bg-gray-700 flex justify-end"
                    >
                        <a
                            :href="route('project.index')"
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
