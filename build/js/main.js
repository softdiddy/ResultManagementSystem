function manage_drugs() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/manage_drugs.php", function (response) {
    $("#load_content").html(response);
  });
}

function add_new_drugs() {
  $("#newDrug").modal("show");
}

function close_new_drugs() {
  $("#newDrug").modal("hide");
}

function addNDrugs() {
  $("#error").html('<center><img src="images/ajax-loader1.gif"></center>');
  var drug_name = document.getElementById("drug_name").value;
  var drug_category = document.getElementById("drug_category").value;
  var drug_type = document.getElementById("drug_type").value;
  var drug_size = document.getElementById("drug_size").value;
  var generic_name = document.getElementById("generic_name").value;
  var manufacturer = document.getElementById("manufacturer").value;
  var description = document.getElementById("description").value;
  var unit_pack = document.getElementById("unit_pack").value;
  $.post(
    "php/addDrugs.php",
    {
      drug_name: drug_name,
      drug_category: drug_category,
      drug_type: drug_type,
      drug_size: drug_size,
      generic_name: generic_name,
      manufacturer: manufacturer,
      description: description,
      unit_pack: unit_pack,
    },
    function (response) {
      $("#error").html(response);
    }
  );

  //$('#error').fadeIn('fast').delay(1000).fadeOut('fast');

  document.getElementById("drug_name").value = "";
  document.getElementById("drug_category").value = "";
  document.getElementById("drug_type").value = "";
  document.getElementById("drug_size").value = "";
  document.getElementById("generic_name").value = "";
  document.getElementById("manufacturer").value = "";
  document.getElementById("description").value = "";
  document.getElementById("unit_pack").value = "";

  manage_drugs();
}
function addNDrugsToMainStore(drug_id) {
  $("#showError").html('<center><img src="images/ajax-loader1.gif"></center>');
  var quantity = document.getElementById("quantity").value;
  var unitPackPrice = document.getElementById("unitPackPrice").value;
  var packQuantity = document.getElementById("packQuantity").value;
  var expired_date = document.getElementById("expired_date").value;

  $.post(
    "php/addNDrugsToMainStore.php",
    {
      drug_id: drug_id,
      quantity: quantity,
      unitPackPrice: unitPackPrice,
      packQuantity: packQuantity,
      expired_date: expired_date,
    },
    function (response) {
      $("#showError").html(response);
    }
  );

  $("#showError").fadeIn("fast").delay(1000).fadeOut("fast");

  document.getElementById("quantity").value = "";
  document.getElementById("unitPackPrice").value = "";
  document.getElementById("packQuantity").value = "";
  document.getElementById("expired_date").value = "";

  //display_drugs_in_main_store();
}

function delete_drugs(drug_id) {
  //delet drug from the drug table also delete from other accciated tables
  var ans = confirm("Are you sure you want to delete this drug?");
  if (ans == true) {
    $.post("php/deleteDrugs.php", { drug_id: drug_id }, function (response) {
      manage_drugs();
    });
  }
}

function edit_drug(drug_id) {
  $("#Showmodal").modal("show");
  $("#modalBody").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post("content/load_edit_drugs.php", { drug_id: drug_id }, function (
    response
  ) {
    $("#modalBody").html(response);
  });
}

function add_drugs_to_main_store() {
  $("#Showmodal").modal("show");
  $("#modalBody").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post("content/add_drugs_to_main_store.php", function (response) {
    $("#modalBody").html(response);
  });
}

function move_drugs_toPhamacyStore(drug_stocked_id) {
  $("#Showmodal").modal("show");
  $("#modalBody").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post(
    "content/move_drugs_toPhamacyStore.php",
    { drug_stocked_id: drug_stocked_id },
    function (response) {
      $("#modalBody").html(response);
    }
  );
}

function giveOutDrug(patient_visit_id, patientID) {
  $("#Showmodal").modal("show");
  $("#modalBody").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post(
    "content/giveOutDrug.php",
    { patient_visit_id: patient_visit_id, patientID: patientID },
    function (response) {
      $("#modalBody").html(response);
    }
  );
}

function pickDrug(student_id, drug_id, refid, patient_visit_id) {
  var drug_quantity = document.getElementById("drug_quantity").value;
  $("#StudentDrugs").html("Adding, Please wait...");
  $.post(
    "php/PickdrugForStudent.php",
    {
      drug_id: drug_id,
      student_id: student_id,
      drug_quantity: drug_quantity,
      refid: refid,
      patient_visit_id: patient_visit_id,
    },
    function (response) {
      $("#StudentDrugs").html(response);
      $("#StudentDrugs").fadeIn("fast").delay(1000).fadeOut("fast");
    }
  );
}

function removeStudentDrug(
  student_id,
  drug_id,
  refid,
  student_drug_id,
  patient_visit_id
) {
  $.post(
    "php/removeStudentDrug.php",
    { student_drug_id: student_drug_id, patient_visit_id: patient_visit_id },
    function (response) {
      Pickstudent(student_id, patient_visit_id);
    }
  );
}

function updateStudentDrug(student_id, refid, patient_visit_id) {
  $.post(
    "php/updateStudentDrug.php",
    { refid: refid, patient_visit_id: patient_visit_id },
    function (response) {
      $("#student_drugInfor").html(response);
      $("#student_drugInfor").fadeIn("fast").delay(1000).fadeOut("fast");
    }
  );
  //load_drugs_in_phamacy_store();
  viewPatientDetails_DV(student_id, patient_visit_id);
  $("#Showmodal").modal("hide");
}

