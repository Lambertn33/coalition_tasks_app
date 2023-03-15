<template>
  <div class="row py-4">
    <the-spinner v-if="isFetching" />
    <div class="col-md-12" v-else>
      <the-header linkType="projects" />
      <router-view />
      <div class="row">
        <h2 class="text-center py-4"><b>Projects List</b></h2>
        <div class="col-md-4" v-for="project in projects" :key="project.id">
          <project-details :project="project" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ProjectDetails from '../projects/ProjectDetails.vue';
export default {
  components: { ProjectDetails },
  data() {
    return  {
      projects: [],
      isFetching: false,
    }
  },
  methods: {
    async fetchProjects() {
      this.isFetching = true;
      const response = await this.$store.dispatch('fetchAllProjects');
      const { projects } = response.data;
      this.projects = projects;
      this.isFetching = false;
    }
  },
  mounted() {
    this.fetchProjects();
  }
}
</script>