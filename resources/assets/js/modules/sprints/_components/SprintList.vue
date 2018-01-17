<template>
  <div>
    <fab icon="plus" @click.native="openCreateDialog"></fab>
    <div class="velocity" v-if="velocity">
      <span class="label">Team's Velocity</span>
      <span class="value">{{ velocity }}</span>
    </div>
    <velocity-chart :chart-data="chartData" :options="chartOptions" :height="300" css-classes="velocity-chart"></velocity-chart>
    <el-table
      :data="sprints"
      row-class-name="clickable"
      style="width: 100%"
      @row-click="openEditDialog($event)">
      <el-table-column
        prop="start_date"
        label="Start Date">
      </el-table-column>
      <el-table-column
        prop="end_date"
        label="End Date">
      </el-table-column>
      <el-table-column
        prop="available_resource"
        label="Available Resource (%)">
      </el-table-column>
      <el-table-column
        prop="available_points"
        label="Available Points">
      </el-table-column>
      <el-table-column
        prop="planned_points"
        label="Planned Points">
      </el-table-column>
      <el-table-column
        prop="actual_points"
        label="Actual Points">
      </el-table-column>
      <el-table-column
        prop="logical_points"
        label="Logical Points">
      </el-table-column>
    </el-table>
    <sprint-create ref="sprintCreate" :velocity="velocity" :users="users" :projects="projects" />
    <sprint-edit ref="sprintEdit" />
  </div>
</template>

<script>
import SprintCreate from './SprintCreate.vue'
import SprintEdit from './SprintEdit.vue'
import VelocityChart from './VelocityChart.vue'
import Fab from '../../../components/Fab.vue'

export default {
  components: {
    'sprint-create': SprintCreate,
    'sprint-edit': SprintEdit,
    'velocity-chart': VelocityChart,
    'fab': Fab
  },

  props: {
    sprints: {
      type: Array,
      required: true
    },
    velocity: {
      type: Number,
      required: true
    },
    users: {
      type: Array,
      required: true
    },
    projects: {
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

  methods: {
    openCreateDialog() {
      this.$refs.sprintCreate.open()
    },

    openEditDialog(sprint) {
      this.$refs.sprintEdit.open(sprint)
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

<style lang="scss" scoped>
@import "../../../../sass/variables";
.velocity-chart {
  margin-bottom: 50px;
}

.velocity {
  .label {
    font-weight: 600;
    font-size: 18px;
    margin-right: 5px;
  }
  .value {
    display: inline-block;
    background: #40B883;
    color: $white;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    line-height: 30px;
    text-align: center;
  }
}

.fab {
  position: fixed;
  bottom: 30px;
  right: 30px;
  z-index: 999;
}
</style>