function PickdrugForStudent(drug_id, student_id, patient_visit_id) {
  var refid = document.getElementById("refid").value;

  $("#Showmodal").modal("show");
  $("#modalBody").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post(
    "content/PickdrugForStudent.php",
    {
      drug_id: drug_id,
      student_id: student_id,
      refid: refid,
      patient_visit_id: patient_visit_id,
    },
    function (response) {
      $("#modalBody").html(response);
    }
  );
}

function MoveDrugs(drug_stocked_id) {
  $("#Error").html('<center><img src="images/ajax-loader1.gif"></center>');
  var quantity_to_move = document.getElementById("quantity_to_move").value;
  if (quantity_to_move != "") {
    $.post(
      "php/move_drugs.php",
      { quantity_to_move: quantity_to_move, drug_stocked_id: drug_stocked_id },
      function (response) {
        load_drugs_in_main_store();
        alert(response);
        $("#Error").html("");
      }
    );

    document.getElementById("quantity_to_move").value = "";
  } else {
    alert("Enter Quantity");
  }
}

function UpdateDrugs(drug_id) {
  $("#errorEdit").html('<center><img src="images/ajax-loader1.gif"></center>');
  var drug_name = document.getElementById("drug_nameE").value;
  var drug_category = document.getElementById("drug_categoryE").value;
  var drug_type = document.getElementById("drug_typeE").value;
  var drug_size = document.getElementById("drug_sizeE").value;
  var generic_name = document.getElementById("generic_nameE").value;
  var manufacturer = document.getElementById("manufacturerE").value;
  var description = document.getElementById("descriptionE").value;
  var unit_pack = document.getElementById("unit_packE").value;
  $.post(
    "php/UpdateDrugs.php",
    {
      drug_id: drug_id,
      drug_name: drug_name,
      drug_category: drug_category,
      drug_type: drug_type,
      drug_size: drug_size,
      generic_name: generic_name,
      manufacturer: manufacturer,
      description: description,
      unit_pack: unit_pack,
    },
    function (response) {
      $("#errorEdit").html(response);
    }
  );

  $("#errorEdit").fadeIn("fast").delay(1000).fadeOut("fast");

  manage_drugs();
}

function search_drug() {
  $("#dispaly_search_drugs").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  var txtSearchDrug = document.getElementById("txtSearchDrug").value;
  $.post("php/search_drug.php", { txtSearchDrug: txtSearchDrug }, function (
    response
  ) {
    $("#dispaly_search_drugs").html(response);
  });
}

function search_drug_to_add_toMainStore() {
  $("#search").html('<center><img src="images/ajax-loader1.gif"></center>');
  var txtSearch = document.getElementById("txtSearch").value;
  $.post(
    "php/search_drug_to_add_toMainStore.php",
    { txtSearch: txtSearch },
    function (response) {
      $("#search").html(response);
    }
  );
}

function searchDrugForStudent(student_id, patient_visit_id) {
  $("#student_drugInfor").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  var txtSearch = document.getElementById("txtSearch").value;
  $.post(
    "php/searchDrugForStudent.php",
    {
      txtSearch: txtSearch,
      student_id: student_id,
      patient_visit_id: patient_visit_id,
    },
    function (response) {
      $("#student_drugInfor").html(response);
    }
  );
}

function search_matricNumber(patient_visit_id) {
  $("#search").html('<center><img src="images/ajax-loader1.gif"></center>');
  var txtSearch = document.getElementById("txtSearch").value;
  $.post(
    "php/search_matricNumber.php",
    { txtSearch: txtSearch, patient_visit_id: patient_visit_id },
    function (response) {
      $("#search").html(response);
    }
  );
}

function Pickdrug(drug_id) {
  $.post("php/Pickdrug.php", { drug_id: drug_id }, function (response) {
    $("#modalBody").html(response);
  });
}

function Pickstudent(student_id, patient_visit_id) {
  $.post(
    "php/Pickstudent.php",
    { student_id: student_id, patient_visit_id: patient_visit_id },
    function (response) {
      $("#modalBody").html(response);
    }
  );
}

function manage_stock() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/manage_stock.php", function (response) {
    $("#load_content").html(response);
  });
}

function load_main_store() {
  $("#load_page").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post("content/load_main_store.php", function (response) {
    $("#load_page").html(response);
  });
}

function load_phamacy_store() {
  $("#load_page").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post("content/load_phamacy_store.php", function (response) {
    $("#load_page").html(response);
  });
}

function load_drugs_in_main_store() {
  $("#load").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post("content/load_drugs_in_main_store.php", function (response) {
    $(load).html(response);
  });
}

function load_drugs_in_phamacy_store() {
  $("#load").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post("content/load_drugs_in_phamacy_store.php", function (response) {
    $(load).html(response);
  });
}

function verification() {
  $("#load").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post("content/verification.php", function (response) {
    $(load).html(response);
  });
}

function view_student_drug_detail(refid) {
  $("#Showmodal").modal("show");
  $("#modalBody").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post("content/view_student_drug_detail.php", { refid: refid }, function (
    response
  ) {
    $("#modalBody").html(response);
  });
}
function getAllperOfDrugs() {
  $("#Showmodal").modal("show");
  $("#modalBody").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post("content/getAllperOfDrugs.php", function (response) {
    $("#modalBody").html(response);
  });
}

function getNotification() {
  $("#Showmodal").modal("show");
  $("#modalBody").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post("php/getNotification.php", function (response) {
    $("#modalBody").html(response);
  });
}

