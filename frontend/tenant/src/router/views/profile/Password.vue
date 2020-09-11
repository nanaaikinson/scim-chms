<template>
  <div class="card">
    <h5 class="card-header bg-light">Change Password</h5>
    <div class="card-body">

      <div ref="formPasswordMsg"></div>

      <form @submit.prevent="changePassword">
        <div class="form-group">
          <label for="current_password">Current Password *</label>
          <input type="password" name="current_password" id="current_password" class="form-control"
                 v-model.trim="form.current_password" required>
        </div>

        <div class="form-group">
          <label for="password">New Password *</label>
          <input type="password" name="password" id="password" class="form-control"
                 v-model.trim="form.password" required>
        </div>

        <div class="form-group">
          <label for="password_confirmation">Confirm New Password *</label>
          <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                 v-model.trim="form.password_confirmation" required>
        </div>

        <div class="mt-4 text-center">
          <button class="btn btn-success px-5" type="submit" ref="submitPasswordBtn">Change Password</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import {addBtnLoading, removeBtnLoading} from "@services/helpers";
import Auth from "@services/api/auth";
import Swal from "sweetalert2";

export default {
  name: "Password",
  data() {
    return {
      form: {
        current_password: "",
        password: "",
        password_confirmation: ""
      }
    }
  },
  methods: {
    changePassword(e) {
      const form = e.target;
      const btn = this.$refs.submitPasswordBtn;
      const formMsg = this.$refs.formPasswordMsg;

      formMsg.innerHTML = "";

      addBtnLoading(btn);

      Auth.passwordUpdate(this.form)
        .then(response => {
          const res = response.data;
          Swal.fire("Success", res.message, "success");

          this.form.current_password = "";
          this.form.password = "";
          this.form.password_confirmation = "";

          form.reset();
        })
        .catch(err => {
          const {status, data} = err.response;
          let errorBag = "";

          if (status === 422) {
            const errorData = Object.values(data.errors);
            errorData.forEach((error) => {
              errorBag += `<span class="d-block">${error}</span>`;
            });
          } else {
            errorBag += data.message;
          }
          formMsg.innerHTML = `<div class="alert alert-danger">${errorBag}</div>`;

        })
        .finally(() => removeBtnLoading(btn));
    }
  }
}
</script>
