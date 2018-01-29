pitch45 = document.getElementById('pitch45');

pitch45.addEventListener('click', pitch45Handler);

function pitch45Handler(){
  globeView.controls.setTilt(45, true);
}

pitch315 = document.getElementById('pitch315');

pitch315.addEventListener('click', pitch315Handler);

function pitch315Handler(){
  globeView.controls.setTilt(-45, true);
}

reset = document.getElementById('reset');

reset.addEventListener('click', resetHandler);

function resetHandler(){
  globeView.controls.setOrbitalPosition({heading: 0, tilt: 0}, true);
}


head90 = document.getElementById('head90');

head90.addEventListener('click', head90Handler);

function head90Handler(){
  globeView.controls.setHeading(90, true);
}

head270 = document.getElementById('head270');

head270.addEventListener('click', head270Handler);

function head270Handler(){
  globeView.controls.setHeading(-90, true);
}
