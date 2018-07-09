/* Parametros de configuracion */
//var URL_SERVICE_AJAX = "https://service.mer-link.co.cr:4504/service";
var URL_SERVICE_AJAX = "https://service.componentefirmacr.go.cr:4504/service";
var URL_SERVICE = "wss://service.componentefirmacr.go.cr:4502/";
var VERSION_COMPONENTE = 3.0;
var CERTIFICATE = "308204743082035ca00302010202143230303031303030303030313030303035383637300d06092a864886f70d01010505003082016f3118301606035504030c0f412e432e2064652070727565626173312f302d060355040a0c26536572766963696f2064652041646d696e69737472616369c3b36e205472696275746172696131383036060355040b0c2f41646d696e69737472616369c3b36e20646520536567757269646164206465206c6120496e666f726d616369c3b36e3129302706092a864886f70d010901161a617369736e657440707275656261732e7361742e676f622e6d783126302406035504090c1d41762e20486964616c676f2037372c20436f6c2e20477565727265726f310e300c06035504110c053036333030310b3009060355040613024d583119301706035504080c10446973747269746f204665646572616c3112301006035504070c09436f796f6163c3a16e31153013060355042d130c5341543937303730314e4e333132303006092a864886f70d0109020c23526573706f6e7361626c653a2048c3a963746f72204f726e656c617320417263696761301e170d3132303732373137303230305a170d3136303732373137303230305a3081db3129302706035504031320414343454d20534552564943494f5320454d50524553415249414c45532053433129302706035504291320414343454d20534552564943494f5320454d50524553415249414c455320534331293027060355040a1320414343454d20534552564943494f5320454d50524553415249414c455320534331253023060355042d131c414141303130313031414141202f2048454754373631303033345332311e301c06035504051315202f20484547543736313030334d4446524e4e30393111300f060355040b1308556e69646164203130819f300d06092a864886f70d010101050003818d0030818902818100b64d34123ce341395c695eff702d8a3c8decc1adbdf88bfb4bc7c8c676dcb2dbb05c7ac39abf6735352fc676fd74bbd4a45adc1dcb7e2e44055eec7d1add53112c7024be9daa3021da65ce13f24e3b26d6fdc2b38487f5c54bc2e04f8cb9390628e9c8af7d75dd96fc5653f81d33f7ba236960e851a8acff07e063c027fa82370203010001a31d301b300c0603551d130101ff04023000300b0603551d0f0404030206c0300d06092a864886f70d010105050003820101004f131e713a4c6dd8521e8e8a5548384151783a9d8806188c68eaedad705d260cc6a2d50570981d042323b536574a5ab54b80c6d63afca78373425cf1b1d4f1681f2748a278284320213ec4eb6c51523d798c8e3da85cfb7f6b8cb6d64b353862a6e9ec37f345d57b6f1123130f0405bdab3f5208a0eaac047d265cd0c0f132928b12411e3e6430b590fecd71523156ba8663aee0cf85cc68915db8f86095e7f4cca377cc5b2ff73ef5421cad8a19b24c43bccc5cebfe8cdeb34d0d8dce16104af95fec3cccd6586b7c4b5ca39ad3df5e016cd6deb9019da1713c1302e1eb2b00dab49d593df6b8f3664144e0005f5c1acfb5b05e9d20b28eec0c29b6ff2515c3";
var TYPE_AUTH = "AUTHENTICATION";
var TYPE_SIGN = "SIGN";
var TYPE_KEY_GENERATOR = "KEY_GENERATOR";
var VALIDATION_TYPE = "ocsp"; //ocsp, crl, nothing
var jq= $.noConflict();

jq.support.cors = true;


function verificarConexionAjax(){
    var codigo;
    var result;
    
    jq.ajax({
            type: "post",
            url: URL_SERVICE,
            dataType: "json",
            async: false,
            data: {
                cmd: "info"
            },
            success:function(data, textStatus, jqXHR){
                 if(data!== null){
                    result = data; 
                    if(result.ErrorCode === 0){
                        var version = parseFloat(result.Version);
                        if(version < VERSION_COMPONENTE){
                            //version desactualizada del componente
                            codigo = 1;
                        }else{
                            codigo = 0;
                        }
                    }
                 }
            },
            error:function(jqXHR, status, error){
                /*if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                }*/
                codigo = 2;  
            }
        });
        return codigo;
}

function verificarConexion(){
	var result = "";
	var jsonParams = {"cmd":"info"};
	var codigo = 2;
	
	var ws = new WebSocket(URL_SERVICE);
		
	ws.onopen = function() {
	    ws.send(JSON.stringify(jsonParams));
	};
	
	ws.onmessage = function (evt) {
	    result = JSON.parse(evt.data);
	    
	    if(result.ErrorCode === 0){
            var version = parseFloat(result.Version);
            if(version < VERSION_COMPONENTE){
                //version desactualizada del componente
                codigo = 1;
            }else{
                codigo = 0;
            }
        }
	};
	
	ws.onclose = function() {
	};

	ws.onerror = function(err) {
	    alert("Error: " + err);
	    codigo = 2;
	};
	return codigo;
}

function downloadComponente(fileUrl, fileName) {
    // Construct the <a> element
    var link = document.createElement("a");
    link.download = fileName;
    link.href = fileUrl;
    document.body.appendChild(link);
    link.click();
    // Cleanup the DOM
    document.body.removeChild(link);
    delete link;
}

/* Llamado al servicio del componente */
function serviceAjax(jsonObject){
    var result;

    jq.ajax({
            type: "post",
            url: URL_SERVICE,
            dataType: "json",
            async: false,
            data: jsonObject,
            success:function(data) {
                result = data; 
            },
            error:function(jqXHR, textStatus, errorThrown){
                result = {ErrorCode:1, Description:"Error de conexión con el componente de firma digital"};
            }
        });
        
        return result;
}

/*WebSocket service*/
async function service(jsonObject){
    var ws = new WebSocket(URL_SERVICE);
    
    return new Promise(function (resolve, reject) {
        //this.socket = new WebSocket(url);
        var socket = ws;
        socket.onopen = function () {
            socket.send(JSON.stringify(jsonObject));
            //It doesn't resolve until get the response from the component
        };

        socket.onmessage = function (message) {
            resolve(message);//return the data obtained from the component
        };

        socket.onerror = function (error) {
            console.log('WebSocket error: ' + error);
            reject(error);
        };

        socket.onclose = function (event) {
            console.log("Websocket socket closed: " + JSON.stringify(event));
        };
        //socket.send(JSON.stringify(jsonObject));
    });
}

async function hacerRequest(){

     var jsonParams = {"cmd":"doRequest", 
                       "url":"http://www.google.com"};
                  
    var resultado = await service(jsonParams).data;
    
    
    var errorCode = resultado.ErrorCode;
    var description = resultado.Description;

    if(errorCode === 0){
        var obj = resultado.Response;
        alert(obj.response);
    }else{
        //mostrar mensaje de error
        alert(description);
    }
}