function manage_category() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/manage_category.php", function (response) {
    $(load_content).html(response);
  });
}

function manage_manufacturer() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/manage_manufacturer.php", function (response) {
    $(load_content).html(response);
  });
}

function manage_supplier() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/manage_supplier.php", function (response) {
    $(load_content).html(response);
  });
}
function load_orderLevel() {
  $("#load").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post("content/load_orderLevel.php", function (response) {
    $(load).html(response);
  });
}

function reports() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/reports.php", function (response) {
    $(load_content).html(response);
  });
}

function print_report() {
  var report = document.getElementById("report").value;
  if (report == "") {
    alert("Please Select the Report you want to print");
  } else {
    $("#getReport").html(
      '<center><img src="images/ajax-loader1.gif"></center>'
    );
    $.post("php/print_report.php", { report: report }, function (response) {
      $(getReport).html(response);
    });
  }
}

function Search_report() {
  var drug_id = document.getElementById("drug_id").value;
  var start_date = document.getElementById("start_date").value;
  var end_date = document.getElementById("end_date").value;
  var student_matric = document.getElementById("student_matric").value;

  $("#displayResult").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post(
    "content/Search_report.php",
    {
      drug_id: drug_id,
      start_date: start_date,
      end_date: end_date,
      student_matric: student_matric,
    },
    function (response) {
      $(displayResult).html(response);
    }
  );
}

function add_new_manufacturer() {
  $("#Showmodal").modal("show");
  $("#modalBody").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post("content/add_new_manufacturer.php", function (response) {
    $("#modalBody").html(response);
  });
}

function add_new_supplier() {
  $("#Showmodal").modal("show");
  $("#modalBody").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post("content/add_new_supplier.php", function (response) {
    $("#modalBody").html(response);
  });
}

function add_new_category() {
  $("#Showmodal").modal("show");
  $("#modalBody").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post("content/add_new_category.php", function (response) {
    $("#modalBody").html(response);
  });
}

function manage_patients() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/manage_patients.php", function (response) {
    $("#load_content").html(response);
  });
}

function search_patient_details() {
  var txtSearchP = document.getElementById("txtSearchP").value;
  $("#searchContent").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post(
    "php/search_patient_details.php",
    { txtSearchP: txtSearchP },
    function (response) {
      $("#searchContent").html(response);
    }
  );
}

function ViewMedicalRecord(token) {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/ViewMedicalRecord.php", { token: token }, function (
    response
  ) {
    $("#load_content").html(response);
  });
}

function LoadMedicalRecord(patient_visit_id, patientID) {
  $("#loadModalContent").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post(
    "content/loadPatientMedicalRecordHistory.php",
    { token: patientID, patient_visit_id: patient_visit_id },
    function (response) {
      $("#loadModalContent").html(response);
    }
  );
}

function createVisit(patientID) {
  var ans = confirm("Are you sure you want to perform his action ?");
  if (ans == true) {
    $.post("php/createNewVisit.php", { token: patientID }, function (response) {
      alert(response);
    });
  }
  ViewMedicalRecord(patientID);
}

function take_reading() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/take_reading.php", function (response) {
    $("#load_content").html(response);
  });
}

function reading(token, patient_visit_id) {
  $("#GetContentR").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post(
    "content/reading.php",
    { token: token, patient_visit_id: patient_visit_id },
    (response) => {
      $("#GetContentR").html(response);
    }
  );
}

function saveVitalSigns(token, patient_visit_id) {
  var ans = confirm("Are you sure you want to perform his action ?");
  if (ans == true) {
    var temp = document.getElementById("temp").value;
    var HR = document.getElementById("HR").value;
    var Pulse = document.getElementById("Pulse").value;
    var BP = document.getElementById("BP").value;
    var RR = document.getElementById("RR").value;
    var Oxygen = document.getElementById("Oxygen").value;
    var PH = document.getElementById("PH").value;

    document.getElementById("saveVitalSigns").disabled = true;
    $("#saveVitalSigns").html(
      '<span class="spinner-border spinner-border-lg" role="status" aria-hidden="true"></span>Save'
    );

    $.post(
      "php/saveVitalSigns.php",
      {
        patient_visit_id: patient_visit_id,
        token: token,
        temp: temp,
        HR: HR,
        Pulse: Pulse,
        BP: BP,
        RR: RR,
        Oxygen: Oxygen,
        PH: PH,
      },
      (response) => {
        alert(response);
        document.getElementById("saveVitalSigns").disabled = false;
        $("#saveVitalSigns").html("Save");

        $("#takeReading").modal("hide");
        take_reading();
      }
    );
  }
}

function load_doctor_desk() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/load_doctor_desk.php", function (response) {
    $("#load_content").html(response);
  });
}

function viewPatientDetails_DV(token, patient_visit_id) {
  $("#searchContent").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post(
    "content/viewPatientDetails_DV.php",
    { token: token, patient_visit_id: patient_visit_id },
    (response) => {
      $("#searchContent").html(response);
    }
  );
}

function request_investigation(token, patientID) {
  $("#GetrequestFormPage").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post(
    "content/GetrequestFormPage.php",
    { token: token, patientID: patientID },
    function (response) {
      $("#GetrequestFormPage").html(response);
    }
  );
}

function addRequest(request_id, encounterID, patientID) {
  $.post(
    "php/addRequest.php",
    { request_id: request_id, encounterID: encounterID, patientID: patientID },
    function (response) {
      request_investigation(encounterID, patientID);
      viewPatientDetails_DV(patientId, encounterID);
    }
  );
}

