<template>
  <el-dialog title="Edit Sprint" custom-class="sprint-dialog"
    :visible.sync="dialogVisible" width="700px" @close="close">
    <el-tabs>
      <el-tab-pane label="Dates">
        <p class="instruction">Select start date and end date.</p>
        <el-date-picker
          class="datepicker"
          v-model="form.dates"
          type="daterange"
          range-separator="To"
          start-placeholder="Start Date"
          end-placeholder="End Date">
        </el-date-picker>
      </el-tab-pane>
      <el-tab-pane label="Resources">
        <p class="instruction">Set working days to each member.</p>
        <el-row>
          <el-col :span="12">
            <div class="user-field" v-for="(user, index) in sprint.users" :key="user.id">
              <div class="user-profile">
                <avatar :image-src="user.avatar_url"></avatar>
                <span class="user-name">{{ user.display_name }}</span>
              </div>
              <el-input-number
                class="number-input"
                v-if="form.users.length"
                v-model="form.users[index].workingDays"
                :min="0" :max="10"
                size="mini">
              </el-input-number>
            </div>
          </el-col>
          <el-col :span="10">
            <available-points
              :points="availablePoints"
              :percentage="availableResource"
              class="available-points">
            </available-points>
          </el-col>
        </el-row>
      </el-tab-pane>
      <el-tab-pane label="Projects">
        <table>
          <thead>
            <tr>
              <th>Project</th>
              <th>Planned Points</th>
              <th>Actual Points</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(project, index) in sprint.projects" :key="project.id">
              <td>{{ project.name }}</td>
              <td>
                <el-input-number
                  class="number-input"
                  v-if="form.projects.length"
                  v-model="form.projects[index].plannedPoints"
                  :min="0" size="mini">
                </el-input-number>
              </td>
              <td>
                <el-input-number
                  class="number-input"
                  v-if="form.projects.length"
                  v-model="form.projects[index].actualPoints"
                  :min="0" size="mini">
                </el-input-number>
              </td>
            </tr>
            <tr class="total-row">
              <td>Total</td>
              <td>{{ totalPlannedPoints }}</td>
              <td>{{ totalActualPoints }}</td>
            </tr>
          </tbody>
        </table>
      </el-tab-pane>
    </el-tabs>
    <div slot="footer" class="dialog-footer">
      <el-button @click="close">CANCEL</el-button>
      <el-button type="primary" @click="update">UPDATE</el-button>
    </div>
  </el-dialog>
</template>

<script>
import Avatar from '../../../components/Avatar.vue'
import AvailablePoints from './AvailablePoints.vue'
import sprint from '../../../services/sprints-service'

export default {
  components: {
    'avatar': Avatar,
    'available-points': AvailablePoints
  },

  data () {
    return {
      dialogVisible: false,
      sprint: {},
      form: {
        dates: [],
        users: [],
        projects: []
      }
    }
  },

  methods: {
    update() {
      const sprint = {
        id: this.sprint.id,
        start_date: new Date(this.form.dates[0]).toLocaleDateString(),
        end_date: new Date(this.form.dates[1]).toLocaleDateString(),
        available_resource: this.availableResource,
        available_points: this.availablePoints,
        planned_points: this.totalPlannedPoints,
        actual_points: this.totalActualPoints,
        logical_points: this.totalLogicalPoints
      }

      const data = {
        sprint: sprint,
        users: this.form.users,
        projects: this.form.projects
      }

      this.$store.dispatch('$_sprints/updateSprint', data)
          .then(() => {
            this.$message({
              message: 'Sprint has been updated!',
              type: 'success',
              duration: 5000
            })

            this.resetForm()
            this.close()
          })
    },

    open(sprint) {
      this.initForm(sprint)
      this.dialogVisible = true
    },

    close() {
      this.resetForm()
      this.dialogVisible = false
    },

    resetForm() {
      this.form = {
        dates: [],
        users: [],
        projects: []
      }
    },

    initForm(sprint) {
      this.sprint = sprint

      this.form.dates = [
        sprint.start_date,
        sprint.end_date
      ]

      for (const user of this.sprint.users) {
        this.form.users.push({
          userId: user.id,
          workingDays: user.pivot.working_days
        })
      }

      for (const project of this.sprint.projects) {
        this.form.projects.push({
          projectId: project.id,
          plannedPoints: project.pivot.planned_points,
          actualPoints: project.pivot.actual_points,
        })
      }
    }
  },

  computed: {
    availableResource: function() {
      if (!this.sprint.users) {
        return 0;
      }

      const maxWorkingDays   = 10 * this.sprint.users.length
      const totalWorkingDays = this.form.users.reduce((sum, user) => {
        return sum + user.workingDays;
      }, 0)

      return Math.round(totalWorkingDays / maxWorkingDays * 100)
    },

    availablePoints: function() {
      if (!this.sprint.velocity) {
        return 0;
      }

      return Math.round(this.sprint.velocity * this.availableResource / 100)
    },

    totalPlannedPoints: function() {
      return this.form.projects.reduce((sum, project) => {
        return sum + project.plannedPoints;
      }, 0)
    },

    totalActualPoints: function() {
      return this.form.projects.reduce((sum, project) => {
        return sum + project.actualPoints;
      }, 0)
    },

    totalLogicalPoints: function() {
      return Math.round(this.totalActualPoints * (100 / this.availableResource))
    }
  }
};
</script>

<style lang="scss" scoped>
@import "../../../../sass/variables";

.datepicker {
  margin-top: 20px;
}

.number-input {
  width: 110px;
}

.user-field {
  margin-top: 20px;
  display: flex;

  .user-profile {
    width: 200px;

    .user-name {
      font-size: 16px;
      vertical-align: middle;
    }
  }
}

.available-points {
  padding: 20px;
}

.project-field {
  margin-top: 20px;
  display: flex;

  .project-name {
    font-size: 16px;
    vertical-align: middle;
    width: 200px;
    line-height: 40px;
  }
}

table {
  margin-top: 10px;

  th {
    padding: 5px 10px;
    border-bottom: 1px solid $gray-light;
  }

  td {
    padding: 10px 15px;
    text-align: center;
  }

  .total-row {
    border-top: 1px solid $gray-light;
    font-weight: bold;
  }
}

</style>
