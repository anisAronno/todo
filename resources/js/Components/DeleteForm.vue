<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const modalShow = ref(false);
const emit = defineEmits(["success"]);
const props = defineProps({
    data: Object,
});
const form = useForm({});
const confirmDeletion = () => {
    modalShow.value = true;
};

const deleteRecord = (id) => {
    form.delete(route(`${props.data.model}.destroy`, id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    modalShow.value = false;
    emit("success", true);
};
</script>

<template>
    <section>
        <DangerButton @click.prevent="confirmDeletion">
            delete
            <slot></slot>
        </DangerButton>

        <Modal :show="modalShow" @close="closeModal">
            <div class="p-6">
                <h2
                    class="text-lg font-medium text-gray-900 dark:text-gray-100"
                >
                    Are you sure you want to delete this {{ data.model }}?
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Once is deleted, all of its resources and data will be
                    permanently deleted.
                </p>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>

                    <DangerButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteRecord(data.id)"
                    >
                        Delete
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
