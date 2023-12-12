<template id="table">
  <td>
    <input
      v-model="isChecked"
      type="checkbox"
      @change="updateTaskStatus()"
    />
  </td>
  <th>{{ task.title }}</th>
  <td>{{ task.description }}</td>
  <td>{{ task.status }}</td>
  <td>{{ task.deadline }}</td>
  <td>
    <button class="btn btn-danger" @click="showConfirm = true">
      Supprimer
    </button>
    <ConfirmDialogue
      v-model="showConfirm"
      @close="closeDelete()"
      @cancel="showConfirm = false"
      @delete="removeTask"
    >
    </ConfirmDialogue>

    <button class="btn btn-primary" @click="showUpdate = true">Modifier</button>
    <UpdateDialogue
      v-model="showUpdate"
      :task="task"
      @close="closeUpdate()"
      @cancel="showUpdate = false"
      @update="updateTask"
      :title="title"
    >
    </UpdateDialogue>
  </td>
</template>

<script lang="ts">
import type { ITask } from "../store/store";
import { useTaskStore } from "../store/store";
import ConfirmDialogue from "../components/Modals/ConfirmDialogue.vue";
import UpdateDialogue from "./Modals/UpdateDialogue.vue";

export default {
  setup(props) {
    const taskStore = useTaskStore();
   
    return { taskStore };
  },

  props: {
    task: {
      type: Object as () => ITask,
      required: true,
    },
  },
  mounted: function () {
    this.isChecked = this.task.isCompleted
  },
  data() {
    return {
      showConfirm: false,
      showUpdate: false,
      title: "",
      description: "",
      deadline: "",
      isChecked: false
    };
  },

  components: { ConfirmDialogue, UpdateDialogue },

  methods: {
    updateTaskStatus: function () {
      const newtask = {...this.task}
    
      if (this.task.id) {
        newtask.isCompleted = this.isChecked;
        newtask.status = this.isChecked ? "terminée" : "à faire";
      }
      this.taskStore.updateTask(this.task.id, newtask)
    },

    updateTask(data: ITask) {
      const updatedTask = { ...this.task, ...data };

      this.taskStore.updateTask(this.task.id, updatedTask);
      this.showUpdate = false;
    },

    removeTask() {
      this.taskStore.removeTask(this.task.id);
      this.showConfirm = false;
    },

    closeDelete() {
      this.showConfirm = false;
    },

    closeUpdate() {
      this.showUpdate = false;
    },

  },
};
</script>
