import axios from "./axios";

export default {
  all() {
    return axios.get("/staff/branches");
  },
  store(payload) {
    return axios.post("/staff/branches", payload);
  },
  show(mask) {
    return axios.get("/staff/branches/" + mask);
  },
  update(payload, mask) {
    return axios.put("/staff/branches/" + mask, payload);
  },
  delete(mask) {
    return axios.delete("/staff/branches/" + mask);
  }
};
