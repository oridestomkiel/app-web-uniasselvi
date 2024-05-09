$(function () {
  var $dateSearch = $("#dateSearch").datepicker({
    uiLibrary: "bootstrap5",
    locale: "pt-br",
    format: "dd/mm/yyyy",
    disableDaysOfWeek: [0, 6],
    close: function (e) {
      var dataIso = dateToIso($dateSearch.value());
      window.location.href = `agenda.php?data=${dataIso}`;
    },
  });
  if (isQueryParam("data")) {
    $dateSearch.value(formatDateToBr(getQueryParam("data")));
  }

  var $dataAgenda = $("#addAgendaForm #recipient-dataAgenda").datepicker({
    uiLibrary: "bootstrap5",
    locale: "pt-br",
    format: "dd/mm/yyyy",
    disableDaysOfWeek: [0, 6],
    close: function (e) {},
  });

  $("#edtAgendaForm #recipient-dataAgendaEdt").datepicker({
    uiLibrary: "bootstrap5",
    locale: "pt-br",
    format: "dd/mm/yyyy",
    disableDaysOfWeek: [0, 6],
    close: function (e) {},
  });

  $(".btn-add").on("click", function () {
    var type = $(this).data("type");
    var requiredFields = getValidateFields(type);
    $.each(requiredFields, function (index, fieldId) {
      var $field = $(`#${fieldId}`);
      $field.removeClass("is-invalid");
      $field.val("");
    });
    $("#recipient-Observacoes").val("");
    $("#recipient-Complemento").val("");
    if (type == "Agenda") {
      var data = $(this).data("data");
      var hora = $(this).data("hora");
      $("#addAgendaForm #recipient-Hora").val(hora);
      $dataAgenda.value(data);
    }
  });

  $(".btn-view").on("click", function () {
    var id = getId($(this).attr("id"));
    var type = $(this).data("type");
    var info = getInfo(type, id);
    addTable(info);
  });

  $(".btn-edt").on("click", function () {
    var id = getId($(this).attr("id"));
    var type = $(this).data("type");
    var info = getInfo(type, id);
    if (type == "Pet") {
      addFormPet(info);
    } else if (type == "Agenda") {
      addFormAgenda(info);
    } else {
      addFormTutor(info);
    }
  });

  $(".btn-del").on("click", function () {
    var id = getId($(this).attr("id"));
    var type = $(this).data("type");
    var info = getInfo(type, id);
    delItem(info);
  });

  $(".btn-add-form, .btn-edt-form").on("click", function () {
    var form = $(this).data("add");
    var formId = $(this).data("form");
    submitForm(form, formId);
  });

  $(".btn-del-form").on("click", function () {
    var form = $(this).data("del");
    if (form == "pets") {
      $("#delPetForm").submit();
    } else if (form == "agendas") {
      $("#delAgendaForm").submit();
    } else {
      $("#delTutorForm").submit();
    }
  });

  $(".recipient-CEP").on("blur", function () {
    var cep = $(this).val().replace(/\D/g, "");

    if (cep.length === 8) {
      var apiUrl = `https://midiaville.com.br/cep.php?cep=${cep}`;
      showLoading();

      $.ajax({
        url: apiUrl,
        method: "GET",
        success: function (response) {
          $(".recipient-Endereco").val(response.street);
          $(".recipient-Bairro").val(response.neighborhood);
          $(".recipient-Cidade").val(response.city);
          $(".recipient-Estado").val(response.state);
          $(".recipient-Numero").focus();
          hideLoading();
        },
        error: function () {
          showAlert("CEP não encontrado ou erro na requisição.", "danger");
          hideLoading();
        },
      });
    } else {
      showAlert("Por favor, insira um CEP válido.", "danger");
    }
  });

  $("#AddAgenda #recipient-Tutor, #EdtAgenda #recipient-Tutor").on(
    "change",
    function () {
      var tutor = $(this).val();
      var act = $(this).data("act");
      if (tutor != "") {
        getPets(tutor, act);
      } else {
        $("#AddAgenda #recipient-Pet").html(
          '<option value="">Selecione um Tutor</option>'
        );
      }
    }
  );

  $(".view-modal-dynamic").on("click", function () {
    var type = $(this).data("type");
    var id = $(this).data("id");

    showLoading();
    $.ajax({
      url: `api/api.php?dados=${type}&id=${id}`,
      method: "GET",
      success: function (response) {
        $("#ViewModalDinamic .modal-title").html(`Visualizar ${type}`);
        $("#ViewModalDinamic .modal-body").html(`${response}`);
        var myModal = new bootstrap.Modal($("#ViewModalDinamic"));
        myModal.show();
        hideLoading();
      },
      error: function () {
        showAlert("Pet não encontrado ou erro na requisição.", "danger");
        hideLoading();
      },
    });
  });
  var horasVagas = $("#recipient-Hora").find("option").length;
  var agendaFechada = $(".agendaFechada").length;
  if (horasVagas == 1) {
    $("#agendaAviso").html("Agenda lotada para esta data!");
    $("#agendaLotada").show();
  }
  if (agendaFechada > 0) {
    $("#agendaAviso").html("Agenda fechada para esta data!");
    $("#agendaLotada").show();
  }
});

