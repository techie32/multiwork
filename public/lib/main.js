
// Add active class to the current element


var zipCodeLS;
var devicePriceLS;
var serviceTypeLS;
var modelLS;
var warrentyLS;
var addOnLS;
var screenProtectorLS;
var cableChargerLS;
var deviceIssueLS;
var screenColorLS;
var nameLS;
var emailLS;
var phoneLS;
var addressLS;
var aptLS;
var deviceNameLS;

var finalObject = {
    zip_code: zipCodeLS,
    service_type: serviceTypeLS,
    device_name: deviceNameLS,
    total_price: devicePriceLS,
    model: modelLS,
    device_issue: deviceIssueLS,
    screen_color: screenColorLS,
    warrenty: warrentyLS,
    screen_protector: screenProtectorLS,
    charger_cable: cableChargerLS,
    name: nameLS,
    email: emailLS,
    phone: phoneLS,
    address: addressLS,
    unit_floor: aptLS,
    date: '27 Dec 2022',
    time: '5:26',
}

function updateObject() {
    zipCodeLS = localStorage.getItem('zip-code')
    devicePriceLS = localStorage.getItem('devicePrice')
    serviceTypeLS = localStorage.getItem('service-type')
    modelLS = localStorage.getItem('model')
    deviceIssueLS = JSON.parse(localStorage.getItem('device-issue'))
    screenColorLS = localStorage.getItem('screen-color')
    warrentyLS = localStorage.getItem('warrenty')
    screenProtectorLS = localStorage.getItem('screen-protector')
    cableChargerLS = localStorage.getItem('charger-cable')
    nameLS = localStorage.getItem('firstname') + " " + localStorage.getItem('lastname')
    emailLS = localStorage.getItem('email')
    phoneLS = localStorage.getItem('phone')
    addressLS = localStorage.getItem('address')
    aptLS = localStorage.getItem('unit_floor')
    deviceNameLS = localStorage.getItem('deviceName')
    // -----------------------------------
    // console.log('ZipCode: ', finalObject.zip_code);
    // console.log('service_type: ', finalObject.service_type);
    // console.log('total_price: ', finalObject.total_price);
    // console.log('model: ', finalObject.model);
    // console.log('deviceIssue: ', finalObject.device_issue);
    // console.log('Color: ', finalObject.screen_color);
    // console.log('Warrenty: ', finalObject.warrenty);
    // console.log('screen_protector: ', finalObject.screen_protector);
    // console.log('charger_cable: ', finalObject.charger_cable);
    // console.log('name: ', finalObject.name);
    // console.log('email: ', finalObject.email);
    // console.log('phone: ', finalObject.phone);
    // console.log('address: ', finalObject.address);
    // console.log('unit_floor: ', finalObject.unit_floor);
    // console.log('device_name: ', finalObject.device_name);

    // ------------------ 

}


const baseUrl = 'http://192.168.0.104:8000/api'

function postCompleteData() {
    delete finalObject.device_issue
    delete finalObject.device_name
    var device_issue_name = deviceIssueLS.issue
    var device_issue_discription = deviceIssueLS.discription
    obj = { ...finalObject, device_issue_name, device_issue_discription };
    console.log("object", obj);

    // post objectData to api
    fetch(`${baseUrl}/booking`, {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(obj)
    }).then(res => {
        console.log("Request complete! response:", res);
    }).catch(err =>
        console.log("error", err));
}


// Important Rendering Function
function deviceDetail() {
    var DeviceName = localStorage.getItem('deviceName')
    finalObject.total_price = localStorage.getItem('devicePrice')

    $(document).ready(function () {
        [].forEach.call(document.querySelectorAll("#devicename-id4, #devicename-id5, #devicename-id6,#devicename-id7,#devicename-id8,#devicename-id9"), function (el) {
            el.innerHTML = DeviceName;
        });
        [].forEach.call(document.querySelectorAll("#deviceprice-id4, #deviceprice-id5, #deviceprice-id6,#deviceprice-id7,#deviceprice-id8,#deviceprice-id9"), function (el) {
            el.innerHTML = finalObject.total_price;
        });
    });

}

function removeActiveClasses() {
    $(document).ready(function () {
        [].forEach.call(document.querySelectorAll("#device-issue-1, #device-issue-2, device-issue-3"), function (el) {
            el.classList.remove('active')
        });
        [].forEach.call(document.querySelectorAll("#modal5card-id1, #modal5card-id2"), function (el) {
            el.classList.remove('active-5')
        });
        [].forEach.call(document.querySelectorAll("#modal6card-id1, #modal6card-id2, #modal7card-id1, #modal7card-id2"), function (el) {
            el.classList.remove('active-6')
        });
    });
    document.getElementById('device-issue').classList.add('disabled')
}


