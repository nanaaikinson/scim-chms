<template>
  <div>
    <div class="card">
      <div class="card-body">
        <div class="mb-5">
          <div class="dropdown">
            <button
              id="myDropdown"
              type="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
              class="btn btn-primary"
            >
              Add Contribution
              <i class="link-arrow pi pi-angle-down"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="myDropdown">
              <router-link
                v-can="'create-contribution'"
                :to="{ name: 'busingadd' }"
                class="dropdown-item"
                >Busing</router-link
              >
              <router-link
                v-can="'create-contribution'"
                :to="{ name: 'covenantadd' }"
                class="dropdown-item"
                >Covenant Partner</router-link
              >
              <router-link
                v-can="'create-contribution'"
                :to="{ name: 'TitheAdd' }"
                class="dropdown-item"
                >Tithe</router-link
              >
              <router-link
                v-can="'create-contribution'"
                :to="{ name: 'addgroup' }"
                class="dropdown-item"
                >Group</router-link
              >
              <router-link
                v-can="'create-contribution'"
                :to="{ name: 'addwelfare' }"
                class="dropdown-item"
                >Welfare</router-link
              >
              <router-link
                v-can="'create-contribution'"
                :to="{ name: 'pledgeAdd' }"
                class="dropdown-item"
                >Pledge</router-link
              >
              <router-link
                v-can="'create-contribution'"
                :to="{ name: 'generalAdd', query: { type: 'altar-seed' } }"
                class="dropdown-item"
                >Altar Seed</router-link
              >
              <router-link
                v-can="'create-contribution'"
                :to="{ name: 'generalAdd', query: { type: 'offering' } }"
                class="dropdown-item"
                >Offering</router-link
              >
              <router-link
                v-can="'create-contribution'"
                :to="{ name: 'generalAdd', query: { type: 'general' } }"
                class="dropdown-item"
                >General</router-link
              >
            </div>
          </div>
        </div>
        <div>
          <DataTable
            :value="table.data"
            :paginator="true"
            :rows="10"
            :loading="loading"
            :filters="filters"
            paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
            :rowsPerPageOptions="[10, 25, 50]"
            currentPageReportTemplate="Showing {first} to {last} of {totalRecords} entries"
            :scrollable="true"
            scrollHeight="55vh"
          >
            <template #header>
              <div class="table-header d-flex justify-content-end">
                <span class="p-input-icon-left">
                  <i class="pi pi-search" />
                  <InputText
                    v-model="filters['global']"
                    placeholder="Search For"
                  />
                </span>
              </div>
            </template>
            <template #empty>
              <div class="text-center">No data found.</div>
            </template>
            <Column field="person.name" header="Contribution For" sortable>
              <template #body="slotProps">
                <span v-if="slotProps.data.type.toLowerCase() === 'general'">{{
                  slotProps.data.title
                }}</span>
                <span v-if="slotProps.data.type.toLowerCase() === 'offering'">{{
                  slotProps.data.title
                }}</span>
                <span
                  v-if="slotProps.data.type.toLowerCase() === 'altar seed'"
                  >{{ slotProps.data.title }}</span
                >
                <span v-else>{{ slotProps.data.person.name }}</span>
              </template>
            </Column>

            <Column field="type" header="Type" sortable></Column>

            <Column field="amount" header="Amount" sortable>
              <template #body="slotProps">
                <small>{{ currency }}</small>
                {{ slotProps.data.amount }}
              </template>
            </Column>

            <Column field="method" header="Method of Payment" sortable></Column>

            <Column field="created_at" header="Date Recorded" sortable></Column>

            <Column field="actions" header="Actions">
              <template #body="slotProps">
                <router-link
                  tag="button"
                  v-can="'update-contribution'"
                  :to="{
                    name: 'covenantedit',
                    params: { mask: slotProps.data.mask },
                  }"
                  class="btn btn-primary btn-icon mr-2"
                  v-tooltip.top="'Edit'"
                  v-if="
                    slotProps.data.type.toLowerCase() === 'covenant partner'
                  "
                >
                  <i class="pi pi-pencil"></i>
                </router-link>
                <router-link
                  tag="button"
                  v-can="'update-contribution'"
                  :to="{
                    name: 'busingedit',
                    params: { mask: slotProps.data.mask },
                  }"
                  class="btn btn-primary btn-icon mr-2"
                  v-tooltip.top="'Edit'"
                  v-if="slotProps.data.type.toLowerCase() === 'busing'"
                >
                  <i class="pi pi-pencil"></i>
                </router-link>
                <router-link
                  tag="button"
                  v-can="'update-contribution'"
                  :to="{
                    name: 'TitheEdit',
                    params: { mask: slotProps.data.mask },
                  }"
                  class="btn btn-primary btn-icon mr-2"
                  v-tooltip.top="'Edit'"
                  v-if="slotProps.data.type.toLowerCase() === 'tithe'"
                >
                  <i class="pi pi-pencil"></i>
                </router-link>
                <router-link
                  tag="button"
                  v-can="'update-contribution'"
                  :to="{
                    name: 'groupEdit',
                    params: { mask: slotProps.data.mask },
                  }"
                  class="btn btn-primary btn-icon mr-2"
                  v-tooltip.top="'Edit'"
                  v-if="slotProps.data.type.toLowerCase() === 'group'"
                >
                  <i class="pi pi-pencil"></i>
                </router-link>
                <router-link
                  tag="button"
                  v-can="'update-contribution'"
                  :to="{
                    name: 'welfareedit',
                    params: { mask: slotProps.data.mask },
                  }"
                  class="btn btn-primary btn-icon mr-2"
                  v-tooltip.top="'Edit'"
                  v-if="slotProps.data.type.toLowerCase() === 'welfare'"
                >
                  <i class="pi pi-pencil"></i>
                </router-link>
                <router-link
                  tag="button"
                  v-can="'update-contribution'"
                  :to="{
                    name: 'pledgeEdit',
                    params: { mask: slotProps.data.mask },
                  }"
                  class="btn btn-primary btn-icon mr-2"
                  v-tooltip.top="'Edit'"
                  v-if="slotProps.data.type.toLowerCase() === 'pledge'"
                >
                  <i class="pi pi-pencil"></i>
                </router-link>
                <router-link
                  tag="button"
                  v-can="'update-contribution'"
                  :to="{
                    name: 'generalEdit',
                    params: { mask: slotProps.data.mask },
                    query: { type: 'general' },
                  }"
                  class="btn btn-primary btn-icon mr-2"
                  v-tooltip.top="'Edit'"
                  v-if="slotProps.data.type.toLowerCase() === 'general'"
                >
                  <i class="pi pi-pencil"></i>
                </router-link>
                <router-link
                  tag="button"
                  v-can="'update-contribution'"
                  :to="{
                    name: 'generalEdit',
                    params: { mask: slotProps.data.mask },
                    query: { type: 'offering' },
                  }"
                  class="btn btn-primary btn-icon mr-2"
                  v-tooltip.top="'Edit'"
                  v-if="slotProps.data.type.toLowerCase() === 'offering'"
                >
                  <i class="pi pi-pencil"></i>
                </router-link>
                <router-link
                  tag="button"
                  v-can="'update-contribution'"
                  :to="{
                    name: 'generalEdit',
                    params: { mask: slotProps.data.mask },
                    query: { type: 'altar-seed' },
                  }"
                  class="btn btn-primary btn-icon mr-2"
                  v-tooltip.top="'Edit'"
                  v-if="slotProps.data.type.toLowerCase() === 'altar seed'"
                >
                  <i class="pi pi-pencil"></i>
                </router-link>
                <button
                  class="btn btn-danger btn-icon mr-2"
                  v-can="'delete-contribution'"
                  v-tooltip.top="'Delete'"
                  @click="
                    deleteContribution(
                      slotProps.data.mask,
                      $event,
                      slotProps.data.type
                    )
                  "
                >
                  <i class="pi pi-trash no-pointer-events"></i>
                </button>
              </template>
            </Column>
          </DataTable>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DataTable from "primevue/datatable";
