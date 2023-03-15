<template>
 <div class="row py-4">
  <the-spinner v-if="isFetching" />
    <div class="col-md-12" v-else>
      <the-header linkType="Tasks" />
      <router-view />
      <div class="row">
        <h2 class="text-center py-4"><b>Tasks List</b></h2>
        <table class="table table-striped" v-if="tasks.length">
          <thead>
            <tr>
              <th scope="col">TASK NAME</th>
              <th scope="col">TASK PROJECT</th>
              <th scope="col">TASK PRIORITY</th>
              <th scope="col">ACTION</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="task in tasks" :key="task.id">
              <td>{{ task.name }}</td>
              <td>{{task.project.name  }}</td>
              <td>{{ task.priority }}</td>
              <td class="td-actions">
                <edit-icon @click="editTask(task.id)"/>
                <delete-icon @click="deleteTask(task.id)"/>
              </td>
            </tr>
          </tbody>
        </table>
        <h6 v-else class="text-center text-danger"><b>No Task available now</b></h6>
      </div>
    </div>
 </div>
</template>

<script>
  import EditIcon from 'vue-material-design-icons/Pencil.vue';
  import DeleteIcon from 'vue-material-design-icons/Delete.vue';

  import EditTask from './EditTask.vue';
  export default {
    components: {
      EditIcon,
      DeleteIcon
    },
    data() {
      return {
        tasks: [],
        isFetching: false,
      }
    },
    methods: {
      async fetchTasks() {
        this.isFetching = true;
        const response = await this.$store.dispatch('fetchAllTasks');
        const { tasks } = response;
        this.$store.commit('setTasks', tasks);
        this.tasks = tasks;
        this.isFetching = false;
      },

      openModal(task) {
        this.$vbsModal
          .open({
            content: EditTask,
            contentProps: {
             task: task
            },
            contentEmits: {
              onClose: this.closeModal
            },
            center: true,
            backgroundScrolling: true,
            staticBackdrop: true,
          });
      },

      closeModal() {
        this.$vbsModal.close();
      },

      async editTask(taskId) {
        const response = await this.$store.dispatch('fetchSingleTask', taskId);
        const { task } = await response;
        this.openModal(task);
      },

      async deleteTask(taskId) {
        const response = await this.$store.dispatch('deleteTask', taskId);
        const { message: successMessage } = await response;
        this.tasks = this.tasks.filter((task) => {
          return task.id !==taskId;
        }); 
        this.$swal({title: 'Success',text: successMessage, type: 'success'});    
      }
    },
    mounted() {
      this.fetchTasks();
    }
  };
</script>

<style>
  .table {
    border: 1px solid gainsboro;
  }
  .table td.td-actions {
    display: flex;
    gap: 0.5rem;
    cursor: pointer;
  }
</style>