const sprints = state => state.sprints
const users = state => state.users
const projects = state => state.projects

const velocity = state => {
  let total = 0
  let count = 0

  for (const sprint of state.sprints) {
    if (count > 2) {
      break
    }

    if (!sprint.logical_points) {
      continue
    }

    total += sprint.logical_points
    count ++
  }

  return Math.round(total / count)
}

export default {
  sprints,
  users,
  projects,
  velocity
}
