
const formOpenBtn = document.querySelector("#form-open"),
  home = document.querySelector(".home"),
  formContainer = document.querySelector(".form_container"),
  formCloseBtn = document.querySelector(".form_close"),
  signupBtn = document.querySelector("#signup"),
  loginBtn = document.querySelector("#login"),
  pwShowHide = document.querySelectorAll(".pw_hide");
const daysTag = document.querySelector("#days1"),
  daysTag2 = document.querySelector("#days2"),
  currentDate = document.querySelector("#current-date1"),
  currentDate2 = document.querySelector("#current-date2"),
  prevNextIcon = document.querySelectorAll(".icons span");

let GloballistofEvents=new Array();
// sign-up and login form
const authPopUp=document.querySelector(".home");
const nonAuthPopupElements = document.querySelectorAll("body > *:not(.home)");
const outsideClickHandlerforAuth = (event) => {
  if (!authPopUp.contains(event.target) && event.target !== authPopUp) {
    nonAuthPopupElements.forEach((element) => {
      element.classList.remove("blur-effect");
      home.classList.remove("show");
    });
    document.removeEventListener("click", outsideClickHandlerforAuth);
  }
};

if(formOpenBtn!==null){
  formOpenBtn.addEventListener("click", () => {
    nonAuthPopupElements.forEach((element) => {
      element.classList.add("blur-effect");
    });

    setTimeout(() => {
      document.addEventListener("click", outsideClickHandlerforAuth);
    }, 100);
    home.classList.add("show");
  });
}
formCloseBtn.addEventListener("click", () => {
  home.classList.remove("show");
  document.removeEventListener("click", outsideClickHandlerforAuth);
  nonAuthPopupElements.forEach((element) => {
    element.classList.remove("blur-effect");
  });
});
const signUpFormClose=document.getElementById("signup-form-close");
if(signUpFormClose!=null){
  signUpFormClose.addEventListener("click", () => {
    home.classList.remove("show");
    document.removeEventListener("click", outsideClickHandlerforAuth);
    nonAuthPopupElements.forEach((element) => {
      element.classList.remove("blur-effect");
    });
  });
}

// to show signup - login form
signupBtn.addEventListener("click", (e) => {
  e.preventDefault();
  formContainer.classList.add("active");
});
loginBtn.addEventListener("click", (e) => {
  e.preventDefault();
  formContainer.classList.remove("active");
});

// for showing msg in signup - login container
const urlParams = new URLSearchParams(window.location.search);
const signup = urlParams.get('signup')
if (signup!=null && formOpenBtn!=null){
  if(signup != 'success') {
    formOpenBtn.click();
    signupBtn.click();
  }
}

const login = urlParams.get('login');
if(login!=null && formOpenBtn!=null){
  if(login!='success'){
    formOpenBtn.click();
  }
}

const sessionMsg = document.querySelector('.session-msg');
  
  // Check if the element exists and set a timeout to remove it after 5 seconds
  if (sessionMsg) {
    setTimeout(() => {
      sessionMsg.remove();
    }, 5000);
  }

// range-sliders
for(let i=1;i<7;i++){
  const slider=document.getElementById(`value-number${i}`);
  const sliderValue=document.getElementById(`range-number${i}`);
  const rangeInput=document.getElementById(`range-input${i}`);
  let rangeValue=5;

  rangeInput.addEventListener("input",()=>{
    changeRangeValue(rangeInput);
    slider.classList.add("show");
  });
  rangeInput.addEventListener("mouseleave" , ()=>{
    slider.classList.remove("show");
  });

  const changeRangeValue=(range)=>{
    rangeValue=range.value;
    sliderValue.textContent=rangeValue;
    slider.style.left=`${rangeValue*10}%`;
    rangeInput.style.backgroundImage=`linear-gradient(90deg , var(--mainColor) ${rangeInput.value*10}%, #f1f1f1 ${rangeInput.value*10}%)`;
  }

  changeRangeValue(rangeInput);
}


