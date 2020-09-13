import Axios from "./axios";
import {apiURL} from "@services/api/axios";

export default {
  all() {
    return Axios.get(apiURL + "staff/contributions");
  },
  covenant(payload) {
    return Axios.post(apiURL + "staff/contributions/covenant-partner", payload);
  },
  covedelete(mask) {
    return Axios.delete(apiURL + "staff/contributions/covenant-partner/" + mask);
  },
  coveshow(mask) {
    return Axios.get(apiURL + "staff/contributions/covenant-partner/" + mask);
  },
  coveupdate(payload, mask) {
    return Axios.put(apiURL + "staff/contributions/covenant-partner/" + mask, payload);
  },
  busing(payload) {
    return Axios.post(apiURL + "staff/contributions/busing", payload);
  },
  busingshow(mask) {
    return Axios.get(apiURL + "staff/contributions/busing/" + mask);
  },
  busingupdate(payload, mask) {
    return Axios.put(apiURL + "staff/contributions/busing/" + mask, payload);
  },
  busingdelete(mask) {
    return Axios.delete(apiURL + "staff/contributions/busing/" + mask);
  },
  titheAdd(payload) {
    return Axios.post(apiURL + "staff/contributions/tithes", payload);
  },
  titheShow(mask) {
    return Axios.get(apiURL + "staff/contributions/tithes/" + mask);
  },
  titheUpdate(payload, mask) {
    return Axios.put(apiURL + "staff/contributions/tithes/" + mask, payload);
  },
  tithedelete(mask) {
    return Axios.delete(apiURL + "staff/contributions/tithes/" + mask);
  },
  groupAdd(payload) {
    return Axios.post(apiURL + "staff/contributions/groups", payload);
  },
  groupShow(mask) {
    return Axios.get(apiURL + "staff/contributions/groups/" + mask);
  },
  groupUpdate(payload, mask) {
    return Axios.put(apiURL + "staff/contributions/groups/" + mask, payload);
  },
  groupdelete(mask) {
    return Axios.delete(apiURL + "staff/contributions/groups/" + mask);
  },
  welfareAdd(payload) {
    return Axios.post(apiURL + "staff/contributions/welfare", payload);
  },
  welfareShow(mask) {
    return Axios.get(apiURL + "staff/contributions/welfare/" + mask);
  },
  welfareUpdate(payload, mask) {
    return Axios.put(apiURL + "staff/contributions/welfare/" + mask, payload);
  },
  welfaredelete(mask) {
    return Axios.delete(apiURL + "staff/contributions/welfare/" + mask);
  },
  pledgeAdd(payload) {
    return Axios.post(apiURL + "staff/contributions/pledge", payload);
  },
  pledgeShow(mask) {
    return Axios.get(apiURL + "staff/contributions/pledge/" + mask);
  },
  pledgeUpdate(payload, mask) {
    return Axios.put(apiURL + "staff/contributions/pledge/" + mask, payload);
  },
  pledgedelete(mask) {
    return Axios.delete(apiURL + "staff/contributions/pledge/" + mask);
  },

  generalAdd(payload) {
    return Axios.post(apiURL + "staff/contributions/general", payload);
  },
  generaldelete(mask) {
    return Axios.delete(apiURL + "staff/contributions/general/" + mask);
  },
  generalShow(mask) {
    return Axios.get(apiURL + "staff/contributions/general/" + mask);
  },
  generalUpdate(payload, mask) {
    return Axios.put(apiURL + "staff/contributions/general/" + mask, payload);
  },
};
