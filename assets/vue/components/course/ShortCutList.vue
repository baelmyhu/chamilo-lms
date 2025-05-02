<template>
  <div class="course-tool">
    <BaseAppLink
      :url="url"
      class="course-tool__link"
    >
      <img
        :alt="shortcut.title"
<<<<<<< HEAD
        :src="`/img/tools/${shortcut.type}.png`"
=======
        :src="shortcut.customImageUrl || `/img/tools/${shortcut.type}.png`"
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
        class="course-tool__icon"
      />
    </BaseAppLink>
    <BaseAppLink
      :url="url"
      class="course-tool__title"
    >
      {{ shortcut.title }}
    </BaseAppLink>
  </div>
</template>

<script setup>
import { computed } from "vue"
import { storeToRefs } from "pinia"
import { useCidReqStore } from "../../store/cidReq"

const cidReqStore = useCidReqStore()
const { course, session } = storeToRefs(cidReqStore)

const props = defineProps({
  shortcut: {
    type: Object,
    required: true,
  },
})

const url = computed(() => `${props.shortcut.url}?cid=${course.value.id}&sid=${session.value?.id || 0}`)
</script>
