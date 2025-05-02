import baseService from "./baseService"

/**
 * @param {string} login
 * @param {string} password
 * @param {boolean} _remember_me
 * @returns {Promise<Object>}
 */
<<<<<<< HEAD
async function login({ login, password, _remember_me }) {
  return await baseService.post("/login_json", {
    username: login,
    password,
    _remember_me,
  })
=======
async function login({ login, password, _remember_me, totp = null }) {
  const payload = {
    username: login,
    password,
    _remember_me,
  }

  if (totp) {
    payload.totp = totp
  }

  return await baseService.post("/login_json", payload)
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
}

/**
 * Checks the status of the user's session.
 * @returns {Promise<Object>}
 */
async function checkSession() {
  return await baseService.get("/check-session")
}

export default {
  login,
  checkSession,
}
