<template>
  <table class="table table-bordered" id="list">
    <thead>
      <tr>
        <th class="col"></th>
        <th class="col">Tâche</th>
        <th class="col">Description</th>
        <th class="col">Statut</th>
        <th class="col">Échéance</th>
        <th class="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="task in tasks" v-bind:key="task.id">
        <Task :task="task"></Task>
      </tr>
    </tbody>
  </table>
</template>

<script lang="ts">
import Task from "./TodoTask.vue";
import { type ITask } from "../store/store";

export default {
  components: {
    Task,
  },

  props: {
    tasks: {
      type: Array as () => ITask[],
    },
  },
};
</script>
