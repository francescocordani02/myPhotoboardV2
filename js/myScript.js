//aggiunta foto profilo
function myCanvas() {
    var c = document.getElementById("profileCanvas");
    var ctx = c.getContext("2d");
    ctx.beginPath();
    ctx.arc(75, 75, 74, 0, 2 * Math.PI);
    ctx.stroke();
    var img = document.getElementById("avatar");
    ctx.drawImage(img, 2, 2, 145, 146);
}


//aggiunta post nei canvas
// var canvas = docuemnt.getElementById("postCanvas");
// var context = canvas.getContext("2d");

// function previewImage(input) {
//     var reader = new FileReader();
//     reader.onload = function(e) {
//         document.getElementById("preview").setAttribute("src", e.target.result);
//     };
//     reader.readAsDataURL(input.files[0]);
// }

// function pubblica() {
//     var img = document.getElementById("preview");
//     context.drawImage(img, x, y, widht, height);
// }