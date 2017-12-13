<template>
  <el-dialog title="Create New Sprint" :visible.sync="dialogVisible">
    <el-date-picker
      class="datepicker"
      v-model="dates"
      type="daterange"
      range-separator="To"
      start-placeholder="Start Date"
      end-placeholder="End Date">
    </el-date-picker>
    <div class="working-days-field" v-for="user in users" :key="user.id">
      <div class="user-profile">
        <img class="avatar" :src="user.avatar_url">
        <span class="user-name">{{ user.display_name }}</span>
      </div>
      <el-input-number v-model="input" :min="1" :max="10"></el-input-number>
    </div>
    <div slot="footer" class="dialog-footer">
      <el-button @click="close">CANCEL</el-button>
      <el-button type="primary" @click="create">CREATE</el-button>
    </div>
  </el-dialog>
</template>

<script>
import project from '../services/project-service'
import sprint from '../services/sprint-service'
import user from '../services/user-service'

export default {
  name: 'sprint-create',

  data () {
    return {
      dialogVisible: false,
      dates: [],
      users: [],
      projects: [],
      input: ''
    }
  },

  mounted() {
    this.fetchUsers()
    this.fetchProjects()
  },

  methods: {
    create() {
      const data = {

      }
      sprint.create(data).then(response => {
        this.close()
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
          user.working_days = 10
        }
      })
    },

    fetchProjects() {
      project.all().then(response => {
        this.projects = response.data.projects
      })
    }
  }
};
</script>

<style lang="scss" scoped>
.datepicker {
  margin-bottom: 15px;
}

.working-days-field {
  margin-top: 20px;
  display: flex;
}

.user-profile {
  width: 185px;
}

.user-name {
  font-size: 16px;
  vertical-align: middle;
}

.avatar {
  border-radius: 50%;
  width: 40px;
  height: 40px;
  margin-right: 5px;
  vertical-align: middle;
}
</style>
