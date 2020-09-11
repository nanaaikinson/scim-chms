<template>
  <div>
    <div class="card">
      <div class="card-body">
        <div class="mb-5">
          <router-link
            :to="{ name: 'branchesadd' }"
            class="btn btn-primary px-5"
            >Add Role</router-link
          >
        </div>

        <div>
          <DataTable
            :value="branches"
            :paginator="true"
            :rows="10"
            :loading="loading"
            :filters="filters"
            paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
            :rowsPerPageOptions="[10, 25, 50]"
            currentPageReportTemplate="Showing {first} to {last} of {totalRecords} entries"
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
              <div class="text-center">
                No data found.
              </div>
            </template>
            <Column field="name" header="Name" sortable></Column>
            <Column field="branches" header="Branches" sortable></Column>
            <Column field="created_at" header="Date Added" sortable></Column>
            <Column field="actions" header="Actions">
              <template #body="slotProps">
                <router-link
                  tag="button"
                  :to="{
                    name: 'branchesedit',
                    params: { mask: slotProps.data.mask }
                  }"
                  class="btn btn-primary btn-icon mr-2"
                  v-tooltip.top="'Edit'"
                >
                  <i class="pi pi-pencil"></i>
                </router-link>
                <button
                  class="btn btn-danger btn-icon mr-2"
                  v-tooltip.top="'Delete'"
                  @click="deleteBranch(slotProps.data.mask, $event)"
                >
                  <i class="pi pi-trash no-pointer-events"></i>
                </button> </template
            ></Column>
          </DataTable>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Branches from "@services/api/branches";
import { addBtnLoading, removeBtnLoading } from "@services/helpers";
import Swal from "sweetalert2";
import InputText from "primevue/inputtext";

export default {
  name: "Roles",
  components: { DataTable, Column, InputText },
  data() {
    return {
      filters: {},
      branches: [],
      loading: true
    };
  },
  methods: {
    //fetch branches
    async getBranches() {
      try {
        const response = await Branches.all();
        this.loading = false;
        const res = response.data;
        this.roles = res.data;
      } catch (error) {
        console.log(error);
        this.loading = false;
      }
    },

    /* delete role  */
    async deleteBranch(mask, e) {
      const btn = e.target;
      try {
        const result = await Swal.fire({
          text: "Do you want to delete this branch?",
          icon: "warning",
          showCancelButton: true,
          cancelButtonText: "No",
          confirmButtonText: "Yes Delete It",
          reverseButtons: true
        });
        if (result.value) {
          addBtnLoading(btn);
          const response = await Branches.delete(mask);
          removeBtnLoading(btn);
          const res = response.data;
          Swal.fire({
            icon: "success",
            title: res.message
          });
          this.getBranches();
        }
      } catch (error) {
        removeBtnLoading(btn);
        const res = error.response.data;
        Swal.fire({
          icon: "error",
          title: res.message
        });
      }
    }
  },
  async created() {
    await this.getBranches();
  }
};
</script>

<style lang="scss" scoped></style>
