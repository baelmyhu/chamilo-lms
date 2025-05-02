<template>
<<<<<<< HEAD
  <div class="card">
    <DataTable
      v-model:expandedRows="expandedRows"
      v-model:filters="filters"
      :global-filter-fields="['title', 'description', 'category.title', 'course.courseLanguage']"
      :loading="status"
      :paginator="true"
      :rows="9"
      :value="sessions"
      class="p-datatable-sessions p-datatable-lg"
      data-key="id"
      filter-display="menu"
      responsive-layout="scroll"
      striped-rows
    >
      <template #header>
        <div class="table-header-container">
          <div class="flex justify-space-between">
            <div class="justify-content-left">
              <Button
                :label="$t('Expand')"
                class="mr-2"
                icon="pi pi-plus"
                @click="expandAll"
              />
              <Button
                :label="$t('Collapse')"
                icon="pi pi-minus"
                @click="collapseAll"
              />
            </div>
            <div class="justify-content-right">
              <Button
                :label="$t('Clear filter results')"
                class="p-button-outlined mr-2"
                icon="pi pi-filter-slash"
                type="button"
                @click="clearFilter()"
              />
              <span class="p-input-icon-left">
                <i class="mdi mdi-search" />
                <InputText
                  v-model="filters['global'].value"
                  :placeholder="$t('Search')"
                />
              </span>
            </div>
          </div>
        </div>
      </template>
      <template #empty>
        {{ $t("There are no sessions available") }}
      </template>
      <template #loading>
        {{ $t("Loading sessions. Please wait.") }}
      </template>
      <Column
        :expander="true"
        header-style="width: 3rem"
      />
      <Column
        :header="$t('Title')"
        :sortable="true"
        class="session-name"
        field="title"
        style="min-width: 12rem"
      >
        <template #body="{ data }">
          {{ data.title }}
        </template>
      </Column>
      <Column
        :header="$t('Session description')"
        :sortable="true"
        field="description"
        style="min-width: 12rem"
      >
        <template #body="{ data }">
          <!-- eslint-disable-next-line vue/no-v-html -->
          <span v-html="data.description" />
        </template>
      </Column>
      <Column
        :header="$t('Category')"
        :sortable="true"
        field="category"
        style="min-width: 12rem"
      >
        <template #body="{ data }">
          <span v-if="data.category">
            <em class="pi pi-tag course-category-icon" />
            {{ data.category.title }}
          </span>
        </template>
      </Column>
      <Column
        :header="$t('Start Date')"
        :sortable="true"
        field="displayStartDate"
        style="min-width: 12rem"
      >
        <template #body="{ data }">
          <i class="pi pi-calendar-times" /> {{ formatDate(data.displayStartDate) }}
        </template>
      </Column>
      <Column
        field="sessionlink"
        header=""
        style="min-width: 8rem"
      >
        <template #body="{ data }">
          <BaseAppLink
            :url="'/main/session/resume_session.php?id_session=' + data.id"
            class="p-button-sm"
          >
            <BaseIcon icon="link-external" />
            {{ t("Go to the session") }}
          </BaseAppLink>
        </template>
      </Column>
      <template #expansion="item">
        <div class="orders-subtable">
          <h5>{{ $t("Courses in this session") + " - " + item.data.title }}</h5>
          <DataTable
            :value="item.data.courses"
            responsive-layout="scroll"
            striped-rows
          >
            <Column header="">
              <template #body="{ data }">
                <img
                  :alt="data.course.title"
                  :src="data.course.illustrationUrl"
                  class="course-image"
                />
              </template>
            </Column>
            <Column
              :header="$t('Title')"
              :sortable="true"
              field="course.title"
            >
              <template #body="{ data }">
                {{ data.course.title }}
              </template>
            </Column>
            <Column
              :header="$t('Language')"
              :sortable="true"
              field="course.courseLanguage"
              style="min-width: 6rem"
            >
              <template #body="{ data }">
                {{ getOriginalLanguageName(data.course.courseLanguage) }}
              </template>
            </Column>
            <Column
              :header="$t('Categories')"
              :sortable="true"
              field="course.categories"
              style="min-width: 8rem"
            >
              <template #body="{ data }">
                <span
                  v-for="category in data.course.categories"
                  :key="category.id"
                >
                  <em class="pi pi-tag course-category-icon" />
                  <span class="course-category">{{ category.title }}</span
                  ><br />
                </span>
              </template>
            </Column>
            <Column
              field="link"
              header=""
              style="min-width: 8rem"
            >
              <template #body="{ data }">
                <BaseAppLink :to="{ name: 'CourseHome', params: { id: data.course.id } }">
                  <BaseIcon
                    class="p-button-sm"
                    icon="link-external"
                  />
                  {{ t("Go to the course") }}
                </BaseAppLink>
              </template>
            </Column>
          </DataTable>
        </div>
      </template>
      <template #footer>
        {{ $t("Number of sessions").concat(": ", sessions ? sessions.length.toString() : "0") }}
      </template>
    </DataTable>
  </div>
