import projectsServices from "../services/projects.services";

export const projectsStore = {
  state: {
    allProjects: []
  },

  actions: {
    fetchAllProjects({ commit }) {
      return projectsServices.getAllProjects().then(
        response => {
          const { projects } = response.data;
          commit('setProjects', [projects]);
          return Promise.resolve(response);
        },
        error => {
          return Promise.reject(error);
        }
      );
    }
  },

  mutations: {
    setProjects(state, projects) {
      state.allProjects = projects;
    }
  },

  getters: {
    getProjects(state) {
      return state.allProjects;
    }
  }
};
