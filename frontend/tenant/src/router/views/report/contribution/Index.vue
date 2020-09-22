<template>
  <div>
    <div class>
      <div class>
        <div class="row">
          <div class="col-md-10 offset-md-1">
            <div class="alert alert-info mb-3"></div>

            <form @submit.prevent="submitReport">
              <div class="card py-3 px-3 mb-3">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="contributiontype">Contribution Type *</label>
                      <select
                        name="contributiontype"
                        id="contributiontype"
                        class="custom-select"
                        v-model.number="form.contributiontype"
                        @change="onChanageContributionType"
                      >
                        <option
                          :value="contribution.value"
                          :key="i"
                          v-for="(contribution, i) in contributions"
                          >{{ contribution.name }}</option
                        >
                      </select>
                    </div>
                  </div>

                  <keep-alive>
                    <div class="col-md-4" v-if="form.contributiontype === 4">
                      <div class="form-group">
                        <label for="group" class="d-block">Group *</label>
                        <Dropdown
                          v-model.number="form.group_id"
                          :options="groups"
                          optionLabel="name"
                          optionValue="id"
                          placeholder="Select Group"
                          class="form-control"
                          :filter="true"
                        />
                      </div>
                    </div>
                  </keep-alive>
                  <keep-alive>
                    <div class="col-md-4" v-if="form.contributiontype === 6">
                      <div class="form-group">
                        <label for="pledge" class="d-block">Pledge *</label>
                        <Dropdown
                          v-model.number="form.pledge_id"
                          :options="pledge"
                          optionLabel="title"
                          optionValue="id"
                          placeholder="Select Pledge"
                          class="form-control"
                          :filter="true"
                        />
                      </div>
                    </div>
                  </keep-alive>

                  <div class="col-md-4">
                    <label for="method">Payment Method *</label>
                    <select
                      name="method"
                      id="method"
                      class="custom-select"
                      v-model.number="form.method"
                    >
                      <option
                        :value="method.value"
                        :key="i"
                        v-for="(method, i) in methods"
                        >{{ method.name }}</option
                      >
                    </select>
                  </div>
                </div>
              </div>

              <div class="card py-3 px-3">
                <div class="row">
                  <div class="col-md-4">
                    <label for="duration">Duration *</label>
                    <select
                      name="duration"
                      id="duration"
                      class="custom-select"
                      v-model.number="form.duration"
                    >
                      <option value>Select duration</option>
                      <option disabled>----------------</option>
                      <option value="1">Day</option>
                      <option value="3">Month</option>
                      <option value="4">Year</option>
                      <option value="5">Specific period</option>
                    </select>
                  </div>
                  <div class="col-md-4" v-if="form.duration === 1">
                    <div class="form-group">
                      <label for="date">Date *</label>
                      <flat-pickr
                        v-model.trim="form.date"
                        placeholder="Select Date"
                        name="date"
                        id="date"
                        class="form-control bg-white"
                        :config="config"
                        required
                      ></flat-pickr>
                    </div>
                  </div>
                  <div class="col-md-4" v-if="form.duration === 3">
                    <div class="form-group">
                      <label for class="d-block">Select Month *</label>
                      <Calendar
                        class="w-100"
                        v-model="form.date"
                        view="month"
                        dateFormat="M-yy"
                        :yearNavigator="true"
                        yearRange="2000:2100"
                        placeholder="Select Month"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-md-4" v-if="form.duration === 4">
                    <div class="form-group">
                      <label for="date">Select Year *</label>
                      <select
                        name="date"
                        id="year"
                        class="custom-select"
                        v-model="form.year"
                        required
                      >
                        <option value>Choose year</option>
                        <option
                          :value="year"
                          v-for="(year, i) in years"
                          :key="i"
                          >{{ year }}</option
                        >
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4" v-if="form.duration === 5">
                    <div class="form-group">
                      <label for="from">Start Date *</label>
                      <flat-pickr
                        v-model.trim="form.from"
                        placeholder="Select Date"
                        name="from"
                        id="from"
                        class="form-control bg-white"
                        :config="config"
                        required
                      ></flat-pickr>
                    </div>
                  </div>
                  <div class="col-md-4" v-if="form.duration === 5">
                    <div class="form-group">
                      <label for="to">End Date *</label>
                      <flat-pickr
                        v-model.trim="form.to"
                        placeholder="Select Date"
                        name="to"
                        id="to"
                        class="form-control bg-white"
                        :config="config"
                        required
                      ></flat-pickr>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="type">Type of Report *</label>
                    <select
                      name="type"
                      id="type"
                      class="custom-select"
                      v-model.number="form.type"
                    >
                      <option value="1">Chart</option>
                      <option value="2">Count</option>
                    </select>
                  </div>
                </div>
                <div class="text-center form-group">
                  <div class="form-group mt-5">
                    <button class="btn btn-success px-5" ref="submitBtn">
                      Submit
                    </button>
                  </div>
                </div>
                <hr class="py-4" />

                <template v-if="chartType === 'multiple bar charts'">
                  <div v-for="(report, i) in reports" :key="i">
                    <div class="d-flex">
                      <h5 class="pr-3">Contribution Report</h5>
                      <InputSwitch v-model="report.toggle" />
                    </div>
                    <div v-show="!report.toggle">
                      <ApexChart
                        type="bar"
                        :id="`year-${i}`"
                        :height="450"
                        :width="850"
                        :options="report.chartOptions"
                        :series="report.series"
                      ></ApexChart>
                    </div>
                    <div v-show="report.toggle">
                      <ApexChart
                        type="line"
                        :id="`year-${i}`"
                        :height="450"
                        :width="850"
                        :options="report.chartOptions"
                        :series="report.series"
                      ></ApexChart>
                    </div>
                  </div>
                </template>

                <div v-if="chartType === 'bar chart'">
                  <div class="d-flex">
                    <h5 class="pr-3">Contribution Report</h5>
                    <InputSwitch v-model="toggleReport" />
                  </div>
                  <div v-show="!toggleReport">
                    <ApexChart
                      type="bar"
                      :height="450"
                      :width="850"
                      :options="chartData.contributions.chartOptions"
                      :series="chartData.contributions.series"
                    ></ApexChart>
                  </div>
                  <div v-show="toggleReport">
                    <ApexChart
                      type="line"
                      :height="450"
                      :width="850"
                      :options="chartData.contributions.chartOptions"
                      :series="chartData.contributions.series"
                    ></ApexChart>
                  </div>
                </div>
                <div v-if="chartType === 'Table'">
                  <DataTable
                    :value="totalContributions"
                    :scrollable="true"
                    scrollHeight="300px"
                    ref="dt"
                  >
                    <template #header>
                      <div class="d-flex justify-content-between">
                        <div class="d-flex">
                          <h5 class="mr-3">Total Amount: {{ total }}</h5>
                        </div>
                        <button class="btn btn-info" @click="exportCSV($event)">
                          Export
                        </button>
                      </div>
                    </template>
                    <Column field="amount" header="Amount"></Column>
                    <Column field="date" header="Date"></Column>
                    <Column field="person" header="Full Name"></Column>
                    <Column
                      field="contribution_type"
                      header="Contribution Type"
                    ></Column>
                    <Column field="method" header="Payment Method"></Column>
                  </DataTable>
                </div>
                <div ref="formMsg"></div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Groups from "@services/api/groups";
