
// ### PROTECTION JS FILE ###//
const areaSelect = document.getElementById('areaSelect');
const engineerSelect = document.querySelector(".engineerSelect");
const eng_name_email = document.getElementById('eng_name_email');
const shiftSelect = document.getElementById('shiftSelect');
const engEmail = document.getElementById('eng_name_email');
const stationName = document.querySelector("#ssname");
const staionFullName=document.querySelector('#staion_full_name');
const controlName = document.querySelector('#control_name');
const make = document.querySelector('#make');
const stationIdInput = document.querySelector('#station_id');
const refNum = document.querySelector("#refNum");
const showAttachment = document.getElementById('showAttachment');
const hideAttachment = document.getElementById('hideAttachment');
const attachmentFile = document.getElementById('attachmentFile');
//generate random number
let randomNumber = Math.floor(Math.random() * 900);
refNum.value += randomNumber + 1;


const controlColor = (value)=>{
    let area_select_option = document.createElement("option");
    let area_select_option2 = document.createElement("option");
    switch(value){
        case "SHUAIBA CONTROL CENTER":
            controlName.classList.add('form-control' ,'text-center','bg-success','text-light');
            area_select_option.text = 'المنطقة الجنوبية';
            area_select_option.value = 1;
            areaSelect.add(area_select_option);
            break;
        case "JABRIYA CONTROL CENTER":
            controlName.classList.add('form-control' ,'text-center','bg-info','text-light');
            area_select_option.text = 'المنطقة الجنوبية';
            area_select_option.value = 1;
            areaSelect.add(area_select_option);
            break;
        case "JAHRA CONTROL CENTER":
            controlName.classList.add('form-control' ,'text-center','bg-warning','text-light');
            area_select_option.text = 'المنطقة الشمالية';
            area_select_option.value = 1;
            areaSelect.add(area_select_option);
            break;
        case "TOWN CONTROL CENTER":
            controlName.classList.add('form-control' ,'text-center','bg-danger','text-light');
            area_select_option.text = 'المنطقة الشمالية';
            area_select_option.value = 1;
            areaSelect.add(area_select_option);
            break;
        case "NATIONAL CONTROL CENTER":
            controlName.classList.add('form-control' ,'text-center','bg-dark','text-light');
            area_select_option.text = 'المنطقة الشمالية';
            area_select_option.value = 1;
            areaSelect.add(area_select_option);
            area_select_option2.text = 'المنطقة الجنوبية';
            area_select_option2.value = 1;
            areaSelect.add(area_select_option2);
            break;
            default:
                controlName.classList.add('form-control' ,'text-center','bg-dark','text-danger');

                controlName.value = ' الرجاء تعديل اسم التحكم من جدول المحطات'
          
    }//switch end
}
//get Station
const getStation = async()=>{
    let station_id = stationName.value;
    const response = await fetch("/battery/stations/" + station_id);
    if (response.status !== 200) {
        throw new Error('can not fetch the data');
    }
    const data = await response.json();
    console.log(data)
    staionFullName.classList.remove('d-none');
    controlName.classList.remove('d-none');
    staionFullName.value = data.fullName;
    make.value = data.COMPANY_MAKE
    controlName.value = data.control;
    stationIdInput.value = data.id;
    controlName.removeAttribute("class");
    areaSelect.innerText = null;
    engineerSelect.innerText=null;
    //calling function
    controlColor(controlName.value);
    return areaSelect.value;
  
}
//get Engineer's name
 const getEngineer = async ()=>{
    area_id = await getStation();
    shift_id = shiftSelect.value ;
    const response = await fetch("/battery/getEngineer/" + area_id + "/" + shift_id);
    if (response.status !== 200) {
        throw new Error('can not fetch the data');
    }
    const data = await response.json();
    console.log(data)
    for (let i = 0; i < data.length; i++) {
        let engineerSelectValue = document.createElement('option');
        engineerSelectValue.value = data[i].id;
        engineerSelectValue.innerHTML = data[i].name;
        engineerSelect.appendChild(engineerSelectValue);
        engEmail.value = data[0].email;
        //console.log(data[i].id, data[i].name)
    }
    return data;

}
//get Engineer's email
const getEngineerEmail = async()=>{
let eng_id = engineerSelect.value;
    const response = await fetch("/battery/getEngineersEmail/" + eng_id);
    if (response.status !== 200) {
        throw new Error('can not fetch the data');
    }
    const data = await response.json();
    engEmail.value = data.email;

}
//get Engineers on shift
const getEngineersShift = async ()=>{
    engineerSelect.innerText = null;
    engEmail.value = "";
    let shift_id = shiftSelect.value;
    let area_id = await getStation();
    const response = await fetch("/battery/getEngineersOnShift/"+ area_id+'/'+ shift_id);
    if (response.status !== 200) {
        throw new Error('can not fetch the data');
    }
    const data = await response.json();
    console.log(data)
    for (let i = 0; i < data.length; i++) {
        let engineerSelectValue = document.createElement('option');
        engineerSelectValue.value = data[i].id;
        engineerSelectValue.innerHTML = data[i].name;
        engineerSelect.appendChild(engineerSelectValue);
        engEmail.value = data[0].email;
        //console.log(data[i].id, data[i].name)
    }
    return data;
}
//to toggle files atthachmant

showAttachment.addEventListener('click', e => {
    e.preventDefault();
    hideAttachment.classList.toggle('d-none');
    showAttachment.classList.toggle('d-none');
    attachmentFile.classList.toggle('d-none');
})
hideAttachment.addEventListener('click', e => {
    e.preventDefault();
    hideAttachment.classList.toggle('d-none');
    showAttachment.classList.toggle('d-none');
    attachmentFile.classList.toggle('d-none');
})
controlColor(controlName.value);
