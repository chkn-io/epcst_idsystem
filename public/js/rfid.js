
var success_sound = document.getElementById("success_sound"); 
var beep_sound = document.getElementById("beep_sound"); 

const days = ['Sunday',"Monday","Tuesday",'Wednesday','Thursday','Friday','Saturday'];
const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];

startTime()

function startTime() {
    const today = new Date()
    let h = today.getHours()
    let m = today.getMinutes()
    let s = today.getSeconds()
    m = checkTime(m)
    var ampm = h >= 12 ? 'PM' : 'AM'
    h = h % 12
    h = h ? h : 12

    $('#time').html(h + ":" + m + ' ' + ampm)

    let mt = month[today.getMonth()]
    let d = today.getDate()
    let y = today.getFullYear();
    let day = days[today.getDay()]

    var date = mt + ' ' + d + ', ' + y + ' | ' + day;
    
    $('#date').html(date)
    setTimeout(startTime, 1000)
  }
  
  function checkTime(i) {
    if (i < 10) {i = "0" + i}  // add zero in front of numbers < 10
        return i
  }



let camera_button = document.querySelector("#start-camera");
let video = document.querySelector("#video");
let click_button = document.querySelector("#click-photo");
let canvas = document.querySelector("#canvas");
var image_url = ''

camera_button.addEventListener('click', async function() {
   	let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
	video.srcObject = stream;
});

click_button.addEventListener('click', function() {
   	canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
   	image_url = canvas.toDataURL('image/png');

   	// data url of the image
   	console.log(image_url);
});


$('#start-camera').click()



// Draggable camera
// Make the DIV element draggable:
dragElement(document.getElementById("camera-handle"));

function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    // if present, the header is where you move the DIV from:
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
    // otherwise, move the DIV from anywhere inside the DIV:
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    // stop moving when mouse button is released:
    document.onmouseup = null;
    document.onmousemove = null;
  }
}

$("#rfid-input").focus()
$(document).click(function(){
    $("#rfid-input").focus()
})

$("#rfid-input").keypress(function(e){
    if(e.keyCode == 13){
      beep_sound.play()
      if($(this).val() != ""){
        $("#rfid-input").attr('disabled','disabled')
        $("#click-photo").click()
        var code = $(this).val()
        $("#scanned-code").val(code)
        $("#snapshot").val(image_url)
        $.ajax({
            type:"post",
            dataType:"JSON",
            data:$('#scan-form').serialize(),
            url:'/rfid',
            beforeSend:function(){
                $("#default-view").css({'display':'none'})
                $("#rfid-input").val('')
                $("#loading").css({'display':'block'})
            },  
            success:function(e){
                $("#details-view").css({'display':'block'})
                $("#id_number").html(e.employee_number)
                $("#employee_name").html(e.name)
                $("#time_type").html(e.type)
                $("#time_type").removeClass(e.type == 'TIME IN' ? 'text-danger':'text-success')
                $("#time_type").addClass(e.type == 'TIME IN' ? 'text-success':'text-danger')
                $("#trans_time").html(e.time)
                $("#profile-image").attr('src',e.picture)
                $("#loading").css({'display':'none'})
                
                success_sound.play()
                var reset = setInterval(function(){
                    $("#details-view").css({'display':'none'})
                    $("#default-view").css({'display':'block'})
                    $("#profile-image").attr('src','img/default.png')
                    clearInterval(reset)
                    const element = document.getElementById('rfid-input');
                    element.disabled = false; 
                    element.focus();
                },5000)
            },
            error:function(e){
                $("#loading").css({'display':'none'})
                $("#norecord-view").css({'display':'block'})
                var reset = setInterval(function(){
                    $("#norecord-view").css({'display':'none'})
                    $("#default-view").css({'display':'block'})
                    const element = document.getElementById('rfid-input');
                    element.disabled = false; 
                    element.focus();
                    
                    clearInterval(reset)
                },3000)

            }
        })
      }
    }
})
