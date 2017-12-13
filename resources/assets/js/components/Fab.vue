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
  width: 60px;
  height: 60px;
  font-size: 20px;
  box-shadow: 0 3px 5px -1px rgba(0,0,0,.2), 0 6px 10px 0 rgba(0,0,0,.14), 0 1px 18px 0 rgba(0,0,0,.12);
}
</style>
