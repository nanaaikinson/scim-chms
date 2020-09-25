<template>
  <div>
    <div class="card min-height-500">
      <div class="card-body">
        <p class="mb-3">NB: Fields marked * are required</p>

        <div class="form-msg" ref="formMsg"></div>

        <form @submit.prevent="addBranch">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Branch Name *</label>
                <input
                  type="text"
                  name="name"
                  id="name"
                  class="form-control"
                  required
                  v-model.trim="name"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="country">Country</label>
                <input
                  name="country"
                  id="country"
                  class="form-control"
                  v-model.trim="country"
                />
              </div>
            </div>
          </div>

          <div class="text-center">
            <div class="form-group mt-5">
              <button class="btn btn-success px-5" ref="submitBtn">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { addBtnLoading, removeBtnLoading } from "@services/helpers";
import Branches from "@services/api/branches";
import Swal from "sweetalert2";

export default {
  name: "AddBranch",
  data() {
    return {
      name: "",
      country: ""
    };
  },
  methods: {
    async addBranch(e) {
      const btn = this.$refs.submitBtn;
      const formMsg = this.$refs.formMsg;
      try {
        addBtnLoading(btn);
        const formData = {
          name: this.name,
          country: this.country
        };
        const response = await Branches.store(formData);
        const res = response.data;
        removeBtnLoading(btn);
        Swal.fire("Success", res.message, "success");
        this.$router.push({ name: "branches" });
      } catch (err) {
        const res = err.response.data;
        let errorBag = "";
        if (res.code === 422) {
          removeBtnLoading(btn);
          const errorData = Object.values(res.errors);
          errorData.map(error => {
            errorBag += `<span class="d-block">${error}</span>`;
          });
        } else {
          errorBag += res.message;
        }
        formMsg.innerHTML = `<div class="alert alert-danger">${errorBag}</div>`;
      }
    }
  }
};
</script>