function getId(id) {
  return id.replace("Id-", "");
}

function getInfo(type, id) {
  return $(`#${type}-${id}`).data("info");
}

function addTable(info) {
  const copiedInfo = { ...info };
  delete copiedInfo.id;
  delete copiedInfo.Tutor_Id;
  delete copiedInfo.Tutor_id;
  delete copiedInfo.Pet_id;
  var table = $("<table>").addClass("vertical-table");
  for (var key in copiedInfo) {
    var row = $("<tr>");
    row.append(`<th class="label-${key}">${getLabel(key)}</th>`);
    row.append(`<td class="data-${key}">${copiedInfo[key]}</td>`);
    table.append(row);
  }
  $("#table-container-info").html(table);
  var dataHora = $("#table-container-info .data-Hora").html();
  $("#table-container-info .data-Hora").html(formataHora(dataHora));
  var dataData = $("#table-container-info .data-Data").html();
  $("#table-container-info .data-Data").html(formatDateToBr(dataData));
}

function delItem(info) {
  var message = alertMessage(
    `Você tem certeza que deseja apagar <strong>${
      info.Nome ? info.Nome : " Agenda "
    }</strong>?`,
    "warning"
  );
  $("#modal-container-del").html(message);
  $("#idDel").val(info.id);
}

function addFormTutor(info) {
  $("#edtTutorForm #recipient-Nome").val(info.Nome);
  $("#edtTutorForm #recipient-Email").val(info.Email);
  $("#edtTutorForm #recipient-Telefone").val(info.Telefone);
  $("#edtTutorForm #recipient-CEP").val(info.CEP);
  $("#edtTutorForm #recipient-Endereco").val(info.Endereco);
  $("#edtTutorForm #recipient-Numero").val(info.Numero);
  $("#edtTutorForm #recipient-Bairro").val(info.Bairro);
  $("#edtTutorForm #recipient-Complemento").val(info.Complemento);
  $("#edtTutorForm #recipient-Estado").val(info.Estado);
  $("#edtTutorForm #recipient-Cidade").val(info.Cidade);
  $("#edtTutorForm #recipient-Id").val(info.id);
}

function addFormPet(info) {
  $("#edtPetForm #recipient-Tutor").val(info.Tutor_Id);
  $("#edtPetForm #recipient-Nome").val(info.Nome);
  $("#edtPetForm #recipient-Especie").val(info.Especie);
  $("#edtPetForm #recipient-Sexo").val(info.Sexo);
  $("#edtPetForm #recipient-Observacoes").val(info.Observacoes);
  $("#edtPetForm #recipient-Id").val(info.id);
}

function addFormAgenda(info) {
  $("#edtAgendaForm #recipient-Tutor").val(info.Tutor_id);
  getPets(info.Tutor_id).done(function () {
    $("#edtAgendaForm #recipient-Pet").val(info.Pet_id);
  });
  $("#edtAgendaForm #recipient-dataAgendaEdt").val(formatDateToBr(info.Data));
  var horaSelect = formataHora(info.Hora);
  var optionsHora =
    $(".optHorasVagas").html() +
    `<option selected value='${info.Hora}'>${horaSelect}</option>`;
  $("#edtAgendaForm #recipient-Hora").html(ordenarOptions(optionsHora));
  $("#edtAgendaForm #recipient-Hora").val(info.Hora);
  $("#edtAgendaForm #recipient-Servico").val(info.Servico);
  $("#edtAgendaForm #recipient-Id").val(info.id);
}

function ordenarOptions(htmlOptions) {
  const tempDiv = document.createElement("div");
  tempDiv.innerHTML = htmlOptions;
  const optionArray = Array.from(tempDiv.querySelectorAll("option"));
  optionArray.sort((a, b) => {
    const aValue = parseInt(a.value, 10);
    const bValue = parseInt(b.value, 10);
    return aValue - bValue;
  });
  const orderedHtmlOptions = optionArray
    .map((option) => option.outerHTML)
    .join("");
  return orderedHtmlOptions;
}