function RemoveRequest(request_id, encounterID, patientID) {
  $.post(
    "php/RemoveRequest.php",
    { request_id: request_id, encounterID: encounterID, patientID: patientID },
    function (response) {
      request_investigation(encounterID, patientID);
      viewPatientDetails_DV(patientId, encounterID);
    }
  );
}

function load_lab() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/load_lab.php", function (response) {
    $("#load_content").html(response);
  });
}

function loadTestForm(request_id, encounterID, patient_id) {
  $("#GetshowLoadInputeLab").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post(
    "content/loadTestForm.php",
    {
      request_id: request_id,
      patient_id: patient_id,
      encounterID: encounterID,
    },
    function (response) {
      $("#GetshowLoadInputeLab").html(response);
    }
  );
}

function save_microbiology(patientID, request_id, encounterID) {
  var sensitiveTo = "";
  var resistantTo = "";
  var sample = document.getElementById("sample").value;
  var investigation = document.getElementById("investigation").value;

  var sensitiveTo1 = document.getElementById("sensitiveTo1").value;
  var sensitiveTo2 = document.getElementById("sensitiveTo2").value;
  var sensitiveTo3 = document.getElementById("sensitiveTo3").value;
  var sensitiveTo4 = document.getElementById("sensitiveTo4").value;
  var sensitiveTo5 = document.getElementById("sensitiveTo5").value;
  var sensitiveTo6 = document.getElementById("sensitiveTo6").value;

  if (sensitiveTo1 != "") {
    sensitiveTo = sensitiveTo + "<li>" + sensitiveTo1 + "</li>";
  }

  if (sensitiveTo2 != "") {
    sensitiveTo = sensitiveTo + "<li>" + sensitiveTo2 + "</li>";
  }

  if (sensitiveTo3 != "") {
    sensitiveTo = sensitiveTo + "<li>" + sensitiveTo3 + "</li>";
  }

  if (sensitiveTo4 != "") {
    sensitiveTo = sensitiveTo + "<li>" + sensitiveTo4 + "</li>";
  }

  if (sensitiveTo5 != "") {
    sensitiveTo = sensitiveTo + "<li>" + sensitiveTo5 + "</li>";
  }

  if (sensitiveTo6 != "") {
    sensitiveTo = sensitiveTo + "<li>" + sensitiveTo6 + "</li>";
  }

  var resistantTo1 = document.getElementById("resistantTo1").value;
  var resistantTo2 = document.getElementById("resistantTo2").value;
  var resistantTo3 = document.getElementById("resistantTo3").value;
  var resistantTo4 = document.getElementById("resistantTo4").value;
  var resistantTo5 = document.getElementById("resistantTo5").value;
  var resistantTo6 = document.getElementById("resistantTo6").value;

  if (resistantTo1 != "") {
    resistantTo = resistantTo + "<li>" + resistantTo1 + "</li>";
  }

  if (resistantTo2 != "") {
    resistantTo = resistantTo + "<li>" + resistantTo2 + "</li>";
  }

  if (resistantTo3 != "") {
    resistantTo = resistantTo + "<li>" + resistantTo3 + "</li>";
  }

  if (resistantTo4 != "") {
    resistantTo = resistantTo + "<li>" + resistantTo4 + "</li>";
  }

  if (resistantTo5 != "") {
    resistantTo = resistantTo + "<li>" + resistantTo5 + "</li>";
  }

  if (resistantTo6 != "") {
    resistantTo = resistantTo + "<li>" + resistantTo6 + "</li>";
  }

  var lab_note = document.getElementById("lab_note").value;

  $("#errorLoading").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post(
    "php/save_microbiology.php",
    {
      encounterID: encounterID,
      investigation: investigation,
      sample: sample,
      sensitiveTo: sensitiveTo,
      resistantTo: resistantTo,
      lab_note: lab_note,
      patientID: patientID,
      request_id: request_id,
    },
    function (response) {
      $("#errorLoading").html(response);
      load_lab();
      $("#showLoadInputeLab").modal("hide");
    }
  );
}

function handleInput(e, request_id, patientID, investi_category_id) {
  $("#errorLoading").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  var resultValue = e.value;
  //var lab_note=document.getElementById("lab_note").value;
  if (resultValue != "") {
    $.post(
      "php/save_general_test_input.php",
      {
        resultValue: resultValue,
        request_id: request_id,
        patientID: patientID,
        investi_category_id: investi_category_id,
      },
      function (response) {
        $("#errorLoading").html(response);
      }
    );
  }
}

function save_general_test(patientID, request_id, encounterID) {
  $("#errorLoading").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post(
    "php/save_general_test.php",
    { encounterID: encounterID, patientID: patientID, request_id: request_id },
    function (response) {
      $("#errorLoading").html(response);
      load_lab();
      $("#showLoadInputeLab").modal("hide");
    }
  );
}

function load_systemUsers() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/load_systemUsers.php", function (response) {
    $("#load_content").html(response);
  });
}

function getUserPrev(user_id) {
  $("#loadUserPrevelages").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/get_UserPrevelages.php", { user_id: user_id }, function (
    response
  ) {
    $("#loadUserPrevelages").html(response);
  });
}

function AssignPriv(side_sub_menu_id, UserID, side_menu_id) {
  $.post(
    "php/AssignPriv.php",
    {
      side_sub_menu_id: side_sub_menu_id,
      UserID: UserID,
      side_menu_id: side_menu_id,
    },
    function (response) {
      getUserPrev(UserID);
    }
  );
}

