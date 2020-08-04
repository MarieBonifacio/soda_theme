window.addEventListener('load', function () {
  var admin = myScript.admin;
  var editor = myScript.editor;
  const bp = document.querySelector(".bpas-post-form-wrapper");

  console.log(admin, editor);
  if(admin || editor)
  {
    bp.style.display = "block";
  }
  else
  {
    bp.style.display = "none";
  }
});

