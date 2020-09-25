<template>
  <div>
    <div class="card min-height-500">
      <div class="card-body">
        <p class="mb-3">NB: Fields marked * are required</p>

        <div class="form-msg" ref="formMsg"></div>

        <form @submit.prevent="updateCurrency">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Select Currency *</label>
                <Dropdown
                  v-model="currency"
                  :options="currencies"
                  optionLabel="country"
                  optionValue="country_id"
                  class="form-control"
                  filter
                >
                  <template #option="slotProps">
                    <div class="p-dropdown-car-option">
                      <span v-if="slotProps.option.symbol">{{
                        slotProps.option.country +
                          " - " +
                          slotProps.option.symbol
                      }}</span>
                      <span v-else>{{
                        slotProps.option.country + " - " + slotProps.option.code
                      }}</span>
                    </div>
                  </template>
                </Dropdown>
              </div>
            </div>
          </div>

          <!-- <span>Checked names: {{ checkedPermissions }}</span> -->

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
import Currency from "@services/api/currency";
import Swal from "sweetalert2";
import Dropdown from "primevue/dropdown";

export default {
  name: "Currency",
  components: {
    Dropdown
  },
  data() {
    return {
      currency: "",
      currencies: []
    };
  },
  methods: {
    async updateCurrency(e) {
      const btn = this.$refs.submitBtn;
      const formMsg = this.$refs.formMsg;
      try {
        addBtnLoading(btn);
        const formData = {
          currency: this.currency
        };
        const response = await Currency.update(formData);
        const res = response.data;
        removeBtnLoading(btn);
        Swal.fire("Success", res.message, "success");
        //this.$router.push({ name: "role" });
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

    setData(data) {
      this.currencies = data.data;
    }
  },

  async beforeRouteEnter(to, from, next) {
    try {
      const response = await Currency.get();
      next(vm => vm.setData(response.data));
    } catch (error) {
      console.log(error);
    }
  }
};
</script>
