import axios from "./axios";
import {apiURL} from "@services/api/axios";

export default {
  expensetemplate() {
    return axios.get(apiURL + "staff/expenses/template");
  },
  importexpense(payload) {
    return axios.post(apiURL + "staff/expenses/import", payload);
  },
  contributiontemplate() {
    return axios.get(apiURL + "staff/contributions/template");
  },
  importcontribution(payload) {
    return axios.post(apiURL + "staff/contributions/import", payload);
  },
  peopletemplate() {
    return axios.get(apiURL + "staff/people/template");
  },
  importpeople(payload) {
    return axios.post(apiURL + "staff/people/import", payload);
  },
};
