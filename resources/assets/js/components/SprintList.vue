<template>
  <div>
    <section>Velocity {{ velocity }}</section>
    <md-table md-card>
      <md-table-row>
        <md-table-head md-numeric>ID</md-table-head>
        <md-table-head>Start Date</md-table-head>
        <md-table-head>End Date</md-table-head>
        <md-table-head md-numeric>Available Resource (%)</md-table-head>
        <md-table-head md-numeric>Available Points</md-table-head>
        <md-table-head md-numeric>Planned Points</md-table-head>
        <md-table-head md-numeric>Actual Points</md-table-head>
        <md-table-head md-numeric>Logical Points</md-table-head>
      </md-table-row>
      <md-table-row v-for="sprint in sprints">
        <md-table-cell md-numeric>{{ sprint.id }}</md-table-cell>
        <md-table-cell>{{ sprint.start_date }}</md-table-cell>
        <md-table-cell>{{ sprint.end_date }}</md-table-cell>
        <md-table-cell md-numeric>{{ sprint.available_resource }}</md-table-cell>
        <md-table-cell md-numeric>{{ sprint.available_points }}</md-table-cell>
        <md-table-cell md-numeric>{{ sprint.planned_points }}</md-table-cell>
        <md-table-cell md-numeric>{{ sprint.actual_points }}</md-table-cell>
        <md-table-cell md-numeric>{{ sprint.logical_points }}</md-table-cell>
      </md-table-row>
    </md-table>
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
