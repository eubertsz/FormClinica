<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas</title>
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
    <?php
        include 'conexao.php';

        $data_consul = $_POST["data_consul"] ?? '';
        $hora_consul = $_POST["hora_consul"] ?? '';
        $nome_medico = $_POST["nome_medico"] ?? '';
        $nome_paciente = $_POST["nome_paciente"] ?? '';
        $especialidade = $_POST["especialidade"] ?? '';

        $erros = [];

        if (empty($data_consul)) {
            $erros[] = "A data da consulta não pode estar vazia.";
        }

        if (empty($hora_consul)) {
            $erros[] = "A hora da consulta não pode estar vazia.";
        }

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
    ?>
    <div class="container mt-4">
        <form method="POST">
            <div class="mb-3">
                <label for="data_consul" class="form-label fw-bold">Data de Consulta</label> 
                <input type="date" class="form-control" id="data_consul" name="data_consul" required>
            </div>

            <div class="mb-3">
                <label for="hora_consul" class="form-label fw-bold">Hora da Consulta</label>
                <input type="time" class="form-control" id="hora_consul" name="hora_consul" required>
            </div>

            <div class="mb-3">
                <label for="nome_medico" class="form-label fw-bold">Nome do Médico</label>
                <input type="text" class="form-control" id="nome_medico" name="nome_medico" required>
            </div>

            <div class="mb-3">
                <label for="nome_paciente" class="form-label fw-bold">Nome do Paciente</label>
                <input type="text" class="form-control" id="nome_paciente" name="nome_paciente" required>
            </div>

            <div class="mb-3">
                <label for="especialidade" class="form-label fw-bold">Especialidade</label>
                <select class="form-select" id="especialidade" name="especialidade" required>
                    <option value="">Selecione uma especialidade</option>
                    <option value="Pediatria">Pediatria</option>
                    <option value="Pneumologia">Pneumologia</option>
                    <option value="Psiquiatria">Psiquiatria</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Agendar Consulta</button>
        </form>
    </div>

    <!-- Script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