// -------------------------------- Modal-1 ------------------------------------- //

const require_zip_codes = [32810, 32808, 32714, 32804, 32710, 32818, 32751, 32799, 32789, 32794, 32733, 32716, 32715, 32701, 32793, 32790, 32703, 32730]

var zip_btn_id = document.getElementById('zip-btn')

function onInputZipCode() {
    if (document.getElementById('zip_code').value) {
        zip_btn_id.classList.remove('disabled')
    } else if (document.getElementById('zip_code').value == '') {
        zip_btn_id.classList.add('disabled')
    }
}

function onChangeZipCode() {
    require_zip_codes.find((zipval, i) => {
        if (zipval == document.getElementById('zip_code').value) {
            zip_btn_id.dataset.bsToggle = 'modal'
            zip_btn_id.dataset.bsTarget = '#secondModal'
            return 'second'
        } else {
            zip_btn_id.dataset.bsToggle = 'modal'
            zip_btn_id.dataset.bsTarget = '#zipModal'
        }
    })
}

function onClickZipCode() {
    finalObject.zip_code = document.getElementById('zip_code').value
    localStorage.setItem('zip-code', finalObject.zip_code)
}

let extraCharge = false
let extraAmmount = 15
function addAmmountForUnmatchZip() {
    finalObject.total_price = extraAmmount
    localStorage.setItem('devicePrice', Number(finalObject.total_price))
    extraCharge = true
}

// -------------------------------- Modal-1 ------------------------------------- //

// -------------------------------- Modal-2 ------------------------------------- //

var pop2Id = document.getElementById("modal2body-id");
var childpop2 = pop2Id.getElementsByClassName("card-devices");
for (var i = 0; i < childpop2.length; i++) {
    childpop2[i].addEventListener("click", function () {
        var currentElemPop2 = document.getElementsByClassName("active-2");
        if (currentElemPop2.length > 0) {
            currentElemPop2[0].className = currentElemPop2[0].className.replace(" active-2", "");
        }
        this.className += " active-2";

        // Service Type Work
        if (this.id == "modal2card-id1") {
            finalObject.service_type = "Iphone Repair"
            localStorage.setItem('service-type', finalObject.service_type)
            // Update Back Button for modal-8 to 7 condition
            var x = document.getElementById('modal8backBtn-id')
            x.dataset.bsTarget = '#sevenModal'
            // Pricing modal display flex
            var price_div = document.querySelectorAll('.hide-price-div')
            for (let i = 0; i < price_div.length; i++) {
                price_div[i].style.display = "flex";
            }
            // update Calender
            var element = document.getElementById("show-time-id");
            element.classList.add("hide-cal-time-class");
            btn9_id.classList.add("disabled");
            Date_2_to_8()
            updateCalender()
        } else if (this.id == "modal2card-id2") {
            finalObject.service_type = "Ipad Repair"
            localStorage.setItem('service-type', finalObject.service_type)
            // Update Back Button for modal-8 to 7 condition
            var x = document.getElementById('modal8backBtn-id')
            x.dataset.bsTarget = '#secondModal'
            // Pricing modal display none
            var price_div = document.querySelectorAll('.hide-price-div')
            for (let i = 0; i < price_div.length; i++) {
                price_div[i].style.display = "none";
            }
            // update Calender
            var element = document.getElementById("show-time-id");
            element.classList.add("hide-cal-time-class");
            btn9_id.classList.add("disabled");
            Date_2_to_8()
            updateCalender()
        }
    });
}

// -------------------------------- Modal-2 ------------------------------------- //

// -------------------------------- Modal-3 ------------------------------------- //

