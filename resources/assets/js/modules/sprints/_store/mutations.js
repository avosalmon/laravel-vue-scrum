const GET_SPRINTS_SUCCESS = (state, response) => {
  state.sprints = response.data.sprints
}

const CREATE_SPRINT_SUCCESS = (state, response) => {

}

const UPDATE_SPRINT_SUCCESS = (state, response) => {

}

const DESTROY_SPRINT_SUCCESS = (state, response) => {

}

const GET_USERS_SUCCESS = (state, response) => {
  state.users = response.data.users
}

const GET_PROJECTS_SUCCESS = (state, response) => {
  state.projects = response.data.projects
}

export default {
  GET_SPRINTS_SUCCESS,
  CREATE_SPRINT_SUCCESS,
  UPDATE_SPRINT_SUCCESS,
  DESTROY_SPRINT_SUCCESS,
  GET_USERS_SUCCESS,
  GET_PROJECTS_SUCCESS
}
