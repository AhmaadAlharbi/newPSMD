const engineerSelect = document.querySelector("#engineer");
const engEmail = document.getElementById("eng_name_email");
const engineer_id = document.getElementById("engineer_id");
//get engineers
const getEngineer = async () => {
    const response = await fetch("/general-chack/get-all-engineers");
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
    return data;
};
//get Engineer's email
const getEngineerEmail = async () => {
    let eng_id = engineerSelect.value;
    const response = await fetch("/general-chack/get-engineer-email/" + eng_id);
    if (response.status !== 200) {
        throw new Error("can not fetch the data");
    }
    const data = await response.json();
    engEmail.value = data[0].email;
    engineer_id.value = data[0].id;
};
// getEngineer();
