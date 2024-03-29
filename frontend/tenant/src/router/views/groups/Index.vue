<template>
  <div>
    <div class="card">
      <div class="card-body">
        <div class="mb-5">
          <router-link
            v-can="'create-group'"
            :to="{ name: 'groupadd' }"
            class="btn btn-primary px-5"
            >Add Group</router-link
          >
        </div>

        <div>
          <DataTable
            :value="groups"
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
            <Column field="id" header="ID" sortable></Column>
            <Column field="name" header="Name" sortable></Column>

            <Column field="persons" header="No. of Persons" sortable></Column>
            <Column field="type" header="Type" sortable></Column>
            <Column field="leader" header="Leader" sortable></Column>
            <Column field="created_at" header="Date Added" sortable></Column>
            <Column field="actions" header="Actions">
              <template #body="slotProps">
                <router-link
                  tag="button"
                  v-can="'update-group'"
                  :to="{
                    name: 'groupedit',
                    params: { mask: slotProps.data.mask }
                  }"
                  class="btn btn-primary btn-icon mr-2"
                  v-tooltip.top="'Edit'"
                >
                  <i class="pi pi-pencil"></i>
                </router-link>
                <button
                  class="btn btn-danger btn-icon mr-2"
                  v-can="'delete-group'"
                  v-tooltip.top="'Delete'"
                  @click="deleteGroup(slotProps.data.mask, $event)"
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
import Column from "primevue/column";
import Group from "@services/api/groups";
import { addBtnLoading, removeBtnLoading } from "@services/helpers";
import Swal from "sweetalert2";
import InputText from "primevue/inputtext";

export default {
  name: "Groups",
  components: { DataTable, Column, InputText },
  data() {
    return {
      filters: {},
      groups: [],
      loading: true
    };
  },
  methods: {
    //fetch groups
    async getGroups() {
      try {
        const response = await Group.all();
        this.loading = false;
        const res = response.data;
        this.groups = res.data;
      } catch (error) {
        console.log(error);
        this.loading = false;
      }
    },

    /* delete group  */
    async deleteGroup(mask, e) {
      const btn = e.target;
      try {
        const result = await Swal.fire({
          text: "Do you want to delete this group?",
          icon: "warning",
          showCancelButton: true,
          cancelButtonText: "No",
          confirmButtonText: "Yes Delete It",
          reverseButtons: true
        });
        if (result.value) {
          addBtnLoading(btn);
          const response = await Group.delete(mask);
          removeBtnLoading(btn);
          const res = response.data;
          Swal.fire({
            icon: "success",
            title: res.message
          });
          this.getGroups();
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
    await this.getGroups();
  }
};
</script>

<style lang="scss" scoped></style>
