// ### TR JS FILE ###//
const areaSelect = document.getElementById("areaSelect");
const engineerSelect = document.querySelector(".engineerSelect");
const eng_name_email = document.getElementById("eng_name_email");
const shiftSelect = document.getElementById("shiftSelect");
const engEmail = document.getElementById("eng_name_email");
const stationName = document.querySelector("#ssname");
const staionFullName = document.querySelector("#staion_full_name");
const controlName = document.querySelector("#control_name");
const make = document.querySelector("#make");
const stationIdInput = document.querySelector("#station_id");
const refNum = document.querySelector("#refNum");
const showAttachment = document.getElementById("showAttachment");
const hideAttachment = document.getElementById("hideAttachment");
const attachmentFile = document.getElementById("attachmentFile");
const checkBox = document.querySelectorAll(".checkbox");
const chemistryAlarmSelect = document.querySelector("#chemistryAlarm");
const MechAlarmSelect = document.querySelector("#MechAlarmSelect");
const electricAlarm = document.querySelector("#electricAlarm");
const department = document.querySelector("#department");
const WorkTypeMechDiv = document.querySelector("#workType-MechDiv");
const WorkTypeChemDiv = document.querySelector("#workType-ChemDiv");
const WorkTypeElecDiv = document.querySelector("#workType-ElectricalDiv");
const alarm = document.querySelector("#alarm");
const sectionLabel = document.querySelector("#section-label");
//mechanical main alarm
const mainAlarm = document.querySelector("#main_alarm");
//electrical work type
const electricDuty = document.querySelector("#electricDuty");
const electricProgram = document.querySelector("#electricProgram");
const electricServicing = document.querySelector("#electricServicing");
const electricPending = document.querySelector("#electricPending");
//choose which section [chemecal or mechiancal]
const checkDepartment = () => {
    alarm.classList.remove("d-none");
    switch (department.value) {
        case "1":
            sectionLabel.innerText = "Mechanical";
            if (WorkTypeMechDiv.classList.contains("d-none")) {
                //show mechanical section
                WorkTypeMechDiv.classList.remove("d-none");
                MechAlarmSelect.classList.remove("d-none");
                mainAlarm.classList.remove("d-none");
                //hide chemestry section
                WorkTypeChemDiv.classList.add("d-none");
                chemistryAlarmSelect.classList.add("d-none");
                //hide electrical section
                WorkTypeElecDiv.classList.add("d-none");
                electricDuty.classList.add("d-none");
                electricProgram.classList.add("d-none");
                electricServicing.classList.add("d-none");
                electricPending.classList.add("d-none");
            }
            break;
        case "2":
            sectionLabel.innerText = "Chemistry";
            if (WorkTypeChemDiv.classList.contains("d-none")) {
                //hide mechanical section
                WorkTypeMechDiv.classList.add("d-none");
                MechAlarmSelect.classList.add("d-none");
                mainAlarm.classList.add("d-none");
                //hide electrical section
                WorkTypeElecDiv.classList.add("d-none");
                electricDuty.classList.add("d-none");
                electricProgram.classList.add("d-none");
                electricServicing.classList.add("d-none");
                electricPending.classList.add("d-none");
                //show chemestry section
                WorkTypeChemDiv.classList.remove("d-none");
                chemistryAlarmSelect.classList.remove("d-none");
            }
            break;
        case "3":
            sectionLabel.innerText = "Electrical";
            if (WorkTypeChemDiv.classList.contains("d-none")) {
                //hide mechanical section
                WorkTypeMechDiv.classList.add("d-none");
                MechAlarmSelect.classList.add("d-none");
                mainAlarm.classList.add("d-none");

                //hide chemestry section
                WorkTypeChemDiv.classList.add("d-none");
                chemistryAlarmSelect.classList.add("d-none");
                //show electrical section
                WorkTypeElecDiv.classList.remove("d-none");
                electricAlarm.classList.remove("d-none");
            }
            break;
    }
    return department.value;
};
//check work type for Mechinacl
const checkBoxMech = (check) => {
    MechAlarmSelect.innerText = null;

    let MechAlarm_select_option = document.createElement("option");
    let MechAlarm_select_option2 = document.createElement("option");
    let MechAlarm_select_option3 = document.createElement("option");
    let MechAlarm_select_option4 = document.createElement("option");
    let MechAlarm_select_option5 = document.createElement("option");
    let MechAlarm_select_option6 = document.createElement("option");
    switch (check) {
        case "TroubleShooting":
            //option 1
            MechAlarm_select_option.text = "Replace Fan";
            MechAlarm_select_option.value = "Replace Fan";
            MechAlarmSelect.add(MechAlarm_select_option);

            //option 2
            MechAlarm_select_option2.text = "Fix Fan";
            MechAlarm_select_option2.value = "Fix Fan";
            MechAlarmSelect.add(MechAlarm_select_option2);
            //option 3
            MechAlarm_select_option3.text = "Remove Fan";
            MechAlarm_select_option3.value = "(TroubleShooting)Remove Fan";
            MechAlarmSelect.add(MechAlarm_select_option3);
            //option 4
            MechAlarm_select_option4.text = "Install Fan";
            MechAlarm_select_option4.value = "Install Fan";
            MechAlarmSelect.add(MechAlarm_select_option4);
            break;
        case "Maintenance":
            //option 1
            MechAlarm_select_option.text = "Replace Silica Gel";
            MechAlarm_select_option.value = "Replace Silica Gel";
            MechAlarmSelect.add(MechAlarm_select_option);
            //option 2
            MechAlarm_select_option2.text = "Replace Breather Oil";
            MechAlarm_select_option2.value = "Replace Breather Oil";
            MechAlarmSelect.add(MechAlarm_select_option2);
            //option 3
            MechAlarm_select_option3.text = "Replace Fuse";
            MechAlarm_select_option3.value = "Replace Fuse";
            MechAlarmSelect.add(MechAlarm_select_option3);
            //option 4
            MechAlarm_select_option4.text = "Replace Temperature Sensor";
            MechAlarm_select_option4.value = "Replace Temperature Sensor";
            MechAlarmSelect.add(MechAlarm_select_option4);
            //option 5
            MechAlarm_select_option5.text = "Fans testing";
            MechAlarm_select_option5.value = "Fans testing";
            MechAlarmSelect.add(MechAlarm_select_option5);
            //option 6
            MechAlarm_select_option6.text = "Workshop";
            MechAlarm_select_option6.value = "Workshop";
            MechAlarmSelect.add(MechAlarm_select_option6);
            break;
        case "Inspection":
            //option 1
            MechAlarm_select_option.text = "Routine check - Silica Gel";
            MechAlarm_select_option.value = "Routine check - Silica Gel";
            MechAlarmSelect.add(MechAlarm_select_option);
            //option 2
            MechAlarm_select_option2.text = "Routine check - Fans";
            MechAlarm_select_option2.value = "Routine check - Fans";
            MechAlarmSelect.add(MechAlarm_select_option2);
            //option 3
            MechAlarm_select_option3.text = "External fans";
            MechAlarm_select_option3.value = "External fans";
            MechAlarmSelect.add(MechAlarm_select_option3);
            //option 4
            MechAlarm_select_option4.text =
                "Check MCB(Main - LT-Cooling Panel MCB)";
            MechAlarm_select_option4.value =
                "Check MCB(Main - LT-Cooling Panel MCB)";
            MechAlarmSelect.add(MechAlarm_select_option4);
            break;
    }
};
//check Work type for Chemestry
const checkBoxFunc = (check) => {
    chemistryAlarmSelect.innerText = null;

    let chemistryAlarm_select_option = document.createElement("option");
    let chemistryAlarm_select_option2 = document.createElement("option");
    let chemistryAlarm_select_option3 = document.createElement("option");
    let chemistryAlarm_select_option4 = document.createElement("option");
    switch (check) {
        case "Emergency":
            chemistryAlarm_select_option.text = "Oil Sampling";
            chemistryAlarm_select_option.value = "Oil Sampling";
            chemistryAlarmSelect.add(chemistryAlarm_select_option);
            break;
        case "Maintenance":
            chemistryAlarm_select_option.text = "Oil Filtering";
            chemistryAlarm_select_option.value = "Oil Filtering";
            chemistryAlarmSelect.add(chemistryAlarm_select_option);
            break;
        case "Inspection":
            //option 1
            chemistryAlarm_select_option.text =
                "Oil Sampling for Laboratory Routine Program";
            chemistryAlarm_select_option.value =
                "Oil Sampling for Laboratory Routine Program";
            //option 2
            chemistryAlarm_select_option2.text = `Transformers' Overall Condintions`;
            chemistryAlarm_select_option2.value = `Transformers' Overall Condintions`;
            //option 3
            chemistryAlarm_select_option3.text =
                "Oil sampling for newly arrived oil drums";
            chemistryAlarm_select_option3.value =
                "Oil sampling for newly arrived oil drums";
            //option 4
            chemistryAlarm_select_option4.text =
                "Testing and Suppling of Oil Drumbs Prior to Distribution";
            chemistryAlarm_select_option4.value =
                "Testing and Suppling of Oil Drumbs Prior to Distribution";
            //add option to the select
            chemistryAlarmSelect.add(chemistryAlarm_select_option);
            chemistryAlarmSelect.add(chemistryAlarm_select_option2);
            chemistryAlarmSelect.add(chemistryAlarm_select_option3);
            chemistryAlarmSelect.add(chemistryAlarm_select_option4);
            break;
    }
};
//check Work type for electrical
const checkBoxElectrical = (check) => {
    chemistryAlarmSelect.innerText = null;
    electricDuty.classList.add("d-none");
    electricProgram.classList.add("d-none");
    electricServicing.classList.add("d-none");
    electricPending.classList.add("d-none");
    switch (check) {
        case "Duty":
            electricDuty.classList.remove("d-none");
            break;
        case "program":
            electricProgram.classList.remove("d-none");

            break;
        case "Servicing":
            electricServicing.classList.remove("d-none");

            break;
        case "Pending":
            electricPending.classList.remove("d-none");

            break;
    }
};
//generate random number
let randomNumber = Math.floor(Math.random() * 900);
refNum.value += randomNumber + 1;