// apply to add an event application form
const applicationForm=document.querySelector(".application-form");
const applyButton=document.querySelector(".apply-button");
const applyCloseButton=document.querySelector(".apply-close-button");
//dimming other parts
const nonApplyPopupElements = document.querySelectorAll("body > *:not(.application-form)");
const applyPopUp=document.querySelector(".application-form");
const outsideClickHandlerforApply = (event) => {
  if (!applyPopUp.contains(event.target) && event.target !== applyPopUp) {
    nonApplyPopupElements.forEach((element) => {
      element.classList.remove("blur-effect");
      applicationForm.classList.remove("show");
    });
    document.removeEventListener("click", outsideClickHandlerforApply);
  }
};
applyButton.addEventListener("click",()=>{  
  nonApplyPopupElements.forEach((element) => {
    element.classList.add("blur-effect");
  });
  setTimeout(() => {
    document.addEventListener("click", outsideClickHandlerforApply);
  }, 100);
  applicationForm.classList.add("show");
});

applyCloseButton.addEventListener("click",()=>{
  applicationForm.classList.remove("show");
  document.removeEventListener("click", outsideClickHandlerforApply);
  nonApplyPopupElements.forEach((element) => {
    element.classList.remove("blur-effect");
  });
});


//calender event functions
function getCalenderDates(callback){
  // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();

  // Set up the request
  xhr.open('GET', 'events/events.php',true);
  // Set up the callback function
  xhr.onload = function() {
    // Check if the request was successful
    if (xhr.status === 200) {
      // Parse the response as JSON
      var data = JSON.parse(xhr.responseText);
      callback(data);
    } else {
      // Handle errors here
      console.error(xhr.statusText);
    }
  };
  // Send the request
  xhr.send();
}

// password show and hide
pwShowHide.forEach((icon) => {
  icon.addEventListener("click", () => {
    let getPwInput = icon.parentElement.querySelector("input");
    if (getPwInput.type === "password") {
      getPwInput.type = "text";
      icon.classList.replace("uil-eye-slash", "uil-eye");
    } else {
      getPwInput.type = "password";
      icon.classList.replace("uil-eye", "uil-eye-slash");
    }
  });
});

// pop-up of sorted events
function SortedPopupString(eventDetails){
    var popup=`<div class="backdrop"></div>
    <div id="popContainer">
      <div class="in_a_row">
        <h3 class="flex h3">Sorted Events</h3>
        <div class="flex close-btn">&times;</div>
      </div>`;
    let i=0;
    while(i<eventDetails.length){
      let loop=`<img src=${eventDetails[i].imageUrl}>
      <div class="event-details">
        <p>Name : ${eventDetails[i].name}</p>
        <p>Date : ${eventDetails[i].date}</p>
        <p>Venue : ${eventDetails[i].venue}</p>
        <p>Type : ${eventDetails[i].type}</p>
        <p>Category : ${eventDetails[i].category}</p>
        <p>Quiz Masters : ${eventDetails[i].masters}</p>
        <p>Contact : ${eventDetails[i].contact}</p>
        <hr>
      </div>`;
      popup=popup.concat(loop);
      i++;
    }
    popup=popup.concat(`</div`);
    return popup;
  }
  function showSortedPopUp(eventDetails) {
      const popUp = document.createElement("div");
      popUp.classList.add("pop-up");
      popUp.innerHTML = SortedPopupString(eventDetails);
      // Close the pop-up window when the close button is clicked
      popUp.querySelector(".close-btn").addEventListener("click", () => {
          popUp.remove();
          document.removeEventListener("click", outsideClickHandler);
          nonPopupElements.forEach((element) => {
            element.classList.remove("blur-effect");
          });
      });
      const outsideClickHandler = (event) => {
        if (!popUp.contains(event.target)&& event.target !== popUp) {
          popUp.remove();
          nonPopupElements.forEach((element) => {
            element.classList.remove("blur-effect");
          });
          document.removeEventListener("click", outsideClickHandler);
        }
      };
      setTimeout(() => {
        document.addEventListener("click", outsideClickHandler);
      }, 100);
      //dimming
      const nonPopupElements = document.querySelectorAll("body > *:not(.pop-up)");
      nonPopupElements.forEach((element) => {
        element.classList.add("blur-effect");
      });
      document.body.appendChild(popUp);
  }