function deleteUser(UserID) {
  $.post("php/deleteUser.php", { UserID: UserID }, function (response) {
    load_systemUsers();
  });
}

function loadEditUser(user_ID) {
  $("#loadUserPrevelages").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/loadEditUser.php", { user_ID: user_ID }, function (response) {
    $("#loadUserPrevelages").html(response);
  });
}

function loadaddUser() {
  $("#loadUserPrevelages").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/add_newUser.php", function (response) {
    $("#loadUserPrevelages").html(response);
  });
}

function AddNewUser() {
  var Username = document.getElementById("Username").value;
  var fullname = document.getElementById("fullname").value;
  var phonrNumber = document.getElementById("phonrNumber").value;
  var email = document.getElementById("email").value;
  var userType = document.getElementById("userType").value;

  $.post(
    "php/AddNewUser.php",
    {
      Username: Username,
      fullname: fullname,
      phonrNumber: phonrNumber,
      email: email,
      userType: userType,
    },
    function (response) {
      load_systemUsers();
      $("#showUserPrevelages").modal("hide");
    }
  );
}

function UsersUpdate(user_ID) {
  var fullname = document.getElementById("fullname").value;
  var phonrNumber = document.getElementById("phonrNumber").value;
  var email = document.getElementById("email").value;
  var userType = document.getElementById("userType").value;

  $.post(
    "php/updateUsers.php",
    {
      user_ID: user_ID,
      fullname: fullname,
      phonrNumber: phonrNumber,
      email: email,
      userType: userType,
    },
    function (response) {
      load_systemUsers();
      $("#showUserPrevelages").modal("hide");
    }
  );
}

function viewPaitentPrescreption(patient_visit_id) {
  $("#loadData").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post(
    "content/viewPaitentPrescreption.php",
    { patient_visit_id: patient_visit_id },
    function (response) {
      $("#loadData").html(response);
    }
  );
}

function closePatientFile(patientID, patient_visit_id) {
  $.post(
    "php/closePatientFile.php",
    { patient_visit_id: patient_visit_id, patientID: patientID },
    function (response) {
      load_doctor_desk();
    }
  );
}

function loadManage_TestRequest() {
  $("#GetData").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post("content/loadManageTestRequest.php", function (response) {
    $("#GetData").html(response);
  });
}

function loaddoctors_requestDetails(request_id) {
  $("#GetData").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post(
    "content/loaddoctors_requestDetails.php",
    { request_id: request_id },
    function (response) {
      $("#GetData").html(response);
    }
  );
}

function changePassword() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/changePassword.php", function (response) {
    $("#load_content").html(response);
  });
}

function setChangePassword() {
  var old_pass = document.getElementById("old_pass").value;
  var new_pass1 = document.getElementById("new_pass1").value;
  var new_pass2 = document.getElementById("new_pass2").value;
  if (new_pass1 == new_pass2 && new_pass1 != "") {
    $.post(
      "php/setChangePassword.php",
      { old_pass: old_pass, new_pass1: new_pass1 },
      function (response) {
        alert(response);
      }
    );
  } else {
    alert("Please check your Entry");
  }
}

function project_supervisor() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/project_supervisor.php", function (response) {
    $("#load_content").html(response);
  });
}

function view_sup_list(sup_id) {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/view_supervisor_list.php", { sup_id: sup_id }, function (
    response
  ) {
    $("#load_content").html(response);
  });
}

function view_student_project(student_id) {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post(
    "content/view_student_project.php",
    { student_id: student_id },
    function (response) {
      $("#load_content").html(response);
    }
  );
}

function load_serach_staff() {
  var txtStaff = document.getElementById("txtStaff").value;
  $("#LoadSerchStaff").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/load_serach_staff.php", { txtStaff: txtStaff }, function (
    response
  ) {
    $("#LoadSerchStaff").html(response);
  });
}

function make_staff_supervisor(staffid) {
  $.post("php/make_staff_supervisor.php", { staffid: staffid }, function (
    response
  ) {
    $("#LoadSerchStaff").html(response);
  });
  project_supervisor();
}

function searchStudent(sup_id) {
  $.post("content/loadAddStudent.php", { sup_id: sup_id }, function (response) {
    $("#LoadSerchStaff").html(response);
  });
}

function addSupStudent(sup_id) {
  document.getElementById("errorr").innerHTML =
    '<center><p style="color:red"><b>Please wait...</b><p>';
  var number = document.getElementById("number").value;
  var email = document.getElementById("email").value;
  var phoneNumber = document.getElementById("phoneNumber").value;
  var faculty = document.getElementById("faculty").value;
  var type = document.getElementById("type").value;
  var name = document.getElementById("name").value;
  var gender = document.getElementById("gender").value;

  if (
    number == "" &&
    email == "" &&
    phoneNumber == "" &&
    faculty == "" &&
    type == "" &&
    name == "" &&
    gender == ""
  ) {
    document.getElementById("errorr").innerHTML =
      "Provide all the requred Informations";
  } else {
    number = $.trim(number);
    email = $.trim(email);
    phoneNumber = $.trim(phoneNumber);
    faculty = $.trim(faculty);
    type = $.trim(type);
    name = $.trim(name);
    gender = $.trim(gender);

    $.post(
      "php/createStudentAccount.php",
      {
        sup_id: sup_id,
        number: number,
        email: email,
        phoneNumber: phoneNumber,
        faculty: faculty,
        type: type,
        name: name,
        gender: gender,
      },
      function (response, status) {
        // Required Callback Function
        document.getElementById("errorr").innerHTML = response;
      }
    );
  }
}

