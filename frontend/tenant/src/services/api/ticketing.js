import axios from "./axios";
import { apiURL } from "@services/api/axios";

export default {
  all() {
    return axios.get(apiURL + "staff/ticketing");
  },
  store(payload) {
    return axios.post(apiURL + "staff/ticketing", payload);
  },
  show(mask) {
    return axios.get(apiURL + "staff/ticketing/" + mask);
  },
  update(payload, mask) {
    return axios.put(apiURL + "staff/ticketing/" + mask, payload);
  },
  delete(mask) {
    return axios.delete(apiURL + "staff/ticketing/" + mask);
  }
};
