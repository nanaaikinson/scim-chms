import Axios from "./axios";

export default {
  login(payload) {
    return Axios.post("/staff/auth/login", payload);
  },
  logout() {
    return Axios.post("/staff/auth/logout");
  },
  user() {
    return Axios.get("/staff/profile");
  },
  passwordReset(payload) {
    return Axios.post("/staff/auth/password-reset", payload);
  },
  detailsUpdate(payload) {
    return Axios.put("/staff/profile/change-details", payload);
  },
  passwordUpdate(payload) {
    return Axios.put("/staff/profile/change-password", payload);
  }
};
