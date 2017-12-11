<template>
  <div>
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
      sprints: []
    }
  },

  mounted() {
    this.fetchSprints()
  },

  methods: {
    fetchSprints() {
      sprint.all().then(response => {
        this.sprints = response.data.sprints
      })
    }
  }
};
</script>
