<template>
<<<<<<< HEAD
  <PageForm
    v-model="item"
    @submit="updateItem"
  />
  <Loading :visible="isLoading" />
</template>

<script setup>
=======
  <div>
    <div class="mb-4">
      <Button
        icon="mdi mdi-arrow-left"
        :label="t('Back to list')"
        class="p-button-secondary"
        @click="router.push({ name: 'PageList', query: $route.query })"
      />
    </div>

    <PageForm
      v-model="item"
      @submit="updateItem"
    />
    <Loading :visible="isLoading" />
  </div>
</template>

<script setup>
import { useRouter, useRoute } from "vue-router"
import { useI18n } from "vue-i18n"
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
import Loading from "../../components/Loading.vue"
import PageForm from "../../components/page/Form.vue"
import { useDatatableUpdate } from "../../composables/datatableUpdate"

const { item, isLoading, retrieve, updateItem } = useDatatableUpdate("Page")
<<<<<<< HEAD
=======
const router = useRouter()
const route = useRoute()
const { t } = useI18n()
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94

retrieve()
</script>
