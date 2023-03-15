import { createStore } from "vuex";

import { projectsStore } from "./projects.store";

import createPersistedState from "vuex-persistedstate";

const store = createStore({ 
  plugins: [createPersistedState()],
  modules: {
    projectsStore
  }
});

export default store;

