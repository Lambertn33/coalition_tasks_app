import { createRouter, createWebHistory } from 'vue-router';

import NewProject from './components/projects/NewProject.vue';

import ProjectsList from './components/projects/ProjectsList.vue';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/', redirect: '/projects/index' },
    { path: '/projects', children: [
      { path: 'index', component: ProjectsList },
      { path: 'create', component: NewProject }
    ]}
  ]
});

export default router;