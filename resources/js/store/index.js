import { createStore } from "vuex";

import { projectsStore } from "./projects.store";

import { tasksStore } from "./tasks.store";

import createPersistedState from "vuex-persistedstate";

const store = createStore({ 
  plugins: [createPersistedState()],
  modules: {
    projectsStore,
    tasksStore
  }
});

export default store;