// getting interested events
function getInterestList(category,interest,listofEvents){
  let j=0;
  let interestedEvents=new Array();
  for(let a=0;a<interest.length;a++){
    for(let i=0;i<listofEvents[0].length && j<10;i++){
      let events=JSON.parse(listofEvents[0][i]["events"]);
      if(events!=null){
        for(let x=0;x<events.length && j<10;x++){
          let eventCategory=events[x].category;
          if((category==events[x].category || category.contains(events[x].category) || events[x].category.contains(category) ) && events[x].type==interest[a]){
            interestedEvents.push(events[x]);
            j++;
          }
        }
      }
    }
    for(let i=0;i<listofEvents[1].length && j<10;i++){
      let events=JSON.parse(listofEvents[1][i]["events"]);
      if(events!=null){
        for(let x=0;x<events.length && j<10;x++){
          if(events[x].category==category && events[x].type==interest[a]){
            interestedEvents.push(events[x]);
            j++;
          }
        }
      }
    }
  }
  return interestedEvents;
}

// pop-up form submission
const submitPopUpForm=()=>{
  const general=document.getElementById("range-input1").value;
  const scitech=document.getElementById("range-input2").value;
  const business=document.getElementById("range-input3").value;
  const scitechbiz=document.getElementById("range-input6").value;
  const sports=document.getElementById("range-input5").value;
  const mela=document.getElementById("range-input6").value;
  let categoryArray=[{"general":general},{"scitech":scitech},{"business":business},{"scitechbiz":scitechbiz},{"sports":sports},{"mela":mela}];
  let array=["general","scitech","business","mela","sports","scitechbiz"];
  const open=document.getElementById("radio-open").checked;
  const school=document.getElementById("radio-school").checked;
  const college=document.getElementById("radio-college").checked;
  let category="open";
  if(open && school && college) category="open";
  else if(open && school) category="open-school";
  else if(open && college) category="open-college";
  else if(school && college) category="school-college";
  else if(school) category="school";
  else if(college) category="college";
  var interests=getInterestList(category,array,GloballistofEvents);
  // console.log(interests);
  showSortedPopUp(interests);
}

