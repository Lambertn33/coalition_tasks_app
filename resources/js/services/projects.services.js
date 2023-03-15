import axios from "axios";

import constants from '../constants/constants';

const endpointUrl = constants.API_URL;

class ProjectsServices {
  getAllProjects() {
    return axios.get(`${endpointUrl}/projects`);
  }

  createNewProject(newProject) {
    const newProjectObject = {
      name: newProject.name,
      description: newProject.description
    }
    return axios.post(`${endpointUrl}/projects`, newProjectObject);
  }
}

export default new ProjectsServices;