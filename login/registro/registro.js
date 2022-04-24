$(document).ready(function () {
    $("#formulario").bind("submit",function(){
        document.getElementById('nomv').style.display="none";
        document.getElementById('nomt').style.display="none";
        document.getElementById('usrv').style.display="none";
        document.getElementById('usrt').style.display="none";
        document.getElementById('usru').style.display="none";
        document.getElementById('ussp').style.display="none";
        document.getElementById('emav').style.display="none";
        document.getElementById('emac').style.display="none";
        document.getElementById('emau').style.display="none";

        document.getElementById('clan').style.display="none";
        document.getElementById('clac').style.display="none";
        document.getElementById('inputPassword').style.border="1px solid #ced4da";
        document.getElementById('inputPassword1').style.border="1px solid #ced4da";
        document.getElementById('inputEmail').style.border="1px solid #ced4da";
        document.getElementById('inputusrid').style.border="1px solid #ced4da";
        document.getElementById('inputname').style.border="1px solid #ced4da";
        var btnEnviar = $("#btnEnviar");
        $.ajax({
            type: $(this).attr("method"),
            url: $(this).attr("action"),
            data:$(this).serialize(),
            success: function(data){
                $(".respuesta").html(data);
                 sleep(500);
                 if(data != 151){
                    if(data == 10000)
                        return fin();
                    else{
                        if (data[1] == 1)
                            nomv();
                        else if (data[1] == 2)
                            nomt();
                        if (data[2] == 1)
                            usrv();
                        else if (data[2] == 2)
                            usrt();
                        else if (data[2] == 3)
                            ussp();
                        else if (data[2] == 4)
                            usru();
                        if (data[3] == 1)
                            emav();
                        else if (data[3] == 2)
                            emac();
                        else if (data[3] == 3)
                            emau();
                        if (data[4] == 1)
                            clac();
                        else if (data[4] == 2)
                            clan();
                    }
                }else{
                    error151();
                }
            },
            error: function(data){
                fail();
            }
        });
        return false;
    });
});
function sleep(tim) {
  const date = Date.now();
  let now = null;
  do {
    now = Date.now();
  } while (now - date < tim);
}
function nomv(){
    document.getElementById('nomv').style.display="block";
    document.getElementById('inputname').style.border="1px solid red";
};
function nomt(){
    document.getElementById('nomt').style.display="block";
    document.getElementById('inputname').style.border="1px solid red";
};

function usrv(){
    document.getElementById('usrv').style.display="block";
    document.getElementById('inputusrid').style.border="1px solid red";
};
function usrt(){
    document.getElementById('usrt').style.display="block";
    document.getElementById('inputusrid').style.border="1px solid red";
};
function ussp(){
    document.getElementById('ussp').style.display="block";
    document.getElementById('inputusrid').style.border="1px solid red";
};
function usru(){
    document.getElementById('usru').style.display="block";
    document.getElementById('inputusrid').style.border="1px solid red";
};

function emav(){
    document.getElementById('emav').style.display="block";
    document.getElementById('inputEmail').style.border="1px solid red";
};
function emac(){
    document.getElementById('emac').style.display="block";
    document.getElementById('inputEmail').style.border="1px solid red";
};
function emau(){
    document.getElementById('emau').style.display="block";
    document.getElementById('inputEmail').style.border="1px solid red";
};

function clac(){
    document.getElementById('clac').style.display="block";
    document.getElementById('inputPassword').style.border="1px solid red";
    document.getElementById('inputPassword1').style.border="1px solid red";
};
function clan(){
    document.getElementById('clan').style.display="block";
    document.getElementById('inputPassword').style.border="1px solid red";
    document.getElementById('inputPassword1').style.border="1px solid red";
};
function error151(){
    document.getElementById('fail').style.display="block";
};
function fail(){
    document.getElementById('ups').style.display="block";
};



