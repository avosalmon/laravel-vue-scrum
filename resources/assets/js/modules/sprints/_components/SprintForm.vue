<template>
  <div>
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
            <div class="user-field" v-for="user in form.users" :key="user.id">
              <div class="user-profile">
                <avatar :image-src="user.avatar_url"></avatar>
                <span class="user-name">{{ user.display_name }}</span>
              </div>
              <el-input-number
                class="number-input"
                v-model="user.workingDays"
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
              <th>Logical Points</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="project in form.projects" :key="project.id">
              <td>{{ project.name }}</td>
              <td>
                <el-input-number
                  class="number-input"
                  v-model="project.plannedPoints"
                  :min="0" size="mini">
                </el-input-number>
              </td>
              <td>-</td>
              <td>-</td>
            </tr>
            <tr class="total-row">
              <td>Total</td>
              <td>{{ plannedPoints }}</td>
              <td>-</td>
              <td>-</td>
            </tr>
          </tbody>
        </table>
      </el-tab-pane>
    </el-tabs>
    <div slot="footer" class="dialog-footer">
      <el-button @click="close">CANCEL</el-button>
      <el-button type="primary" @click="submit">SAVE</el-button>
    </div>
  </div>
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

  props: {
    velocity: {
      type: Number,
      required: true
    },
    sprint: {
      type: Object
    }
  },

  data () {
    return {
      form: {
        dates: [],
        users: [],
        projects: []
      }
    }
  },

  methods: {
    submit() {
      const sprint = {
        start_date: new Date(this.form.dates[0]).toLocaleDateString(),
        end_date: new Date(this.form.dates[1]).toLocaleDateString(),
        available_resource: this.availableResource,
        available_points: this.availablePoints,
        planned_points: this.plannedPoints
      }

      const data = {
        sprint: sprint,
        users: this.form.users,
        projects: this.form.projects
      }

      this.resetForm()
    },

    resetForm() {
      this.form = {
        dates: [],
        users: [],
        projects: []
      }
    }
  },

  computed: {
    availableResource: function() {
      const maxWorkingDays   = 10 * this.form.users.length
      const totalWorkingDays = this.form.users.reduce((sum, user) => {
        return sum + user.workingDays;
      }, 0)

      return Math.round(totalWorkingDays / maxWorkingDays * 100)
    },

    availablePoints: function() {
      if (!this.velocity) {
        return 0;
      }

      return Math.round(this.velocity * this.availableResource / 100)
    },

    plannedPoints: function() {
      return this.form.projects.reduce((sum, project) => {
        return sum + project.plannedPoints;
      }, 0)
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
  }
}

</style>
