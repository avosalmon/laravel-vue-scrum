import sprints from '../../../services/sprints-service'
import users from '../../../services/users-service'
import projects from '../../../services/projects-service'

const getSprints = ({ commit }) => {
  sprints.allWith('users,projects')
    .then(response => {
      commit('GET_SPRINTS_SUCCESS', response)
    })
}

const createSprint = ({ commit }, data) => {

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
