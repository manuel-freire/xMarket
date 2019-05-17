$(document).ready(function(){


    $("#nombre").change(function(){
        var url ="js/comprobarUsuario.php?nombre=" + $("#nombre").val();
        if($("#nombre").val().length <= 20) $.get(url, usuarioExiste);
        else {
            $("#nombre").style.backgroundColor="red";
            $("#nombre").focus();
        }
    });

    function usuarioExiste(data,status) {
        //console.log($.trim(data));
		if ($.trim(data) == "existe") {
            $("#nombre").style.backgroundColor="red";
			$("#nombre").focus(); //Devuelvo el foco
		} else $("#nombre").style.backgroundColor="green";

	}
});