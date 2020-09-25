import Vue from "vue";
import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";
import Auth from "@services/api/auth";
import router from "@router";
const persistenceKey = window.location.pathname || "chms";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    user: {},
    auth: {
      email: "",
      password: "",
      remember: false,
    },
    settings: {
      currency: "GH₵",
    },
  },
  getters: {
    user(state) {
      return state.user;
    },
    avatar(state) {
      return state.user.avatar;
    },
    defaultAvatar(state) {
      return require("@assets/img/avatar.svg");
    },
    currency(state) {
      return state.settings.currency;
    },
  },

  mutations: {
    setUser(state, { name, email, avatar, permissions }) {
      state.user = { name, email, avatar, permissions };
    },
    setToken(state, token) {
      localStorage.setItem(`_${persistenceKey}_token`, token);
    },
    logout(state) {
      state.user = {};
      localStorage.removeItem(`_${persistenceKey}_token`);
    },
  },

  actions: {
    login({ commit }, payload) {
      return new Promise((resolve, reject) => {
        Auth.login(payload)
          .then(({ data: res }) => {
            commit("setUser", res.data.user);
            commit("setToken", res.data.token);

            resolve(true);
          })
          .catch((err) => {
            const { status, data } = err.response;

            reject({ status, data });
          });
      });
    },

    logout({ commit }) {
      Auth.logout()
        .then(() => {
          commit("logout");
          router.replace({ name: "Home" });
        })
        .catch((err) => console.log(err));
    },
  },
  plugins: [createPersistedState({ key: `_${persistenceKey}_store` })],
});
