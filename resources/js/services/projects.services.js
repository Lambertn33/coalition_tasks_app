import axios from "axios";

import constants from '../constants/constants';

const endpointUrl = constants.API_URL;

class ProjectsServices {
  getAllProjects() {
    return axios.get(`${endpointUrl}/projects`);
  }
}

export default new ProjectsServices;