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
            area_select_option.text = "المنطقة الوسطى";
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
            area_select_option3.text = "المنطقة الوسطى";
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
    return areaSelect.value;
};
//get Station
const getStation = async () => {
    let station_id = stationName.value;
    const response = await fetch("/switchgear/stations/" + station_id);
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
//show Engineers
const showEngineers = async () => {
    area_id = controlColor(controlName.value);
    shift_id = shiftSelect.value;
    const response = await fetch(
        "/switchgear/getEngineer/" + area_id + "/" + shift_id
    );
    if (response.status !== 200) {
        throw new Error("can not fetch the data");
    }
    const data = await response.json();
    console.log(data);
    for (let i = 0; i < data.length; i++) {
        if (data[i].id != engineerSelect.value) {
            let engineerSelectValue = document.createElement("option");
            engineerSelectValue.value = data[i].id;
            engineerSelectValue.text = data[i].name;
            engineerSelect.appendChild(engineerSelectValue);
        }
    }
    return data;
};
showEngineers();
//get Engineer's name
const getEngineer = async () => {
    area_id = await getStation();
    shift_id = shiftSelect.value;
    const response = await fetch(
        "/switchgear/getEngineer/" + area_id + "/" + shift_id
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
    const response = await fetch("/switchgear/getEngineersEmail/" + eng_id);
    if (response.status !== 200) {
        throw new Error("can not fetch the data");
    }
    const data = await response.json();
    engEmail.value = data[0].email;
};
//get Engineers on shift
const getEngineersShift = async () => {
    // let area_id = await getStation();
    engineerSelect.innerHTML = "";
    engEmail.innerHTML = "";
    if (shiftSelect.value == 1) {
        const response = await fetch("/switchgear/getEngineersOnShift");
        if (response.status !== 200) {
            throw new Error("can not fetch the data");
        }
        const data = await response.json();
        for (let i = 0; i < data.length; i++) {
            let engineerSelectValue = document.createElement("option");
            engineerSelectValue.value = data[i].id;
            engineerSelectValue.innerHTML = data[i].name;
            engineerSelect.appendChild(engineerSelectValue);
            engEmail.value = data[0].email;
        }
    } else {
        area_id = controlColor(controlName.value);
        shift_id = 0;
        const response = await fetch(
            "/switchgear/getEngineer/" + area_id + "/" + shift_id
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
    }
};
//to color control based on area
controlColor(controlName.value);
