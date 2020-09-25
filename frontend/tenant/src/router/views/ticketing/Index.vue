<template>
  <div>
    <div class="card">
      <div class="card-body">
        <div class="mb-5">
          <router-link :to="{ name: 'ticketsadd' }" class="btn btn-primary px-5"
            >New Ticket</router-link
          >
        </div>

        <div>
          <DataTable
            :value="tickets"
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
            <Column field="title" header="Title" sortable></Column>
            <Column field="tag" header="Tag" sortable></Column>
            <Column field="description" header="Description" sortable></Column>
            <Column field="status" header="Status" sortable></Column>
            <Column field="actions" header="Actions">
              <template #body="slotProps">
                <router-link
                  tag="button"
                  :to="{
                    name: 'ticketsedit',
                    params: { mask: slotProps.data.mask }
                  }"
                  class="btn btn-primary btn-icon mr-2"
                  v-tooltip.top="'Edit'"
                >
                  <i class="pi pi-pencil"></i>
                </router-link> </template
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
import Ticket from "@services/api/family";
import { addBtnLoading, removeBtnLoading } from "@services/helpers";
import Swal from "sweetalert2";
import InputText from "primevue/inputtext";

export default {
  name: "Groups",
  components: { DataTable, Column, InputText },
  data() {
    return {
      filters: {},
      tickets: [],
      loading: true
    };
  },
  methods: {
    //fetch tickets
    async fetchTickets() {
      try {
        const response = await Ticket.all();
        this.loading = false;
        const res = response.data;
        this.groups = res.data;
      } catch (error) {
        console.log(error);
        this.loading = false;
      }
    }
  },
  async created() {
    await this.fetchTickets();
  }
};
</script>

<style lang="scss" scoped></style>
