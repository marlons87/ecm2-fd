/* 
 * jq("#divLoading").dialog({
                autoOpen: false
});*/


function overlay() {
	alert("Hola Mundoooo!");
    var el = document.getElementById("overlay");
    el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";
    var pin = document.getElementById("pin");
    pin.value = "";
    pin.focus();
}

async function showModalAutenticacion(){
  alert("Hola Mundoooo!");
  //var modalLoading = jq('#divLoading'); 
  await verificarConexion(modalLoading);
}

function verificarConexionAjax(modalLoading){
    var codigo;
    var result;
    
    jq.ajax({
            cache: false,
            type: "post",
            url: URL_SERVICE_AJAX,
            dataType: "json",
            async: true,
            data: {
                cmd: "info"
            },
            beforeSend: function (xhr) {
                modalLoading.show();
            },
            success:function(data){
                 if(data!== null){
                    result = data; 
                    if(result.ErrorCode === 0){
                        var version = parseFloat(result.Version);
//                        if(version < VERSION_COMPONENTE){
//                            //version desactualizada del componente
//                            codigo = 1;
//                        }else{
                            codigo = 0;
//                        }
                    }
                 }
                 modalLoading.hide();
                 varificarResultado(codigo);
            },
            error:function(jqXHR, status, error){
                codigo = 2;  
                modalLoading.hide();
                varificarResultado(codigo);
            }
        });
    
}

function verificarConexion(modalLoading){
	var modalLoading = jq('#divLoading');    
	var result = "";
	var jsonParams = {"cmd":"info"};
	var codigo = 2;
	
	var ws = new WebSocket(URL_SERVICE);
	
	return new Promise(function(resolve, reject){
		ws.onopen = function() {
		    modalLoading.show();
		    ws.send(JSON.stringify(jsonParams));
		};
		
		ws.onmessage = function (evt) {
		    result = JSON.parse(evt.data);
		    
		    if(result.ErrorCode === 0){
	            var version = parseFloat(result.Version);
	            codigo = 0;
	            modalLoading.hide();
	            varificarResultado(codigo);
	        }
		    resolve();
		};
		
		ws.onclose = function() {
		    //modalLoading.hide();
		};

		ws.onerror = function(err) {
			codigo = 2;
			modalLoading.hide();
		    varificarResultado(codigo);
		    reject();
		};
	});
}

function varificarResultado(codigo){
    if(codigo === 0){
        overlay(); //mostrar modal autenticacion
        typeCertificate();
    }else{ //Manejar mensajes de error.
        if(codigo === 1){
            alert("Su equipo dispone de una versión desactualizada del componente de firma digital. \n\
                                    Por favor proceda a actualizar el componente de firma digital."); 
        }else {
            alert("Error de conexión con el componente de firma digital.\n\Favor verifique que tenga instalado el componente de firma digital.");
        }
        var cfm = confirm("Desea descargar el instalador del componente de firma digital?");
        if (cfm === true) {
            //Descargar el instalador del componente
            downloadComponente("http://www.mer-link.co.cr/atDocs/Instalador_Componente_Firma.msi", "Instalador Componente Firma.msi");
        }
    }
}

function typeCertificate(){
    var certificateType = document.querySelector('input[name=tipoCertificado]:checked').value;
    var divFiles = document.getElementById("divFiles");
    var divCerts = document.getElementById("divSmartCard"); 
    

    if(certificateType === "FILE"){
        divCerts.style.display = "none";
        divFiles.style.display = "block";
        certificatesFiles();
    }else{
        divFiles.style.display = "none";
        divCerts.style.display = "block";
        smartCardCertificates();
    }
}

async function certificatesFiles(){
    var jsonParams = {"cmd":"certificatesFiles"};
    var resolve = await service(jsonParams);
    var resultado = JSON.parse(resolve.data);
    //var resultado = await service(jsonParams).data;
    var errorCode = resultado.ErrorCode;
    var description = resultado.Description;

    if(errorCode === 0){
       var divCerts = document.getElementById("divCertFiles"); 
       var objCerts = resultado.Certificados;
      
       var htmlNameFiles = "<select id='idSelectFiles'>";
       
       if(objCerts.length >= 1){
           if(objCerts.length > 1){
               htmlNameFiles += "<option value='-1' disabled selected hidden>Seleccione su certificado</option>";
           }
           for (var i = 0; i < objCerts.length; i++) {
               htmlNameFiles += "<option value='"+objCerts[i]+"'>"+objCerts[i]+"</option>";
           }
       }else{
           htmlNameFiles += "<option value='-1' disabled selected hidden>No se han encontrado certificados</option>";
       }
       
       htmlNameFiles += "</select>";
       divCerts.innerHTML = htmlNameFiles;
    }else{
        //mostrar mensaje de error
        alert(description);
    }
}

async function smartCardCertificates(){
    var jsonParams = {"cmd":"smartCardCertificates"};
                  
    var resolve = await service(jsonParams);
    var resultado = JSON.parse(resolve.data);
    var errorCode = resultado.ErrorCode;
    var description = resultado.Description;

    if(errorCode === 0){
       var divCerts = document.getElementById("divSmartCardCerts"); 
       var objCerts = resultado.Certificados;

       var htmlCerts = "<select id='idSelectCerts'>";
       
       if(objCerts.length >= 1){
           if(objCerts.length > 1){
               htmlCerts += "<option value='-1' disabled selected hidden>Seleccione su certificado </option>";
           }
           for (var i = 0; i < objCerts.length; i++) {
               htmlCerts += "<option value='"+objCerts[i].slot+"'>"+objCerts[i].titularCertificado+"</option>";
           }
       }else{
           htmlCerts += "<option value='-1' disabled selected hidden>No se han detectado tarjetas conectadas</option>";
       }
       
       htmlCerts += "</select>";
        
       divCerts.innerHTML = htmlCerts;

    }else{
        //mostrar mensaje de error
        alert(description);
    }
}
*/
