<template>
  <div class="container">
    <p class="points">{{ points }} Points Available</p>
    <el-progress type="circle" :percentage="percentage"></el-progress>
  </div>
</template>

<script>
export default {
  props: {
    points: {
      type: Number,
      required: true
    },
    percentage: {
      type: Number,
      required: true
    }
  }
};
</script>

<style lang="scss" scoped>
.container {
  text-align: center;
}
</style>
