import axios from "./axios";
import { apiURL } from "@services/api/axios";

export default {
  store(payload) {
    return axios.post(apiURL + "staff/pastors-report", payload);
  },
  all() {
    return axios.get(apiURL + "staff/pastors-report");
  }
};
