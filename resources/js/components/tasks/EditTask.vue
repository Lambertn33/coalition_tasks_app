<template>
  <div class="row py-4">
     <div class="col-md-12">
       <div class="row">
         <h2 class="text-center py-4"><b>Edit Task</b></h2>
         <div class="col-md-10 offset-md-1">
          <form>

            <div class="mb-3">
              <label class="form-label">Task name</label>
              <input
                class="form-control" 
                type="text"
                :value="task.name"
              >
            </div>
            <div class="mb-3">
              <label class="form-label">Task Project</label>
              <select class="form-select">
                <option
                  v-for="project in allProjects"
                  :key="project.id"
                  :value="project.id"
                  :selected=getCurrentProject(project.id)
                  >{{ project.name }}</option>
              </select>
            </div>
            <div class="footer">
              <button type="submit" class="btn btn-success">Update Task</button>
              <button type="button" @click="$emit('onClose')" class="btn btn-info">Close</button>
            </div>
          </form>
        </div>
       </div>
     </div>
  </div>
 </template>
 
 <script>
  export default {
    data() {
      return {
        allProjects: [],
      }
    },
    props: {
      task: Object
    },
    emits: ['onClose'],
    computed: {
      getCurrentProject() {
        return projectId => this.task.project_id == projectId ? true : false;
      }
    },
    mounted() {
      console.log('kekeke', this.$store.getters.getProjects)
      this.allProjects = this.$store.getters.getProjects
    }
  }
 </script>

 <style scoped>
  .footer {
    display: flex;
    gap: 0.5rem;
  }
</style>  