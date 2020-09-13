import axios from "./axios";
import {apiURL} from "@services/api/axios";

export default {
  attendance(params) {
    return axios.get(apiURL + "staff/reports/attendance", params);
  },
  expenses(params) {
    return axios.get(apiURL + "staff/reports/expenses", params);
  },
};
