function printButtons(list){
  console.log(list);
  var i;
  for(i=0; i<list.length; i++){
    printButton(list[i]);
  }
}
function printButton(a){
  console.log(a);
  const container = document.getElementById('buttons');
  if(container!=null){
    const but = document.createElement('button');
    but.setAttribute("onclick","write2("+a+")");
    but.innerHTML=String.fromCodePoint(a);
    container.appendChild(but);
  }
}
function write2(a){
  document.getElementById('myText').value+=String.fromCodePoint(a);
}
