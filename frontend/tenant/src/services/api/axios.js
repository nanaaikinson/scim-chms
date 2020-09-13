import axios from "axios";

const apiURL = "/";
const devURL = "/";
const Axios = axios.create({
  baseURL: process.env.NODE_ENV === "production" ? apiURL : devURL,
  timeout: 10000,
  params: {}
});

// Response interceptor
// Axios.interceptors.response.use(
//   (response) => response,
//   (error) => {
//     if (error.response.status === 401) {
//       this.$store.dispatch("logout");
//     }
//     return Promise.reject(error);
//   }
// );

export default Axios;
