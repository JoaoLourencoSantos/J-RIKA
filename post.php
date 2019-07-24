<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/post.css">
    <link rel="icon" type="imagem/png" href="assets/icon.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>JÉRIKA</title>
</head>

<body>
    

    <header class="header">
        <img src="assets/logo2.png" alt="" id="logo">
        <nav>
            <ul>
                <li> <a href="index.html">Home</a></li>
                <li> <a href="post.html">Posts </a></li>
                <li> <a href="sobre.html">Sobre Nós</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <header>
                <span>Postagens</span>                
            </header>
            <main>
                    <?php
                    // importando os objetos que precisarei, como conexão para fzer leitura
                    require('PHP/conexao.php');
                    //Try que roda o tamanho do banco e retorna dos dados em suas respectivas posições 
                    try {
                        $stmt = conectDB()->prepare("SELECT * FROM POSTAGENS");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                //pegando parte da string da imagem, tirando o desnecessário
                                $nome = $rs->IMAGEM_POST;
                                $parte = substr($nome, 3);
                                //imprimindo os articles/posts
                                echo "  <article>"
                                        ."<div><img src='".$parte."' alt='Olá'></div>"
                                        ."<div><span>".$rs->CONTEUDO_POST."</span>"
                                        ."<span>".$rs->DATA_POST."</span></div>"
                                        ."</article>";
                            }
                        } else {
                            echo "Erro: Não foi possível recuperar os dados do banco de dados";
                        }
                    } catch (PDOException $erro) {
                        echo "Erro: ".$erro->getMessage();
                    }
                    ?>     
            </main>

        </section>

        <section>
            <div id="titulo-comentario"> Postar</div>

            <form id="conteudo1" action="PHP/conexao.php?type=1" method="POST"  enctype="multipart/form-data" >
                <input hidden type="number" value="5"  name="id-post">
                <input hidden type="number" value="5"  name="id-user">
                <input hidden type="number" value="10" name="curtidas">
                <textarea name="postagem" placeholder="Sobre o que vamos falar hoje?"cols="30" rows="5"></textarea>
                <div id="form2">
                    <select name="categoria" id="categoria">
                        <option value="1"> Esporte </option>
                        <option value="2"> Filme   </option>
                        <option value="3"> Livro   </option>
                        <option value="4"> Moda    </option>
                        <option value="5"> Música  </option>
                        <option value="6"> Serie   </option>
                    </select>

                    <label id="imagem" for='selecao-arquivo' >
                        <img src="assets/icon-image.png ">
                    </label>
                    <input id='selecao-arquivo' type='file' name="imagem">
                    <label id="save" for='salvar'>
                        <img src="assets/icon-success.png ">
                    </label>
                    <input id='salvar' type='submit'>
                </div>

            </form>


        </section>

    </main>

    <script src="script/script.js"></script>
</body>

</html>