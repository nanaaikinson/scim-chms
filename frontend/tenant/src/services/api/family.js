import axios from "./axios";
import {apiURL} from "@services/api/axios";

export default {
  all() {
    return axios.get(apiURL + "staff/family");
  },
  store(payload) {
    return axios.post(apiURL + "staff/family", payload);
  },
  show(mask) {
    return axios.get(apiURL + "staff/family/" + mask);
  },
  update(payload, mask) {
    return axios.put(apiURL + "staff/family/" + mask, payload);
  },
  delete(mask) {
    return axios.delete(apiURL + "staff/family/" + mask);
  },
};
