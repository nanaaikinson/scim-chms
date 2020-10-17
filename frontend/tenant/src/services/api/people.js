import axios from "./axios";
import { apiURL } from "@services/api/axios";

export default {
  all() {
    return axios.get(apiURL + "staff/people");
  },
  members() {
    return axios.get(apiURL + "staff/people/read-only");
  },
  readOnly() {
    return axios.get(apiURL + "staff/people/read-only");
  },
  store(payload) {
    return axios.post(apiURL + "staff/people", payload);
  },
  show(mask) {
    return axios.get(apiURL + "staff/people/" + mask);
  },
  update(payload, mask) {
    return axios.post(apiURL + "staff/people/" + mask, payload);
  },
  delete(mask) {
    return axios.delete(apiURL + "staff/people/" + mask);
  },
  person: {
    details(mask) {
      return axios.get(apiURL + "staff/people/" + mask + "/details");
    },
    attendance(mask, params) {
      return axios.get(apiURL + "staff/people/" + mask + "/attendance", params);
    },
    followUp(mask, params) {
      return axios.get(apiURL + "staff/people/" + mask + "/follow-ups", params);
    },
    contributions(mask, params) {
      return axios.get(
        apiURL + "staff/people/" + mask + "/contributions",
        params
      );
    }
  }
};
