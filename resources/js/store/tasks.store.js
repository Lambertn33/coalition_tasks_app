import tasksServices from "../services/tasks.services";

export const tasksStore = {
  state: {
    allTasks: []
  },

  actions: {
    fetchAllTasks({ commit }) {
      return tasksServices.getAllTasks().then(
        response => {
          const { tasks } = response.data;
          commit('setProjects', [tasks]);
          return Promise.resolve(response);
        },
        error => {
          return Promise.reject(error);
        }
      );
    },
    
    deleteTask({commit}, taskId) {
      return tasksServices.deleteTask(taskId).then(
        response => {
          return Promise.resolve(response.data);
        },
        error => {
          return Promise.reject(error);
        }
      );
    }
  },  

  mutations: {
    setTasks(state, tasks) {
      state.allTasks = tasks;
    }
  }
}