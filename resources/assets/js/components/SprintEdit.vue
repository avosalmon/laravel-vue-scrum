<template>
  <md-dialog ref="dialog">
    <md-dialog-title>Edit Sprint</md-dialog-title>
    <md-dialog-content v-if="sprint">
      ID: {{ sprint.id }}
    </md-dialog-content>
    <md-dialog-actions>
      <md-button class="md-primary" @click="close">CLOSE</md-button>
      <md-button class="md-primary" @click="update">SAVE</md-button>
    </md-dialog-actions>
  </md-dialog>
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
      this.$refs.dialog.open()
    },

    close() {
      this.$refs.dialog.close()
    }
  }
};
</script>
