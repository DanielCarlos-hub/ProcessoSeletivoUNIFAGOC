$('.deselect-all').click(function () {
    let $select2 = $(this).parent().siblings('.select2');
    $select2.find('option').prop('selected', '');
    $select2.trigger('change');
});

$(function(e) {
	$(".date-inputmask").inputmask("date", {
		inputFormat: "dd/mm/aaaa",
		outputFormat: "yyyy-mm-dd",
		locale: "pt-BR"
	});
	$(".cpf").inputmask("999.999.999-99");
	$(".cep").inputmask("99999999");
    $(".celular").inputmask("(99) \\9-9999-9999");
    $(".telefone").inputmask(["(99) 9999-9999"]);
	$(".uf").inputmask("AA");
	
});

function validarCPF( cpf ){
	if(cpf !== ''){
		var filtro = /^\d{3}.\d{3}.\d{3}-\d{2}$/i;

		if(!filtro.test(cpf)){
			return false;
		}

		cpf = remove(cpf, ".");
		cpf = remove(cpf, "-");

		if(cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" ||
			cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" ||
			cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" ||
			cpf == "88888888888" || cpf == "99999999999"){
				return false;
		}

		soma = 0;

		for(i = 0; i < 9; i++){
			soma += parseInt(cpf.charAt(i)) * (10 - i);
		}

		resto = 11 - (soma % 11);

		if(resto == 10 || resto == 11){
			resto = 0;
		}

		if(resto != parseInt(cpf.charAt(9))){
			return false;
		}

		soma = 0;
		for(i = 0; i < 10; i ++){
			soma += parseInt(cpf.charAt(i)) * (11 - i);
		}

		resto = 11 - (soma % 11);
		if(resto == 10 || resto == 11){
			resto = 0;
		}

		if(resto != parseInt(cpf.charAt(10))){
			return false;
		}
	}
}

function remove(str, sub) {
	i = str.indexOf(sub);
	r = "";
	if (i == -1) return str;
	{
		r += str.substring(0,i) + remove(str.substring(i + sub.length), sub);
	}

	return r;
}


$('#cpf').on("blur", function(){
	var cpf = $(this).val()
	console.log($(this).val())
	$.ajax({
		url: "http://localhost/admin/users/cpf/validar",
		data: {cpf: cpf},
		type: "GET",
		success: function(response){
			$('#cpf').addClass('is-invalid');
			$('#cpfValidate').addClass('invalid-feedback').html(response).css('display', 'block');
		},
		error: function (xhr){
			//
		}
	});
});

function datetimePTBR(datetime)
{
    return moment(datetime).format('DD/MM/YYYY hh:mm');
}

function datePTBR(date)
{
    return moment(date).format('DD/MM/YYYY');
}