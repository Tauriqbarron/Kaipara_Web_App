function loaded(){

    n =  new Date();
    y = n.getFullYear();
    m = n.getMonth() + 1;
    d = n.getDate();
    document.getElementById("date").innerHTML = d + "/" + m + "/" + y;
}

function f(button, target){
    theButton = document.getElementById(button);
    theTarget = document.getElementById(target);

    if(!(theTarget.classList.contains('collapsing')))
    {
        degrees = getRotation(theButton);
        degrees += 180;
        if(degrees < 0){
            degrees--;
        }
        theButton.style.transform = "rotate("+degrees+"deg)";
        theButton.style.transition = "transform 300ms";
    }

}

function getRotation(element){
    var st = window.getComputedStyle(element, null);
    var tr = st.getPropertyValue("-webkit-transform") ||
        st.getPropertyValue("-moz-transform") ||
        st.getPropertyValue("-ms-transform") ||
        st.getPropertyValue("-o-transform") ||
        st.getPropertyValue("transform") ||
        "FAIL";

// With rotate(30deg)...
// matrix(0.866025, 0.5, -0.5, 0.866025, 0px, 0px)
    console.log('Matrix: ' + tr);


    var values = tr.split('(')[1].split(')')[0].split(',');
    var a = values[0];
    var b = values[1];
    var c = values[2];
    var d = values[3];

    var scale = Math.sqrt(a*a + b*b);

    console.log('Scale: ' + scale);

// arc sin, convert from radians to degrees, round
    var sin = b/scale;
// next line works for 30deg but not 130deg (returns 50);
// var angle = Math.round(Math.asin(sin) * (180/Math.PI));
    var angle = Math.round(Math.atan2(b, a) * (180/Math.PI));
    console.log('Angle: ' + angle + 'deg');

    return angle;
}
