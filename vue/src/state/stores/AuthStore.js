import { defineStore } from "pinia";

export const useAuthStore = defineStore("auth", {
  state: () => {
    return {
      username: null,
      jwt: null,
      timeJwtSet: null,
    };
  },
  getters: {
    isAuthenticated() {
      // TODO => something with a check on timeJwtSet when the jwt is set
      if (this.jwt != null) {
        return true;
      }
    },
  },
  actions: {
    loginUser() {},
    logoutUser() {
      this.$reset();
    },
  },
});
