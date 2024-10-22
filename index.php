<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
    <div class="container mt-5">
        <h1 class="text-center text-white">Cadastro de Paciente</h1>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                include 'conexao.php';

                $nome = $_POST["nome"];
                $data_nascimento = $_POST["data_nascimento"];
                $email = $_POST["email"];
                $telefone = $_POST["telefone"];
                $endereco = $_POST["endereco"];
                $sexo = $_POST["sexo"];
                
                $erros = [];

                if (empty($nome)) {
                    $erros[] = "O nome não pode estar vazio.";
                }

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $erros[] = "E-mail inválido.";
                }

                if (!preg_match('/^[0-9]{10,11}$/', $telefone)) {
                    $erros[] = "Telefone deve conter apenas números e ter 10 ou 11 dígitos.";
                }

                $data_atual = new DateTime();
                $data_nasc = new DateTime($data_nascimento);
                $idade = $data_atual->diff($data_nasc)->y;


                if ($idade < 18) {
                    $erros[] = "O paciente deve ser maior de idade.";
                }
                if (empty($erros)) {
                    $sql = "INSERT INTO pacientes (nome, data_nascimento, email, telefone, endereco, sexo) 
                            VALUES ('$nome', '$data_nascimento', '$email', '$telefone', '$endereco', '$sexo')";
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
                <label for="nome" class="form-label text-white fw-bold">Nome Completo</label> 
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>

            <div class="mb-3">
                <label for="data_nascimento" class="form-label text-white fw-bold">Data de Nascimento</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label text-white fw-bold">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="telefone" class="form-label text-white fw-bold">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" required maxlength="11" pattern="\d{10,11}">
            </div>

            <div class="mb-3">
                <label for="endereco" class="form-label text-white fw-bold">Endereço</label>
                <input type="text" class="form-control" id="endereco" name="endereco">
            </div>

            <div class="mb-3">
                <label for="sexo" class="form-label text-white fw-bold">Sexo</label>
                <select class="form-select" id="sexo" name="sexo" required>
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                    <option value="outro">Outro</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Cadastrar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
