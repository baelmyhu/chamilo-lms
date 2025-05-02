<script setup>
import { ref } from "vue"
import { usePlatformConfig } from "../../store/platformConfig"
<<<<<<< HEAD
import { useVisualTheme } from "../../composables/theme"

const platformConfigStore = usePlatformConfig()
=======
import { useSecurityStore } from "../../store/securityStore"
import { useVisualTheme } from "../../composables/theme"

const platformConfigStore = usePlatformConfig()
const securityStore = useSecurityStore()

>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
const { getThemeAssetUrl } = useVisualTheme()

const siteName = platformConfigStore.getSetting("platform.site_name")

const sources = [getThemeAssetUrl("images/header-logo.svg"), getThemeAssetUrl("images/header-logo.png")]

const currentSrc = ref(sources[0])

const onError = () => {
  const currentIndex = sources.indexOf(currentSrc.value)

  if (currentIndex < sources.length - 1) {
    currentSrc.value = sources[currentIndex + 1]
  } else {
    console.error("All image sources failed to load.")
  }
}
</script>

<template>
  <div class="platform-logo">
<<<<<<< HEAD
    <BaseAppLink :to="{ name: 'Index' }">
=======
    <BaseAppLink :to="securityStore.user ? { name: 'Home' } : { name: 'Index' }">
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
      <img
        :alt="siteName"
        :src="currentSrc"
        :title="siteName"
        @error="onError"
      />
    </BaseAppLink>
  </div>
</template>
