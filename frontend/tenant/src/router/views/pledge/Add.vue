<template>
  <div>
    <div class="card min-height-500">
      <div class="card-body">
        <p class="mb-3">NB: Fields marked * are required</p>

        <div class="form-msg" ref="formMsg"></div>

        <form @submit.prevent="addGroup">
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
                  min="0"
                  step="0.01"
                  id="amount"
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
          </div>
          <div class="text-center">
            <div class="form-group mt-5">
              <button class="btn btn-success px-5" ref="submitBtn">
                Save
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
  name: "PledgeAdd",
  components: {
    Dropdown
  },
  data() {
    return {
      title: "",
      amount: 0,
      purpose: "",
      person_id: "",
      members: []
    };
  },
  methods: {
    async addGroup(e) {
      const btn = this.$refs.submitBtn;
      const formMsg = this.$refs.formMsg;
      try {
        addBtnLoading(btn);
        const formData = {
          title: this.title,
          amount: this.amount,
          purpose: this.purpose,
          person_id: this.person_id
        };
        const response = await Pledge.store(formData);
        const res = response.data;
        removeBtnLoading(btn);
        Swal.fire("Success", res.message, "success");
        this.$router.push({ name: "pledge" });
      } catch (err) {
        const res = err.response;
        let errorBag = "";
        if (res.status === 422) {
          removeBtnLoading(btn);
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
    //fetch members
    async getMembers() {
      try {
        const response = await Member.members();
        const res = response.data;
        this.members = res.data;
      } catch (error) {
        console.log(error);
      }
    }
  },
  async created() {
    await this.getMembers();
  }
};
</script>
