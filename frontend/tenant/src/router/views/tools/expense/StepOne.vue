<template>
  <div>
    <div class="alert alert-info mb-3 mt-4">
      <h5>Notes about how to import expenses from excel file</h5>
      <ul class="pl-3 mt-2">
        <li>Make sure to download file before you proceed.</li>
        <li>
          Required Fields in the excel template are; Name, Amount, Expense Type
          And Type
        </li>
        <li>
          Values for expense type are as follows;
          <ul class="pl-4">
            <li v-for="(type, i) in expenseTypes" :key="i">{{ type.id }} is for {{ type.name }}</li>
          </ul>
        </li>
      </ul>
    </div>

    <div>
      <div class>
        <div class="mb-3">
          <button
            class="btn btn-primary"
            type="button"
            ref="downloadTem"
            @click="downloadTemplate($event)"
          >
            Download Template
          </button>
        </div>

        <div>
          <button
            class="btn btn-success"
            :disabled="disableProgessButton"
            @click="next"
          >
            Next
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Import from "@services/api/imports";
import { addBtnLoading, removeBtnLoading } from "@services/helpers";

export default {
  data() {
    return {
      disableProgessButton: true,
      expenseTypes: [
        { name: "Utility ", id: 1 },
        { name: "Donation ", id: 2 },
        { name: "Welfare ", id: 3 },
        { name: "Equipment And Technology ", id: 4 },
        { name: "Allowance  ", id: 5 },
        { name: "Building And Construction", id: 6 },
        { name: "Publicity", id: 7 },
        { name: "Evangelism", id: 8 },
        { name: "Transport And Fuel", id: 9 },
        { name: "Administrative And Stationery", id: 10 },
        { name: "Miscellaneous", id: 11 },
      ]
    };
  },

  methods: {
    next() {
      if (!this.disableProgessButton) this.$emit("set-step");
    },

    /** download template */
    downloadTemplate(mask, e) {
      const btn = this.$refs.downloadTem;

      (async () => {
        try {
          addBtnLoading(btn);

          const response = await Import.expensetemplate();
          removeBtnLoading(btn);
          this.disableProgessButton = false;
          const res = response.data;
          const { url, filename } = res.data;
          const anchor = document.createElement("a");
          anchor.setAttribute("download", filename);
          anchor.setAttribute("href", url);
          document.body.appendChild(anchor);
          anchor.click();
          document.body.removeChild(anchor);
        } catch (error) {
          const res = error.response.data;
          Swal.fire({
            icon: "error",
            title: res.message,
          });
          removeBtnLoading(btn);
        }
      })();
    },
  },
};
</script>
