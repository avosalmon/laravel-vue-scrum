<template>
  <div>
    <el-container>
      <el-header>
        <h1>Scrum Velocity Manager</h1>
      </el-header>
      <el-main>
        <router-view></router-view>
      </el-main>
    </el-container>
  </div>
</template>

<style lang="scss">
@import "../sass/variables";

.el-header {
  color: $white;
  background-color: #34485D;
  line-height: 60px;

  h1 {
    font-weight: bold;
    font-size: 20px;
  }
}
</style>
