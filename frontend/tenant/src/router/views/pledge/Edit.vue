<template>
  <div>
    <div class="card min-height-500">
      <div class="card-body">
        <p class="mb-3">NB: Fields marked * are required</p>

        <div class="form-msg" ref="formMsg"></div>

        <form @submit.prevent="editPledge">
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
                <label for="amount">Amount *</label>
                <input
                  type="number"
                  name="amount"
                  id="amount"
                  min="0"
                  step="0.01"
                  class="form-control"
                  required
                  v-model.trim="amount"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="person">Person *</label>
                <Dropdown
                  v-model="person_id"
                  :options="members"
                  :filter="true"
                  optionLabel="name"
                  optionValue="id"
                  placeholder="Select Person"
                  class="form-control"
                />
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="purpose">Purpose</label>
                <textarea
                  name="purpose"
                  id="purpose"
                  class="form-control"
                  v-model.trim="purpose"
                ></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="comment">Comment *</label>
                <textarea
                  name="comment"
                  id="comment"
                  required
                  class="form-control"
                  v-model.trim="comment"
                ></textarea>
              </div>
            </div>
          </div>
          <div class="text-center">
            <div class="form-group mt-5">
              <button class="btn btn-success px-5" ref="submitBtn">
                Update
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
import Pledge from "@services/api/pledge";
import Member from "@services/api/people";
import Swal from "sweetalert2";
import Dropdown from "primevue/dropdown";

export default {
  name: "PledgeEdit",
  components: {
    Dropdown
  },
  data() {
    return {
      title: "",
      amount: "",
      purpose: "",
      comment: "",
      person_id: "",
      mask: "",
      members: []
    };
  },
  methods: {
    async editPledge(e) {
      const btn = this.$refs.submitBtn;
      const formMsg = this.$refs.formMsg;
      try {
        addBtnLoading(btn);
        const formData = {
          title: this.title,
          amount: this.amount,
          purpose: this.purpose,
          person_id: this.person_id,
          comments: this.comment
        };
        const response = await Pledge.update(formData, this.mask);
        const res = response.data;
        removeBtnLoading(btn);
        Swal.fire("Success", res.message, "success");
        this.$router.push({ name: "pledge" });
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
    },
    setData(pledge) {
      this.members = pledge[0].data.data;
      const { data } = pledge[1].data;
      this.title = data.title;
      this.person_id = data.person_id;
      this.amount = parseFloat(data.amount).toFixed(2);
      this.purpose = data.purpose;
      this.comment = data.comment;
      this.mask = data.mask;
    }
  },
  async beforeRouteEnter(to, from, next) {
    try {
      const mask = to.params.mask;
      if (!mask) {
        next({ name: "Home" });
      }
      // const response = await Pledge.show(mask);
      const response = await Promise.all([Member.members(), Pledge.show(mask)]);
      next(vm => vm.setData(response));
    } catch (error) {
      console.log(error);
    }
  }
};
</script>
