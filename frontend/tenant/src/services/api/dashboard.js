import Axios, {apiURL} from "./axios";

export default {
  init() {
    return Axios.get(apiURL + "staff/dashboard");
  },
};
