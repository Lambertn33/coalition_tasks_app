<template>
 <div class="row py-4">
  <the-spinner v-if="isFetching" />
    <div class="col-md-12" v-else>
      <the-header linkType="Tasks" />
      <router-view />
      <div class="row">
        <h2 class="text-center py-4"><b>Tasks List</b></h2>
        <span class="text-danger pb-4"><b>N.B: Drag Table columns to update task priority</b></span>
        <table class="table table-striped" v-if="tasks.length">
          <thead>
            <tr>
              <th scope="col">TASK NAME</th>
              <th scope="col">TASK PROJECT</th>
              <th scope="col">TASK PRIORITY</th>
              <th scope="col">ACTION</th>
            </tr>
          </thead>
            <draggable tag="tbody" @end="updateByPriority" v-model="tasks" item-key="id">
              <template #item="{ element}">
                <tr>
                  <td>{{ element.name }}</td>
                  <td>{{element.project.name  }}</td>
                  <td>{{ element.priority }}</td>
                  <td class="td-actions">
                    <edit-icon @click="editTask(element.id)"/>
                    <delete-icon @click="deleteTask(element.id)"/>
                  </td>
                </tr>
              </template>
            </draggable>
        </table>
        <h6 v-else class="text-center text-danger"><b>No Task available now</b></h6>
      </div>
    </div>
 </div>
</template>

<script>
  import EditIcon from 'vue-material-design-icons/Pencil.vue';
  import DeleteIcon from 'vue-material-design-icons/Delete.vue';
  import Draggable from 'vuedraggable';

  import EditTask from './EditTask.vue';
  export default {
    components: {
      EditIcon,
      DeleteIcon,
      Draggable
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

      async updateByPriority(evt) {
        const taskId = evt.item._underlying_vm_.id;
        const oldPriority = evt.oldIndex + 1;
        const newPriority = evt.newIndex + 1;
        const priorites = { 
          oldPriority,
          newPriority
        };
        const response = await this.$store.dispatch('updateTasksPrioritiesByDragAndDrop', {
          'taskId': taskId, 
          'prioritiesObject': priorites
        });
        const { message: successMessage } = response.data;
        this.$swal({title: 'Success',text: successMessage, type: 'success'}).then(okay => {
          if( okay) {
            window.location.reload();
          }
        });
      },

      openModal(task) {
        this.$vbsModal
          .open({
            content: EditTask,
            contentProps: {
             task: task
            },
            contentEmits: {
              onClose: this.closeModal,
              updateTask: this.updateTask
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

      async updateTask(taskId, updatedTask) {
        const response = await this.$store.dispatch('updateTask', {
          'taskId': taskId, 
          'updatedTaskObject': updatedTask
        });
        const { message: successMessage } = response.data;
        this.closeModal();
        this.$swal({title: 'Success',text: successMessage, type: 'success'}).then(okay => {
          if( okay) {
            window.location.reload();
          }
        });
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
    border: 0.0625rem solid gainsboro;
  }
  .table td.td-actions {
    display: flex;
    gap: 1.5rem;
    cursor: pointer;
  }
</style>