import { defineStore } from "pinia"
import { useSecurityStore } from "./securityStore"
import { messageService } from "../services/message"
import { MESSAGE_TYPE_INBOX } from "../components/message/constants"

export const useMessageRelUserStore = defineStore("messageRelUser", {
  state: () => ({
    countUnread: 0,
  }),
  actions: {
    async findUnreadCount() {
      const securityStore = useSecurityStore()

      try {
        const params = {
          "order[sendDate]": "desc",
          "receivers.read": false,
          "receivers.receiver": securityStore.user["@id"],
          itemsPerPage: 1,
          msgType: MESSAGE_TYPE_INBOX,
        }
        const response = await messageService.countUnreadMessages(params)

        if (response && response["hydra:totalItems"] !== undefined) {
          this.countUnread = response["hydra:totalItems"]
        } else {
          this.countUnread = 0
        }
      } catch (error) {
        console.error("Error fetching unread count:", error)
        this.countUnread = 0
      }
    },
  },
})
