<template>
  <div class="row py-4">
    <div class="col-md-12">
      <the-header linkType="projects" />
      <router-view />
      <div class="row">
        <h2 class="text-center py-4"><b>Create new Project</b></h2>
        <div class="col-md-6 offset-md-3">
          <form v-on:submit.prevent="createNewProject">

            <div class="mb-3">
              <label class="form-label">Project name</label>
              <input
                class="form-control" 
                :class="validateNameClass ? 'error' : ''"
                type="text"
                v-model="newProjectData.name"
              >
              <span class="errorMessage" v-if="validateNameClass">
                {{ validationErrors.name }}
              </span>
            </div>

            <div class="mb-3">
              <label class="form-label">Project description</label>
              <textarea
                class="form-control"
                :class="validateDescriptionClass ? 'error' : ''"
                cols="30"
                rows="3"
                v-model="newProjectData.description"
                >
              </textarea>
              <span class="errorMessage" v-if="validateDescriptionClass">
                {{ validationErrors.description }}
              </span>
            </div>

            <button type="submit" class="btn btn-primary">Create Project</button>
          </form>
        </div>
      </div>
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
        newProjectData: {
          name: '',
          description: ''
        },
        validationErrors: {
          name: '',
          description: '',
        }
      }
    },

    validations() {
      return {
        newProjectData: {
          name: { required },
          description: { required }
        }
      }
    },
    methods: {
      async createNewProject() {
        this.v$.$validate();
        if (this.v$.$error) {
          this.hasValidationsError = true;
          if (this.v$.newProjectData.name.$errors.length) {
            this.validationErrors.name = this.v$.newProjectData.name.$errors[0].$message;
          }
          if (this.v$.newProjectData.description.$errors.length) {
            this.validationErrors.description = this.v$.newProjectData.description.$errors[0].$message;
          }
        } else {
          this.$isSubmitting = true;
          this.hasValidationsErrors = false;
          this.validationErrors.name = '';
          this.validationErrors.description = '';
          // Send New Project to DB
          const response = await this.$store.dispatch('createNewProject', this.newProjectData);
          const { message: successMessage } = response.data;
          this.newProjectData.name = '';
          this.newProjectData.description = '';
          this.$swal({title: 'Success',text: successMessage, type: 'success'}).then(okay => {
            if( okay) {
              this.$router.push('/projects/index');
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
      validateDescriptionClass() {
        return this.validationErrors.description !== "" ? true: false;
      }
    }
  }  
</script>

<style>
  form {
    border: 0.0625rem solid gray;
    padding: 1.5rem;
  }
  .error {
    border: 2px solid red !important;
  }
  .errorMessage {
    color: red;
    font-weight: 600;
    font-size: 0.75rem;
  } 
</style>