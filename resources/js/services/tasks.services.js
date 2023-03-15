import axios from "axios";

import constants from '../constants/constants';

const endpointUrl = constants.API_URL;

class TasksServices {
  getAllTasks() {
    return axios.get(`${endpointUrl}/tasks`);
  }

  deleteTask(taskId) {
    return axios.delete(`${endpointUrl}/tasks/${taskId}`);
  }

  // createNewProject(newProject) {
  //   const newProjectObject = {
  //     name: newProject.name,
  //     description: newProject.description
  //   }
  //   return axios.post(`${endpointUrl}/projects`, newProjectObject);
  // }
}

export default new TasksServices;