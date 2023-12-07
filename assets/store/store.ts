import { defineStore } from 'pinia'
import { fetchAll, create, update, remove } from '../api/tasks';

export interface ITask {
  id: number,
  title: string,
  description: string,
  deadline: string,
  status: string,
  isCompleted: boolean,
}

export const useTaskStore = defineStore('taskStore', {
  state: () => ({
    tasks: [] as ITask[],
    searchText: '',
    newTask: '',
    newDescription: '',
    newDeadline: '',
    selectedStatus: 'all',
    filterTimeout: 0,
  }),

  actions: {

    async fetchTasks() {
      try {
        const tasks = await fetchAll();
        this.tasks = tasks;
      } catch (error) {
        console.error('Erreur lors de la récupération des tâches dans le store', error);
      }
    },

    async addTask(newTask: string, newDescription: string, newDeadline: string) {
      if (newTask.trim() !== '') {
        try {
          const newTaskData = {
            title: newTask,
            description: newDescription,
            deadline: newDeadline,
          };
          await create(newTaskData);
          this.fetchTasks();
        } catch (error) {
          console.error('Erreur lors de l\'ajout de la tâche dans le store', error);
        }
      }
    },

    async removeTask(id: number) {
      try {
        await remove(id);
        this.fetchTasks();
      } catch (error) {
        console.error(`Erreur lors de la suppression de la tâche avec l\'ID ${id}`, error);
      }
    },

    async updateTask(id: number, updatedData: Partial<ITask>) {
      try {
        await update(id, updatedData);
        this.fetchTasks();
      } catch (error) {
        console.error('Erreur lors de la modification de la tâche avec l\'ID:' + id, error);
      }
    },

    setStatus(status: string) {
      this.selectedStatus = status;
    },

    applyFilterByName: function (query: string) {
      this.searchText = query;
    },

    debounceNameFilter: function (query: string) {
      // Annule le délai précédent s'il y en a un
      if (this.filterTimeout) {
        clearTimeout(this.filterTimeout);
      }
      // Définit un nouveau délai
      this.filterTimeout = setTimeout(() => {
        this.applyFilterByName(query);
      }, 360);
    },



  },

  getters: {

    getTasks(state): ITask[] {
      return state.tasks
    },

    filtered(state): ITask[] {
      // je duplique le tableau
      let tasksToFilter = state.tasks;
      this.selectedStatus = state.selectedStatus;
      // si la barre de recherche n'est pas vide
      if (state.searchText.trim() !== '') {
        tasksToFilter = tasksToFilter.filter(item =>
          item.title.toLowerCase().includes(state.searchText.toLowerCase())
        );
      };
      // si j'ai un statut !all, je filtre et retourne
      if (state.selectedStatus !== 'all') {
        tasksToFilter = tasksToFilter.filter(item => item.status === state.selectedStatus
        );
      }
      //je retourne le tableau
      return tasksToFilter;
    },

  },
})

