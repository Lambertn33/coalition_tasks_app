<template>
  <div class="row py-4">
     <div class="col-md-12">
       <the-header linkType="Tasks" />
       <router-view />
       <div class="row" v-if="allProjects.length">
         <h2 class="text-center py-4"><b>Create new task</b></h2>
         <div class="col-md-6 offset-md-3">
          <form v-on:submit.prevent="createNewTask">

            <div class="mb-3">
              <label class="form-label">Task name</label>
              <input
                class="form-control" 
                :class="validateNameClass ? 'error' : ''"
                type="text"
                v-model="newTaskData.name"
              >
              <span class="errorMessage" v-if="validateNameClass">
                {{ validationErrors.name }}
              </span>
            </div>

            <div class="mb-3">
              <label class="form-label">Task Project</label>
              <select class="form-select" :class="validateProjectClass ? 'error' : ''" v-model="newTaskData.project">
                <option selected value="">Select Project</option>
                <option v-for="project in allProjects" :key="project.id" :value="project.id">{{ project.name }}</option>
              </select>
              <span class="errorMessage" v-if="validateProjectClass">
                {{ validationErrors.project }}
              </span>
            </div>
            <button type="submit" class="btn btn-primary">Create Task</button>
          </form>
        </div>
       </div>
       <span class="text-danger pb-4 text-center" v-else><b>N.B: Create at least one project to proceed</b></span>
     </div>
  </div>
 </template>
 
 <script>
  import { useVuelidate } from '@vuelidate/core'
  import { required } from '@vuelidate/validators'
  export default {
    setup () {
      return { v$: useVuelidate() }
    },
    data() {
      return {
        hasValidationsErrors: false,
        isSubmitting: false,
        allProjects: [],
        newTaskData: {
          name: '',
          project: ''
        },
        validationErrors: {
          name: '',
          project: '',
        }
      }
    },
    validations() {
      return {
        newTaskData: {
          name: { required },
          project: { required }
        }
      }
    },
    methods: {
      async createNewTask() {
        this.v$.$validate();
        if (this.v$.$error) {
          this.hasValidationsError = true;
          if (this.v$.newTaskData.name.$errors.length) {
            this.validationErrors.name = 'the task name is required';
          }
          if (this.v$.newTaskData.project.$errors.length) {
            this.validationErrors.project = 'the task project is required';
          }
        } else {
          this.$isSubmitting = true;
          this.hasValidationsErrors = false;
          this.validationErrors.name = '';
          this.validationErrors.description = '';
          // Send New Project to DB
          const response = await this.$store.dispatch('createNewTask', this.newTaskData);
          const { message: successMessage } = response.data;
          this.newTaskData.name = '';
          this.newTaskData.description = '';
          this.$swal({title: 'Success',text: successMessage, type: 'success'}).then(okay => {
            if( okay) {
              this.$router.push('/tasks/index');
            }
          });
          //END
          this.isSubmitting = false;
        }
      },

    },
    computed: {
      validateNameClass() {
        return this.validationErrors.name !== "" ? true: false;
      },
      validateProjectClass() {
        return this.validationErrors.project !== "" ? true: false;
      }
    },
    mounted() {
      this.allProjects = this.$store.getters.getProjects
    }
  };
 </script>
