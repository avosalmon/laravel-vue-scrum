import http from './http'

const endpoint = '/api/users'

const defaultParams = {
  offset: 0,
  limit: 10,
  sort: 'id',
  direction: 'desc'
}

export default {

  all(meta) {
    const url = endpoint + this.formatParameters(meta)
    return http.get(url)
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
