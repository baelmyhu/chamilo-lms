<template>
  <div
    v-if="visible"
<<<<<<< HEAD
    class="w-full h-full fixed block top-0 left-0 bg-white opacity-60 text-center"
    style="z-index: 9999"
  >
    <div
      class="spinner-border text-success opacity-75 top-1/2 my-0 mx-auto block relative w-0 h-0"
      role="status"
    >
=======
    class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-50 backdrop-blur-md"
    style="z-index: 10"
  >
    <div class="loader" role="status">
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
      <span class="sr-only">Loading</span>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    visible: {
      type: Boolean,
      required: true,
    },
  },
}
</script>
