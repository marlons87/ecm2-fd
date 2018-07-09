//Funciones de autenticacion en Mer-link
function inicioSesion(){
    var pin = document.getElementById("pin").value;
    var certificateType = document.querySelector('input[name=tipoCertificado]:checked').value;
    var fileName;
    var slotSelected;
    
    if(certificateType === "CARD"){
        var selectCerts = document.getElementById("idSelectCerts");
        slotSelected = selectCerts.options[selectCerts.selectedIndex].value;
        if(slotSelected === '-1'){
            alert(selectCerts.options[selectCerts.selectedIndex].text);
            return;
        }
     }else{ //FILE
        var selectFiles = document.getElementById("idSelectFiles");
        fileName = selectFiles.options[selectFiles.selectedIndex].value;
        if(fileName === '-1'){
            alert(selectFiles.options[selectFiles.selectedIndex].text);
            return;
        }
     }
   
    var jsonParams = {"cmd":"getAuthValues", 
                      "password":pin,
                      "signType":TYPE_AUTH,
                      "certificateType":certificateType,
                      "certificatePath":fileName,
                      "validationType":VALIDATION_TYPE,
                      "certificate":CERTIFICATE,
                      "slot":slotSelected};
                  
    var resultado = service(jsonParams);
    
    var errorCode = resultado.ErrorCode;
    var description = resultado.Description;

    if(errorCode === 0){
        overlay(); //cerrar modal
        
        var auth = resultado.Authentication;
        var result = "";
            result += "Fecha Inicio " + auth.validityStart;
            result += "\n\nFecha Expira " + auth.validityExpire;
            result += "\n\nCN " + auth.userCn;
            result += "\n\nDN sin CN " + auth.userDnWithoutCn;
            result += "\n\nLlave de encripcion cookie " + auth.keyEnc;

           

            document.getElementById("texto").value = result;

      

    }else{
        //mostrar mensaje de error
        alert(description);
    }
} 

async function getCertificadoBase64(){
    var pin = document.getElementById("pin").value;
    var certificateType = document.querySelector('input[name=tipoCertificado]:checked').value;
    var fileName;
    var slotSelected;
    
    if(certificateType === "CARD"){
        var selectCerts = document.getElementById("idSelectCerts");
        slotSelected = selectCerts.options[selectCerts.selectedIndex].value;
        if(slotSelected === '-1'){
            alert(selectCerts.options[selectCerts.selectedIndex].text);
            return;
        }
     }else{ //FILE
        var selectFiles = document.getElementById("idSelectFiles");
        fileName = selectFiles.options[selectFiles.selectedIndex].value;
        if(fileName === '-1'){
            alert(selectFiles.options[selectFiles.selectedIndex].text);
            return;
        }
     }
    
     var jsonParams = {"cmd":"certificateBase64", 
                      "password":pin,
                      "signType":TYPE_AUTH,
                      "certificateType":certificateType,
                      "certificatePath":fileName,
                      "validationType":VALIDATION_TYPE,
                      "slot":slotSelected};
                  
    var resolve = await service(jsonParams);
    var resultado = JSON.parse(resolve.data);
    
    
    var errorCode = resultado.ErrorCode;
    var description = resultado.Description;

    if(errorCode === 0){
        overlay(); //cerrar modal
        
        var obj = resultado.Certificado;
        document.getElementById("texto").value = obj.certificateBase64;
    }else{
        //mostrar mensaje de error
        alert(description);
    }
}

