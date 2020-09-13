import Axios from "./axios";
import {apiURL} from "@services/api/axios";

export default {
  all() {
    return Axios.get(apiURL + "staff/contributions/pledges");
  },
  store(payload) {
    return Axios.post(apiURL + "staff/contributions/pledges", payload);
  },
  show(mask) {
    return Axios.get(apiURL + "staff/contributions/pledges/" + mask);
  },
  update(payload, mask) {
    return Axios.put(apiURL + "staff/contributions/pledges/" + mask, payload);
  },
  delete(mask) {
    return Axios.delete(apiURL + "staff/contributions/pledges/" + mask);
  },
};
