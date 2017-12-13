<template>
  <el-dialog title="Edit Sprint" :visible.sync="dialogVisible">
    <el-date-picker
      v-model="dates"
      type="daterange"
      range-separator="To"
      start-placeholder="Start Date"
      end-placeholder="End Date">
    </el-date-picker>
    <div slot="footer" class="dialog-footer">
      <el-button @click="close">CANCEL</el-button>
      <el-button type="primary" @click="update">SAVE</el-button>
    </div>
  </el-dialog>
</template>

<script>
import sprint from '../services/sprint-service'

export default {
  name: 'sprint-edit',

  data () {
    return {
      sprint: {},
      dialogVisible: false,
      dates: [],
      formLabelWidth: '120px',
      form: {}
    }
  },

  methods: {
    update() {
      sprint.update(this.sprint.id, this.sprint).then(response => {
        this.close()
      })
    },

    open(sprint) {
      this.sprint = sprint
      this.dates = [
        this.sprint.start_date,
        this.sprint.end_date
      ]
      this.dialogVisible = true
    },

    close() {
      this.dialogVisible = false
    },

  }
};
</script>
