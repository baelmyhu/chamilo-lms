<template>
<<<<<<< HEAD
  <div class="card">
    <DataTable
      v-model:filters="filters"
      :global-filter-fields="['title', 'description', 'category.title', 'courseLanguage']"
      :loading="status"
      :paginator="true"
      :rows="9"
      :value="courses"
      class="p-datatable-courses p-datatable-lg"
      data-key="id"
      edit-mode="cell"
      filter-display="menu"
      responsive-layout="scroll"
      striped-rows
    >
      <template #header>
        <div class="table-header-container">
          <div class="flex justify-content-end">
            <Button
              :label="$t('Clear filter results')"
              class="p-button-outlined mr-2"
              icon="pi pi-filter-slash"
              type="button"
              @click="clearFilter()"
            />
            <span class="p-input-icon-left">
              <i class="pi pi-search" />
              <InputText
                v-model="filters['global'].value"
                :placeholder="$t('Search')"
              />
            </span>
          </div>
        </div>
      </template>
      <template #empty>
        {{ $t("No course available") }}
      </template>
      <template #loading>
        {{ $t("Loading courses. Please wait.") }}
      </template>
      <Column
        header=""
        style="min-width: 5rem"
      >
        <template #body="{ data }">
          <img
            :alt="data.title"
            :src="data.illustrationUrl"
            class="course-image"
          />
        </template>
      </Column>
      <Column
        :header="$t('Title')"
        :sortable="true"
        field="title"
        style="min-width: 8rem; text-align: center"
      >
        <template #body="{ data }">
          {{ data.title }}
        </template>
      </Column>
      <Column
        v-if="showCourseDuration"
        :header="$t('Course description')"
        :sortable="true"
        field="description"
        style="min-width: 8rem; text-align: center"
      >
        <template #body="{ data }">
          {{ data.description }}
        </template>
      </Column>

      <Column
        :header="$t('Duration')"
        :sortable="true"
        field="duration"
        style="min-width: 8rem; text-align: center"
      >
        <template #body="{ data }">
          <div
            v-if="data.duration"
            class="course-duration"
          >
            {{ (data.duration / 60 / 60).toFixed(2) }} hours
          </div>
        </template>
      </Column>

      <Column
        :header="$t('Teachers')"
        :sortable="true"
        field="teachers"
        style="min-width: 10rem; text-align: center"
      >
        <template #body="{ data }">
          <div v-if="data.teachers && data.teachers.length > 0">
            {{ data.teachers.map((teacher) => teacher.user.fullName).join(", ") }}
          </div>
        </template>
      </Column>
      <Column
        :header="$t('Language')"
        :sortable="true"
        field="courseLanguage"
        style="min-width: 5rem; text-align: center"
      >
        <template #body="{ data }">
          {{ data.courseLanguage }}
        </template>
      </Column>
      <Column
        :header="$t('Categories')"
        :sortable="true"
        field="categories"
        style="min-width: 8rem; text-align: center"
      >
        <template #body="{ data }">
          <span
            v-for="category in data.categories"
            :key="category.id"
          >
            <em class="pi pi-tag course-category-icon" />
            <span class="course-category">{{ category.title }}</span
            ><br />
          </span>
        </template>
      </Column>
      <Column
        :header="$t('Ranking')"
        :sortable="true"
        field="trackCourseRanking.realTotalScore"
        style="min-width: 10rem; text-align: center"
      >
        <template #body="{ data }">
          <Rating
            :cancel="false"
            :model-value="data.trackCourseRanking ? data.trackCourseRanking.realTotalScore : 0"
            :stars="5"
            class="pointer-events: none"
            @change="onRatingChange($event, data.trackCourseRanking, data.id)"
          />
        </template>
      </Column>
      <Column
        field="link"
        header=""
        style="min-width: 10rem; text-align: center"
      >
        <template #body="{ data }">
          <router-link
            v-if="data.visibility === 3"
            :to="{ name: 'CourseHome', params: { id: data.id } }"
          >
            <Button
              :label="$t('Go to the course')"
              class="btn btn--primary text-white"
              icon="pi pi-external-link"
            />
          </router-link>
          <router-link
            v-else-if="data.visibility === 2 && isUserInCourse(data)"
            :to="{ name: 'CourseHome', params: { id: data.id } }"
          >
            <Button
              :label="$t('Go to the course')"
              class="btn btn--primary text-white"
              icon="pi pi-external-link"
            />
          </router-link>
          <Button
            v-else-if="data.visibility === 2 && !isUserInCourse(data)"
            :label="$t('Not subscribed')"
            class="btn btn--primary text-white"
            disabled
            icon="pi pi-times"
          />
          <Button
            v-else
            :label="$t('Private course')"
            class="btn btn--primary text-white"
            disabled
            icon="pi pi-lock"
          />
        </template>
      </Column>
      <template #footer>
        {{ $t("Total number of courses").concat(": ", courses ? courses.length.toString() : "0") }}
      </template>
    </DataTable>
  </div>