function assign_student(sup_id, std_id) {
  $.post(
    "php/assign_student.php",
    { sup_id: sup_id, std_id: std_id },
    function (response) {
      view_sup_list(sup_id);
    }
  );
}

function search_Staff() {
  var txtStaff = document.getElementById("txtSearchP").value;
  $("#LoadSerchStaff").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/LoadSearchStaff.php", { txtStaff: txtStaff }, function (
    response
  ) {
    $("#GetLoadSearchStaff").html(response);
  });
}

function set_password(staffIDD) {
  $.post("php/set_password.php", { staffIDD: staffIDD }, function (response) {
    load_systemUsers();
  });
}

function sendMessage(staff_IDD, student_id) {
  var msg = document.getElementById("btn-input").value;
  if (msg == "") {
    alert("message cant be empty");
  } else {
    $.post(
      "php/sendMessage.php",
      { msg: msg, staff_IDD: staff_IDD, student_id: student_id },
      function (response) {
        getAllMessages(staff_IDD, student_id);
        document.getElementById("btn-input").value = "";
      }
    );
  }
}

function getAllMessages(staffIDD, student_id) {
  $.post(
    "php/getAllMessages.php",
    { staffIDD: staffIDD, student_id: student_id },
    function (response) {
      $("#chat").html(response);
    }
  );
}

function turnitin_cordinator() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/turnitin_cordinator.php", function (response) {
    $("#load_content").html(response);
  });
}

function getListOfStudentUnderFac(faculty_id) {
  $("#load_page").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post(
    "content/getListOfStudentUnderFac.php",
    { faculty_id: faculty_id },
    function (response) {
      $("#load_page").html(response);
    }
  );
}

function approveProjectByCordidator(student_id) {
  var ans = confirm("Are you sure you want to approve this result?");
  if (ans) {
    $.post(
      "php/approveProjectByCordidator.php",
      { student_id: student_id },
      function (response) {
        turnitin_cordinator();
      }
    );
  }
}

function turnitin_assessment(student_id) {
  $("#load_page").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post(
    "content/turnitin_assessment.php",
    { student_id: student_id },
    function (response) {
      $("#load_page").html(response);
    }
  );
}

function SubmitTurnitinResult(student_id) {
  var similarityIndex = document.getElementById("similarityIndex").value;
  var internetSources = document.getElementById("internetSources").value;
  var publications = document.getElementById("publications").value;
  var studentPapers = document.getElementById("studentPapers").value;

  $.post(
    "php/SubmitTurnitinResult.php",
    {
      student_id: student_id,
      similarityIndex: similarityIndex,
      internetSources: internetSources,
      publications: publications,
      studentPapers: studentPapers,
    },
    function (response) {
      alert(response);
    }
  );
}

function AssignStaffToFaculty() {
  var txtStaff = document.getElementById("txtStaff").value;
  $("#LoadSerchStaff").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/AssignStaffToFaculty.php", { txtStaff: txtStaff }, function (
    response
  ) {
    $("#LoadSerchStaff").html(response);
  });
}

function assignFac(staffid) {
  var faculty = document.getElementById("faculty").value;
  $.post("php/assignFac.php", { staffid: staffid, faculty: faculty }, function (
    response
  ) {
    turnitin_cordinator();
  });
}

function turnitin_payment() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/turnitin_payment.php", function (response) {
    $("#load_content").html(response);
  });
}

function turnitinDesk() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/turnitinDesk.php", function (response) {
    $("#load_content").html(response);
  });
}

function view_project_details(student_id) {
  $("#load_page").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post(
    "content/view_project_details.php",
    { student_id: student_id },
    function (response) {
      $("#load_page").html(response);
    }
  );
}

function push_for_Approval(student_id) {
  var ans = confirm("Are you sure you want to push for Approval?");
  if (ans == true) {
    $.post("php/push_for_Approval.php", { student_id: student_id }, function (
      response
    ) {
      turnitinDesk();
    });
  }
}

function turnitinApprovalDesk() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/turnitinApprovalDesk.php", function (response) {
    $("#load_content").html(response);
  });
}

function view_project_details_forApproval(student_id) {
  $("#load_page").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post(
    "content/view_project_details_forApproval.php",
    { student_id: student_id },
    function (response) {
      $("#load_page").html(response);
    }
  );
}

function turnitin_Approval(student_id) {
  var ans = confirm("Are you sure you want to Approval this?");
  if (ans == true) {
    $.post("php/turnitin_Approval.php", { student_id: student_id }, function (
      response
    ) {
      turnitinApprovalDesk();
    });
  }
}

function manage_student() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/manage_students.php", function (response) {
    $("#load_content").html(response);
  });
}

function students_wizard() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/students_wizard.php", function (response) {
    $("#load_content").html(response);
  });
}

function download_student() {
  document.getElementById("btn-download").disabled = true;
  var programm = document.getElementById("programm").value;
  var level = document.getElementById("level").value;

  $("#loading").html('<center><img src="images/ajax-loader1.gif"></center>');
  if (programm == "") {
    alert("Please Select Programme");
    document.getElementById("btn-download").disabled = false;
    $("#loading").html("");
  } else if (level == "") {
    alert("Please Select Level");
    document.getElementById("btn-download").disabled = false;
    $("#loading").html("");
  } else {
    $.post(
      "php/pull_students.php",
      { programm: programm, level: level },
      function (response) {
        document.getElementById("btn-download").disabled = false;
        $("#loading").html("");
        alert(response);
        students_wizard();
      }
    );
  }
}

