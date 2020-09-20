import axios from "axios";

const devURL = "/";

const Axios = axios.create({
  timeout: 10000,
  params: {}
});

export const apiURL =
  process.env.NODE_ENV === "production"
    ? window.location.origin + window.location.pathname + "/"
    : devURL;

export default Axios;
