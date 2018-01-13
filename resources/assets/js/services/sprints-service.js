import http from './http'

const endpoint = '/api/sprints'

const defaultParams = {
  offset: 0,
  limit: 10,
  sort: 'id',
  direction: 'desc'
}

export default {
  all(params) {
    const url = endpoint + this.formatParameters(params)
    return http.get(url)
  },

  allWith(relationships, params) {
    const url = `${endpoint}/with/${relationships}` + this.formatParameters(params)
    return http.get(url)
  },

  findWith(id, relationships) {
    const url = `${endpoint}/${id}/with/${relationships}`
    return http.get(url)
  },

  update(id, data) {
    const url = `${endpoint}/${id}`
    return http.put(url, data)
  },

  create(data) {
    return http.post(endpoint, data)
  },

  attachUser(sprintId, userId, data) {
    const url = `${endpoint}/${sprintId}/users/${userId}`
    return http.post(url, data)
  },

  updateUser(sprintId, userId, data) {
    const url = `${endpoint}/${sprintId}/users/${userId}`
    return http.put(url, data)
  },

  attachProject(sprintId, projectId, data) {
    const url = `${endpoint}/${sprintId}/projects/${projectId}`
    return http.post(url, data)
  },

  updateProject(sprintId, projectId, data) {
    const url = `${endpoint}/${sprintId}/projects/${projectId}`
    return http.put(url, data)
  },

  formatParameters(params) {
    params = params || defaultParams

    let formatted = ''
    formatted += '?limit=' + encodeURIComponent(params.limit)
    formatted += '&offset=' + encodeURIComponent(params.offset)
    formatted += '&sort=' + encodeURIComponent(params.sort)
    formatted += '&direction=' + encodeURIComponent(params.direction)

    return formatted
  }
}
