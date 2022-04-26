/*
Created by: Mathias Moser
Hype Technology Spain
©2019-2021
*/

var closeButton = document.getElementById('closeButton');

if(closeButton != null){
    closeButton.addEventListener('click', function(event){

        setCookie("__err__", "", 0);

    });
}

$(function() {
    let http = new XMLHttpRequest();
    let form = document.getElementById("registerform");
    form.addEventListener('submit', async function(event) {
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            form.classList.add('was-validated'); //Y cambia la classe del formulario, para validado
        } //Si son validos el bucle se detiene
        else{
            var email = $('#registerEmail').val().toLowerCase();
            var nombre = $('#registerNombre').val();
            var apellidos = $('#registerApellidos').val();
            var pass = $('#registerPassword').val();
            var documento = $('#registerDocumento').val();
            var confirmPass = $('#registerConfirmPassword').val();
            var fechaNacimiento = $('#registerFechaNacimiento').val();
            var remember = document.getElementById("remember");
            
            
            if (email == "" || nombre == "" || documento =="" || apellidos== ""  || pass== ""  || confirmPas== ""  || fechaNacimiento== "" || confirm== "" || !remember.checked){
                event.preventDefault();
                event.stopPropagation();
                form.classList.add('was-validated'); //Y cambia la classe del formulario, para validado
                return true 
            }

            if(confirmPass != pass){
                window.location.search = "?result="+configs["confirmPasswordToken"];
                return true 
            }

            const params = await prepare(email,nombre,documento, apellidos,pass, fechaNacimiento);
        
            http.onreadystatechange = function() {
                if(http.readyState === 4) {
                    alert(http.responseText)
                    var responseCode = configs["wrongRequestToken"];

                    try{
                        var obj = JSON.parse(http.responseText);
                        responseCode = obj.responseCode;
                    } catch(e){
                        responseCode = configs["wrongRequestToken"];
                    }

                    if(responseCode == configs["successToken"]){
                        token = obj.token;
                        nombre = obj.nombre;
                        setCookie("__LOGIN__", "TRUE",0.2,"/");
                        window.location.search = "?result="+configs["successToken"];
                        window.location.href = "../?nombre="+ nombre + "&token=" + token;
                    }
                    else{
                        window.location.search = "?result="+responseCode.toString();
                    }

                }
            }
            const url = '../assets/mod/register.php';
            http.open('POST',url,false);
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            http.send(params);
        }

    }, false);
});

async function prepare(email,nombre,apellidos,pass, fechaNacimiento){
    const cryptpass = await sha256(pass);
    const seed = user+cryptpass;
    const token = await sha256(seed);
    const UUID = getCookie("UUID");
    return 'email='+email +'&nombre='+ nombre +'&documento' + documento+ '&apellidos='+ apellidos +'&pass='+ cryptpass + '&fechaNacimiento='+ fechaNacimiento + '&token=' + token + "&uuid=" + UUID;
}


function getSession() {
    cname = "PHPSESSID";
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}