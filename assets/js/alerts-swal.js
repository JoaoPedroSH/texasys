function swalRegisterSuccess() {
  Swal.fire({
    position: "top-end",
    icon: "success",
    title: "Produto cadastrado com sucesso!",
    showConfirmButton: false,
    timer: 1500,
  });
}

function swalRegisterfailed() {
  Swal.fire({
    position: "top-end",
    icon: "failed",
    title: "Produto não foi cadastrado!",
    showConfirmButton: false,
    timer: 1500,
  });
}

function swalAddTableSuccess() {
  Swal.fire({
    position: "top-end",
    icon: "success",
    title: "Mesa adicionada!",
    showConfirmButton: false,
    timer: 1500,
  });
}

function swalAddTablefailed() {
  Swal.fire({
    position: "top-end",
    icon: "error",
    title: "Erro ao adicionar mesa!",
    showConfirmButton: false,
    timer: 1500,
  });
}
