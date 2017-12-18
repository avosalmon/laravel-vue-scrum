<template>
  <el-dialog title="Create New Sprint" custom-class="sprint-dialog" :visible.sync="dialogVisible">
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
        <div class="user-field" v-for="(user, index) in users" :key="user.id">
          <div class="user-profile">
            <avatar :image-src="user.avatar_url"></avatar>
            <span class="user-name">{{ user.display_name }}</span>
          </div>
          <el-input-number
            class="number-input"
            v-model="form.users[index].workingDays"
            :min="1" :max="10"
            controls-position="right">
          </el-input-number>
        </div>
        <span>{{ availableResource }}%</span>
        <span>{{ availablePoints }}Points</span>
      </el-tab-pane>
      <el-tab-pane label="Projects">
        <p class="instruction">Set planned story points to each project.</p>
        <div class="project-field" v-for="(project, index) in projects" :key="project.id">
          <span class="project-name">{{ index + 1 }}. {{ project.name }}</span>
          <el-input-number
            class="number-input"
            v-model="form.projects[index].plannedPoints"
            controls-position="right">
          </el-input-number>
        </div>
        <span>{{ plannedPoints }}Points</span>
      </el-tab-pane>
    </el-tabs>
    <div slot="footer" class="dialog-footer">
      <el-button @click="close">CANCEL</el-button>
      <el-button type="primary" @click="create">CREATE</el-button>
    </div>
  </el-dialog>
</template>

<script>
import AvatarComponent from './Avatar.vue'
import project from '../services/project-service'
import sprint from '../services/sprint-service'
import user from '../services/user-service'

export default {
  name: 'sprint-create',

  components: {
    'avatar': AvatarComponent
  },

  props: {
    velocity: {
      type: Number,
      required: true
    }
  },

  data () {
    return {
      dialogVisible: false,
      users: [],
      projects: [],
      form: {
        dates: [],
        users: [],
        projects: []
      }
    }
  },

  mounted() {
    this.fetchUsers()
    this.fetchProjects()
  },

  methods: {
    create() {
      const sprintData = {
        start_date: new Date(this.form.dates[0]).toLocaleDateString(),
        end_date: new Date(this.form.dates[1]).toLocaleDateString(),
        available_resource: this.availableResource,
        available_points: this.availablePoints,
        planned_points: this.plannedPoints
      }

      sprint.create(sprintData).then(response => {
        const createdSprint = response.data.sprint
        let promises = []

        for (const user of this.form.users) {
          const data = {
            working_days: user.workingDays
          }
          promises.push(sprint.attachUser(createdSprint.id, user.userId, data))
        }

        for (const project of this.form.projects) {
          const data = {
            planned_points: project.plannedPoints
          }
          promises.push(sprint.attachProject(createdSprint.id, project.projectId, data))
        }

        axios.all(promises).then(() => {
          this.$message({
            message: 'Sprint has been created!',
            type: 'success',
            duration: 5000
          });
          this.$emit('created')
          this.close()
        })
      })
    },

    open() {
      this.dialogVisible = true
    },

    close() {
      this.dialogVisible = false
    },

    fetchUsers() {
      user.all().then(response => {
        this.users = response.data.users
        for (const user of this.users) {
          const formData = {
            userId: user.id,
            workingDays: 10
          }
          this.form.users.push(formData)
        }
      })
    },

    fetchProjects() {
      project.all().then(response => {
        this.projects = response.data.projects
        for (const project of this.projects) {
          const formData = {
            projectId: project.id,
            plannedPoints: 0
          }
          this.form.projects.push(formData)
        }
      })
    }
  },

  computed: {
    availableResource: function() {
      const maxWorkingDays   = 10 * this.users.length
      const totalWorkingDays = this.form.users.reduce((sum, user) => {
        return sum + user.workingDays;
      }, 0)

      return Math.round(totalWorkingDays / maxWorkingDays * 100)
    },

    availablePoints: function() {
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
.datepicker {
  margin-top: 20px;
}

.number-input {
  width: 120px;
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
</style>
