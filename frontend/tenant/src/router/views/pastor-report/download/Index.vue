<template>
  <div>
    <div class="card">
      <div class="card-body">
        <div>
          <DataTable
            :value="reports"
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
            <Column field="tenant" header="Branch" sortable></Column>
            <Column field="user" header="User" sortable></Column>
            <Column field="type" header="Type" sortable></Column>
            <Column field="title" header="Title" sortable></Column>
            <Column field="date" header="Date" sortable></Column>
            <Column field="download_link" header="Download File">
              <template #body="slotProps">
                <a :href="slotProps.data.file_url">Download</a>
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
import PastorReport from "@services/api/pastor-report";
import InputText from "primevue/inputtext";
export default {
  name: "PastorReport",
  components: { DataTable, Column, InputText },
  data() {
    return {
      filters: {},
      reports: [],
      loading: true
    };
  },
  methods: {
    //fetch expenses
    async getPastorReport() {
      try {
        const response = await PastorReport.all();
        this.loading = false;
        const res = response.data;
        this.reports = res.data;
      } catch (error) {
        console.log(error);
        this.loading = false;
      }
    }
  },
  async created() {
    await this.getPastorReport();
  }
};
</script>

<style lang="scss" scoped></style>