function compute_result() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/compute_result.php", function (response) {
    $("#load_content").html(response);
  });
}

function load_cumpute_result(course_id) {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/load_cumpute_result.php", { course_id: course_id }, function (
    response
  ) {
    $("#load_content").html(response);
  });
}

function save_ca(id, student_id, course_id, semester) {
	
  var ca = document.getElementById("ca_" + student_id).value;
  var exam = document.getElementById("exam_" + student_id).value;
  if (ca == "") {
    alert("CA can not be empty");
    document.getElementById("ca_" + student_id).style.border = "1px solid red";
  } else if (ca > 30) {
    alert("CA can not be more than 30");
    document.getElementById(id).style.border = "1px solid red";
    document.getElementById("ca_" + student_id).value = "";
  } else if (exam == "") {
    alert("Exam can not be empty");
    document.getElementById("exam_" + student_id).style.border =
      "1px solid red";
  } else if (exam > 70) {
    alert("Exam can not be more than 70");
    document.getElementById(id).style.border = "1px solid red";
    document.getElementById("exam_" + student_id).value = "";
  } else {
    var total = parseInt(ca) + parseInt(exam);
    document.getElementById("total_" + student_id).value = total;

    $.post(
      "php/save_ca.php",
      {
        student_id: student_id,
        total: total,
        ca: ca,
        exam: exam,
        course_id: course_id,
        semester: semester,
      },
      function (response) {
		 //alert(response);
        if (response == "1") {
          document.getElementById("ca_" + student_id).style.border =
            "5px solid green";
          document.getElementById("exam_" + student_id).style.border =
            "5px solid green";
          document.getElementById("total_" + student_id).style.border =
            "5px solid green";
        }
      }
    );
  }
}

function submit_result(course_id) {
  ans = confirm("Are you sure you want to submit this Result?");
  if (ans == true) {
    //loading
    $.post("php/submit_result.php", { course_id: course_id }, function (
      response
    ) {
      if (response == "1") {
        alert("Result submited Successfully");
      }
    });
  }
}

function generate_pin() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/generate_pin.php", function (response) {
    $("#load_content").html(response);
  });
}

function search_student() {
  var matric_number = document.getElementById("matric_number").value;
  $("#loadSearch").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post(
    "php/search_student_for_election.php",
    { matric_number: matric_number },
    function (response) {
      $("#loadSearch").html(response);
    }
  );
}

function election_result() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/election_result.php", function (response) {
    $("#load_content").html(response);
  });
}

function RefreshRegisteredStudent(course_id) {
  $("#loading").html("<center>Please Wait...</center>");
  $.post("php/pull_students_courses.php", { course_id: course_id }, function (
    response
  ) {
    $("#loading").html("");
    alert(response);
    load_cumpute_result(course_id);
  });
}

function result_manager() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/result_manager.php", function (response) {
    $("#load_content").html(response);
  });
}

function search_programme_courses() {
  var session = document.getElementById("session").value;
  var programme = document.getElementById("programme").value;
  var level = document.getElementById("level").value;

  $("#load_page_contecnt").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post(
    "php/search_programme_courses.php",
    { session: session, programme: programme, level: level },
    function (response) {
      $("#load_page_contecnt").html(response);
    }
  );
}

function removeCourse(id) {
  var session = document.getElementById("session").value;
  var ans = confirm("Are you sure you want to remove the course?");
  if (ans == true) {
    $.post(
      "php/remove_programme_courses.php",
      { id: id, session: session },
      function (response) {
        alert(response);
        search_programme_courses();
      }
    );
  }
}

function loadCoursesByProgramme(programme_id, semester) {
  $("#loadCourses").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post(
    "content/loadCoursesByProgramme.php",
    { programme_id: programme_id, semester: semester },
    function (response) {
      $("#loadCourses").html(response);
    }
  );
}

function search_course(semester) {
  var session = document.getElementById("session").value;
  var programme = document.getElementById("programme").value;
  var level = document.getElementById("level").value;

  var course_title = document.getElementById("course_title").value;
  $("#load_search_course").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post(
    "php/search_course.php",
    {
      semester: semester,
      course_title: course_title,
      session: session,
      programme: programme,
      level: level,
    },
    function (response) {
      $("#load_search_course").html(response);
    }
  );
}

function addCourseToProgramme(course_id, semester) {
  var session = document.getElementById("session").value;
  var programme = document.getElementById("programme").value;
  var level = document.getElementById("level").value;
  $.post(
    "php/addCourseToProgramme.php",
    {
      semester: semester,
      course_id: course_id,
      session: session,
      programme: programme,
      level: level,
    },
    function (response) {
      alert(response);
      search_programme_courses();
    }
  );
}

function manage_courses() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/manage_courses.php", function (response) {
    $("#load_content").html(response);
  });
}

function manage_programme() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/manage_programme.php", function (response) {
    $("#load_content").html(response);
  });
}

function manage_department() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/manage_departments.php", function (response) {
    $("#load_content").html(response);
  });
}

function manage_faculty() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/manage_faculty.php", function (response) {
    $("#load_content").html(response);
  });
}

function load_courses() {
  var programme_id = document.getElementById("programme_id").value;
  $("#load_courses").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/load_courses.php", { programme: programme_id }, function (
    response
  ) {
    $("#load_courses").html(response);
  });
}

