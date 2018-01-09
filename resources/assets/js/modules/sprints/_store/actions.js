import sprints from '../../../services/sprints-service'
import users from '../../../services/users-service'
import projects from '../../../services/projects-service'

const getSprints = ({ commit }) => {
  sprints.allWith('users,projects')
    .then(response => {
      commit('GET_SPRINTS_SUCCESS', response)
    })
}

const createSprint = ({ dispatch, commit }, data) => {
  sprints.create(data.sprint).then(response => {
    const createdSprint = response.data.sprint
    let promises = []

    for (const user of data.users) {
      promises.push(sprints.attachUser(createdSprint.id, user.userId, {
        working_days: user.workingDays
      }))
    }

    for (const project of data.projects) {
      promises.push(sprints.attachProject(createdSprint.id, project.projectId, {
        planned_points: project.plannedPoints
      }))
    }

    axios.all(promises).then(() => {
      dispatch('getSprints')
      // this.$message({
      //   message: 'Sprint has been created!',
      //   type: 'success',
      //   duration: 5000
      // })
    })
  })
}

const updateSprint = ({ commit }, data) => {

}

const destroySprint = ({ commit }, id) => {

}

const getUsers = ({ commit }) => {
  users.all()
    .then(response => {
      commit('GET_USERS_SUCCESS', response)
    })
}

const getProjects = ({ commit }) => {
  projects.all()
    .then(response => {
      commit('GET_PROJECTS_SUCCESS', response)
    })
}

export default {
  getSprints,
  createSprint,
  updateSprint,
  destroySprint,
  getUsers,
  getProjects
}
