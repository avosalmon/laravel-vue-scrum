<template>
  <div>
    <fab icon="plus" @click.native="openCreateDialog"></fab>
    <div class="velocity" v-if="velocity">
      <span class="label">Team's Velocity</span>
      <span class="value">{{ velocity }}</span>
    </div>
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
    <sprint-create ref="sprintCreate" :velocity="velocity" @created="fetchSprints"></sprint-create>
    <sprint-edit ref="sprintEdit"></sprint-edit>
  </div>
</template>

<script>
import sprint from '../services/sprint-service'
import SprintCreateComponent from './SprintCreate.vue'
import SprintEditComponent from './SprintEdit.vue'
import FabComponent from './Fab.vue'

export default {
  components: {
    'sprint-create': SprintCreateComponent,
    'sprint-edit': SprintEditComponent,
    'fab': FabComponent
  },

  data () {
    return {
      sprints: []
    }
  },

  computed: {
    velocity: function() {
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

      return Math.round(total / count)
    }
  },

  mounted() {
    this.fetchSprints()
  },

  methods: {
    openCreateDialog() {
      this.$refs.sprintCreate.open()
    },

    openEditDialog(sprint) {
      this.$refs.sprintEdit.open(sprint)
    },

    fetchSprints() {
      sprint.allWith('users,projects').then(response => {
        this.sprints = response.data.sprints
      })
    }
  }
};
</script>

<style lang="scss" scoped>
@import "../../sass/variables";

.menu-section {
  display: flex;
  justify-content: space-between;
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
