import axios from "axios";

import constants from '../constants/constants';

const endpointUrl = constants.API_URL;

class TasksServices {
  getAllTasks() {
    return axios.get(`${endpointUrl}/tasks`);
  }

  getTask(taskId) {
    return axios.get(`${endpointUrl}/tasks/${taskId}`);
  }

  updateTask(taskId, updatedTask) {
    const updatedTaskObject = {
      name: updatedTask.name,
      project: updatedTask.project
    }
    return axios.put(`${endpointUrl}/tasks/${taskId}`, updatedTaskObject);
  }

  deleteTask(taskId) {
    return axios.delete(`${endpointUrl}/tasks/${taskId}`);
  }

  createNewTask(newTask) {
    const newTaskObject = {
      name: newTask.name,
      project: newTask.project
    }
    return axios.post(`${endpointUrl}/tasks`, newTaskObject);
  }
}

export default new TasksServices;