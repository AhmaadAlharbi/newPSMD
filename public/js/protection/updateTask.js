// ### PROTECTION JS FILE ###//
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
//generate random number

if (refNum === "") {
    let randomNumber = Math.floor(Math.random() * 900);
    refNum.value += randomNumber + 1;
}
const controlColor = (value) => {
    let area_select_option = document.createElement("option");
    let area_select_option2 = document.createElement("option");
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
            area_select_option.text = "المنطقة الجنوبية";
            area_select_option.value = 2;
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
            area_select_option.text = "المنطقة الشمالية";
            area_select_option.value = 1;
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
            area_select_option2.text = "المنطقة الجنوبية";
            area_select_option2.value = 2;
            areaSelect.add(area_select_option2);
            break;
    } //switch end
};
//get Station
const getStation = async () => {
    let station_id = stationName.value;
    const response = await fetch("/stations/" + station_id);
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
    return [areaSelect.value, stationIdInput.value];
};
//get Engineer's name
const getEngineer = async () => {
    const area_fromFunc = await getStation();
    area_id = area_fromFunc[0];
    shift_id = shiftSelect.value;
    const response = await fetch("/getEngineer/" + area_id + "/" + shift_id);
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
//show Engineers instead of a button to call a function
const showEngineers = async () => {
    const area_fromFunc = await getStation();
    area_id = area_fromFunc[0];
    shift_id = shiftSelect.value;
    const response = await fetch("/getEngineer/" + area_id + "/" + shift_id);
    if (response.status !== 200) {
        throw new Error("can not fetch the data");
    }
    const data = await response.json();
    console.log(data);
    for (let i = 0; i < data.length; i++) {
        let engineerSelectValue = document.createElement("option");

        if (data[i].id != engineerSelect.value) {
            engineerSelectValue.value = data[i].id;
            engineerSelectValue.innerHTML = data[i].name;
            engineerSelect.appendChild(engineerSelectValue);
            engEmail.value = data[0].email;
        }
    }
    return data;
};
showEngineers();
//get Engineer's email
const getEngineerEmail = async () => {
    let eng_id = engineerSelect.value;
    const response = await fetch("/getEngineersEmail/" + eng_id);
    if (response.status !== 200) {
        throw new Error("can not fetch the data");
    }
    const data = await response.json();
    engEmail.value = data[0].email;
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
//to color control based on area
controlColor(controlName.value);

const equipVoltage = document.getElementById("equipVoltage");
const equipName = document.querySelector("#equipName");
const equipNumber = document.querySelector("#equipNumber");
//to show equip of the station selected
const showEquip = async (station_id) => {
    let voltage_option = document.createElement("option");
    let equip_number_option = document.createElement("option");
    const response2 = await fetch("/protection/Equip/" + station_id);
    const data2 = await response2.json();
    let voltageArray = [];
    let EquipNumberArray = [];
    for (let i = 0; i < data2.length; i++) {
        voltage_option = document.createElement("option");
        equip_number_option = document.createElement("option");
        // console.log(data2)
        voltageArray.push(data2[i].voltage_level);
    }

    const voltageSet = new Set(voltageArray);
    const voltageUnique = [...voltageSet];
    for (let i = 0; i < voltageUnique.length; i++) {
        voltage_option = document.createElement("option");
        equip_number_option = document.createElement("option");
        // console.log(data2)

        if (voltageUnique[i] !== equipVoltage[0].text) {
            voltage_option.text = voltageUnique[i];
            equipVoltage.add(voltage_option);
        }
    }
};
const showEquipNumber = async (station_id) => {
    const response2 = await fetch(
        "/protection/EquipNumber/" + station_id + "/" + equipVoltage.value
    );
    if (response2.status !== 200) {
        throw new Error("can not fetch the data");
    }
    const data2 = await response2.json();
    // console.log(JSON.stringify(data2));

    for (let i = 0; i < data2.length; i++) {
        let equip_number_option = document.createElement("option");
        equip_number_option.text = data2[i].equip_number;
        equipNumber.add(equip_number_option);
        equipName.value = data2[0].equip_name;
    }
};
//call
showEquip(stationIdInput.value);
showEquipNumber(stationIdInput.value);
const getEquip = async () => {
    let voltage_option = document.createElement("option");
    let equip_number_option = document.createElement("option");
    equipVoltage.innerText = null;
    equipNumber.innerText = null;
    equipName.value = null;
    voltage_option.text = "-";
    equip_number_option.text = "-";
    equipVoltage.add(voltage_option);
    equipNumber.add(equip_number_option);
    //get area value from getStation
    const area_fromFunc = await getStation();
    let station_id = area_fromFunc[1];
    // let station_id =await getStation()
    const response2 = await fetch("/protection/Equip/" + station_id);
    const data2 = await response2.json();
    console.log(data2);
    let voltageArray = [];
    for (let i = 0; i < data2.length; i++) {
        voltage_option = document.createElement("option");
        equip_number_option = document.createElement("option");
        // console.log(data2)
        voltageArray.push(data2[i].voltage_level);
        // voltage_option.text = data2[i];
        equip_number_option.text = data2[i].eqiup_number;
        // equipVoltage.add(voltage_option)
        equipNumber.add(equip_number_option);
    }
    const voltageSet = new Set(voltageArray);
    const voltageUnique = [...voltageSet];
    equipVoltage.innerText = null;
    voltage_option.text = "-";
    equipVoltage.add(voltage_option);
    for (let i = 0; i < voltageUnique.length; i++) {
        voltage_option = document.createElement("option");
        equip_number_option = document.createElement("option");
        // console.log(data2)
        voltage_option.text = voltageUnique[i];
        equipVoltage.add(voltage_option);
        console.log(voltageArray);
        console.log(voltageSet);
        console.log(voltageUnique);
    }
};
const getEquipNumber = async () => {
    equipNumber.innerText = null;
    let station_id = stationIdInput.value;
    let voltage_level_select = equipVoltage.value;
    const response2 = await fetch(
        "/protection/EquipNumber/" + station_id + "/" + voltage_level_select
    );
    if (response2.status !== 200) {
        throw new Error("can not fetch the data");
    }
    const data2 = await response2.json();
    // console.log("eeeeee " + data2);
    console.log(JSON.stringify(data2));
    for (let i = 0; i < data2.length; i++) {
        let equip_number_option = document.createElement("option");
        equip_number_option.text = data2[i].equip_number;
        equipNumber.add(equip_number_option);
        equipName.value = data2[0].equip_name;
    }
};
const getEquipName = async () => {
    const response = await fetch(
        "/protection/Equipname/" + (await equipNumber.value)
    );
    if (response.status !== 200) {
        throw new Error("can not fetch the data");
    }
    const data = await response.json();
    equipName.value = data[0].equip_name;
};