const controlColor = (value) => {
    let area_select_option = document.createElement("option");
    let area_select_option2 = document.createElement("option");
    let area_select_option3 = document.createElement("option");
    switch (value) {
        case "SHUAIBA CONTROL CENTER":
            controlName.classList.add(
                "form-control",
                "text-center",
                "bg-success",
                "text-light"
            );
            area_select_option.text = "المنطقة الجنوبية";
            area_select_option.value = 2;
            areaSelect.add(area_select_option);
            break;
        case "JABRIYA CONTROL CENTER":
            controlName.classList.add(
                "form-control",
                "text-center",
                "bg-info",
                "text-light"
            );
            area_select_option.text = "المنطقة  الوسطى";
            area_select_option.value = 3;
            areaSelect.add(area_select_option);
            break;
        case "JAHRA CONTROL CENTER":
            controlName.classList.add(
                "form-control",
                "text-center",
                "bg-warning",
                "text-light"
            );
            area_select_option.text = "المنطقة الشمالية";
            area_select_option.value = 1;
            areaSelect.add(area_select_option);
            break;
        case "TOWN CONTROL CENTER":
            controlName.classList.add(
                "form-control",
                "text-center",
                "bg-danger",
                "text-light"
            );
            area_select_option.text = "المنطقة  الوسطى";
            area_select_option.value = 3;
            areaSelect.add(area_select_option);
            break;
        case "NATIONAL CONTROL CENTER":
            controlName.classList.add(
                "form-control",
                "text-center",
                "bg-dark",
                "text-light"
            );
            area_select_option.text = "المنطقة الشمالية";
            area_select_option.value = 1;
            areaSelect.add(area_select_option);
            area_select_option3.text = "المنطقة  الوسطى";
            area_select_option3.value = 3;
            areaSelect.add(area_select_option3);
            area_select_option2.text = "المنطقة الجنوبية";
            area_select_option2.value = 2;
            areaSelect.add(area_select_option2);

            break;
        default:
            controlName.classList.add(
                "form-control",
                "text-center",
                "bg-dark",
                "text-danger"
            );
            controlName.value = " الرجاء تعديل اسم التحكم من جدول المحطات";
    } //switch end
};
//get Station
const getStation = async () => {
    let station_id = stationName.value;
    const response = await fetch("/Transformers/stations/" + station_id);
    if (response.status !== 200) {
        throw new Error("can not fetch the data");
    }
    const data = await response.json();
    console.log(data);
    staionFullName.classList.remove("d-none");
    controlName.classList.remove("d-none");
    staionFullName.value = data.fullName;
    make.value = data.COMPANY_MAKE;
    controlName.value = data.control;
    stationIdInput.value = data.id;
    controlName.removeAttribute("class");
    areaSelect.innerText = null;
    engineerSelect.innerText = null;
    //calling function
    controlColor(controlName.value);
    return areaSelect.value;
};
//get Admins
const getAdmins = async () => {
    let area = await getStation();
    let department = await checkDepartment();
    const response = await fetch("/Transformers/" + area + "/" + department);
    if (response.status !== 200) {
        throw new Error("can not fetch the data");
    }
    const data = await response.json();
    console.log(data);
    for (let i = 0; i < data.length; i++) {
        let engineerSelectValue = document.createElement("option");
        engineerSelectValue.value = data[i].id;
        engineerSelectValue.text = data[i].name;
        engineerSelect.appendChild(engineerSelectValue);
        engEmail.value = data[0].email;
    }
    return data;
};
//get Engineer's name
const getEngineer = async () => {
    area_id = await getStation();
    // shift_id = shiftSelect.value;
    shift_id = 1;
    let department = await checkDepartment();
    const response = await fetch(
        "/Transformers/getEngineer/" +
            area_id +
            "/" +
            department +
            "/" +
            shift_id
    );
    if (response.status !== 200) {
        throw new Error("can not fetch the data");
    }
    const data = await response.json();
    console.log(data);
    for (let i = 0; i < data.length; i++) {
        let engineerSelectValue = document.createElement("option");
        engineerSelectValue.value = data[i].id;
        engineerSelectValue.innerHTML = data[i].name;
        engineerSelect.appendChild(engineerSelectValue);
        engEmail.value = data[0].email;
        //console.log(data[i].id, data[i].name)
    }
    return data;
};
//get Engineer's email
const getEngineerEmail = async () => {
    let eng_id = engineerSelect.value;
    const response = await fetch("/Transformers/getAdminEmail/" + eng_id);
    if (response.status !== 200) {
        throw new Error("can not fetch the data");
    }
    const data = await response.json();
    console.log(data);
    engEmail.value = data.email;
};
//get Engineers on shift
const getEngineersShift = async () => {
    engineerSelect.innerText = null;
    engEmail.value = "";
    let shift_id = shiftSelect.value;
    let area_id = await getStation();
    const response = await fetch(
        "/getEngineersOnShift/" + area_id + "/" + shift_id
    );
    if (response.status !== 200) {
        throw new Error("can not fetch the data");
    }
    const data = await response.json();
    console.log(data);
    for (let i = 0; i < data.length; i++) {
        let engineerSelectValue = document.createElement("option");
        engineerSelectValue.value = data[i].id;
        engineerSelectValue.innerHTML = data[i].name;
        engineerSelect.appendChild(engineerSelectValue);
        engEmail.value = data[0].email;
        //console.log(data[i].id, data[i].name)
    }
    return data;
};
//to toggle files atthachmant

showAttachment.addEventListener("click", (e) => {
    e.preventDefault();
    hideAttachment.classList.toggle("d-none");
    showAttachment.classList.toggle("d-none");
    attachmentFile.classList.toggle("d-none");
});
hideAttachment.addEventListener("click", (e) => {
    e.preventDefault();
    hideAttachment.classList.toggle("d-none");
    showAttachment.classList.toggle("d-none");
    attachmentFile.classList.toggle("d-none");
});
controlColor(controlName.value);
