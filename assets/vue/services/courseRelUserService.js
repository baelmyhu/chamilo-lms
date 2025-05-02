import baseService from "./baseService"

/**
 * @param {Object} searchParams
 * @returns {Promise<{totalItems, items}>}
 */
async function findAll(searchParams) {
  return await baseService.getCollection("/api/course_rel_users", searchParams)
}

<<<<<<< HEAD
export default {
  findAll,
=======
/**
 * Subscribes a user to a course.
 * @param {Object} params
 * @param {number} params.userId
 * @param {number} params.courseId
 * @returns {Promise<Object>}
 */
async function subscribe({ userId, courseId }) {
  return await baseService.post("/api/course_rel_users", {
    user: `/api/users/${userId}`,
    course: `/api/courses/${courseId}`,
    relationType: 0,
    status: 5,
  })
}

export default {
  findAll,
  subscribe,
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
}
