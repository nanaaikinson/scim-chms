<template>
  <nav class="sidebar">
    <div class="sidebar-header">
      <a class="sidebar-brand">
        <img :src="logo" class="img-fluid" alt="logo" />
      </a>

      <!-- <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
      </div>-->
    </div>
    <div class="sidebar-body ps ps--active-y">
      <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
          <router-link :to="{ name: 'Dashboard' }" class="nav-link">
            <i class="pi pi-microsoft link-icon"></i>

            <span class="link-title">Dashboard</span>
          </router-link>
        </li>
        <li class="nav-item nav-category">Navigation</li>

        <!-- <li class="nav-item">
          <router-link :to="{ name: 'Books' }" class="nav-link">
            <i class="link-icon pi pi-file-pdf"></i>
            <span class="link-title">Books</span>
          </router-link>
        </li>-->
        <li class="nav-item">
          <router-link
            v-can="'read-person'"
            :to="{ name: 'people' }"
            class="nav-link"
          >
            <i class="link-icon pi pi-user"></i>
            <span class="link-title">People</span>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link
            v-can="'read-group'"
            :to="{ name: 'groups' }"
            class="nav-link"
          >
            <i class="link-icon pi pi-users"></i>
            <span class="link-title">Groups</span>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link
            v-can="'read-family'"
            :to="{ name: 'family' }"
            class="nav-link"
          >
            <i class="link-icon pi pi-users"></i>
            <span class="link-title">Family</span>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link
            v-can="'read-follow-up'"
            :to="{ name: 'FollowUp' }"
            class="nav-link"
          >
            <i class="link-icon pi pi-calendar"></i>
            <span class="link-title">Follow Up</span>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link
            v-can="'read-expense'"
            :to="{ name: 'expenses' }"
            class="nav-link"
          >
            <i class="link-icon pi pi-dollar"></i>
            <span class="link-title">Expenses</span>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link
            v-can="'read-attendance'"
            :to="{ name: 'attendance' }"
            class="nav-link"
          >
            <i class="link-icon pi pi-list"></i>
            <span class="link-title">Attendance</span>
          </router-link>
        </li>

        <li class="nav-item" v-can="'read-contribution'">
          <a
            id="contributions-collapse-btn"
            class="nav-link"
            data-toggle="collapse"
            href="#contributions"
            role="button"
            aria-expanded="false"
            aria-controls="users-roles"
          >
            <i class="link-icon pi pi-dollar"></i>
            <span class="link-title">Contributions</span>
            <i class="link-arrow pi pi-angle-down"></i>
          </a>
          <div class="collapse" id="contributions">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <router-link :to="{ name: 'pledge' }" class="nav-link"
                  >Pledge</router-link
                >
              </li>
              <li class="nav-item">
                <router-link :to="{ name: 'Contributions' }" class="nav-link"
                  >All Contributions</router-link
                >
              </li>
            </ul>
          </div>
        </li>

        <li
          class="nav-item"
          v-can="
            'create-attendance' ||
              'import-expense' ||
              'import-contribution' ||
              'import-person'
          "
        >
          <a
            id="import-collapse-btn"
            class="nav-link"
            data-toggle="collapse"
            href="#import"
            role="button"
            aria-expanded="false"
            aria-controls="users-roles"
          >
            <i class="link-icon pi pi-cog"></i>
            <span class="link-title">Tools</span>
            <i class="link-arrow pi pi-angle-down"></i>
          </a>
          <div class="collapse" id="import">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <router-link
                  :to="{ name: 'AttendanceAdd' }"
                  v-can="'create-attendance'"
                  class="nav-link"
                  >Import Attendance</router-link
                >
              </li>
              <li class="nav-item">
                <router-link
                  :to="{ name: 'expenseimport' }"
                  v-can="'import-expense'"
                  class="nav-link"
                  >Import Expense</router-link
                >
              </li>
              <li class="nav-item">
                <router-link
                  :to="{ name: 'contributionsimport' }"
                  v-can="'import-contribution'"
                  class="nav-link"
                  >Import Contributions</router-link
                >
              </li>
              <li class="nav-item">
                <router-link
                  :to="{ name: 'peopleimport' }"
                  v-can="'import-person'"
                  class="nav-link"
                  >Import People</router-link
                >
              </li>
            </ul>
          </div>
        </li>

        <li
          class="nav-item"
          v-can="
            'view-attendance-report' ||
              'view-expenses-report' ||
              'view-contributions-report'
          "
        >
          <router-link :to="{ name: 'ReportIndex' }" class="nav-link">
            <i class="link-icon pi pi-chart-bar"></i>
            <span class="link-title">Reports</span>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name: 'tickets' }" class="nav-link">
            <i class="link-icon pi pi-ticket"></i>
            <span class="link-title">Ticketing</span>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name: 'currency' }" class="nav-link">
            <i class="link-icon pi pi-cog"></i>
            <span class="link-title">Settings</span>
          </router-link>
        </li>

        <li class="nav-item" v-can="'read-contribution'">
          <a
            id="pastor-report-collapse-btn"
            class="nav-link"
            data-toggle="collapse"
            href="#pastor-report"
            role="button"
            aria-expanded="false"
            aria-controls="pastor-report"
          >
            <i class="link-icon pi pi-user"></i>
            <span class="link-title">Pastor's Report</span>
            <i class="link-arrow pi pi-angle-down"></i>
          </a>
          <div class="collapse" id="pastor-report">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <router-link
                  :to="{ name: 'pastor-report' }"
                  v-can="'read-contribution'"
                  class="nav-link"
                  >Upload Pastor's Report</router-link
                >
              </li>
              <li class="nav-item">
                <router-link
                  :to="{ name: 'download-pastor-report' }"
                  v-can="'read-role'"
                  class="nav-link"
                  >Download Pastor's Report</router-link
                >
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item" v-can="'read-role' || 'read-user'">
          <a
            id="users-role-collapse-btn"
            class="nav-link"
            data-toggle="collapse"
            href="#users-roles"
            role="button"
            aria-expanded="false"
            aria-controls="users-roles"
          >
            <i class="link-icon pi pi-user-plus"></i>
            <span class="link-title">Users & Roles</span>
            <i class="link-arrow pi pi-angle-down"></i>
          </a>
          <div class="collapse" id="users-roles">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <router-link
                  :to="{ name: 'user' }"
                  v-can="'read-user'"
                  class="nav-link"
                  >Users</router-link
                >
              </li>
              <li class="nav-item">
                <router-link
                  :to="{ name: 'role' }"
                  v-can="'read-role'"
                  class="nav-link"
                  >Roles</router-link
                >
              </li>
            </ul>
          </div>
        </li>
        <!-- <li class="nav-item">
          <a
            id="settings-collapse-btn"
            class="nav-link"
            data-toggle="collapse"
            href="#settings"
            role="button"
            aria-expanded="false"
            aria-controls="settings"
          >
            <i class="link-icon pi pi-cog"></i>
            <span class="link-title">Settings</span>
            <i class="link-arrow pi pi-angle-down"></i>
          </a>
          <div class="collapse" id="settings">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <router-link :to="{ name: 'branches' }" class="nav-link"
                  >Branches</router-link
                >
              </li>
            </ul>
          </div>
        </li> -->
      </ul>
    </div>
  </nav>
</template>

<script>
import BSN from "bootstrap.native";
const logo = require("@assets/img/logo-long.png");

export default {
  name: "Sidebar",
  data() {
    return {
      logo
    };
  },
  mounted() {
    new BSN.Collapse("#users-role-collapse-btn");
    new BSN.Collapse("#contributions-collapse-btn");
    new BSN.Collapse("#import-collapse-btn");
    new BSN.Collapse("#pastor-report-collapse-btn");
    // new BSN.Collapse("#settings-collapse-btn");
  }
};
</script>
