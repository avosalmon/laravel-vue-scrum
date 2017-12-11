import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/sprints',
      component: require('./components/SprintList.vue')
    },
    // {
    //     path: '/create',
    //     component: require('./components/SprintCreate.vue')
    // },
    {
        path: '/sprints/:id',
        component: require('./components/SprintEdit.vue')
    },
    {
      path: '*',
      redirect: '/sprints'
    }
  ]
})
