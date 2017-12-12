<template>
  <div>
    <section>Velocity {{ velocity }}</section>
    <table class="table table-hover">
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
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="sprint in sprints">
          <td>{{ sprint.id }}</td>
          <td>{{ sprint.start_date }}</td>
          <td>{{ sprint.end_date }}</td>
          <td>{{ sprint.available_resource }}</td>
          <td>{{ sprint.available_points }}</td>
          <td>{{ sprint.planned_points }}</td>
          <td>{{ sprint.actual_points }}</td>
          <td>{{ sprint.logical_points }}</td>
          <td>
            <router-link :to="'/sprints/' + sprint.id">
              <md-button class="md-icon-button">
                <md-icon>mode_edit</md-icon>
              </md-button>
            </router-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import sprint from '../services/sprint-service'

export default {
  data () {
    return {
      sprints: [],
      velocity: null
    }
  },

  mounted() {
    this.fetchSprints()
  },

  methods: {
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
