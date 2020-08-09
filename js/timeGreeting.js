function date() {
  let currentDate = new Date();
  let dateOptions = {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  };
  let date = currentDate.toLocaleDateString("en-GB", dateOptions);
  document.getElementById("header_date").innerHTML = date;
}

function greet() {
  let currentTime = new Date();
  const hour = currentTime.getHours();

  // before 4 am
  if (hour < 4) {
    document.getElementById("header_greet").innerHTML = "Good night!";
  }
  // before 12 pm (noon)
  else if (hour < 12) {
    document.getElementById("header_greet").innerHTML = "Good morning!";
  }
  // before 5 pm
  else if (hour < 16) {
    document.getElementById("header_greet").innerHTML = "Good afternoon!";
  }
  // before 9 pm
  else if (hour < 21) {
    document.getElementById("header_greet").innerHTML = "Good evening!";
  }
  // any time after 9pm
  else {
    document.getElementById("header_greet").innerHTML = "Good night!";
  }
}

function loadFunctions() {
  date();
  greet();
}
