<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DataTable com Bootstrap</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.26.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.dark.min.css">
    <style>
        /* Estilos personalizados */
        #dataTable_filter input {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
        }
        body {
            background-color: #343a40; /* Cor de fundo escura */
        }

        .container {
            background-color: #fff; /* Cor de fundo clara para o conteúdo */
            border-radius: 8px; /* Borda arredondada para o container */
            padding: 20px; /* Espaçamento interno para o container */
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h1 class="mb-4">Lista de Pacientes</h1>
    <button type="button" class="btn btn-primary" data-toggle="modal" onclick="modalCadastro()">Novo Paciente</button>
    <table id="dataTable" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome Completo</th>
            <th>Nome da Mãe</th>
            <th>CPF</th>
            <th>CNS</th>
            <th>Data de Nascimento</th>
            <th>Data de Criação</th>
            <th>Data de Atualização</th>
            <th>Ações</th> <!-- Nova coluna para ações -->
        </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<!-- Modal para visualizar/Editar -->
<div class="modal fade" id="viewEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalhes do Paciente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="patientForm">
                    <input type="hidden" id="patientId" name="id" value="" readonly>
                    <div class="form-group">
                        <label for="full_name">Nome Completo</label>
                        <input type="text" class="form-control" id="full_name" name="full_name">
                    </div>
                    <div class="form-group">
                        <label for="full_name_mom">Nome da Mãe</label>
                        <input type="text" class="form-control" id="full_name_mom" name="full_name_mom" >
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" >
                    </div>
                    <div class="form-group">
                        <label for="cns">CNS</label>
                        <input type="text" class="form-control" id="cns" name="cns" >
                    </div>
                    <div class="form-group">
                        <label for="date_of_birth">Data de Nascimento</label>
                        <input type="text" class="form-control" id="date_of_birth" name="date_of_birth">
                    </div>
                    <div class="form-group">
                        <label for="cep">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep" onblur="buscarEnderecoPorCEP(this)">
                    </div>
                    <div class="form-group">
                        <label for="logradouro">Logradouro</label>
                        <input type="text" class="form-control" id="logradouro" name="logradouro">
                    </div>
                    <div class="form-group">
                        <label for="bairro">Bairro</label>
                        <input type="text" class="form-control" id="bairro" name="bairro">
                    </div>
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <input type="text" class="form-control" id="estado" name="estado">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeModalButton" onclick="fecharModal()">Fechar</button>
                <button type="button" class="btn btn-primary" id="editButton">Salvar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Cadastro de Paciente -->
<div class="modal fade" id="addPatientModal" tabindex="-1" role="dialog" aria-labelledby="addPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPatientModalLabel">Cadastrar Novo Paciente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulário de cadastro de paciente -->
                <form id="newPatientForm">
                    <div class="form-group">
                        <label for="new_full_name">Nome Completo</label>
                        <input type="text" class="form-control" id="new_full_name" name="full_name">
                    </div>
                    <div class="form-group">
                        <label for="new_full_name_mom">Nome da Mãe</label>
                        <input type="text" class="form-control" id="new_full_name_mom" name="full_name_mom">
                    </div>
                    <div class="form-group">
                        <label for="new_cpf">CPF</label>
                        <input type="text" class="form-control" id="new_cpf" name="cpf">
                    </div>
                    <div class="form-group">
                        <label for="new_cns">CNS</label>
                        <input type="text" class="form-control" id="new_cns" name="cns">
                    </div>
                    <div class="form-group">
                        <label for="new_date_of_birth">Data de Nascimento</label>
                        <input type="date" class="form-control" id="new_date_of_birth" name="date_of_birth">
                    </div>
                    <div class="form-group">
                        <label for="cep">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep" onblur="buscarEnderecoPorCEP(this)">
                    </div>
                    <div class="form-group">
                        <label for="logradouro">Logradouro</label>
                        <input type="text" class="form-control" id="logradouro" name="logradouro">
                    </div>
                    <div class="form-group">
                        <label for="bairro">Bairro</label>
                        <input type="text" class="form-control" id="bairro" name="bairro">
                    </div>
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <input type="text" class="form-control" id="estado" name="estado">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" id="submitPatientButton">Cadastrar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "ajax": {
                "url": "http://localhost/patients",
                "dataSrc": "data",
            },
            "columns": [
                { "data": "id" },
                { "data": "full_name" },
                { "data": "full_name_mom" },
                { "data": "cpf" },
                { "data": "cns" },
                { "data": "date_of_birth" },
                { "data": "created_at" },
                { "data": "updated_at" },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return '<button class="btn btn-link view-edit-button" data-id="' + data.id + '"><i class="fa fa-eye"></i></button>' +
                            ' <button class="btn btn-link delete-button" data-id="' + data.id + '"><i class="icon-trash"></i></button>';
                    }
                }
            ]
        });

        // Abrir o modal e carregar os detalhes do paciente
        $('#dataTable tbody').on('click', 'button.view-edit-button', function() {
            var patientId = $(this).data('id');
            $.ajax({
                url: "http://localhost/patients/" + patientId,
                method: "GET",
                success: function(data) {
                    var patient = data.data;
                    $('#patientId').val(patient.id);
                    $('#full_name').val(patient.full_name);
                    $('#full_name_mom').val(patient.full_name_mom);
                    $('#cpf').val(patient.cpf);
                    $('#cns').val(patient.cns);
                    $('#date_of_birth').val(patient.date_of_birth);
                    $('#viewEditModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.log("Erro ao buscar os detalhes do paciente.");
                }
            });
        });

        // Lidar com ação de edição
        // Lidar com ação de edição
        $('#editButton').on('click', function() {
            // Capturar os valores dos campos do modal de edição
            var patientId = $('#patientId').val();
            var full_name = $('#full_name').val();
            var full_name_mom = $('#full_name_mom').val();
            var cpf = limparCPF($('#new_cpf').val());
            var cns = $('#cns').val();
            var date_of_birth = $('#date_of_birth').val();
            if(!validaCPF(cpf)){
                toastr.error("CPF invalido");
                return false;
            }
            // Dados a serem enviados via PUT
            var data = {
                id: patientId,
                full_name: full_name,
                full_name_mom: full_name_mom,
                cpf: cpf,
                cns: cns,
                date_of_birth: date_of_birth
            };

            // Enviar a solicitação PUT
            $.ajax({
                url: "http://localhost/patients/" + patientId,
                method: "PUT",
                data: JSON.stringify(data),
                contentType: "application/json",
                success: function(response) {
                    toastr.success('Dados atualizados com sucesso!');
                    console.log("Dados atualizados com sucesso");
                    $('#viewEditModal').modal('hide');
                    setTimeout(function (){
                        location.reload();
                    }, 3000);

                },
                error: function(xhr, status, error) {
                    // Lógica de erro, se necessário
                    console.log("Erro ao atualizar os dados do paciente.");
                }
            });
        });

    });

    function fecharModal() {
        $('#viewEditModal').modal('hide'); // Substitua 'viewEditModal' pelo ID do seu modal
        $('#addPatientModal').modal('hide'); // Substitua 'viewEditModal' pelo ID do seu modal
    }

    // Adicionar um ouvinte de evento ao botão "Fechar" do modal
    document.getElementById('closeModalButton').addEventListener('click', function() {
        fecharModal();
    });

    function cadastrarPaciente() {
        let cpf = limparCPF($('#new_cpf').val());
        if(!validaCPF(cpf)){
            toastr.error("CPF invalido");
            return false;
        }
        var newPatientData = {
            full_name: $('#new_full_name').val(),
            full_name_mom: $('#new_full_name_mom').val(),
            cpf: cpf,
            cns: $('#new_cns').val(),
            date_of_birth: $('#new_date_of_birth').val(),
        };

        $.ajax({
            url: "http://localhost/patients",
            method: "POST",
            data: JSON.stringify(newPatientData),
            contentType: "application/json",
            success: function(response) {
                toastr.success('Paciente cadastrado com sucesso');
                $('#addPatientModal').modal('hide');
                setTimeout(function (){
                    location.reload();
                }, 3000);
            },
            error: function(xhr, status, error) {
                var responseJson = xhr.responseJSON;
                if (responseJson && responseJson.error && responseJson.errors) {
                    toastr.error(responseJson.errors.join('<br>'));
                } else if (responseJson && responseJson.error && responseJson.message) {
                    toastr.error(responseJson.message);
                } else {
                    toastr.error('Erro ao cadastrar o paciente.');
                }
            }
        });
    }

    // Adicionar um ouvinte de evento ao botão "Cadastrar"
    document.getElementById('submitPatientButton').addEventListener('click', function() {
        cadastrarPaciente();
    });

    function modalCadastro() {
        $('#addPatientModal').modal('show'); // Substitua 'viewEditModal' pelo ID do seu modal
    }
    function limparCPF(cpf) {
        return cpf.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
    }
    function validaCPF(cpf) {
        cpf = cpf.replace(/[^\d]/g, ''); // Remove caracteres não numéricos

        if (cpf.length !== 11) {
            return false; // CPF deve ter 11 dígitos
        }

        // Verifica se todos os dígitos são iguais; nesse caso, o CPF é inválido
        if (/^(\d)\1{10}$/.test(cpf)) {
            return false;
        }

        // Calcula o primeiro dígito verificador
        let soma = 0;
        for (let i = 0; i < 9; i++) {
            soma += parseInt(cpf.charAt(i)) * (10 - i);
        }
        let digito1 = 11 - (soma % 11);

        if (digito1 > 9) {
            digito1 = 0;
        }

        // Verifica o primeiro dígito verificador
        if (parseInt(cpf.charAt(9)) !== digito1) {
            return false;
        }

        // Calcula o segundo dígito verificador
        soma = 0;
        for (let i = 0; i < 10; i++) {
            soma += parseInt(cpf.charAt(i)) * (11 - i);
        }
        let digito2 = 11 - (soma % 11);

        if (digito2 > 9) {
            digito2 = 0;
        }

        // Verifica o segundo dígito verificador
        return parseInt(cpf.charAt(10)) === digito2;
    }

    function buscarEnderecoPorCEP(element) {
        // Formatar o CEP para remover caracteres não numéricos

        let cep = element.value;
        cep = cep.replace(/\D/g, '');

        // Verificar se o CEP tem o tamanho correto
        if (cep.length !== 8) {
            toastr.error('CEP inválido');
            return;
        }

        // Fazer a requisição GET para o serviço ViaCEP
        $.get('https://viacep.com.br/ws/' + cep + '/json/', function(data) {
            if (!data.erro) {
                // Preencher os campos de endereço com os dados retornados
                $('#logradouro').val(data.logradouro);
                $('#bairro').val(data.bairro);
                $('#cidade').val(data.localidade);
                $('#estado').val(data.uf);
            } else {
                toastr.error('CEP não encontrado');
            }
        });
    }

    // Adicionar um ouvinte de evento ao campo de CEP
    $('#cep').on('blur', function() {
        var cep = $(this).val();
        buscarEnderecoPorCEP(cep);
    });
</script>

</body>
</html>
