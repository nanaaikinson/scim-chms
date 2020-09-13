import axios from "./axios";
import {apiURL} from "@services/api/axios";

export default {
  all() {
    return axios.get(apiURL + "staff/groups");
  },
  store(payload) {
    return axios.post(apiURL + "staff/groups", payload);
  },
  show(mask) {
    return axios.get(apiURL + "staff/groups/" + mask);
  },
  update(payload, mask) {
    return axios.put(apiURL + "staff/groups/" + mask, payload);
  },
  delete(mask) {
    return axios.delete(apiURL + "staff/groups/" + mask);
  },
};
