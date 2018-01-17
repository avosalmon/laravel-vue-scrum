<template>
  <line-chart :chart-data="chartData" :options="chartOptions" :height="300" css-classes="velocity-chart"></line-chart>
</template>

<script>
import LineChart from '../../../components/LineChart.vue'

export default {
  components: {
    'line-chart': LineChart
  },

  props: {
    sprints: {
      type: Array,
      required: true
    }
  },

  data () {
    return {
      chartOptions: {
        responsive: true,
        maintainAspectRatio: false
      }
    }
  },

  computed: {
    chartData: function() {
      let data = {
        labels: [],
        datasets: [
          {
            label: 'Logical Points',
            borderColor: '#f87979',
            pointBackgroundColor: 'white',
            fill: false,
            data: []
          }
        ]
      }

      for (const sprint of this.sprints) {
        if (!sprint.logical_points) {
          continue
        }

        const startDate = sprint.start_date.replace(/-/g, '')
        const endDate   = sprint.end_date.replace(/-/g, '')
        const label     = `${startDate}-${endDate}`

        data.labels.unshift(label)
        data.datasets[0].data.unshift(sprint.logical_points)
      }

      return data
    }
  }
};
</script>
