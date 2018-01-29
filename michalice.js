var pitch45 = document.getElementById('pitch45');

pitch45.addEventListener('click', pitch45Handler);

function pitch45Handler(){
  globeView.controls.setTilt(45, true);
}

var pitch315 = document.getElementById('pitch315');

pitch315.addEventListener('click', pitch315Handler);

function pitch315Handler(){
  globeView.controls.setTilt(-45, true);
}

var reset = document.getElementById('reset');

reset.addEventListener('click', resetHandler);

function resetHandler(){
  globeView.controls.setOrbitalPosition({heading: 0, tilt: 0}, true);
  position = 0;
}


var head90 = document.getElementById('head90');
var position = 0;
head90.addEventListener('click', head90Handler);

function head90Handler(){
  position += 90;
  if (position == 360){
    position = 0;
  };
  globeView.controls.setHeading(position, true);
};

var head270 = document.getElementById('head270');

head270.addEventListener('click', head270Handler);

function head270Handler(){
  position -= 90;
  if (position == -360){
    position = 0;
  };
  globeView.controls.setHeading(position, true);
};
