<template>
  <div id="home" class="container-fluid text-align-center">
    <h1>Bienvenue</h1>

    <div v-if="loading" class="spinner-grow" role="status">
      <span class="visually-hidden">Chargement...</span>
    </div>

    <div v-else>
      <div>
        <h2>Rechercher une tâche</h2>
        <SearchBar @apply-filter="taskStore.debounceNameFilter" />
      </div>

      <br />

      <h2>Ajouter une tâche</h2>

      <div class="row g-2 align-items-center">
        <div class="col-auto">
          <input
            type="text"
            class="form-control"
            v-model="newTask"
            placeholder="encore une super tâche"
          />
        </div>
        <div class="col-auto">
          <input
            type="text"
            class="form-control"
            v-model="newDescription"
            placeholder="description"
          />
        </div>
        <div class="col-auto">
          <input type="date" class="form-control" v-model="newDeadline" />
        </div>
        <div class="col-auto">
          <button class="btn btn-light" @click="addTask">Ajouter</button>
        </div>
      </div>

      <br />

      <h2>Mes tâches</h2>

      <div>
        <div class="btn-group">
          <button class="btn btn-light" @click="setSelectedStatus('all')">
            Tous
          </button>
          <button class="btn btn-light" @click="setSelectedStatus('à faire')">
            À faire
          </button>
          <button class="btn btn-light" @click="setSelectedStatus('terminée')">
            Terminée
          </button>
        </div>
      </div>

      <br />

      <div class="table-responsive" data-bs-theme="dark">
        <List v-if="filteredTasks.length > 0" :tasks="filteredTasks"></List>
        <p v-else>Vous n'avez aucune tâche programmée</p>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import SearchBar from "./TheSearchBar.vue";
import List from "./TodoList.vue";

import { useTaskStore } from "../store/store";

export default {
  created() {
    this.loading = true;
    // Appel de l'action pour récupérer les tâches depuis l'API
    useTaskStore()
      .fetchTasks()
      // Si l'appel est réussi, le chargment passe à faux
      .then(() => {
        this.loading = false;
      })
      .catch((error) => {
        console.error("Erreur lors du chargement des tâches", error);
        this.loading = false;
      });
  },

  setup() {
    const taskStore = useTaskStore();
    return { taskStore };
  },

  components: {
    SearchBar,
    List,
  },

  data() {
    return {
      newTask: "",
      newDescription: "",
      newDeadline: "",
      loading: false,
    };
  },

  methods: {
    async addTask() {
      this.loading = true;
      try {
        await this.taskStore.addTask(
          this.newTask,
          this.newDescription,
          this.newDeadline,
        );
        this.newTask = "";
        this.newDescription = "";
        this.newDeadline = "";
      } catch (error) {
        console.error("Erreur lors de l'ajout de la tâche", error);
      } finally {
        this.loading = false;
      }
    },

    setSelectedStatus: function (status: string) {
      this.taskStore.setStatus(status);
    },
  },

  computed: {
    filteredTasks: function () {
      return this.taskStore.filtered;
    },
  },
};
</script>