// rendering calender
function renderFrontEnd(listofEvents){
  GloballistofEvents=listofEvents;
  // getting new date, current year and month
  let date = new Date(),
  currYear = date.getFullYear(),
  currMonth = date.getMonth();

  // storing full name of all months in array
  const months = ["January", "February", "March", "April", "May", "June", "July",
                "August", "September", "October", "November", "December"];

  // getting color to show 
  function getColor(date){
    let eventTypes=date.event_types;
    console.log(date.event_types);
    if(eventTypes.includes("open") && eventTypes.includes("school") && eventTypes.includes("college")){
      return "active4";
    }else if(eventTypes.includes("open") && eventTypes.includes("school")){
      return "active5";
    }else if(eventTypes.includes("open") && eventTypes.includes("college")){
      return "active6";
    }else if(eventTypes.includes("school") && eventTypes.includes("college")){
      return "active7";
    }else if(eventTypes.includes("open")){
      return "active";
    }else if(eventTypes.includes("school")){
      return "active2";
    }else if(eventTypes.includes("college")){
      return "active3";
    }
  }
  function PopupString(day,eventDetails){
    var popup=`<div class="backdrop"></div>
    <div id="popContainer">
      <div class="in_a_row">
        <h3 class="flex h3">${months[currMonth]} ${day}, ${currYear}</h3>
        <div class="flex close-btn">&times;</div>
      </div>`;
    let i=0;
    while(i<eventDetails.length){
      let loop=`<img src=${eventDetails[i].imageUrl}>
      <div class="event-details">
        <p>Name : ${eventDetails[i].name}</p>      
        <p>Venue : ${eventDetails[i].venue}</p>
        <p>Type : ${eventDetails[i].type}</p>
        <p>Category : ${eventDetails[i].category}</p>
        <p>Quiz Masters : ${eventDetails[i].masters}</p>
        <p>Contact : ${eventDetails[i].contact}</p>
        <hr>
      </div>`;
      popup=popup.concat(loop);
      i++;
    }
    popup=popup.concat(`</div`);
    return popup;
  }
  function showPopUp(day,eventDetails) {
      const popUp = document.createElement("div");
      popUp.classList.add("pop-up");
      popUp.innerHTML = PopupString(day,eventDetails);
      // Close the pop-up window when the close button is clicked
      popUp.querySelector(".close-btn").addEventListener("click", () => {
          popUp.remove();
          document.removeEventListener("click", outsideClickHandler);
          nonPopupElements.forEach((element) => {
            element.classList.remove("blur-effect");
          });
      });
      const outsideClickHandler = (event) => {
        if (!popUp.contains(event.target)&& event.target !== popUp) {
          popUp.remove();
          nonPopupElements.forEach((element) => {
            element.classList.remove("blur-effect");
          });
          document.removeEventListener("click", outsideClickHandler);
        }
      };
      setTimeout(() => {
        document.addEventListener("click", outsideClickHandler);
      }, 100);
      //dimming
      const nonPopupElements = document.querySelectorAll("body > *:not(.pop-up)");
      nonPopupElements.forEach((element) => {
        element.classList.add("blur-effect");
      });
      document.body.appendChild(popUp);
  }

  const renderCalendar = () => {
      let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
      lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
      lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
      lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
      let liTag = "";

      for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
          liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
      }
      for (let i = 1; i <= lastDateofMonth; i++) { // creating li of all days of current month
          // adding active class to li if the current day, month, and year matched
          let dayToday=`${currYear}-${currMonth}-${i}`;
          console.log(listofEvents[0][i-1]["date"]);
          var isToday=listofEvents[0][i-1]["date"]=="null"?"":getColor(JSON.parse(listofEvents[0][i-1]["date"]));
          liTag += `<li class="${isToday}">${i}</li>`;
      }
      for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
          liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
      }
      currentDate.textContent = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
      daysTag.innerHTML = liTag;
      const dayElements = daysTag.querySelectorAll('li');
      let i=1;
      dayElements.forEach(dayElement => {
          dayElement.addEventListener('click', () => {
              const day = dayElement.innerText;
              if(listofEvents[0][day-1]["date"]!='null'){
                showPopUp(day,JSON.parse(listofEvents[0][day-1]["events"]));
              }
          });
          i++;
      }); 
  }
  renderCalendar();
  currMonth++;
  const rendernextCalendar = () => {
     firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
    lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
    lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
    lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
    let liTag = "";

    for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
        liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
    }
    for (let i = 1; i <= lastDateofMonth; i++) { // creating li of all days of current month
        // adding active class to li if the current day, month, and year matched
        let dayToday=`${currYear}-${currMonth}-${i}`;
        console.log(listofEvents[1][i-1]["date"]);
        var isToday=listofEvents[1][i-1]["date"]=="null"?"":getColor(JSON.parse(listofEvents[1][i-1]["date"]));
        liTag += `<li class="${isToday}">${i}</li>`;
    }
    for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
        liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
    }
    currentDate2.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
    daysTag2.innerHTML = liTag;
    const dayElements = daysTag2.querySelectorAll('li');
    dayElements.forEach(dayElement => {
        dayElement.addEventListener('click', () => {
            const day = dayElement.innerText;
            console.log(day);
            if(listofEvents[1][day-1]["date"]!='null'){
              showPopUp(day,JSON.parse(listofEvents[1][day-1]["events"]));
            }
        });
    }); 
  }
  rendernextCalendar();
}
getCalenderDates(renderFrontEnd);

// for showing the selected image
const fileInput = document.getElementById('file-input');
const fileContainer = document.querySelector('.image-container');
const previewImage = document.getElementById('preview-image');
const labelForFileInput=document.querySelector(".preview-label");

fileInput.addEventListener('change', () => {
  const selectedFile = fileInput.files[0];
  
  if (selectedFile) {
    const reader = new FileReader();
    
    reader.addEventListener('load', () => {
      previewImage.src = reader.result;
      previewImage.style.display = "block";
      labelForFileInput.setAttribute('for','none');
      labelForFileInput.classList.add("dont-show");
      console.log(reader.result);
    });
    reader.readAsDataURL(selectedFile); // main thing
  }
  // else {
  //   previewImage.src = previousImage;
  // }
});

// checking image selected or not
const selectImage=document.querySelector(".select-image");
const leftSide=document.querySelector(".left-side");
const imageNotNull=()=>{
  const selectedFile = fileInput.files[0];
  if(selectedFile==null){
    selectImage.classList.add("show");
  }
}