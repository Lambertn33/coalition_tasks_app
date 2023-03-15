<template>
  <div class="card" style="width: 18rem;">
    <img src="../../images/card_cover.jfif" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title"><b>{{ project.name }}</b></h5>
      <p class="card-text">{{ project.description }}</p>
      <a href="#" class="btn btn-info">View related tasks</a>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      project: Object
    }
  }
</script>

<style>
  .btn-info {
    color: #fff;
    font-weight: 700;
  }
</style>