function generarLlaves(){
    var pin = document.getElementById("pin").value;
    var certificateType = document.querySelector('input[name=tipoCertificado]:checked').value;
    var fileName;
    var slotSelected;
    
    if(certificateType === "CARD"){
        var selectCerts = document.getElementById("idSelectCerts");
        slotSelected = selectCerts.options[selectCerts.selectedIndex].value;
        if(slotSelected === '-1'){
            alert(selectCerts.options[selectCerts.selectedIndex].text);
            return;
        }
     }else{ //FILE
        var selectFiles = document.getElementById("idSelectFiles");
        fileName = selectFiles.options[selectFiles.selectedIndex].value;
        if(fileName === '-1'){
            alert(selectFiles.options[selectFiles.selectedIndex].text);
            return;
        }
     }
    
     var jsonParams = {"cmd":"generarLlaves", 
                      "password":pin,
                      "signType":TYPE_KEY_GENERATOR,
                      "certificateType":certificateType,
                      "certificatePath":fileName,
                      "validationType":VALIDATION_TYPE,
                      "keyName": "CR_102313231237127381", 
                      "slot":slotSelected};
                  
    var resultado = service(jsonParams);
    
    
    var errorCode = resultado.ErrorCode;
    var description = resultado.Description;

    if(errorCode === 0){
        overlay(); //cerrar modal
        
        var obj = resultado.Llaves;
        var llaves = "Llave Publica en base64: \n" + obj.publicKey +"\n\n" + "Llave Privada en base64: \n" + obj.privateKey;
        var divKeys = document.getElementById("keys");
        divKeys.value = llaves;
        
        //guardar en archivo
        saveFile(llaves, 'userenc.dat', 'text/plain');
    }else{
        //mostrar mensaje de error
        alert(description);
    }
}

    function saveFile(text, fileName, type) {

        var link = document.createElement("a");
        var file = new Blob([text], {type: type});
        link.download = fileName;
        link.href = URL.createObjectURL(file);
        document.body.appendChild(link);
        link.click();
          // Cleanup the DOM
        document.body.removeChild(link);
        delete link;
       
    }

async function getDN(){
    var pin = document.getElementById("pin").value;
    var certificateType = document.querySelector('input[name=tipoCertificado]:checked').value;
    var fileName;
    var d = new Date();
    var token = d.getTime();
    var slotSelected;
    
    if(certificateType === "CARD"){
       var selectCerts = document.getElementById("idSelectCerts");
       slotSelected = selectCerts.options[selectCerts.selectedIndex].value;
       if(slotSelected === '-1'){
           alert(selectCerts.options[selectCerts.selectedIndex].text);
           return;
       }
    }else{ //FILE
       var selectFiles = document.getElementById("idSelectFiles");
       fileName = selectFiles.options[selectFiles.selectedIndex].value;
       if(fileName === '-1'){
           alert(selectFiles.options[selectFiles.selectedIndex].text);
           return;
       }    
    }
   
    var jsonParams = {"cmd":"getDN", 
                      "password":pin,
                      "signType":TYPE_AUTH,
                      "certificateType":certificateType,
                      "certificatePath":fileName,
                      "validationType":VALIDATION_TYPE,
                      "token":token,
                      "slot":slotSelected
                     };
                     
    var resolve = await service(jsonParams);
    var resultado = JSON.parse(resolve.data);
    
    var errorCode = resultado.ErrorCode;
    var description = resultado.Description;

    if(errorCode === 0){
        overlay(); //cerrar modal
        
        var auth = resultado.DnInfo;
        var result = "";
            result += "\n\UserDn: " + auth.UserDn;
            result += "\n\nVersion: " + auth.Version;
            result += "\n\nValidityStart: " + auth.ValidityStart;
            result += "\n\nValidityExpire: " + auth.ValidityExpire;
            result += "\n\nCertificateBase64: " + auth.CertificateBase64;
            result += "\n\nToken: " + auth.Token;
            result += "\n\nTextSigned: " + auth.TextSigned;
            
           // document.getElementById("texto").value = result;

            var inicioUsuario=auth.UserDn.indexOf("CN="); 
            var finUsuario = auth.UserDn.indexOf("(AUTENTICACION)");

            var inicioCedula=auth.UserDn.indexOf("=CPF-"); 
            var cedula= auth.UserDn.substring(parseInt(inicioCedula)+5,auth.UserDn.length);

           
           
            document.getElementById("usuario").value=auth.UserDn.substring(parseInt(inicioUsuario)+3,finUsuario);
            document.getElementById("cedula").value=cedula.replace(new RegExp("-","g"), "");

            //alert(auth.UserDn);

    }else{
        //mostrar mensaje de error
        alert(description);
    }
} 