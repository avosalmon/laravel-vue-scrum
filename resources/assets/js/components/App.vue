<template>
  <div>
    <header>
      <router-link to="/">Laravel Vue Scrum</router-link>
    </header>
    <div id="app">
      <router-view></router-view>
    </div>
  </div>
</template>

<style lang="scss">
header {
  padding: 0 15%;
}
</style>
