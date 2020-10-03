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
  // var myTable = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

  // const gen = document.querySelector(".gen");
  // const town = document.querySelector(".town");

  // gen.addEventListener("click", ()=>{
  //   myTable.splice((myTable.length), 0, Math.floor(Math.random()*100));
  //   console.log(myTable);
  // })
  // town.addEventListener("click", ()=>{
  //   shuffle(myTable);
  //   console.log(myTable);
  // })
  // function shuffle(myTable){
  //   for (let i = 0; i < myTable.length; i++) {
  //     const indexReplace = Math.floor(Math.random()*(myTable.length));
  //     const replace = myTable[indexReplace];
  //     myTable[i]= myTable[indexReplace];
  //     myTable[i]= replace;
  //   }
  // }
});
