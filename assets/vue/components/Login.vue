<template>
  <div class="login-section">
    <h2
      v-t="'Sign in'"
      class="login-section__title"
    />

    <form
      class="login-section__form p-input-filled"
      @submit.prevent="onSubmitLoginForm"
    >
      <div class="field">
        <InputText
          id="login"
          v-model="login"
          :placeholder="t('Username')"
          type="text"
        />
      </div>

      <div class="field">
        <Password
          v-model="password"
          :feedback="false"
          :placeholder="t('Password')"
          input-id="password"
          toggle-mask
        />
      </div>

<<<<<<< HEAD
=======
      <div v-if="requires2FA" class="field">
        <InputText
          v-model="totp"
          :placeholder="t('Enter 2FA code')"
          type="text"
        />
      </div>

>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
      <div class="field login-section__remember-me">
        <InputSwitch
          v-model="remember"
          input-id="binary"
          name="remember_me"
          tabindex="4"
        />
        <label
          v-t="'Remember me'"
          for="binary"
        />
      </div>

      <div class="field login-section__buttons">
        <Button
<<<<<<< HEAD
          :label="t('Sign in')"
=======
          :label="requires2FA ? t('Submit code') : t('Sign in')"
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
          :loading="isLoading"
          type="submit"
        />

        <a
          v-if="allowRegistration"
<<<<<<< HEAD
          v-t="'Register oneself'"
=======
          v-t="'Sign up'"
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
          class="btn btn--primary-outline"
          href="/main/auth/inscription.php"
          tabindex="3"
        />
      </div>

      <div class="field text-center">
        <a
          id="forgot"
          v-t="'Forgot your password?'"
          class="field"
          href="/main/auth/lostPassword.php"
          tabindex="5"
        />
      </div>
    </form>

<<<<<<< HEAD
    <ExternalLoginButtons />
=======
    <LoginOAuth2Buttons />
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
  </div>
</template>

<script setup>
import { computed, ref } from "vue"
import Button from "primevue/button"
import InputText from "primevue/inputtext"
import Password from "primevue/password"
import InputSwitch from "primevue/inputswitch"
import { useI18n } from "vue-i18n"
import { useLogin } from "../composables/auth/login"
<<<<<<< HEAD
import ExternalLoginButtons from "./login/LoginExternalButtons.vue"
=======
import LoginOAuth2Buttons from "./login/LoginOAuth2Buttons.vue"
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
import { usePlatformConfig } from "../store/platformConfig"

const { t } = useI18n()
const platformConfigStore = usePlatformConfig()
const allowRegistration = computed(() => "false" !== platformConfigStore.getSetting("registration.allow_registration"))

const { redirectNotAuthenticated, performLogin, isLoading } = useLogin()

const login = ref("")
const password = ref("")
<<<<<<< HEAD
const remember = ref(false)

redirectNotAuthenticated()

function onSubmitLoginForm() {
  performLogin({
    login: login.value,
    password: password.value,
    _remember_me: remember.value,
  })
=======
const totp = ref("")
const remember = ref(false)
const requires2FA = ref(false)

redirectNotAuthenticated()

async function onSubmitLoginForm() {
  const response = await performLogin({
    login: login.value,
    password: password.value,
    totp: requires2FA.value ? totp.value : null,
    _remember_me: remember.value,
  })

  if (response.requires2FA) {
    requires2FA.value = true
  } else {
    router.replace({ name: "Home" })
  }
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
}
</script>
