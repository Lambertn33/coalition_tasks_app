<template>
  <nav class="navbar navbar-expand-lg bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand logo" href="#">Tasks App</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav me-auto">
        <li class="nav-item" v-for="link in links" :key="link.name">
          <router-link class="nav-link active" aria-current="page" :to="link.href">{{ link.name }}</router-link>
        </li>
      </ul>
    </div>
  </div>
</nav> 
</template>

<script>
  export default {
    data() {
      return {
        links: [
          {
            name: 'Projects List',
            href: "/projects/index",
          },
          {
            name: 'Tasks List',
            href: "/projects/create",
          },
        ],
      }
    },
  }
</script>

<style scoped>
  .icon {
    color: #fff;
  }
  .navbar {
    padding: 1rem;
  }
  .navbar-nav {
    display: flex;
    gap: 1.5rem;
  }
  .navbar-brand,
  .nav-link {
    color: white !important;
    font-weight: 600;
  }
  .nav-item {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .navbar-collapse {
    margin-left: 2.5rem;
  }
  .nav-link:hover {
    transition: .4s;
    color:turquoise;
  }
  a.router-link-exact-active {
    color: black !important;
  }
</style>