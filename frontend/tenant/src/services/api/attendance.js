import Axios from "./axios";
import { apiURL } from "@services/api/axios";

export default {
  all() {
    return Axios.get(apiURL + "staff/attendance");
  },
  store(payload) {
    return Axios.post(apiURL + "staff/attendance", payload);
  },
  show(mask) {
    return Axios.get(apiURL + "staff/attendance/" + mask);
  },
  update(payload, mask) {
    return Axios.post(apiURL + "staff/attendance/" + mask, payload);
  },
  delete(mask) {
    return Axios.delete(apiURL + "staff/attendance/" + mask);
  },
  download(mask) {
    return Axios.get(`${apiURL}staff/attendance/${mask}/download`);
  },
  template(params) {
    return Axios.get(apiURL + "staff/attendance/template", params);
  }
};
