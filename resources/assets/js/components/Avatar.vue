<template>
  <img class="avatar" :src="imageSrc">
</template>

<script>
export default {
  name: 'avatar',

  props: {
    imageSrc: {
      type: String,
      required: true
    }
  }
};
</script>

<style lang="scss" scoped>
.avatar {
  border-radius: 50%;
  width: 40px;
  height: 40px;
  margin-right: 5px;
  vertical-align: middle;
}
</style>