</template>
<script setup>
import { ref } from "vue"
import { FilterMatchMode } from "primevue/api"
import Button from "primevue/button"
import DataTable from "primevue/datatable"
import Column from "primevue/column"
import Rating from "primevue/rating"
import { usePlatformConfig } from "../../store/platformConfig"
import { useSecurityStore } from "../../store/securityStore"

import courseService from "../../services/courseService"
import * as trackCourseRanking from "../../services/trackCourseRankingService"

import { useNotification } from "../../composables/notification"
import { useLanguage } from "../../composables/language"

const { showErrorNotification } = useNotification()
const { findByIsoCode: findLanguageByIsoCode } = useLanguage()

const securityStore = useSecurityStore()
const status = ref(false)
const courses = ref([])
const filters = ref(null)
const currentUserId = securityStore.user.id

const platformConfigStore = usePlatformConfig()
const showCourseDuration = "true" === platformConfigStore.getSetting("course.show_course_duration")

async function load() {
  status.value = true

  try {
    const { items } = await courseService.listAll()

    courses.value = items.map((course) => ({
      ...course,
      courseLanguage: findLanguageByIsoCode(course.courseLanguage)?.originalName,
    }))
=======
  <div class="catalogue-courses p-4">
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
      <div>
        <strong>{{ $t("Total number of courses") }}:</strong>
        {{ totalVisibleCourses }}<br />
        <strong>{{ $t("Matching courses") }}:</strong>
        {{ totalVisibleCourses }}
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
      {{ $t("Loading courses. Please wait.") }}
    </div>
    <div
      v-else-if="!filteredCourses.length"
      class="text-center text-gray-500 py-6"
    >
      {{ $t("No course available") }}
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 px-4">
      <CatalogueCourseCard
        v-for="course in visibleCourses"
        :key="course.id"
        :course="course"
        :current-user-id="currentUserId"
        @rate="onRatingChange"
        @subscribed="onUserSubscribed"
      />
    </div>

    <div
      v-if="loadingMore"
      class="text-center text-gray-400 py-4"
    >
      {{ $t("Loading more courses...") }}
    </div>
  </div>
</template>
<script setup>
import { computed, onMounted, onUnmounted, ref, watch } from "vue"
import InputText from "primevue/inputtext"
import Button from "primevue/button"
import { FilterMatchMode } from "primevue/api"
import courseService from "../../services/courseService"
import { useNotification } from "../../composables/notification"
import { useLanguage } from "../../composables/language"
import { useSecurityStore } from "../../store/securityStore"
import CatalogueCourseCard from "../../components/course/CatalogueCourseCard.vue"
import * as userRelCourseVoteService from "../../services/userRelCourseVoteService"
import { useRouter } from "vue-router"
import { usePlatformConfig } from "../../store/platformConfig"

const { showErrorNotification } = useNotification()
const { findByIsoCode } = useLanguage()
const router = useRouter()
const securityStore = useSecurityStore()
const platformConfigStore = usePlatformConfig()

if (!securityStore.user?.id) {
  router.push({ name: "Login" })
  throw new Error("No active session. Redirecting to login.")
}

const currentUserId = securityStore.user.id
const status = ref(false)
const courses = ref([])
const filters = ref({ global: { value: null, matchMode: FilterMatchMode.CONTAINS } })

const rowsPerScroll = 9
const visibleCount = ref(rowsPerScroll)
const loadingMore = ref(false)

const onUserSubscribed = ({ courseId, newUser }) => {
  const course = courses.value.find((c) => c.id === courseId)
  if (course) {
    course.users.push(newUser)
  }
}

const load = async () => {
  status.value = true
  try {
    const { items } = await courseService.listAll({}, true)
    courses.value = items.map((course) => ({
      ...course,
      courseLanguage: findByIsoCode(course.courseLanguage)?.originalName || course.courseLanguage,
      userVote: null,
    }))

    const votes = await userRelCourseVoteService.getUserVotes({
      userId: currentUserId,
      urlId: window.access_url_id,
    })

    for (const vote of votes) {
      let courseId
      if (typeof vote.course === "object" && vote.course !== null) {
        courseId = vote.course.id
      } else if (typeof vote.course === "string") {
        courseId = parseInt(vote.course.split("/").pop())
      }

      const course = courses.value.find((c) => c.id === courseId)
      if (course) {
        course.userVote = vote
      }
    }
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
  } catch (error) {
    showErrorNotification(error)
  } finally {
    status.value = false
  }
}

<<<<<<< HEAD
async function updateRating(id, value) {
  status.value = true

  try {
    const response = await trackCourseRanking.updateRanking({
      iri: `/api/track_course_rankings/${id}`,
      totalScore: value,
    })

    courses.value.forEach((course) => {
      if (course.trackCourseRanking && course.trackCourseRanking.id === id) {
        course.trackCourseRanking.realTotalScore = response.realTotalScore
      }
    })
  } catch (e) {
    showErrorNotification(e)
  } finally {
    status.value = false
  }
}

const newRating = async function (courseId, value) {
  status.value = true

  try {
    const response = await trackCourseRanking.saveRanking({
      totalScore: value,
      courseIri: `/api/courses/${courseId}`,
      urlId: window.access_url_id,
      sessionId: 0,
    })

    courses.value.forEach((course) => {
      if (course.id === courseId) {
        course.trackCourseRanking = response
      }
    })
  } catch (e) {
    showErrorNotification(e)
  } finally {
    status.value = false
  }
}

const isUserInCourse = (course) => {
  return course.users.some((user) => user.user.id === currentUserId)
}

const clearFilter = function () {
  initFilters()
}

const initFilters = function () {
  filters.value = {
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
  }
}

const onRatingChange = function (event, trackCourseRanking, courseId) {
  let { value } = event
  if (value > 0) {
    if (trackCourseRanking) updateRating(trackCourseRanking.id, value)
    else newRating(courseId, value)
  } else {
    event.preventDefault()
  }
}

load()
initFilters()
</script>
<style scoped>
.p-datatable .p-datatable-thead > tr > th {
  text-align: center !important;
}

.course-image {
  width: 100px;
  height: auto;
}

.course-duration {
  text-align: center;
  font-weight: bold;
}

.btn--primary {
  background-color: #007bff;
  border-color: #007bff;
  color: #fff;
=======
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

const filteredCourses = computed(() => {
  const keyword = filters.value.global.value?.toLowerCase()
  if (!keyword) return courses.value
  return courses.value.filter(
    (course) =>
      course.title?.toLowerCase().includes(keyword) ||
      course.description?.toLowerCase().includes(keyword) ||
      course.categories?.some((cat) => cat.title.toLowerCase().includes(keyword)) ||
      course.courseLanguage?.toLowerCase().includes(keyword),
  )
})

const visibleCoursesBase = computed(() => {
  const hidePrivate = platformConfigStore.getSetting("platform.course_catalog_hide_private") === "true"

  return filteredCourses.value
    .filter((course) => {
      const visibility = Number(course.visibility)
      if (visibility === 0 || visibility === 4) return false
      if (visibility === 1 && hidePrivate) return false
      return true
    })
    .sort((a, b) => a.title.localeCompare(b.title, undefined, { numeric: true, sensitivity: "base" }))
})

const visibleCourses = computed(() => {
  return visibleCoursesBase.value.slice(0, visibleCount.value)
})

const totalVisibleCourses = computed(() => visibleCoursesBase.value.length)

const handleScroll = () => {
  if (loadingMore.value) return

  const threshold = 150
  const scrollTop = window.scrollY
  const viewportHeight = window.innerHeight
  const fullHeight = document.documentElement.scrollHeight

  if (scrollTop + viewportHeight + threshold >= fullHeight) {
    if (visibleCount.value < visibleCoursesBase.value.length) {
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

const saveOrUpdateVote = async (course, value) => {
  try {
    const sessionId = 0
    const urlId = window.access_url_id
    const courseId = course.id
    const courseIri = `/api/courses/${courseId}`

    const existingVote = await userRelCourseVoteService.getUserVote({
      userId: currentUserId,
      courseId,
      sessionId,
      urlId,
    })

    if (existingVote?.["@id"]) {
      const updated = await userRelCourseVoteService.updateVote({
        iri: existingVote["@id"],
        vote: value,
        sessionId,
        urlId,
      })

      course.userVote = { ...existingVote, vote: updated.vote }
    } else {
      const newVote = await userRelCourseVoteService.saveVote({
        courseIri,
        userId: currentUserId,
        vote: value,
        sessionId,
        urlId,
      })
      course.userVote = newVote
    }
  } catch (e) {
    showErrorNotification(e)
  }
}

const onRatingChange = ({ value, course }) => {
  if (value > 0) {
    saveOrUpdateVote(course, value)
  }
}
</script>
<style scoped>
.catalogue-courses {
  width: 100%;
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
}
</style>
