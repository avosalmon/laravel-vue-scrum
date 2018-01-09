<template>
  <sprint-list :sprints="sprints" :users="users" :projects="projects" :velocity="velocity" />
</template>

<script>
import { mapGetters } from 'vuex'
import store from './_store';
import SprintList from './_components/SprintList';

export default {
  components: {
    'sprint-list': SprintList
  },

  computed: {
    ...mapGetters({
      sprints: '$_sprints/sprints',
      users: '$_sprints/users',
      projects: '$_sprints/projects',
      velocity: '$_sprints/velocity',
    }),
  },

  created() {
    this.$store.registerModule('$_sprints', store)
  },

  mounted() {
    this.$store.dispatch('$_sprints/getSprints')
    this.$store.dispatch('$_sprints/getUsers')
    this.$store.dispatch('$_sprints/getProjects')
  },
}
</script>
