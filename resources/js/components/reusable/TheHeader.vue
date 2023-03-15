<template>
  <div class="header-container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item" v-for="link in renderLinks" :key="link.to">
          <router-link :to="link.to" active-class="active">{{ link.label }}</router-link>
        </li>
      </ol>
    </nav>
  </div>
</template>

<script>
  export default {
    props: {
      linkType: String
    },
    data() {
      return {
        projectLinks: [
          {
            to: "/projects/index",
            label: "View Projects"
          },
          {
            to: "/projects/create",
            label: "Add new project"
          },  
        ],
        tasksLinks: [
          {
            to: "/tasks/index",
            label: "View Tasks"
          },
          {
            to: "/tasks/create",
            label: "Add new Task"
          },  
        ]
      }
    },
    computed: {
      renderLinks() {
         return this.linkType === "Tasks" ?
          this.tasksLinks : this.projectLinks;
      }
    }
  }
</script>

<style scoped>
  nav {
    padding: 0;
  }
  .header-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 1.5rem;
    text-align: center;
    width: 100%;
  }
  .breadcrumb-item {
    font-weight: bold;
  }
  .breadcrumb-item a {
    text-decoration: none;
  }
  .router-link-exact-active {
    color: black;
  }
</style>