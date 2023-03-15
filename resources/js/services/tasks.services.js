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