var device_container_id = document.getElementById('device-container-id');
var devicePriceShow;
let loader = true;
const callDeviceApi = async () => {
    if (loader) {
        loader = false
        device_container_id.innerHTML = ` 
        <div class="d-flex justify-content-center pt-2 pb-5">
            <div class="loader"></div>
        </div>`
    }
    const response = await fetch(`${baseUrl}/mobileinfo`);
    var devices = await response.json();

    const showDevices = devices.map((device, i) => {
        return `
    <div class="col-md-6 col-sm-6 col-10 mx-auto">
    <div
      class="card mb-3 card-devices"
      style="
        border-radius: 16px;
        box-shadow: 4px 4px 23px rgba(0, 0, 0, 0.25);
      "
      data-bs-target="#fourthModal"
      data-bs-toggle="modal"
      data-modelid=${device.id}
      data-name='${device.mobile_name} ${device.model}'
    >
      <div class="row g-0">
        <div
          class="card-body d-flex flex-column justify-content-around align-items-center gap-3" data-detail=${device.price}
          id="get-price-id"
        >
          <img
            src="data:image/jpeg;base64,${device.image}"
            class="img-fluid"
            alt="Iphone Pic"
            style="
              width: 160px;
              height: 100px;
              border-radius: 10px;
            "
          />
          <h5
            class="card-text fw-400"
            style="font-size: 19px; padding-bottom: 8px"
            id="devices-card-id"
          >
           ${device.mobile_name} ${device.model}
          </h5>
        </div>
      </div>
    </div>
  </div>
`
    })
    device_container_id.innerHTML = showDevices.join('')

    var childpop3 = device_container_id.getElementsByClassName("card-devices");
    for (var i = 0; i < childpop3.length; i++) {
        childpop3[i].addEventListener("click", function () {
            var currentElem3 = document.getElementsByClassName("active-3");
            if (currentElem3.length > 0) {
                currentElem3[0].className = currentElem3[0].className.replace(" active-3", "");

            }
            this.className += " active-3";

            // Removing class After re-select of device
            removeActiveClasses()

            // Device_model_id
            finalObject.model = this.dataset.modelid
            localStorage.setItem('model', finalObject.model)

            // Device_name
            // finalObject.device_name = this.lastElementChild.lastElementChild.lastElementChild.innerHTML
            finalObject.device_name = this.dataset.name
            localStorage.setItem('deviceName', finalObject.device_name)
            updateObject()

            // Device_price
            devicePriceShow = this.firstElementChild.firstElementChild.dataset.detail
            // localStorage.setItem('devicePrice', Number(devicePriceShow))
            if (extraCharge) {
                finalObject.total_price += Number(devicePriceShow)
                localStorage.setItem('devicePrice', Number(finalObject.total_price).toFixed(2))
            } else {
                localStorage.setItem('devicePrice', Number(devicePriceShow))
            }

            // Show DeviceName and total_price in Every Modal
            deviceDetail()

            // changing next modal Pricing bsTarget data id
            var x = document.getElementById('pri-btn-id')
            x.dataset.bsTarget = '#fourthModal'
        });
    }
}

// -------------------------------- Modal-4 ------------------------------------- //

const screen_replace_prices = [
    { device_name: 'iPhone 6', replace_price: 89.99 },
    { device_name: 'iPhone 6 Plus', replace_price: 89.99 },
    { device_name: 'iPhone 6S', replace_price: 89.99 },
    { device_name: 'iPhone 6S Plus', replace_price: 89.99 },
    { device_name: 'iPhone 7', replace_price: 89.99 },
    { device_name: 'iPhone 7 Plus', replace_price: 89.99 },
    { device_name: 'iPhone 8', replace_price: 89.99 },
    { device_name: 'iPhone X', replace_price: 99.99 },
    { device_name: 'iPhone XR', replace_price: 99.99 },
    { device_name: 'iPhone XS', replace_price: 99.99 },
    { device_name: 'iPhone XS Max', replace_price: 99.99 },
    { device_name: 'iPhone 11', replace_price: 99.99 },
    { device_name: 'iPhone 11 Pro', replace_price: 119.99 },
    { device_name: 'iPhone 11 Pro Max', replace_price: 139.99 },
    { device_name: 'iPhone 12', replace_price: 199.99 },
    { device_name: 'iPhone 12 Pro', replace_price: 199.99 },
]

const battery_replace_prices = [
    { device_name: 'iPhone 6', replace_price: 59.99 },
    { device_name: 'iPhone 6 Plus', replace_price: 59.99 },
    { device_name: 'iPhone 6S', replace_price: 59.99 },
    { device_name: 'iPhone 6S Plus', replace_price: 59.99 },
    { device_name: 'iPhone 7', replace_price: 59.99 },
    { device_name: 'iPhone 7 Plus', replace_price: 59.99 },
    { device_name: 'iPhone 8', replace_price: 59.99 },
    { device_name: 'iPhone 8 Plus', replace_price: 59.99 },
    { device_name: 'iPhone 11 Pro', replace_price: 59.99 },
    { device_name: 'iPhone 12 Pro', replace_price: 99.99 }
]