var hashsha256 = function sha256(ascii) {
	function rightRotate(value, amount) {
		return (value>>>amount) | (value<<(32 - amount));
	};
	
	var mathPow = Math.pow;
	var maxWord = mathPow(2, 32);
	var lengthProperty = 'length'
	var i, j; // Used as a counter across the whole file
	var result = ''

	var words = [];
	var asciiBitLength = ascii[lengthProperty]*8;
	
	//* caching results is optional - remove/add slash from front of this line to toggle
	// Initial hash value: first 32 bits of the fractional parts of the square roots of the first 8 primes
	// (we actually calculate the first 64, but extra values are just ignored)
	var hash = sha256.h = sha256.h || [];
	// Round constants: first 32 bits of the fractional parts of the cube roots of the first 64 primes
	var k = sha256.k = sha256.k || [];
	var primeCounter = k[lengthProperty];
	/*/
	var hash = [], k = [];
	var primeCounter = 0;
	//*/

	var isComposite = {};
	for (var candidate = 2; primeCounter < 64; candidate++) {
		if (!isComposite[candidate]) {
			for (i = 0; i < 313; i += candidate) {
				isComposite[i] = candidate;
			}
			hash[primeCounter] = (mathPow(candidate, .5)*maxWord)|0;
			k[primeCounter++] = (mathPow(candidate, 1/3)*maxWord)|0;
		}
	}
	
	ascii += '\x80' // Append Ƈ' bit (plus zero padding)
	while (ascii[lengthProperty]%64 - 56) ascii += '\x00' // More zero padding
	for (i = 0; i < ascii[lengthProperty]; i++) {
		j = ascii.charCodeAt(i);
		if (j>>8) return; // ASCII check: only accept characters in range 0-255
		words[i>>2] |= j << ((3 - i)%4)*8;
	}
	words[words[lengthProperty]] = ((asciiBitLength/maxWord)|0);
	words[words[lengthProperty]] = (asciiBitLength)
	
	// process each chunk
	for (j = 0; j < words[lengthProperty];) {
		var w = words.slice(j, j += 16); // The message is expanded into 64 words as part of the iteration
		var oldHash = hash;
		// This is now the undefinedworking hash", often labelled as variables a...g
		// (we have to truncate as well, otherwise extra entries at the end accumulate
		hash = hash.slice(0, 8);
		
		for (i = 0; i < 64; i++) {
			var i2 = i + j;
			// Expand the message into 64 words
			// Used below if 
			var w15 = w[i - 15], w2 = w[i - 2];

			// Iterate
			var a = hash[0], e = hash[4];
			var temp1 = hash[7]
				+ (rightRotate(e, 6) ^ rightRotate(e, 11) ^ rightRotate(e, 25)) // S1
				+ ((e&hash[5])^((~e)&hash[6])) // ch
				+ k[i]
				// Expand the message schedule if needed
				+ (w[i] = (i < 16) ? w[i] : (
						w[i - 16]
						+ (rightRotate(w15, 7) ^ rightRotate(w15, 18) ^ (w15>>>3)) // s0
						+ w[i - 7]
						+ (rightRotate(w2, 17) ^ rightRotate(w2, 19) ^ (w2>>>10)) // s1
					)|0
				);
			// This is only used once, so *could* be moved below, but it only saves 4 bytes and makes things unreadble
			var temp2 = (rightRotate(a, 2) ^ rightRotate(a, 13) ^ rightRotate(a, 22)) // S0
				+ ((a&hash[1])^(a&hash[2])^(hash[1]&hash[2])); // maj
			
			hash = [(temp1 + temp2)|0].concat(hash); // We don't bother trimming off the extra ones, they're harmless as long as we're truncating when we do the slice()
			hash[4] = (hash[4] + temp1)|0;
		}
		
		for (i = 0; i < 8; i++) {
			hash[i] = (hash[i] + oldHash[i])|0;
		}
	}
	
	for (i = 0; i < 8; i++) {
		for (j = 3; j + 1; j--) {
			var b = (hash[i]>>(j*8))&255;
			result += ((b < 16) ? 0 : '') + b.toString(16);
		}
	}
	return result;
};
function fin(){
    userid = document.getElementById('inputusrid').value;
    email = document.getElementById('inputEmail').value;
    message = document.getElementById('inputPassword').value;
    pass = hashsha256(message);
    token = hashsha256(email+pass);
    window.location = "../usuario/index.php?id="+ userid + "&token=" + token;
};
