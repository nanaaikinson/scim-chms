import axios from "axios";

const origin = window.location.origin;
const pathname = window.location.pathname;

export const apiURL = `${origin}${pathname}`;
const devURL = "/";

const Axios = axios.create({
  baseURL: process.env.NODE_ENV === "production" ? apiURL : devURL,
  timeout: 10000,
  params: {}
});


export default Axios;
