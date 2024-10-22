<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas</title>
</head>
<body>
<?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                include 'conexao.php';

                $data_consul = $_POST["data_consul"];
                $hora_consul = $_POST["hora_consul"];
                $nome_medico = $_POST["nome_medico"];
                $nome_paciente = $_POST["nome_paciente"];
                $especialidade = $_POST["especialidade"];
                
                $erros = [];

                if (empty($data_consul)) {
                    $erros[] = "O data_consul não pode estar vazio.";
                }

                if (empty($hora_consul)) {
                    $erros[] = "O data_consul não pode estar vazio.";
                }

                if (empty($nome_medico)) {
                    $erros[] = "O data_consul não pode estar vazio.";
                }

                if (empty($especialidade)) {
                    $erros[] = "O data_consul não pode estar vazio.";
                }

                $data_atual = new DateTime();
                $data_nasc = new DateTime($data_consul);

                if (empty($erros)) {
                    $sql = "INSERT INTO agendamentos (data_consul, hora_consul, nome_medico, especialidade, nome_paciente) 
                            VALUES ('$data_consul', '$hora_consul', '$nome_medico', '$especialidade', '$nome_paciente')";
                    if ($conn->query($sql) === TRUE) {
                        echo "<div class='alert alert-success'>Cadastro realizado com sucesso!</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Erro ao cadastrar: " . $conn->error . "</div>";
                    }
                    $conn->close();
                } else {
                    foreach ($erros as $erro) {
                        echo "<div class='alert alert-danger'>$erro</div>";
                    }
                }
            }
        ?>
<form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="data_consul" class="form-label text-white fw-bold">Data de Consulta</label> 
                <input type="text" class="form-control" id="data_consul" name="data_consul" required>
            </div>

            <div class="mb-3">
                <label for="hora_consul" class="form-label text-white fw-bold">Hora da Consulta</label>
                <input type="date" class="form-control" id="hora_consul" name="hora_consul" required>
            </div>

            <div class="mb-3">
                <label for="nome_medico" class="form-label text-white fw-bold">Nome do Medico</label>
                <input type="nome_medico" class="form-control" id="nome_medico" name="nome_medico" required>
            </div>

            <div class="mb-3">
                <label for="nome_paciente" class="form-label text-white fw-bold">Nome do Paciente</label>
                <input type="nome_paciente" class="form-control" id="nome_paciente" name="noem_paciente" required>
            </div>

            <div class="mb-3">
                <label for="sexo" class="form-label text-white fw-bold">Especialidade</label>
                <select class="form-select" id="sexo" name="especialidade" required>
                    <option value="Pediatria"></option>
                    <option value="Pneumologia"></option>
                    <option value="Psiquiatria"></option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Agendar Consulta</button>
        </form>
</body>
</html>