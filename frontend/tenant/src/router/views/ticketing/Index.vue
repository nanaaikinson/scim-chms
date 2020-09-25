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
            <Column field="tag" header="Tag" sortable>
              <template #body="slotProps">
                <span
                  class="badge badge-danger"
                  v-if="slotProps.data.tag == 'Bug'"
                  >{{ slotProps.data.tag }}</span
                >
                <span
                  class="badge badge-primary"
                  v-if="slotProps.data.tag == 'Suggestion'"
                  >{{ slotProps.data.tag }}</span
                >
                <span
                  class="badge badge-success"
                  v-if="slotProps.data.tag == 'Feature'"
                  >{{ slotProps.data.tag }}</span
                >
              </template>
            </Column>
            <Column field="description" header="Description" sortable></Column>
            <Column field="status" header="Status" sortable>
              <template #body="slotProps">
                <span
                  class="badge badge-info"
                  v-if="slotProps.data.status == 'open'"
                  >{{
                    slotProps.data.status[0].toUpperCase() +
                      slotProps.data.status.slice(1)
                  }}</span
                >
                <span class="badge badge-success" v-else>{{
                  slotProps.data.status[0].toUpperCase() +
                    slotProps.data.status.slice(1)
                }}</span>
              </template>
            </Column>
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
import Ticket from "@services/api/ticketing";
import { addBtnLoading, removeBtnLoading } from "@services/helpers";
import Swal from "sweetalert2";
import InputText from "primevue/inputtext";

export default {
  name: "Tickets",
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
        this.tickets = res.data;
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
