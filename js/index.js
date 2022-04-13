var n1=document.getElementById('n1');
var n2=document.getElementById('n2');
var n3=document.getElementById('n3');
var n4=document.getElementById('n4');
var n5=document.getElementById('n5');
var n6=document.getElementById('n6');
var n7=document.getElementById('n7');
var n8=document.getElementById('n8');
var n9=document.getElementById('n9');
var n0=document.getElementById('n0');
var n0=document.getElementById('n0');
var n0=document.getElementById('n0');
var nU=document.getElementById('nU');
var nB=document.getElementById('nB');
var field=document.getElementById('passfield');
field.addEventListener("textinput", ()=>{
    alert(field.value);
})
if(!field.getAttribute('disabled')){
n1.addEventListener("click", ()=>{
  let str=field.value;
  if(str.length<6){
    field.value=field.value+"1";
  }
});
n2.addEventListener("click", ()=>{
  let str=field.value;
  if(str.length<6){
    field.value=field.value+"2";
  }
});
n3.addEventListener("click", ()=>{
  let str=field.value;
  if(str.length<6){
    field.value=field.value+"3";
  }
});
n4.addEventListener("click", ()=>{
  let str=field.value;
  if(str.length<6){
    field.value=field.value+"4";
  }
});
n5.addEventListener("click", ()=>{
  let str=field.value;
  if(str.length<6){
    field.value=field.value+"5";
  }
});
n6.addEventListener("click", ()=>{
  let str=field.value;
  if(str.length<6){
    field.value=field.value+"6";
  }
});
n7.addEventListener("click", ()=>{
  let str=field.value;
  if(str.length<6){
    field.value=field.value+"7";
  }
});
n8.addEventListener("click", ()=>{
  let str=field.value;
  if(str.length<6){
    field.value=field.value+"8";
  }
});
n9.addEventListener("click", ()=>{
  let str=field.value;
  if(str.length<6){
    field.value=field.value+"9";
  }
});
nB.addEventListener("click", ()=>{
  let str=field.value;
  //let ln=str.length-1;
  str=str.slice(0, -1);
  field.value=str;
});
}
