<template>
  <div>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <router-link
              v-can="'view-attendance-report'"
              :to="{ name: 'ReportAttendance' }"
              style="color: inherit"
            >
              <div class="border py-5">
                <div class="d-flex justify-content-center align-items-center">
                  <div class="text-center">
                    <i
                      class="pi pi-calendar-plus pb-2"
                      style="fontSize: 3rem"
                    ></i>
                    <p class="display-5">Attendance</p>
                  </div>
                </div>
              </div>
            </router-link>
          </div>

          <div class="col-md-3">
            <router-link
              v-can="'view-expenses-report'"
              :to="{ name: 'ReportExpense' }"
              style="color: inherit"
            >
              <div class="border py-5">
                <div class="d-flex justify-content-center align-items-center">
                  <div class="text-center">
                    <i class="pi pi-chart-line pb-2" style="fontSize: 3rem"></i>
                    <p class="display-5">Expense</p>
                  </div>
                </div>
              </div>
            </router-link>
          </div>

          <div class="col-md-3">
            <router-link
              v-can="'view-contributions-report'"
              :to="{ name: 'ReportContribution' }"
              style="color: inherit"
            >
              <div class="border py-5">
                <div class="d-flex justify-content-center align-items-center">
                  <div class="text-center">
                    <i class="pi pi-money-bill pb-2" style="fontSize: 3rem"></i>
                    <p class="display-5">Contribution</p>
                  </div>
                </div>
              </div>
            </router-link>
          </div>

          <!-- <div class="col-md-3">
            <router-link
              v-can="'view-contributions-report'"
              :to="{ name: 'pastor-report' }"
              style="color: inherit"
            >
              <div class="border py-5">
                <div class="d-flex justify-content-center align-items-center">
                  <div class="text-center">
                    <i class="pi pi-user pb-2" style="fontSize: 3rem"></i>
                    <p class="display-5">Pastor's Report</p>
                  </div>
                </div>
              </div>
            </router-link>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ReoprtIndex"
};
</script>
