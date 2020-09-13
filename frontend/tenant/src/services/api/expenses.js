import axios from "./axios";
import {apiURL} from "@services/api/axios";

export default {
  all() {
    return axios.get(apiURL + "staff/expenses");
  },
  store(payload) {
    return axios.post(apiURL + "staff/expenses", payload);
  },
  show(mask) {
    return axios.get(apiURL + "staff/expenses/" + mask);
  },
  update(payload, mask) {
    return axios.put(apiURL + "staff/expenses/" + mask, payload);
  },
  delete(mask) {
    return axios.delete(apiURL + "staff/expenses/" + mask);
  },
};
