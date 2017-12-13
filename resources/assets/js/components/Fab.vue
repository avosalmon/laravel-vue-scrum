<template>
  <button type="button" class="el-button el-button--primary fab">
    <i :class="iconClass"></i>
  </button>
</template>

<script>
export default {
  name: 'fab',

  props: [
    'icon'
  ],

  computed: {
    iconClass: function () {
      return `el-icon-${this.icon}`
    }
  }
};
</script>

<style lang="scss" scoped>
.fab {
  padding: 12px;
  border-radius: 50%;
  width: 50px;
  height: 50px;
  font-size: 20px;
}
</style>
