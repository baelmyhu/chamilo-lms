<script setup>
import { RouterLink } from "vue-router"
import { computed } from "vue"

const props = defineProps({
  ...RouterLink.props,
  url: {
    type: String,
    required: false,
    default: null,
  },
})

const isAnchor = computed(() => !!props.url)
</script>

<template>
  <a
    v-if="isAnchor"
    :href="url !== '#' ? url : undefined"
    v-bind="$attrs"
  >
    <slot />
  </a>
  <router-link
<<<<<<< HEAD
    v-else
=======
    v-else-if="props.to"
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    v-bind="props"
  >
    <slot />
  </router-link>
<<<<<<< HEAD
=======
  <span v-else>
    <slot />
  </span>
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
</template>
