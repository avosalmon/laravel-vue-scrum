<template>
  <div>
    <section>Velocity {{ velocity }}</section>
    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Available Resource (%)</th>
            <th>Available Points</th>
            <th>Planned Points</th>
            <th>Actual Points</th>
            <th>Logical Points</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="sprint in sprints" :key="sprint.id" class="clickable" @click="openDetail(sprint)">
            <td>{{ sprint.id }}</td>
            <td>{{ sprint.start_date }}</td>
            <td>{{ sprint.end_date }}</td>
            <td>{{ sprint.available_resource }}</td>
            <td>{{ sprint.available_points }}</td>
            <td>{{ sprint.planned_points }}</td>
            <td>{{ sprint.actual_points }}</td>
            <td>{{ sprint.logical_points }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <sprint-edit ref="sprintEdit"></sprint-edit>
  </div>
</template>

<script>
import sprint from '../services/sprint-service'
import SprintEditComponent from './SprintEdit.vue'

export default {
  data () {
    return {
      sprints: [],
      velocity: null
    }
  },

  components: {
    'sprint-edit': SprintEditComponent
  },

  mounted() {
    this.fetchSprints()
  },

  methods: {
    openDetail(sprint) {
      this.$refs.sprintEdit.open(sprint)
    },

    fetchSprints() {
      sprint.all().then(response => {
        this.sprints = response.data.sprints
        this.calculateVelocity()
      })
    },

    calculateVelocity() {
      let total = 0
      let count = 0

      for (const sprint of this.sprints) {
        if (count > 2) {
          break
        }

        if (!sprint.logical_points) {
          continue
        }

        total += sprint.logical_points
        count ++
      }

      this.velocity = Math.round(total / count)
    }
  }
};
</script>
