import axios from "./axios";
import {apiURL} from "@services/api/axios";

export default {
  all() {
    return axios.get(apiURL + "staff/roles");
  },
  rolepermissions() {
    return axios.get(apiURL + "staff/roles/permissions");
  },
  store(payload) {
    return axios.post(apiURL + "staff/roles", payload);
  },
  show(mask) {
    return axios.get(apiURL + "staff/roles/" + mask);
  },
  update(payload, mask) {
    return axios.put(apiURL + "staff/roles/" + mask, payload);
  },
  delete(mask) {
    return axios.delete(apiURL + "staff/roles/" + mask);
  },
};