var text;
var device_issue;
var pri_modal_device_issue;
var pop4Id = document.getElementById("accordion-2");
var childpop4 = pop4Id.getElementsByClassName("card-devices");
for (var i = 0; i < childpop4.length; i++) {
    childpop4[i].addEventListener("click", function () {
        var currentElem = document.getElementsByClassName("active");
        if (currentElem.length > 0) {
            currentElem[0].className = currentElem[0].className.replace(" active", "");

        } else {
            var currentBtn = document.getElementsByClassName("disabled");
            currentBtn[0].className = currentBtn[0].className.replace(" disabled", "");
        }
        this.className += " active";

        if (this.dataset.issue == "Screen Replacement") {
            // Screen_Replacement
            screen_replace_prices.filter((spVal, i) => {
                if (spVal.device_name.toLowerCase() === finalObject.device_name.toLowerCase()) {
                    device_issue = {
                        issue: this.dataset.issue,
                        price: spVal.replace_price,
                        discription: "discription"
                    }
                    finalObject.device_issue = JSON.stringify(device_issue)
                    localStorage.setItem('device-issue', finalObject.device_issue)
                    // extraChargeCondition
                    if (extraCharge) {
                        // pricing
                        if (device_issue.price != devicePriceShow) {
                            finalObject.total_price = Number(devicePriceShow) + device_issue.price + extraAmmount
                            localStorage.setItem('devicePrice', Number(finalObject.total_price).toFixed(2))
                            // deviceDetail()
                        } else {
                            finalObject.total_price = Number(finalObject.total_price) + device_issue.price + extraAmmount
                            localStorage.setItem('devicePrice', Number(finalObject.total_price).toFixed(2))
                            // deviceDetail()
                        }
                    } else {
                        if (device_issue.price != devicePriceShow) {
                            finalObject.total_price = Number(devicePriceShow) + device_issue.price
                            localStorage.setItem('devicePrice', Number(finalObject.total_price).toFixed(2))
                            // deviceDetail()
                        } else {
                            finalObject.total_price = Number(finalObject.total_price) + device_issue.price
                            localStorage.setItem('devicePrice', Number(finalObject.total_price).toFixed(2))
                            // deviceDetail()
                        }
                    }
                    deviceDetail()
                }
            })
            pri_modal_device_issue = "Screen Replacement"
        } else if (this.dataset.issue == "Battery Replacement") {
            // Battery_Replacement
            battery_replace_prices.filter((bpVal, i) => {
                if (bpVal.device_name.toLowerCase() === finalObject.device_name.toLowerCase()) {
                    device_issue = {
                        issue: this.dataset.issue,
                        price: bpVal.replace_price,
                        discription: "discription"
                    }
                    finalObject.device_issue = JSON.stringify(device_issue)
                    localStorage.setItem('device-issue', finalObject.device_issue)
                    // extraChargeCondition
                    if (extraCharge) {
                        // pricing
                        if (device_issue.price != devicePriceShow) {
                            finalObject.total_price = Number(devicePriceShow) + device_issue.price + extraAmmount
                            localStorage.setItem('devicePrice', Number(finalObject.total_price).toFixed(2))
                            // deviceDetail()
                        } else {
                            finalObject.total_price = Number(finalObject.total_price) + device_issue.price + extraAmmount
                            localStorage.setItem('devicePrice', Number(finalObject.total_price).toFixed(2))
                            // deviceDetail()
                        }
                    } else {
                        if (device_issue.price != devicePriceShow) {
                            finalObject.total_price = Number(devicePriceShow) + device_issue.price
                            localStorage.setItem('devicePrice', Number(finalObject.total_price).toFixed(2))
                            // deviceDetail()
                        } else {
                            finalObject.total_price = Number(finalObject.total_price) + device_issue.price
                            localStorage.setItem('devicePrice', Number(finalObject.total_price).toFixed(2))
                            // deviceDetail()
                        }
                    }
                    deviceDetail()
                }
            })
            pri_modal_device_issue = "Battery Replacement"
        } else {
            // SomeThingElse
            device_issue = {
                issue: this.dataset.issue,
                price: 0,
                discription: "discription"
            }
            finalObject.device_issue = JSON.stringify(device_issue)
            localStorage.setItem('device-issue', finalObject.device_issue)
            // pricing
            if (extraCharge) {
                finalObject.total_price = Number(devicePriceShow) + device_issue.price + extraAmmount
                localStorage.setItem('devicePrice', finalObject.total_price)
                // deviceDetail()
            } else {
                finalObject.total_price = Number(devicePriceShow) + device_issue.price
                localStorage.setItem('devicePrice', finalObject.total_price)
                // deviceDetail()
            }
            deviceDetail()
            pri_modal_device_issue = ""
        }
    });
}

function onClickModal4Btn() {
    updateObject()
    text = JSON.parse(finalObject.device_issue)
    if (text.issue == 'Screen Replacement') {
        text.discription = document.getElementById('issueText-1').value
        device_issue = {
            issue: text.issue,
            price: text.price,
            discription: text.discription
        }
        finalObject.device_issue = JSON.stringify(device_issue)
        localStorage.setItem('device-issue', finalObject.device_issue)
    } else if (text.issue == 'Battery Replacement') {
        text.discription = document.getElementById('issueText-2').value
        device_issue = {
            issue: text.issue,
            price: text.price,
            discription: text.discription
        }
        finalObject.device_issue = JSON.stringify(device_issue)
        localStorage.setItem('device-issue', finalObject.device_issue)
    } else {
        text.discription = document.getElementById('issueText-3').value
        device_issue = {
            issue: text.issue,
            price: text.price,
            discription: text.discription
        }
        finalObject.device_issue = JSON.stringify(device_issue)
        localStorage.setItem('device-issue', finalObject.device_issue)
    }

    // changing next modal Pricing bsTarget data id
    var x = document.getElementById('pri-btn-id')
    x.dataset.bsTarget = '#fifthModal'
}

