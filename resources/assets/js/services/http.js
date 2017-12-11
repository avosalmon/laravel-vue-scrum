import axios from 'axios'

export default {

  get(url) {
    return axios.get(url)
  },

  post(url, data) {
    return axios.post(url, data)
  },

  put(url, data) {
    return axios.put(url, data)
  },

  delete(url) {
    return axios.delete(url)
  },

  // TODO: implement interceptors
  init() {
    axios.interceptors.request.use(function (config) {
      // Do something before request is sent
      let token = ''
      config.headers.Authorization = 'Bearer ' + token
      return config
    }, function (error) {
      // Do something with request error
      return Promise.reject(error)
    })
  }
}
