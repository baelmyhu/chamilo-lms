<script setup>
import Rating from "primevue/rating"

const model = defineModel({
  type: Number,
})

defineProps({
  stars: {
    type: Number,
    default: 5,
    require: false,
  },
})

const emit = defineEmits(["change"])
</script>

<template>
  <Rating
    v-model="model"
    :cancel="false"
    :stars="stars"
<<<<<<< HEAD
    @change="emit('change', $event, model)"
=======
    @change="emit('change', $event)"
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
  />
</template>
