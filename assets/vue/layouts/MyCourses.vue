<template>
<<<<<<< HEAD
  <div class="flex justify-between items-center">
    <h2 v-t="'My courses'" />
    <Button
      v-if="isTeacher"
      :label="t('Course')"
      class="p-button-secondary hidden md:inline-flex"
      icon="pi pi-plus"
      @click="redirectToCreateCourse"
    />
  </div>
  <hr />
=======
  <SectionHeader :title="t('My courses')">
    <BaseAppLink :to="{ name: 'CourseCreate' }">
      <BaseButton
        v-if="isTeacher"
        type="secondary"
        icon="plus"
        :label="t('Course')"
      />
    </BaseAppLink>
  </SectionHeader>
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
  <router-view />
</template>

<script setup>
<<<<<<< HEAD
import Button from "primevue/button"
import { useI18n } from "vue-i18n"
import { storeToRefs } from "pinia"
import { useSecurityStore } from "../store/securityStore"
import { useRouter } from "vue-router"

const { t } = useI18n()
const { isTeacher } = storeToRefs(useSecurityStore())
const router = useRouter()

const redirectToCreateCourse = () => {
  router.push({ name: "CourseCreate" })
}
=======
import { useI18n } from "vue-i18n"
import { storeToRefs } from "pinia"
import { useSecurityStore } from "../store/securityStore"
import SectionHeader from "../components/layout/SectionHeader.vue"
import BaseButton from "../components/basecomponents/BaseButton.vue"
import BaseAppLink from "../components/basecomponents/BaseAppLink.vue"

const { t } = useI18n()
const { isTeacher } = storeToRefs(useSecurityStore())
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
</script>
