import axios from "./axios";
import { apiURL } from "@services/api/axios";

export default {
  attendance(params) {
    return axios.get(apiURL + "staff/reports/attendance", params);
  },
  contribution(params) {
    return axios.get(apiURL + "staff/reports/contributions", params);
  },
  expenses(params) {
    return axios.get(apiURL + "staff/reports/expenses", params);
  },
  pastor(params) {
    return axios.post(apiURL + "staff/reports/expenses", params);
  }
};
