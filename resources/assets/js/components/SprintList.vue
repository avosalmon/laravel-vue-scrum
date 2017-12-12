<template>
  <div>
    <section>Velocity {{ velocity }}</section>
    <el-table
      :data="sprints"
      row-class-name="clickable"
      style="width: 100%"
      @row-click="openEditDialog($event)">
      <el-table-column
        prop="id"
        label="ID">
      </el-table-column>
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
    openEditDialog(sprint) {
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
