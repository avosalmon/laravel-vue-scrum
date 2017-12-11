<template>
  <div>
    <form name="form">
      <div class="row">
        <div class="form-element">
          <label for="start-date">Start Date</label>
          <input type="text" id="start-date" class="form-control" v-model="sprint.start_date" />
        </div>
        <div class="form-element">
          <label for="end-date">End Date</label>
          <input type="text" id="end-date" class="form-control" v-model="sprint.end_date" />
        </div>
      </div>
      <div class="form-navigation">
        <button class="btn btn-lg" @click.prevent="updateSprint">
          <span class="glyphicon glyphicon-thumbs-up"></span>
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import router from '../router'
import sprint from '../services/sprint-service'

export default {
  data () {
    return {
      sprint: {}
    }
  },

  mounted() {
    this.fetchSprint()
  },

  methods: {
    fetchSprint() {
      const relationships = 'users,projects'
      sprint.findWith(this.$route.params.id, relationships).then(response => {
        this.sprint = response.data.sprint
      })
    },

    updateSprint() {
      router.push('/sprints')
    }
  }
};
</script>
