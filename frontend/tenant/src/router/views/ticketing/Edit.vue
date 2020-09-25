<template>
  <div>
    <div class="card min-height-500">
      <div class="card-body">
        <p class="mb-3">NB: Fields marked * are required</p>

        <div class="form-msg" ref="formMsg"></div>

        <form @submit.prevent="editTicket">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="title">Title *</label>
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
                <label for="tag">Tag</label>
                <select
                  name="tag"
                  id="tag"
                  v-model.number="tag"
                  required
                  class="form-control"
                >
                  <option value="">Select </option>
                  <option value="1">Bug</option>
                  <option value="2">Suggestion</option>
                  <option value="3">Feature</option>
                </select>
              </div>
            </div>
          </div>

          <div class="text-center">
            <div class="form-group mt-5">
              <button class="btn btn-success px-5" ref="submitBtn">
                Update Ticket
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { addBtnLoading, removeBtnLoading } from "@services/helpers";
import Ticket from "@services/api/ticketing";
import Swal from "sweetalert2";

export default {
  name: "editTicket",
  data() {
    return {
      title: "",
      tag: "",
      description: "",
      mask: ""
    };
  },
  methods: {
    async editTicket(e) {
      const btn = this.$refs.submitBtn;
      const formMsg = this.$refs.formMsg;
      try {
        addBtnLoading(btn);
        const formData = {
          title: this.title,
          tag: this.tag,
          description: this.description
        };
        const response = await Ticket.update(formData, this.mask);
        const res = response.data;
        removeBtnLoading(btn);
        Swal.fire("Success", res.message, "success");
        this.$router.push({ name: "tickets" });
      } catch (err) {
        removeBtnLoading(btn);
        const res = err.response;
        let errorBag = "";
        if (res.status === 422) {
          const errorData = Object.values(res.data.errors);
          errorData.map(error => {
            errorBag += `<span class="d-block">${error}</span>`;
          });
        } else {
          errorBag += res.message;
        }
        formMsg.innerHTML = `<div class="alert alert-danger">${errorBag}</div>`;
      }
    },

    setData(ticket) {
      // console.log(ticket);
      const { data } = ticket.data;
      this.title = data.title;
      this.description = data.description;
      this.tag = data.tag;
      this.mask = data.mask;
    }
  },
  async beforeRouteEnter(to, from, next) {
    try {
      const mask = to.params.mask;
      if (!mask) {
        next({ name: "Home" });
      }

      const response = await Ticket.show(mask);
      next(vm => vm.setData(response));
    } catch (error) {
      console.log(error);
    }
  }
};
</script>
