<template>
  <el-dialog title="Edit Sprint" :visible.sync="dialogVisible">
    ID:{{ sprint.id }}
    <!-- <el-form :model="form">
      <el-form-item label="Promotion name" :label-width="formLabelWidth">
        <el-input v-model="form.name" auto-complete="off"></el-input>
      </el-form-item>
      <el-form-item label="Zones" :label-width="formLabelWidth">
        <el-select v-model="form.region" placeholder="Please select a zone">
          <el-option label="Zone No.1" value="shanghai"></el-option>
          <el-option label="Zone No.2" value="beijing"></el-option>
        </el-select>
      </el-form-item>
    </el-form>
    <span slot="footer" class="dialog-footer">
      <el-button @click="dialogVisible = false">Cancel</el-button>
      <el-button type="primary" @click="dialogVisible = false">Confirm</el-button>
    </span> -->
  </el-dialog>
</template>

<script>
import sprint from '../services/sprint-service'

export default {
  name: 'sprint-edit',

  data () {
    return {
      sprint: {},
      dialogVisible: false,
      formLabelWidth: '120px',
      form: {

      }
    }
  },

  methods: {
    update() {
      sprint.update(this.sprint.id, sprint).then(response => {
        this.close()
      })
    },

    open(sprint) {
      this.sprint = sprint
      this.dialogVisible = true
    },

    close() {
      this.dialogVisible = false
    }
  }
};
</script>
