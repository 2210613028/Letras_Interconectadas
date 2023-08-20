let arreglo = ["","",""];

function allowDrop(ev){
  ev.preventDefault();
}
function drag(){
  ev.dragTransfer.setData("text", ev.target.id);
}
function drop(ev){
  if(arreglo[parseInt(ev.target.id)]==""){
  var data = ev.dataTranster.getData["text"];
  arreglo[parseInt(ev.target.id)] ==data;
  ev.target.appendChild(document.getElementById(data));
}
if(arreglo[0]!="" && arreglo[1]!="" && arreglo[2]!=""){
  if(arreglo[0]=="gato" && arreglo[1] =="perro" && arreglo[2]=="loro"){
    document.querySelector("h1").innerHTML = "MUY BIEN!!";
  }else{
    document.querySelector("h1").innerHTML = "INTENTA DE NUEVO";
  }

  }
}