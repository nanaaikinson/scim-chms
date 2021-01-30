import store from "../../../store";

//check permissions
function hasAccess(name) {
  const permissions = store.state.user.permissions || [];
  switch (name) {
    case "Home":
      return true;

    case "Dashboard":
      return true;

    case "Profile":
      return true;

    case "user":
      return permissions.includes("read-user");

    case "adduser":
      return permissions.includes("create-user");

    case "useredit":
      return permissions.includes("update-user");

    case "role":
      return permissions.includes("read-role");

    case "roleadd":
      return permissions.includes("create-role");

    case "roleedit":
      return permissions.includes("update-role");

    case "groups":
      return permissions.includes("read-group");

    case "groupadd":
      return permissions.includes("create-group");

    case "groupedit":
      return permissions.includes("update-group");

    case "people":
      return permissions.includes("read-person");

    case "addperson":
      return permissions.includes("create-person");

    case "personedit":
      return permissions.includes("update-person");

    case "PersonDetail":
      return permissions.includes("read-person");

    case "family":
      return permissions.includes("read-family");

    case "familyadd":
      return permissions.includes("create-family");

    case "familyedit":
      return permissions.includes("update-family");

    case "FollowUp":
      return permissions.includes("read-follow-up");

    case "FollowUpAdd":
      return permissions.includes("create-follow-up");

    case "FollowUpEdit":
      return permissions.includes("update-follow-up");

    case "attendance":
      return permissions.includes("read-attendance");

    case "AttendanceAdd":
      return permissions.includes("create-attendance");

    case "attendanceEdit":
      return permissions.includes("update-attendance");

    case "expenses":
      return permissions.includes("read-expense");

    case "expensesadd":
      return permissions.includes("create-expense");

    case "expensesedit":
      return permissions.includes("update-expense");

    case "pledge":
      return permissions.includes("read-contribution");

    case "pledgeadd":
      return permissions.includes("create-contribution");

    case "pledgeedit":
      return permissions.includes("update-contribution");

    case "Contributions":
      return permissions.includes("read-contribution");

    case "covenantadd":
      return permissions.includes("create-contribution");

    case "covenantedit":
      return permissions.includes("update-contribution");

    case "busingadd":
      return permissions.includes("create-contribution");

    case "busingedit":
      return permissions.includes("update-contribution");

    case "TitheAdd":
      return permissions.includes("create-contribution");

    case "TitheEdit":
      return permissions.includes("update-contribution");

    case "addgroup":
      return permissions.includes("create-contribution");

    case "groupEdit":
      return permissions.includes("update-contribution");

    case "addwelfare":
      return permissions.includes("create-contribution");

    case "welfareedit":
      return permissions.includes("update-contribution");

    case "pledgeAdd":
      return permissions.includes("create-contribution");

    case "pledgeEdit":
      return permissions.includes("update-contribution");

    case "generalAdd":
      return permissions.includes("create-contribution");

    case "generalEdit":
      return permissions.includes("update-contribution");

    case "expenseimport":
      return permissions.includes("import-expense");

    case "peopleimport":
      return permissions.includes("import-person");

    case "contributionsimport":
      return permissions.includes("import-contribution");

    case "ReportIndex":
      return true;

    case "ReportAttendance":
      return permissions.includes("view-attendance-report");

    case "ReportExpense":
      return permissions.includes("view-expenses-report");

    case "ReportContribution":
      return permissions.includes("view-contributions-report");

    case "pastor-report":
      return true;

    case "download-pastor-report":
      return true;

    case "tickets":
      return true;

    case "ticketsadd":
      return true;

    case "ticketsedit":
      return true;

    case "currency":
      return true;

    default:
      return false;
  }
}

export default hasAccess;
