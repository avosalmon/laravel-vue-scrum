import Vue from 'vue'
import Router from 'vue-router'
import SprintList from '../components/SprintList.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/sprints',
      component: SprintList
    },
    {
      path: '*',
      redirect: '/sprints'
    }
  ]
})