// -------------------------------- Modal-4 ------------------------------------- //

// -------------------------------- Modal-5 ------------------------------------- //

var pop5Id = document.getElementById("popup-5");
var childpop5 = pop5Id.getElementsByClassName("card-devices");
for (var i = 0; i < childpop5.length; i++) {
    childpop5[i].addEventListener("click", function () {
        var currentElemPop5 = document.getElementsByClassName("active-5");
        if (currentElemPop5.length > 0) {
            currentElemPop5[0].className = currentElemPop5[0].className.replace(" active-5", "");
        }
        this.className += " active-5";

        // Screen Color Work
        if (this.id == "modal5card-id1") {
            finalObject.screen_color = "White Screen"
            localStorage.setItem('screen-color', finalObject.screen_color)

            // changing next modal Pricing bsTarget data id
            var x = document.getElementById('pri-btn-id')
            x.dataset.bsTarget = '#sixthModal'

        } else if (this.id == "modal5card-id2") {
            finalObject.screen_color = "Black Screen"
            localStorage.setItem('screen-color', finalObject.screen_color)

            // changing next modal Pricing bsTarget data id
            var x = document.getElementById('pri-btn-id')
            x.dataset.bsTarget = '#sixthModal'
        }
    });
}

// -------------------------------- Modal-5 ------------------------------------- //

//----------------------------- Modal-6  COMPLETE -----------------------------------//

var pop6Id = document.getElementById("popup-6");
var childpop6 = pop6Id.getElementsByClassName("card-devices");
for (var i = 0; i < childpop6.length; i++) {
    childpop6[i].addEventListener("click", function () {
        var btn6_id = document.getElementById("id-modal-6-btn");
        btn6_id.classList.remove("disabled");

        var currentElem6 = document.getElementsByClassName("active-6");
        if (currentElem6.length > 0) {
            currentElem6[0].className = currentElem6[0].className.replace(" active-6", "");
        }
        this.className += " active-6";

        // Warrenty Work
        if (this.id == "modal6card-id1") {
            finalObject.warrenty = "yes"
            localStorage.setItem('warrenty', finalObject.warrenty)
        } else if (this.id == "modal6card-id2") {
            finalObject.warrenty = "no"
            localStorage.setItem('warrenty', finalObject.warrenty)
        }
    });
}


function onClickModal6Btn() {
    // changing next modal Pricing bsTarget data id
    var x = document.getElementById('pri-btn-id')
    x.dataset.bsTarget = '#sevenModal'
}

//----------------------------- Modal-6  COMPLETE -----------------------------------//

//----------------------------- Modal-7 -----------------------------------//

finalObject.screen_protector = "no"
finalObject.charger_cable = "no"
let screen_protector_price = 10
let charger_cable_price = 10

var pop7Id = document.getElementById("popup-7");
var childpop7 = pop7Id.getElementsByClassName("card-devices");
for (var i = 0; i < childpop7.length; i++) {
    childpop7[i].addEventListener("click", function () {
        if (this.className == "card mb-3 card-devices") {
            this.className += " active-6";
            updateObject()
        } else if (this.className == "card mb-3 card-devices active-6") {
            this.className = "card mb-3 card-devices"
            updateObject()
        }
    });
}

function onClickScreenProtector() {
    if (finalObject.screen_protector == "no") {
        finalObject.screen_protector = "yes"
        localStorage.setItem('screen-protector', finalObject.screen_protector)
        // pricing
        finalObject.total_price = Number(finalObject.total_price) + screen_protector_price
        localStorage.setItem('devicePrice', Number(finalObject.total_price).toFixed(2))
        deviceDetail()
    } else if (finalObject.screen_protector == "yes") {
        finalObject.screen_protector = "no"
        localStorage.setItem('screen-protector', finalObject.screen_protector)
        // pricing
        finalObject.total_price = Number(finalObject.total_price) - screen_protector_price
        localStorage.setItem('devicePrice', Number(finalObject.total_price).toFixed(2))
        deviceDetail()
    }
}

function onClickChargerCable() {
    if (finalObject.charger_cable == "no") {
        finalObject.charger_cable = "yes"
        localStorage.setItem('charger-cable', finalObject.charger_cable)
        // pricing
        finalObject.total_price = Number(finalObject.total_price) + charger_cable_price
        localStorage.setItem('devicePrice', Number(finalObject.total_price).toFixed(2))
        deviceDetail()
    } else if (finalObject.charger_cable == "yes") {
        finalObject.charger_cable = "no"
        localStorage.setItem('charger-cable', finalObject.charger_cable)
        // pricing
        finalObject.total_price = Number(finalObject.total_price) - charger_cable_price
        localStorage.setItem('devicePrice', Number(finalObject.total_price).toFixed(2))
        deviceDetail()
    }
}