import InputText from "primevue/inputtext";
import Column from "primevue/column";
import Contribution from "@services/api/contribution";
import { addBtnLoading, removeBtnLoading } from "@services/helpers";
import BSN from "bootstrap.native";
import Swal from "sweetalert2";

export default {
  name: "Contributions",
  components: { DataTable, Column, InputText },
  data() {
    return {
      table: {
        data: [],
        total: 0,
      },
      loading: true,
      filters: {},
    };
  },
  computed: {
    currency() {
      return this.$store.getters.currency;
    },
  },
  methods: {
    async setData() {
      const response = await Contribution.all();
      const { data: res } = response.data;
      this.table.data = res.items;
      this.loading = false;
    },

    /* delete contribution  */
    async deleteContribution(mask, e, type) {
      const btn = e.target;
      try {
        const result = await Swal.fire({
          text: "Do you want to delete this contribution?",
          icon: "warning",
          showCancelButton: true,
          cancelButtonText: "No",
          confirmButtonText: "Yes Delete It",
          reverseButtons: true,
        });
        if (result.value) {
          addBtnLoading(btn);
          let response;
          switch (type.toLowerCase()) {
            case "covenant partner":
              response = await Contribution.covedelete(mask);
              break;
            case "busing":
              response = await Contribution.busingdelete(mask);
              break;
            case "group":
              response = await Contribution.groupdelete(mask);
              break;
            case "welfare":
              response = await Contribution.welfaredelete(mask);
              break;
            case "pledge":
              response = await Contribution.pledgedelete(mask);
              break;
            case "tithe":
              response = await Contribution.tithedelete(mask);
              break;
            case "general":
              response = await Contribution.generaldelete(mask);
              break;
            case "offering":
              response = await Contribution.generaldelete(mask);
              break;
            case "altar seed":
              response = await Contribution.generaldelete(mask);
              break;
          }

          removeBtnLoading(btn);
          const res = response.data;
          Swal.fire({
            icon: "success",
            title: res.message,
          });
          this.setData();
        }
      } catch (error) {
        removeBtnLoading(btn);
        const res = error.response.data;
        Swal.fire({
          icon: "error",
          title: res.message,
        });
      }
    },
  },
  beforeRouteEnter(to, from, next) {
    next((vm) => {
      vm.setData();
      next();
    });
  },
  mounted() {
    new BSN.Dropdown("#myDropdown");
  },
};
</script>
