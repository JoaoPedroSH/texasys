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
