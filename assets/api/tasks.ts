import axios from "axios";
import { ITask } from "../store/store";

const API_URL = "http://localhost:8000";

export const fetchAll = async () => {
  try {
    const response = await axios.get(`${API_URL}/tasks`);
    return response.data;
  } catch (error) {
    console.error("Erreur lors de la récupération des tâches", error);
    throw error;
  }
};

export const create = async (newTaskData: ITask) => {
  try {
    const response = await axios.post(`${API_URL}/tasks`, newTaskData);
    return response.data;
  } catch (error) {
    console.error("Erreur lors de la création d'une tâche", error);
    throw error;
  }
};

export const update = async (taskId: number, updatedTaskData: ITask) => {
  try {
    const response = await axios.patch(
      `${API_URL}/task/${taskId}`,
      updatedTaskData,
    );
    return response.data;
  } catch (error) {
    console.error("Erreur lors de la mise à jour de la tâche", error);
    throw error;
  }
};

export const remove = async (taskId: number) => {
  try {
    const response = await axios.delete(`${API_URL}/task/${taskId}`);
    return response.data;
  } catch (error) {
    console.error("Erreur lors de la suppression de la tâche", error);
    throw error;
  }
};
