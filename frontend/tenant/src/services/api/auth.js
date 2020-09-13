import Axios, {apiURL} from "./axios";

export default {
  login(payload) {
    return Axios.post(apiURL + "staff/auth/login", payload);
  },
  logout() {
    return Axios.post(apiURL + "staff/auth/logout");
  },
  user() {
    return Axios.get(apiURL + "staff/profile");
  },
  passwordReset(payload) {
    return Axios.post(apiURL + "staff/auth/password-reset", payload);
  },
  detailsUpdate(payload) {
    return Axios.put(apiURL + "staff/profile/change-details", payload);
  },
  passwordUpdate(payload) {
    return Axios.put(apiURL + "staff/profile/change-password", payload);
  }
};
