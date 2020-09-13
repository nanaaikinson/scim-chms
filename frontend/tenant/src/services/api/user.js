import axios from "./axios";
import {apiURL} from "@services/api/axios";

export default {
  all() {
    return axios.get(apiURL + "staff/users");
  },
  store(payload) {
    return axios.post(apiURL + "staff/users", payload);
  },
  show(mask) {
    return axios.get(apiURL + "staff/users/" + mask);
  },
  update(payload, mask) {
    return axios.put(apiURL + "staff/users/" + mask, payload);
  },
  delete(mask) {
    return axios.delete(apiURL + "staff/users/" + mask);
  },
};
