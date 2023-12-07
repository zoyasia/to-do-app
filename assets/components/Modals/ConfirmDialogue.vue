<template>
    <PopupModal v-if="modelValue">
        <template v-slot:header>{{ title }}</template>
        <template v-slot:body>{{ message }}</template>
        <template v-slot:footer>
            <div class="btns">
                <button class="btn btn-secondary" @click="cancel">{{ cancelButton }}</button>
                <button class="btn btn-danger" @click="confirmDelete">{{ deleteButton }}</button>
            </div>
        </template>
    </PopupModal>
</template>

<script lang="ts">
import PopupModal from './PopupModal.vue'

export default {

    name: 'ConfirmDialogue',

    components: { PopupModal },

    props: {
        modelValue: Boolean, // Déclare la prop qui sera utilisée pour v-model
    },

    data: () => ({
        title: 'Confirmation suppression',
        message: 'Êtes-vous sûr.e de vouloir supprimer cette tâche ?',
        deleteButton: 'Supprimer',
        cancelButton: 'Annuler',
    }),

    methods: {

        confirmDelete() {
            this.$emit('delete'); // Émettre un événement de suppression vers le parent (Task.vue)
        },

        cancel() {
            this.$emit('cancel');
        }

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