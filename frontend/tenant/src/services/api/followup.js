import Axios from "./axios";
import {apiURL} from "@services/api/axios";

export default {
  all() {
    return Axios.get(apiURL + "staff/follow-up");
  },
  store(formData) {
    return Axios.post(apiURL + "staff/follow-up", formData);
  },
  show(mask) {
    return Axios.get(apiURL + "staff/follow-up/" + mask);
  },
  update(formData, mask) {
    return Axios.put(apiURL + "staff/follow-up/" + mask, formData);
  },
  delete(mask) {
    return Axios.delete(apiURL + "staff/follow-up/" + mask);
  },
};
