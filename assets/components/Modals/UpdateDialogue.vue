<template>
    <PopupModal v-if="modelValue">

        <template v-slot:header>{{ modalTitle }}</template>

        <template v-slot:body>
            <div>
                <label for="newTitle">Intitulé de la tâche :</label>
                <input v-model="title" name="newTitle" type="text" class="form-control">
            </div>
            <div>
                <label for="newDescription">Description :</label>
                <input v-model="description" name="newDescription" type="text" class="form-control">
            </div>
            <div>
                <label for="newDeadline">Deadline :</label>
                <input v-model="deadline" name="newDeadline" type="date" class="form-control">
            </div>
        </template>

        <template v-slot:footer>
            <div class="btns">
                <button class="btn btn-secondary" @click="cancel">{{ cancelButton }}</button>
                <button class="btn btn-success" @click="confirmUpdate">{{ updateButton }}</button>
            </div>
        </template>

    </PopupModal>
</template>

<script lang="ts">
import PopupModal from './PopupModal.vue';
import type { ITask } from '@/store/store';

export default {

    name: 'UpdateDialogue',

    components: { PopupModal },

    props: {
        modelValue: Boolean, // Déclare la prop qui sera utilisée pour v-model
        task: Object as () => ITask,
    },

    data: () => ({
        modalTitle: 'Modification',
        updateButton: 'Enregistrer',
        cancelButton: 'Annuler',
        title: '',
        description: '',
        deadline: '',
    }),

    emits: ["update", "cancel", "closeUpdate", "update:modelValue"],

    watch: {
        task: {
            immediate: true, // se déclenche au mount
            handler(newTask) {
                this.title = newTask.title || ''; // passe une string vide si undefined
                this.description = newTask.description || '';
                this.deadline = newTask.deadline || '';
            },
        },
    },

    methods: {

        confirmUpdate() {
            this.$emit('update', {
                title: this.title,
                description: this.description,
                deadline: this.deadline,
            });
        },

        cancel() {
            this.$emit('cancel');
        },

        closeModal() {
            this.$emit('closeUpdate');
        },
    },
}
</script>

<style scoped>
.btns {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}
</style>