<template>
  <div>
    <div class="card min-height-500">
      <div class="card-body">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <p class="mb-3">NB: Fields marked * are required</p>

            <div class="form-msg" ref="formMsg"></div>

            <form @submit.prevent="updateGroup">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Title *</label>
                    <input
                      type="text"
                      name="title"
                      id="title"
                      class="form-control"
                      v-model.trim="name"
                      required
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
                    <label for="date">Date *</label>
                    <flat-pickr
                      v-model="date"
                      placeholder="Select Date"
                      name="date"
                      id="date"
                      required
                      class="form-control bg-white"
                    ></flat-pickr>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="method">Method of payment *</label>
                    <select
                      name="method"
                      id="method"
                      class="custom-select"
                      v-model.number="method"
                    >
                      <option
                        :value="m.id"
                        v-for="(m, i) in methods"
                        :key="i"
                        >{{ m.name }}</option
                      >
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="comment">Comment *</label>
                    <textarea
                      name="comment"
                      id="comment"
                      cols="30"
                      rows="3"
                      class="form-control"
                      v-model="comment"
                      required
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
    </div>
  </div>
</template>

<script>
import { addBtnLoading, removeBtnLoading } from "@services/helpers";
import Member from "@services/api/people";
import Contribution from "@services/api/contribution";
import Group from "@services/api/groups";
import Swal from "sweetalert2";
import Dropdown from "primevue/dropdown";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";

export default {
  name: "GeneralEdit",
  components: {
    Dropdown,
    flatPickr
  },
  data() {
    return {
      amount: "",
      comment: "",
      date: "",
      name: "",
      method: "",
      mask: "",
      methods: [
        { name: "Cash", id: 1 },
        { name: "Cheque", id: 2 },
        { name: "Online", id: 3 },
        { name: "Mobile Money", id: 4 }
      ]
    };
  },
  methods: {
    async updateGroup(e) {
      const btn = this.$refs.submitBtn;
      const formMsg = this.$refs.formMsg;
      try {
        addBtnLoading(btn);
        const formData = {
          amount: this.amount,
          comment: this.comment,
          date: this.date,
          name: this.name,
          method: this.method,
          type: this.$route.query.type
        };
        const response = await Contribution.generalUpdate(formData, this.mask);
        const res = response.data;
        removeBtnLoading(btn);
        Swal.fire("Success", res.message, "success");
        this.$router.push({ name: "Contributions" });
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
    //set data
    setData(data) {
      this.amount = parseFloat(data.amount).toFixed(2);
      this.name = data.name;
      this.date = data.date;
      this.comment = data.comment;
      this.mask = data.mask;
      this.method = data.method;
    }
  },

  async beforeRouteEnter(to, from, next) {
    try {
      const mask = to.params.mask;
      if (!mask) {
        next({ name: "Home" });
      }

      const response = await Contribution.generalShow(mask);
      next(vm => vm.setData(response.data));
    } catch (error) {
      console.log(error);
    }
  }
};
</script>