import Pledge from "@services/api/pledge";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";
import Calendar from "primevue/calendar";
import { addBtnLoading, removeBtnLoading } from "@services/helpers";
import Report from "@services/api/reports";
import dayjs from "dayjs";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Dropdown from "primevue/dropdown";
import ApexChart from "vue-apexcharts";
import InputSwitch from "primevue/inputswitch";
import Swal from "sweetalert2";
export default {
  name: "ContributionReport",
  components: {
    flatPickr,
    Calendar,
    Column,
    DataTable,
    Dropdown,
    ApexChart,
    InputSwitch
  },
  data() {
    return {
      form: {
        contributiontype: "all",
        method: 1,
        group_id: null,
        pledge_id: null,
        date: "",
        year: "",
        type: 1,
        to: null,
        from: null,
        duration: 1
      },
      contributions: [
        { value: "all", name: "All" },
        { value: 1, name: "Tithe" },
        { value: 2, name: "Busing" },
        { value: 3, name: "Covenant Partner" },
        { value: 4, name: "Group" },
        { value: 5, name: "Welfare" },
        { value: 6, name: "Pledge" },
        { value: 7, name: "General" }
      ],
      methods: [
        { name: "Cash", value: 1 },
        { name: "Cheque", value: 2 },
        { name: "Online", value: 3 },
        { name: "Mobile Money", value: 4 }
      ],
      reports: [],
      groups: [],
      pledge: [],
      years: [],
      total: "",
      toggleReport: false,
      chartData: {
        contributions: {
          series: [],
          chartOptions: {}
        }
      },
      totalContributions: [],
      chartType: "",
      config: {
        allowInput: true
      }
    };
  },
  methods: {
    async submitReport() {
      const btn = this.$refs.submitBtn;
      try {
        if (!this.form.group_id && this.form.contributiontype === 4) {
          Swal.fire("", "All fields marked * are required", "info");
          return;
        }
        if (!this.form.pledge_id && this.form.contributiontype === 6) {
          Swal.fire("", "All fields marked * are required", "info");
          return;
        }
        addBtnLoading(btn);
        const params = {
          date:
            this.form.duration === 4
              ? this.form.year
              : dayjs(this.form.date).format("YYYY-MM-DD"),
          group_id: this.form.group_id,
          pledge_id: this.form.pledge_id,
          contribution_type: this.form.contributiontype,
          payment_method: this.form.method,
          duration: this.form.duration,
          report_type: this.form.type
        };

        if (this.form.duration === 5) {
          params.from = this.form.from;
          params.to = this.form.to;
          delete params.date;
        }
        if (this.form.contributiontype === 6) {
          delete params.groupId;
        }
        if (this.form.contributiontype === 4) {
          delete params.pledge;
        }

        const response = await Report.contribution({ params });
        removeBtnLoading(btn);
        const res = response.data;
        // console.log(res.results);
        if (
          Object.entries(res.results).length === 0 ||
          res.results.length === 0
        ) {
          this.$refs.formMsg.innerHTML = `<h5 class="text-center">No Data Found</h5>`;
          this.chartType = "";
          return;
        }

        switch (res.chart_type) {
          case "bar chart":
            this.renderBar(res.results);
            this.chartType = res.chart_type;
            this.$refs.formMsg.innerHTML = ``;
            break;
          case "multiple bar charts":
            this.renderMultipleBar(res.results);
            this.chartType = res.chart_type;
            this.$refs.formMsg.innerHTML = ``;
            break;
          case "Table":
            this.chartType = "Table";
            this.totalContributions = res.results;
            this.total = res.total;
            this.$refs.formMsg.innerHTML = ``;
            break;
          default:
            this.chartType = "Table";
            this.totalContributions = res.results.results;
            this.total = res.results.total;
            this.$refs.formMsg.innerHTML = ``;
        }
      } catch (error) {
        removeBtnLoading(btn);
        console.log(error);
      }
    },
    async onChanageContributionType(e) {
      try {
        const value = parseInt(e.target.value);

        if (!value) return;
        if (value === 4) {
          const response = await Groups.all();
          const { data: res } = response.data;
          this.groups = res;
        }
        if (value === 6) {
          const response = await Pledge.all();
          const { data: res } = response.data;
          this.pledge = res;
        }

        //this.form.group_id = value;
      } catch (error) {
        console.log(error.message);
      }
    },

    exportCSV() {
      this.$refs.dt.exportCSV();
    },

    renderMultipleBar(response) {
      for (let index of Object.keys(response)) {
        const resultData = response[index];

        const series = [{ name: `Total Amount ${index}`, data: [] }];
        const categories = [];

        resultData.forEach((val, index) => {
          categories.push(val.name);
          series[0].data.push(val.total);
        });

        this.reports.push({
          series: series,
          chartOptions: {
            plotOptions: {
              bar: {
                horizontal: false
              }
            },
            dataLabels: {
              enabled: false
            },
            xaxis: {
              categories: categories
            },
            stroke: {
              curve: "smooth"
            },
            title: {
              text: `Contributions ${index}`,
              align: "center"
            }
          },
          toggle: false
        });
      }
    },

    renderBar(response) {
      const series = [{ name: "Total Amount", data: [] }];
      const categories = [];
      response.forEach((val, index) => {
        categories.push(val.name);
        series[0].data.push(val.total);
      });

      this.chartData.contributions = {
        series: series,
        chartOptions: {
          plotOptions: {
            bar: {
              horizontal: false
            }
          },
          dataLabels: {
            enabled: false
          },
          xaxis: {
            categories: categories
          },
          stroke: {
            curve: "smooth"
          }
        }
      };
    }
  },
  created() {
    const year = new Date().getFullYear();
    const startYear = 1970;
    for (let i = year; i >= startYear; i--) {
      this.years.push(i);
    }
  }
};
</script>

<style scoped>
div .p-inputswitch {
  width: 3rem;
  height: 1.5rem;
}
</style>
