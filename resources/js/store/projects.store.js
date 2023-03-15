import projectsServices from "../services/projects.services";

export const projectsStore = {
  state: {
    allProjects: []
  },

  actions: {
    fetchAllProjects({ commit }) {
      return projectsServices.getAllProjects().then(
        response => {
          return Promise.resolve(response.data);
        },
        error => {
          return Promise.reject(error);
        }
      );
    },

    createNewProject({ commit }, newProject) {
      return projectsServices.createNewProject(newProject).then(
        response => {
          commit('addProject', newProject);
          return Promise.resolve(response);
        },
        error => {
          return Promise.reject(error);
        }
      )
    }
  },

  mutations: {
    setProjects(state, projects) {
      state.allProjects = projects;
    },
    addProject(state, newProject) {
      state.allProjects.push(newProject);
    }
  },

  getters: {
    getProjects(state) {
      return state.allProjects;
    }
  }
};