function manage_session() {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("content/manage_session.php", function (response) {
    $("#load_content").html(response);
  });
}

function download_courses() {
  var programme_id = document.getElementById("programme_id").value;
  $("#load_courses").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post("php/download_courses.php", { programme_id: programme_id }, function (
    response
  ) {
    load_courses();
  });
}

function asignCourseToStaff(course_id) {
  $("#modelData").html('<center><img src="images/ajax-loader1.gif"></center>');
  $.post(
    "content/loadAssignStaffCoursePage.php",
    { course_id: course_id },
    function (response) {
      $("#modelData").html(response);
    }
  );
}

function assignCourse(course_id) {
  var staffNo = document.getElementById("staffNo").value;
  if (staffNo == "") {
    alert("Please provide me with the staff number ");
  } else {
    $.post(
      "php/assignCourse.php",
      { staffNo: staffNo, course_id: course_id },
      function (response) {
        alert(response);
        search_programme_courses();
      }
    );
  }
}

function view_programme(programme_id) {
  $("#load_content").html(
    '<center><img src="images/ajax-loader1.gif"></center>'
  );
  $.post(
    "content/view_programme.php",
    { programme_id: programme_id },
    function (response) {
      $("#load_content").html(response);
    }
  );
}

function runResultWiz(semester) {
  var session = document.getElementById("session").value;
  var programme = document.getElementById("programme").value;
  var level = document.getElementById("level").value;

  if (level == "100 Level" && semester == "1") {
    run_100_level_result_first_semester(session, programme);
  } else if (level == "100 Level" && semester == "2") {
    run_100_level_result_second_semester(session, programme);
  }
}

function getFirstSemesterResultGrade(session, programme) {
  $("#result_error").html(
    '<center><img src="images/ajax-loader1.gif"><br/><p>Please Wait, Computing Result, This will take a some moment</p></center>'
  );
  $.post(
    "content/getFirstSemesterResultGrade.php",
    { session: session, programme: programme },
    function (response) {
      $("#result_error").html(response);
    }
  );
}

function run_100_level_result_first_semester(session, programme) {
  $("#result_error").html(
    '<center><img src="images/ajax-loader1.gif"><br/><p>Please Wait, I am trying to get you the Record, This may take some moment</p></center>'
  );
  $.post(
    "php/run_100_level_result_first_semester.php",
    { session: session, programme: programme },
    function (response) {
      search_programme_courses();
    }
  );
}

function run_100_level_result_second_semester(session, programme) {
  $("#result_error").html(
    '<center><img src="images/ajax-loader1.gif"><br/><p>Please Wait, I am trying to get you the Record, This may take some moment</p></center>'
  );
  $.post(
    "php/run_100_level_result_second_semester.php",
    { session: session, programme: programme },
    function (response) {
      alert(response);
      search_programme_courses();
    }
  );
}

function setCore(core,programm_course_id){

  var session = document.getElementById("session").value;
  
  $.post(
    "php/setCore.php",
    { core: core, programm_course_id: programm_course_id,session:session },
    function (response) {
     alert(response);
    }
  );
 
}

function setCore2(core,programm_course_id){
	var session = document.getElementById("session").value;
	$.post(
	  "php/setCore.php",
	  { core: core, programm_course_id: programm_course_id,session:session },
	  function (response) {
	   alert(response);
	  }
	);
   
  }

  function vewResult(semester){
	var session = document.getElementById("session").value;
	var programme = document.getElementById("programme").value;
	var level = document.getElementById("level").value;
	$("#result_error").html(
		'<center><img src="images/ajax-loader1.gif"><br/><p>Please Wait, I am trying to get you the Record, This may take some moment</p></center>'
	  );
	  $.post(
		"content/vewResult.php",
		{ session:session,programme:programme,level:level,semester:semester},
		function (response) {
			$("#result_error").html(response);
		}
	  );
  }


  function vewSenet(semester){
	var session = document.getElementById("session").value;
	var programme = document.getElementById("programme").value;
	var level = document.getElementById("level").value;
	$("#result_error").html(
		'<center><img src="images/ajax-loader1.gif"><br/><p>Please Wait, I am trying to get you the Record, This may take some moment</p></center>'
	  );
	  $.post(
		"content/vewSenet.php",
		{ session:session,programme:programme,level:level,semester:semester},
		function (response) {
			$("#result_error").html(response);
		}
	  );
  }

  function upload_student(){
  var session = document.getElementById("session").value;
	var programme = document.getElementById("programm").value;
	var level = document.getElementById("level").value;
  
	$("#loadUpload").html(
		'<center><img src="images/ajax-loader1.gif"><br/><p>Please Wait, I am trying to get you the Record, This may take some moment</p></center>'
	  );
	  $.post(
		"content/loadStudentUpload.php",
		{ session:session,programme:programme,level:level},
		function (response) {
			$("#loadUpload").html(response);
		}
	  );
  }

  function AddNewCourse(){
    var courseCode = document.getElementById("courseCode").value;
	  var courseTitle = document.getElementById("courseTitle").value;
	  var courseUnit = document.getElementById("courseUnit").value;
    
    $("#error").html(
      '<center><img src="images/ajax-loader1.gif"><br/><p>Please Wait...</p></center>'
      );
      $.post(
      "php/addCourse.php",
      { courseCode:courseCode,courseTitle:courseTitle,courseUnit:courseUnit},
      function (response) {
        if(response==1){
          alert("Course Added Successfully");
          load_courses();
        }else{
          $("#error").html(response);
        }
       
      }
      );
  }

 //download_student