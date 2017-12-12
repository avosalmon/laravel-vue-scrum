<template>
  <el-dialog title="Create New Sprint" :visible.sync="dialogVisible" :before-close="handleClose">
    <el-date-picker
      v-model="dates"
      type="daterange"
      range-separator="To"
      start-placeholder="Start Date"
      end-placeholder="End Date">
    </el-date-picker>
    <div slot="footer" class="dialog-footer">
      <el-button @click="close">CANCEL</el-button>
      <el-button type="primary" @click="create">CREATE</el-button>
    </div>
  </el-dialog>
</template>

<script>
import sprint from '../services/sprint-service'

export default {
  name: 'sprint-create',

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
    create() {
      sprint.create(this.sprint).then(response => {
        this.close()
      })
    },

    open() {
      this.dialogVisible = true
    },

    close() {
      this.dialogVisible = false
    },

    handleClose(done) {
      this.$confirm('Are you sure to close this dialog?')
        .then(_ => {
          done();
        })
        .catch(_ => {});
    }
  }
};
</script>
