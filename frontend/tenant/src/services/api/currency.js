import axios from "./axios";
import { apiURL } from "@services/api/axios";

export default {
  get() {
    return axios.get(apiURL + "staff/settings/currency/all");
  },
  single() {
    return axios.get(apiURL + "staff/settings/currency");
  },
  update(payload) {
    return axios.put(apiURL + "staff/settings/currency", payload);
  }
};