function alertMessage(message, type) {
  return `<div class="alert alert-${type}" role="alert">
    ${message}
  </div>`;
}

function showAlert(message, alertType = "success") {
  if ($("#alert-container").length === 0) {
    $("body").prepend(
      '<div id="alert-container" style="position: fixed; top: 0; width: 100%; z-index: 99999;"></div>'
    );
  }
  var alertHtml = `
      <div class="alert alert-${alertType} alert-dismissible fade show" role="alert">
          ${message}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  `;
  $("#alert-container").append(alertHtml);
  setTimeout(function () {
    $(".alert").alert("close");
  }, 5000);
}

function submitForm(form, formId) {
  if (formId == "edtAgendaForm") {
    var requiredFields = getValidateFieldsAgendaEdt();
  } else {
    var requiredFields = getValidateFields(form);
  }
  console.log(requiredFields);
  var allFieldsFilled = true;
  $.each(requiredFields, function (index, fieldId) {
    var $field = $(`#${formId} #${fieldId}`);
    var value = $field.val().trim();
    if (!value || value === "") {
      allFieldsFilled = false;
      $field.addClass("is-invalid");
    } else {
      $field.removeClass("is-invalid");
    }
  });
  if (!allFieldsFilled) {
    event.preventDefault();
    showAlert("Por favor, preencha todos os campos obrigatórios!", "danger");
  } else {
    $(`#${formId}`).submit();
  }
}

function getValidateFieldsAgendaEdt() {
  return [
    "recipient-Tutor",
    "recipient-Pet",
    "recipient-dataAgendaEdt",
    "recipient-Hora",
    "recipient-Servico",
  ];
}

function getValidateFields(form) {
  if (form == "pets") {
    return [
      "recipient-Tutor",
      "recipient-Nome",
      "recipient-Especie",
      "recipient-Sexo",
    ];
  } else if (form == "Agenda") {
    return [
      "recipient-Tutor",
      "recipient-Pet",
      "recipient-dataAgenda",
      "recipient-Hora",
      "recipient-Servico",
    ];
  } else {
    return [
      "recipient-Nome",
      "recipient-Email",
      "recipient-Telefone",
      "recipient-CEP",
      "recipient-Endereco",
      "recipient-Numero",
      "recipient-Bairro",
      "recipient-Estado",
      "recipient-Cidade",
    ];
  }
}

function getPets(tutor, act) {
  showLoading();
  return $.ajax({
    url: `api/api.php?pets=${tutor}`,
    method: "GET",
    success: function (response) {
      populaSelect("recipient-Pet", response, act);
      hideLoading();
    },
    error: function () {
      showAlert("Pet não encontrado ou erro na requisição.", "danger");
      hideLoading();
    },
  });
}

function populaSelect(id, data, act) {
  var options = '<option value="">Selecione</option>';
  if (data.length == 1) {
    options += `<option selected value="${data[0].id}">${data[0].Nome}</option>`;
  } else {
    data.forEach((item) => {
      options += `<option value="${item.id}">${item.Nome}</option>`;
    });
  }
  if (act == "add") {
    $(`#${id}`).html(options);
  } else {
    $(`.${id}`).html(options);
  }
}

function showLoading() {
  $("#loadingOverlay").css("display", "flex");
}

function hideLoading() {
  $("#loadingOverlay").css("display", "none");
}

function dateToIso(data) {
  var [day, month, year] = data.split("/");
  return `${year}-${month}-${day}`;
}

function getQueryParam(name) {
  const query = window.location.search.slice(1);
  const params = query.split("&");
  for (const param of params) {
    const [key, value] = param.split("=");
    if (key === name) {
      return decodeURIComponent(value);
    }
  }
  return null;
}

function isQueryParam(name) {
  const query = window.location.search.slice(1);
  const params = query.split("&");
  for (const param of params) {
    const [key, value] = param.split("=");
    if (key === name) {
      return true;
    }
  }
  return false;
}

function getLabel(key) {
  const mapeamento = {
    Email: "E-mail",
    Endereco: "Endereço",
    Especie: "Espécie",
    NomePet: "Nome Pet",
    NomeTutor: "Nome Tutor",
    Numero: "Número",
    Observacoes: "Observações",
    Servico: "Serviço",
  };
  if (mapeamento[key]) {
    return mapeamento[key];
  }
  return key;
}

function formatDateToBr(dateStr) {
  const [year, month, day] = dateStr.split("-");
  return `${day}/${month}/${year}`;
}

function formataHora(hour) {
  const formattedHour = hour.toString().padStart(2, "0");
  return `${formattedHour}:00`;
}
