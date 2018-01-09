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
import sprint from '../../../services/sprints-service'

export default {
  name: 'sprint-edit',

  props: {
    velocity: {
      type: Number,
      required: true
    }
  },

  data () {
    return {
      dialogVisible: false,
      form: {
        dates: [],
        users: [],
        projects: []
      }
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
      this.form.dates = [
        this.sprint.start_date,
        this.sprint.end_date
      ]

      for (const user of sprint.users) {
        this.form.users.push({
          userId: user.id,
          workingDays: user.pivot.working_days
        })
      }

      for (const project of sprint.projects) {
        this.form.projects.push({
          projectId: project.id,
          plannedPoints: project.pivot.planned_points,
          actualPoints: project.pivot.actual_points,
        })
      }

      this.dialogVisible = true
    },

    close() {
      this.dialogVisible = false
    }
  }
};
</script>
