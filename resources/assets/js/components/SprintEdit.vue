<template>
  <div>
    Sprint ID: {{ sprint.id }}
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

    }
  }
};
</script>
