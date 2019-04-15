function toggleaddproduct() {
  document.querySelector('#toggleaddproduct').setAttribute("style", "display: block");
  document.querySelector('#togglecategories').setAttribute("style", "display: none");
  document.querySelector('#toggleinventory').setAttribute("style", "display: none");
  document.querySelector('#togglehistory').setAttribute("style", "display: none");
};

function togglecategories() {
  document.querySelector('#toggleaddproduct').setAttribute("style", "display: none");
  document.querySelector('#togglecategories').setAttribute("style", "display: block");
  document.querySelector('#toggleinventory').setAttribute("style", "display: none");
  document.querySelector('#togglehistory').setAttribute("style", "display: none");
};

function toggleinventory() {
  document.querySelector('#toggleaddproduct').setAttribute("style", "display: none");
  document.querySelector('#togglecategories').setAttribute("style", "display: none");
  document.querySelector('#toggleinventory').setAttribute("style", "display: block");
  document.querySelector('#togglehistory').setAttribute("style", "display: none");
};

function togglehistory() {
  document.querySelector('#toggleaddproduct').setAttribute("style", "display: none");
  document.querySelector('#togglecategories').setAttribute("style", "display: none");
  document.querySelector('#toggleinventory').setAttribute("style", "display: none");
  document.querySelector('#togglehistory').setAttribute("style", "display: block");
};