function onClickModal7Btn() {
    // changing next modal Pricing bsTarget data id
    var x = document.getElementById('pri-btn-id')
    x.dataset.bsTarget = '#eightModal'
}

//----------------------------- Modal-7 -----------------------------------//


// --------------------------------- Calender Work Start ------------------------------------- //

function Date_2_to_8() {
    calenderList = [
        { day: "MO", date: "2", slots: ['1:00 PM', '1:00 PM', '1:00 PM', '1:00 PM', '1:00 PM', '8:00 PM', '9:00 PM'] },
        { day: "TU", date: "3", slots: ['2:00 PM', '2:00 PM', '2:00 PM', '2:00 PM', '2:00 PM', '2:00 PM', '2:00 PM', '8:00 PM', '9:00 PM'] },
        { day: "We", date: "4", slots: ['3:00 PM', '3:00 PM', '3:00 PM', '3:00 PM', '3:00 PM', '3:00 PM', '3:00 PM', '3:00 PM', '9:00 PM'] },
        { day: "TH", date: "5", slots: ['4:00 PM', '4:00 PM', '4:00 PM', '4:00 PM', '4:00 PM', '4:00 PM', '4:00 PM', '8:00 PM', '9:00 PM'] },
        { day: "FR", date: "6", slots: ['5:00 PM', '5:00 PM', '5:00 PM', '5:00 PM', '5:00 PM', '5:00 PM', '5:00 PM', '8:00 PM', '9:00 PM'] },
        { day: "SA", date: "7", slots: ['6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '8:00 PM', '9:00 PM'] },
        { day: "SU", date: "8", slots: ['7:00 PM', '7:00 PM', '7:00 PM', '7:00 PM', '7:00 PM', '7:00 PM', '7:00 PM', '8:00 PM', '9:00 PM'] },
    ];
}

function Date_9_to_16() {
    calenderList = [
        { day: "MO", date: "9", slots: ['1:00 PM', '1:00 PM', '1:00 PM', '1:00 PM', '1:00 PM', '8:00 PM', '9:00 PM'] },
        { day: "TU", date: "10", slots: ['2:00 PM', '2:00 PM', '2:00 PM', '2:00 PM', '2:00 PM', '2:00 PM', '2:00 PM', '8:00 PM', '9:00 PM'] },
        { day: "We", date: "12", slots: ['3:00 PM', '3:00 PM', '3:00 PM', '3:00 PM', '3:00 PM', '9:00 PM'] },
        { day: "TH", date: "13", slots: ['4:00 PM', '4:00 PM', '4:00 PM', '4:00 PM', '4:00 PM', '4:00 PM', '4:00 PM', '8:00 PM', '9:00 PM'] },
        { day: "FR", date: "14", slots: ['5:00 PM', '5:00 PM', '5:00 PM', '5:00 PM', '5:00 PM', '5:00 PM', '5:00 PM', '8:00 PM', '9:00 PM'] },
        { day: "SA", date: "15", slots: ['6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '8:00 PM', '9:00 PM'] },
        { day: "SU", date: "16", slots: ['7:00 PM', '7:00 PM', '7:00 PM', '7:00 PM', '7:00 PM', '7:00 PM', '7:00 PM', '8:00 PM', '9:00 PM'] },
    ]
    updateCalender()
}

function Date_17_to_23() {
    calenderList = [
        { day: "MO", date: "17", slots: ['1:00 PM', '1:00 PM', '1:00 PM', '1:00 PM', '1:00 PM', '8:00 PM', '9:00 PM'] },
        { day: "TU", date: "18", slots: ['2:00 PM', '2:00 PM', '2:00 PM', '2:00 PM', '2:00 PM', '2:00 PM', '2:00 PM', '8:00 PM', '9:00 PM'] },
        { day: "We", date: "19", slots: ['3:00 PM', '3:00 PM', '3:00 PM', '3:00 PM', '3:00 PM', '9:00 PM'] },
        { day: "TH", date: "20", slots: ['4:00 PM', '4:00 PM', '4:00 PM', '4:00 PM', '4:00 PM', '4:00 PM', '4:00 PM', '8:00 PM', '9:00 PM'] },
        { day: "FR", date: "21", slots: ['5:00 PM', '5:00 PM', '5:00 PM', '5:00 PM', '5:00 PM', '5:00 PM', '5:00 PM', '8:00 PM', '9:00 PM'] },
        { day: "SA", date: "22", slots: ['6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '8:00 PM', '9:00 PM'] },
        { day: "SU", date: "23", slots: ['7:00 PM', '7:00 PM', '7:00 PM', '7:00 PM', '7:00 PM', '7:00 PM', '7:00 PM', '8:00 PM', '9:00 PM'] },
    ]
    updateCalender()
}

var calenderList = []
var output;
var showInHTMl;
var countNextDate = 0
var btn9_id = document.getElementById("id-modal-9-btn");

const onClickNextButton = () => {
    // show div time 
    var element = document.getElementById("show-time-id");
    element.classList.add("hide-cal-time-class");
    btn9_id.classList.add("disabled");
    // Condition for different dates
    if (countNextDate === 0) {
        Date_9_to_16()
        countNextDate = 1
    } else if (countNextDate === 1) {
        Date_17_to_23()
        countNextDate = 2
    }
}

const onClickPrevButton = () => {
    // show div time 
    var element = document.getElementById("show-time-id");
    element.classList.add("hide-cal-time-class");
    btn9_id.classList.add("disabled");
    // Condition for different dates
    if (countNextDate === 1) {
        Date_2_to_8()
        updateCalender()
        countNextDate = 0
    } else if (countNextDate === 2) {
        Date_9_to_16()
        countNextDate = 1
    } else if (countNextDate === 0) {
        Date_2_to_8()
        updateCalender()
    }
}

// Original
Date_2_to_8()
updateCalender()

// Modal-8
function updateCalender() {
    output = document.getElementById('Calender');

    showInHTMl = calenderList.map((list, i) => {
        return `
            <div key=${i} class="week-css" >
                <p>${list.day}</p>
                <p>${list.date}</p>
            </div>
`
    })
    output.innerHTML = showInHTMl.join('')
    var pop8Id = document.getElementById("Calender");
    var childpop8 = pop8Id.getElementsByClassName("week-css");
    for (var i = 0; i < childpop8.length; i++) {
        childpop8[i].addEventListener("click", function () {
            var currentElemPop8 = document.getElementsByClassName("active-day");
            if (currentElemPop8.length > 0) {
                currentElemPop8[0].className = currentElemPop8[0].className.replace(" active-day", "");
                btn9_id.classList.add("disabled");
            }
            this.className += " active-day";

            // Show Different time of each object
            const ss = calenderList.find((list) => list.day === currentElemPop8[0].firstElementChild.innerHTML)
            console.log(currentElemPop8[0].firstElementChild.innerHTML);
            const outputTime = document.getElementById('time-loop-id');
            const dd = ss.slots.map(time => {
                return `
                <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                    <p class="slot-css">${time}</p>
                </div>
                `
            })
            outputTime.innerHTML = dd.join('')

            // show div time 
            var element = document.getElementById("show-time-id");
            element.classList.remove("hide-cal-time-class");

            // Active Any Showed Time 
            var timeActiveId = document.getElementById("time-loop-id");
            var timeActiveClass = timeActiveId.getElementsByClassName("slot-css");
            for (var i = 0; i < timeActiveClass.length; i++) {
                timeActiveClass[i].addEventListener("click", function () {
                    var current = document.getElementsByClassName("active-time");
                    if (current.length > 0) {
                        current[0].className = current[0].className.replace(" active-time", "");

                    }
                    this.className += " active-time";

                    btn9_id.classList.remove("disabled");
                });
            }
        });
    }
}

function onClickModal8Btn() {
    // changing next modal Pricing bsTarget data id
    var x = document.getElementById('pri-btn-id')
    x.dataset.bsTarget = '#nineModal'
}

// ----------------------------- Calender End -----------------------------------------//


/**
 * Battery replacement: [{deviceId:, price}]
 * Screen replacement: [{deviceId:, price}]
 */


// ----------------------------- Modal-9 -----------------------------------------//

function removeDisableBtnModal9() {
    if (document.getElementById('address').value) {
        document.getElementById('modal-9-btn').classList.remove('disabled')
    } else {
        document.getElementById('modal-9-btn').classList.add('disabled')
    }
}

function formSubmit() {
    finalObject.name = document.getElementById('firstname').value + " " + document.getElementById('lastname').value
    finalObject.email = document.getElementById('email').value
    finalObject.phone = document.getElementById('phone').value
    finalObject.address = document.getElementById('address').value
    finalObject.unit_floor = document.getElementById('apt').value
    localStorage.setItem('name', finalObject.name)
    localStorage.setItem('email', finalObject.email)
    localStorage.setItem('phone', finalObject.phone)
    localStorage.setItem('address', finalObject.address)
    localStorage.setItem('unit_floor', finalObject.unit_floor)
    updateObject()
    postCompleteData()
}

// ----------------------------- Modal-9 -----------------------------------------//

// ----------------------------- Redeem  Coupon --------------------------------- //

let count = 0

var y = document.getElementById('redeem-btn-id')

function onClickDismissRedeem() {
    y.dataset.bsToggle = 'modal'
    y.dataset.bsTarget = '#nineModal'
    var jj = document.getElementById('redeem-close-btn')
    jj.click()
    y.dataset.bsToggle = ''
    y.dataset.bsTarget = ''
}

const checkCoupon = async () => {
    if (count == 0) {
        const response = await fetch(`${baseUrl}/couponcode`);
        var coupons = await response.json();
        let coupon_input = document.getElementById('coupon-text').value
        coupons.find((val, i) => {
            if (coupon_input == val.coupon_code) {
                finalObject.total_price = finalObject.total_price - val.amount
                localStorage.setItem('devicePrice', Number(finalObject.total_price).toFixed(2))
                updateObject()
                deviceDetail()
                count = 1
                onClickDismissRedeem()
                document.getElementById('coupon-id').classList.remove('coupon-reject')
                document.getElementById('coupon-id').classList.add('coupon-accept')
                document.getElementById('coupon-result').innerHTML = "coupon code use only onse <br> coupon matched"
                return 'coupon succeed'
            } else {
                document.getElementById('coupon-id').classList.remove('coupon-accept')
                document.getElementById('coupon-id').classList.add('coupon-reject')
                document.getElementById('coupon-result').innerHTML = "Coupon doesn't Match"
                // return 
            }
        })
    }
}


// ----------------------------- Redeem  Coupon --------------------------------- //


// ----------------------------- Modal-pricing -----------------------------------------//

var devIssue;
function callPricingModal() {
    updateObject()
    var device_name = localStorage.getItem('deviceName')
    // var screen_color = localStorage.getItem('screen-color')
    var estimatePrice = localStorage.getItem('devicePrice')
    // devIssue = JSON.parse(finalObject.device_issue)
    document.getElementById('pricing-body-id').innerHTML = `
    <div>
        <h3>${device_name ? device_name : ""}</h3>
        <div>
            <div class="d-flex justify-content-between">
                <p>${extraCharge ? "Extra Service Charge" : ""}</p>
                <p class="fw-semibold fs-6" style="color:#7AA237">${extraCharge ? "$" + extraAmmount : ""}</p>
            </div>
            <p>${finalObject.device_issue ? pri_modal_device_issue : ""}</p>
            <p>${finalObject.screen_color ? finalObject.screen_color : ""}</p>
            <p>${finalObject.warrenty == "yes" ? "Add Warranty Protection" : ""}</p>
            <p>${finalObject.warrenty == "no" ? "Decline Warranty Protection" : ""}</p>
            <p>${finalObject.screen_protector == "yes" ? "Tempered Glass Screen Protector - $10" : ""}</p>
            <p>${finalObject.charger_cable == "yes" ? "iPhone Lighting USB Charger Cable - $10" : ""}</p>
        </div>
        <div class="pricing-para-estimate">
            <p>Estimate</p>
            <div class="d-flex fw-semibold fs-6" style="color:#7AA237">
                $
                <p>${estimatePrice}</p>
            </div>
        </div>
    </div>
        `
}

const onClickModal5backBtn = () => {
    // changing next modal Pricing bsTarget data id
    var x = document.getElementById('pri-btn-id')
    x.dataset.bsTarget = '#fourthModal'
}

const onClickModal6backBtn = () => {
    // changing next modal Pricing bsTarget data id
    var x = document.getElementById('pri-btn-id')
    x.dataset.bsTarget = '#fifthModal'
}

const onClickModal7backBtn = () => {
    // changing next modal Pricing bsTarget data id
    var x = document.getElementById('pri-btn-id')
    x.dataset.bsTarget = '#sixthModal'
    // remove active classes
    $(document).ready(function () {
        [].forEach.call(document.querySelectorAll("#modal7card-id1, #modal7card-id2"), function (el) {
            el.classList.remove('active-6')
        });
    });
    finalObject.screen_protector = "no"
    localStorage.setItem('screen-protector', finalObject.screen_protector)
    finalObject.charger_cable = "no"
    localStorage.setItem('charger-cable', finalObject.charger_cable)
}

const onClickModal8backBtn = () => {
    // changing next modal Pricing bsTarget data id
    var x = document.getElementById('pri-btn-id')
    x.dataset.bsTarget = '#sevenModal'
}

const onClickModal9backBtn = () => {
    // changing next modal Pricing bsTarget data id
    var x = document.getElementById('pri-btn-id')
    x.dataset.bsTarget = '#eightModal'
}

// const onClickModal10backBtn = () => {
//     // changing next modal Pricing bsTarget data id
//     var x = document.getElementById('pri-btn-id')
//     x.dataset.bsTarget = '#nineModal'
// }
