import { createRouter, createWebHistory } from 'vue-router';

import NewProject from './components/projects/NewProject.vue';

import ProjectsList from './components/projects/ProjectsList.vue';

import TasksList from './components/tasks/TasksList.vue';

import NewTask from './components/tasks/NewTask.vue';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/', redirect: '/projects/index' },
    { path: '/projects', children: [
      { path: 'index', component: ProjectsList },
      { path: 'create', component: NewProject }
    ]},
    { path: '/tasks', children: [
      { path: 'index', component: TasksList },
      { path: 'create', component: NewTask }
    ]}
  ]
});

export default router;