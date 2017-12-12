<template>

</template>

<script>
import sprint from '../services/sprint-service'

export default {
  name: 'sprint-edit',

  data () {
    return {
      sprint: {}
    }
  },

  methods: {
    update() {
      sprint.update(this.sprint.id, sprint).then(response => {
        this.close()
      })
    },

    open(sprint) {
      this.sprint = sprint
      // this.$refs.dialog.open()
    },

    close() {
      // this.$refs.dialog.close()
    }
  }
};
</script>