</template>
<script>
import { ENTRYPOINT } from "../../config/entrypoint"
import axios from "axios"
import { FilterMatchMode } from "primevue/api"
import Button from "primevue/button"
import DataTable from "primevue/datatable"
import Column from "primevue/column"
import BaseAppLink from "../../components/basecomponents/BaseAppLink.vue"
import BaseIcon from "../../components/basecomponents/BaseIcon.vue"

export default {
  name: "SessionCatalog",
  components: {
    BaseIcon,
    BaseAppLink,
    DataTable,
    Column,
    Button,
  },
  data() {
    return {
      status: null,
      sessions: [],
      filters: null,
      expandedRows: [],
    }
  },
  created: function () {
    this.load()
    this.initFilters()
  },
  mounted: function () {},
  methods: {
    load: function () {
      this.status = true
      axios
        .get(ENTRYPOINT + "sessions.json")
        .then((response) => {
          this.status = false
          if (Array.isArray(response.data)) {
            this.sessions = response.data
          }
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    clearFilter() {
      this.initFilters()
    },
    initFilters() {
      this.filters = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
      }
    },
    expandAll() {
      this.expandedRows = this.sessions.filter((p) => p.id)
    },
    collapseAll() {
      this.expandedRows = null
    },
    formatDate(value) {
      return new Date(value).toLocaleDateString(undefined, {
        month: "long",
        day: "numeric",
        year: "numeric",
      })
    },
    getOriginalLanguageName(courseLanguage) {
      const languages = window.languages
      let language = languages.find((element) => element.isocode === courseLanguage)
      if (language) {
        return language.originalName
      } else {
        return ""
      }
    },
  },
}
</script>
=======
  <div class="catalogue-sessions p-4">
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
      <div>
        <strong>{{ $t("Total number of sessions") }}:</strong>
        {{ sessions?.length || 0 }}<br />
        <strong>{{ $t("Matching sessions") }}:</strong>
        {{ filteredSessions.length }}
      </div>
      <div class="flex gap-3">
        <Button
          :label="$t('Clear filter results')"
          class="p-button-outlined"
          icon="pi pi-filter-slash"
          @click="clearFilter()"
        />
        <span class="p-input-icon-left">
          <i class="pi pi-search" />
          <InputText
            v-model="filters['global'].value"
            :placeholder="$t('Search')"
            class="w-64"
          />
        </span>
      </div>
    </div>

    <div
      v-if="status"
      class="text-center text-gray-500 py-6"
    >
      {{ $t("Loading sessions. Please wait.") }}
    </div>

    <div
      v-else-if="!filteredSessions.length"
      class="text-center text-gray-500 py-6"
    >
      {{ $t("No session available") }}
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 px-4">
      <CatalogueSessionCard
        v-for="session in visibleSessions"
        :key="session.id"
        :session="session"
        @rate="onRatingChange"
        @subscribed="onSessionSubscribed"
      />
    </div>

    <div
      v-if="loadingMore"
      class="text-center text-gray-400 py-4"
    >
      {{ $t("Loading more sessions...") }}
    </div>
  </div>
</template>
<script setup>
import { computed, onMounted, onUnmounted, ref, watch } from "vue"
import InputText from "primevue/inputtext"
import Button from "primevue/button"
import { FilterMatchMode } from "primevue/api"
import axios from "axios"
import CatalogueSessionCard from "../../components/session/CatalogueSessionCard.vue"
import { useSecurityStore } from "../../store/securityStore"
import * as userRelCourseVoteService from "../../services/userRelCourseVoteService"
import { useRouter } from "vue-router"

const router = useRouter()
const securityStore = useSecurityStore()

if (!securityStore.user?.id) {
  router.push({ name: "Login" })
  throw new Error("No active session. Redirecting to login.")
}

const currentUserId = securityStore.user.id
const urlId = window.access_url_id

const status = ref(false)
const sessions = ref([])
const filters = ref({ global: { value: null, matchMode: FilterMatchMode.CONTAINS } })

const rowsPerScroll = 9
const visibleCount = ref(rowsPerScroll)
const loadingMore = ref(false)

const saveOrUpdateVote = async (session, value) => {
  try {
    const sessionId = session.id
    const allVotes = await userRelCourseVoteService.getUserVotes({
      userId: currentUserId,
      urlId,
    })

    const existingVote = allVotes.find(
      (v) =>
        v.session &&
        parseInt(v.session.split("/").pop()) === sessionId &&
        (v.course === null || v.course === undefined),
    )

    if (existingVote?.["@id"]) {
      const updated = await userRelCourseVoteService.updateVote({
        iri: existingVote["@id"],
        vote: value,
        sessionId,
        urlId,
      })
      session.userVote = { ...existingVote, vote: updated.vote }
    } else {
      session.userVote = await userRelCourseVoteService.saveVote({
        courseIri: null,
        userId: currentUserId,
        vote: value,
        sessionId,
        urlId,
      })
    }
  } catch (e) {
    console.error("Error saving/updating vote:", e)
  }
}

const onRatingChange = ({ value, session }) => {
  if (value > 0) {
    saveOrUpdateVote(session, value)
  }
}

const onSessionSubscribed = (sessionId) => {
  const session = sessions.value.find((s) => s.id === sessionId)
  if (session) {
    session.isSubscribed = true
  }
}

const load = async () => {
  status.value = true
  try {
    const response = await axios.get("/catalogue/sessions-list")
    sessions.value = response.data.map((s) => ({
      ...s,
      userVote: null,
    }))

    const votes = await userRelCourseVoteService.getUserVotes({
      userId: currentUserId,
      urlId,
    })

    for (const vote of votes) {
      const sessionId = vote.session?.id ?? parseInt(vote.session?.split("/")?.pop())
      const session = sessions.value.find((s) => s.id === sessionId)
      if (session) {
        session.userVote = vote
      }
    }

    const sessionSubs = await axios.get(`/api/session_rel_users?user=${currentUserId}`)

    for (const sub of sessionSubs.data["hydra:member"]) {
      const sessionId = sub.session?.id ?? parseInt(sub.session?.split("/")?.pop())
      const session = sessions.value.find((s) => s.id === sessionId)
      if (session) {
        session.isSubscribed = true
      }
    }
  } catch (error) {
    console.log(error)
  } finally {
    status.value = false
  }
}

onMounted(() => {
  window.addEventListener("scroll", handleScroll)
  load()
})

onUnmounted(() => {
  window.removeEventListener("scroll", handleScroll)
})

const clearFilter = () => {
  filters.value.global.value = null
  visibleCount.value = rowsPerScroll
}

const filteredSessions = computed(() => {
  const keyword = filters.value.global.value?.toLowerCase()
  if (!keyword) return sessions.value
  return sessions.value.filter((session) => {
    return (
      session.title?.toLowerCase().includes(keyword) ||
      session.description?.toLowerCase().includes(keyword) ||
      session.category?.title?.toLowerCase().includes(keyword) ||
      session.courses?.some((sc) => sc.courseLanguage?.toLowerCase().includes(keyword))
    )
  })
})

const visibleSessions = computed(() => {
  return filteredSessions.value.slice(0, visibleCount.value)
})

const handleScroll = () => {
  if (loadingMore.value) return

  const threshold = 150
  const scrollTop = window.scrollY
  const viewportHeight = window.innerHeight
  const fullHeight = document.documentElement.scrollHeight

  if (scrollTop + viewportHeight + threshold >= fullHeight) {
    if (visibleCount.value < filteredSessions.value.length) {
      loadingMore.value = true
      setTimeout(() => {
        visibleCount.value += rowsPerScroll
        loadingMore.value = false
      }, 400)
    }
  }
}

watch(
  () => filters.value.global.value,
  () => {
    visibleCount.value = rowsPerScroll
  },
)
</script>
<style scoped>
.catalogue-sessions {
  width: 100%;
}
</style>
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
