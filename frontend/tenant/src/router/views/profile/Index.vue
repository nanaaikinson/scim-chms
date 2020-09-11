<template>
  <div>
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <h5 class="card-header bg-light">Update Details</h5>
              <div class="card-body">

                <div ref="formDetailsMsg"></div>

                <form @submit.prevent="changeDetails">
                  <div class="form-group">
                    <label for="first_name">First Name *</label>
                    <input type="text" name="first_name" id="first_name" class="form-control"
                           v-model.trim="user.first_name" required>
                  </div>

                  <div class="form-group">
                    <label for="last_name">Last Name *</label>
                    <input type="text" name="last_name" id="last_name" class="form-control"
                           v-model.trim="user.last_name" required>
                  </div>

                  <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" name="email" id="email" class="form-control" v-model.trim="user.email" required>
                  </div>

                  <div class="form-group">
                    <label for="telephone">Mobile Number</label>
                    <input type="text" name="telephone" id="telephone" class="form-control"
                           v-model.trim="user.telephone">
                  </div>

                  <div class="mt-4 text-center">
                    <button class="btn btn-success px-5" type="submit" ref="submitDetailsBtn">Save</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <Password/>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Password from "./Password";
import Auth from "@services/api/auth";
import {addBtnLoading, removeBtnLoading} from "@services/helpers";
import Swal from "sweetalert2";

export default {
  name: "Index",
  components: {Password},
  data() {
    return {
      user: {
        first_name: "",
        last_name: "",
        email: "",
        telephone: ""
      },
      busy: false
    }
  },
  methods: {
    fetchData() {
      Auth.user()
        .then(response => {
          const res = response.data;
          const {data: user} = res;

          this.user.first_name = user.first_name;
          this.user.last_name = user.last_name;
          this.user.email = user.email;
          this.user.telephone = user.telephone;
        })
        .catch(err => console.log(err))
        .finally(() => this.busy = false);
    },

    changeDetails(e) {
      const btn = this.$refs.submitDetailsBtn;
      const formMsg = this.$refs.formDetailsMsg;

      formMsg.innerHTML = "";

      addBtnLoading(btn);

      Auth.detailsUpdate(this.user)
        .then(response => {
          const res = response.data;
          Swal.fire("Success", res.message, "success");
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
  },
  created() {
    this.fetchData();
  }
}
</script>

