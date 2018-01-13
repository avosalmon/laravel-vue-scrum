import Vue from 'vue'
import Router from 'vue-router'
import Sprints from '../modules/sprints'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/sprints',
      component: Sprints
    },
    {
      path: '*',
      redirect: '/sprints'
    }
  ]
})
