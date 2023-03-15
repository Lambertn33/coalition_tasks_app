import tasksServices from "../services/tasks.services";

export const tasksStore = {
  state: {
    allTasks: []
  },

  actions: {
    fetchAllTasks({ commit }) {
      return tasksServices.getAllTasks().then(
        response => {
          return Promise.resolve(response.data);
        },
        error => {
          return Promise.reject(error);
        }
      );
    },

    fetchSingleTask({ commit }, taskId) {
      return tasksServices.getTask(taskId).then(
        response => {
          return Promise.resolve(response.data);
        },
        error => {
          return Promise.reject(error);
        }
      );
    },

    createNewTask({ commit }, newTask) {
      return tasksServices.createNewTask(newTask).then(
        response => {
          return Promise.resolve(response);
        },
        error => {
          return Promise.reject(error);
        }
      )
    },

    updateTask({ commit }, { taskId, updatedTaskObject }) {
      return tasksServices.updateTask(taskId, updatedTaskObject).then(
        response => {
          return Promise.resolve(response);
        },
        error => {
          return Promise.reject(error);
        }
      )
    },

    updateTasksPrioritiesByDragAndDrop({ commit }, { taskId, prioritiesObject }){
      return tasksServices.updateTasksPrioritiesByDragAndDrop(taskId, prioritiesObject).then(
        response => {
          return Promise.resolve(response);
        },
        error => {
          return Promise.reject(error);
        }
      )
    },
    
    deleteTask({ commit }, taskId) {
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
  },

  getters: {
    getTasks(state) {
      return state.allTasks;
    }
  }
}