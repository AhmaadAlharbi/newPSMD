//buttons
const btnLocal = document.getElementById('btn-local')
const btnIncoming = document.getElementById('btn-incoming')
const btnCommon = document.getElementById('btn-common')

//divs
const divLocal = document.getElementById('div-local')
const divIncoming = document.getElementById('div-incoming')
const divCommon = document.getElementById('div-common')

//enventlistners for tasks buttons
btnLocal.addEventListener('click',(e)=>{
   divLocal.classList.toggle('d-none');

})

btnIncoming.addEventListener('click',(e)=>{
    divIncoming.classList.toggle('d-none');

 })

 btnCommon.addEventListener('click',(e)=>{
    divCommon.classList.toggle('d-none');

    
 })