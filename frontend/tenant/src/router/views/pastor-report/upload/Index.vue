<template>
  <div>
    <div class="card min-height-500">
      <div class="card-body">
        <p class="mb-3">NB: Fields marked * are required</p>

        <div class="form-msg" ref="formMsg"></div>

        <form @submit.prevent="handleSubmit">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Title *</label>
                <input
                  type="text"
                  name="title"
                  id="title"
                  class="form-control"
                  required
                  v-model.trim="title"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Type *</label>
                <select class="form-control" v-model="type">
                  <option value="">Select</option>
                  <option value="monthly">Monthly</option>
                  <option value="yearly">Yearly</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Date *</label>
                <flat-pickr
                  v-model="date"
                  placeholder="Select Date"
                  name="date"
                  id="date"
                  class="form-control bg-white"
                ></flat-pickr>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="file">File *</label>
                <input
                  type="file"
                  name="file"
                  id="file"
                  class="form-control-file"
                  ref="file"
                  accept="application/pdf"
                  required
                />
              </div>
            </div>
          </div>
          <div class="text-center mt-5">
            <button class="btn btn-success px-5" ref="submitBtn">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { addBtnLoading, removeBtnLoading } from "@services/helpers";
import PastorReport from "@services/api/pastor-report";
import Swal from "sweetalert2";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";

export default {
  name: "PastorReport",
  components: {
    flatPickr
  },
  data() {
    return {
      title: "",
      type: "",
      date: ""
    };
  },
  methods: {
    async handleSubmit(e) {
      const btn = this.$refs.submitBtn;
      const formMsg = this.$refs.formMsg;
      try {
        addBtnLoading(btn);
        const formData = new FormData();
        const file = this.$refs.file;
        formData.append("title", this.title);
        formData.append("type", this.type);
        formData.append("date", this.date);
        formData.append("file", file.files[0]);
        const response = await PastorReport.store(formData);
        const res = response.data;
        Swal.fire("Success", res.message, "success");
        this.$router.push({ name: "download-pastor-report" });
      } catch (err) {
        console.log(err);
        const res = err.response.data;
        let errorBag = "";
        if (res.code === 422) {
          const errorData = Object.values(res.errors);
          errorData.map(error => {
            errorBag += `<span class="d-block">${error}</span>`;
          });
        } else {
          errorBag += res.message;
        }
        formMsg.innerHTML = `<div class="alert alert-danger">${errorBag}</div>`;
      } finally {
        removeBtnLoading(btn);
      }
    }
  }
};
</script>
