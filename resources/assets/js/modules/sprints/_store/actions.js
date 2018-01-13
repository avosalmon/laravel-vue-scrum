import sprints from '../../../services/sprints-service'
import users from '../../../services/users-service'
import projects from '../../../services/projects-service'

const getSprints = ({ commit }) => {
  sprints.allWith('users,projects')
    .then(response => {
      commit('GET_SPRINTS_SUCCESS', response)
    })
}

const createSprint = async ({ dispatch, commit }, data) => {
  const response = await sprints.create(data.sprint)
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

  await Promise.all(promises)

  dispatch('getSprints')
}

const updateSprint = ({ commit }, data) => {
  const response = await sprints.update(data.sprint.id, data.sprint)
  let promises = []

  for (const user of data.users) {
    promises.push(sprints.updateUser(createdSprint.id, user.userId, {
      working_days: user.workingDays
    }))
  }

  for (const project of data.projects) {
    promises.push(sprints.updateUser(createdSprint.id, project.projectId, {
      planned_points: project.plannedPoints,
      actual_points: project.actualPoints
    }))
  }

  await Promise.all(promises)

  dispatch('getSprints')
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
