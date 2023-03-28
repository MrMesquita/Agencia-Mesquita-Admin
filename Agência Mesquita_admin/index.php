<?php
    include('Mysql.php');
    $sobre = $pdo->prepare("SELECT * FROM `tb_sobre`");
    $sobre->execute();
    $sobre = $sobre->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Painel de Controle</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

</head>
<body>

     <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Agência Mesquita</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul id="menu-principal" class="nav navbar-nav">
            <li class="active"><a href="#" ref_sys="sobre">Editar Sobre</a></li>
            <li><a href="#" ref_sys="cadastrar_equipe">Cadstrar Equipe</a></li>
            <li><a href="#" ref_sys="lista_equipe">Lista Equipe</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li><a href=""><span class="glyphicon glyphicon-off"></span> Sair</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
        <div class="container">
            <div class="row">

                <div class="col-md-9">
                    <h2><span class="glyphicon glyphicon-cog" aria-hiden="true"></span> Painel de Controle</h2>
                </div>

                <div class="col-md-3">
                    <p><span class="glyphicon glyphicon-time"></span> Seu último login foi em: 20/03/2023</p>
                </div>

            </div><!----row------>
        </div><!----container---->
    </header>

    <section class="bread">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                     <li class="breadcrumb-item active" aria-current="page">Home</li>
                 </ol>
            </nav>
        </div><!---container---->
    </section>

    <section class="principal">
        <div class="container">
            <div class="row">

                <div class="col-md-3">    
                    <div class="list-group active cor-padrao">
                      <a class="list-group-item list-group-item-action cor-padrao" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home" ref_sys="sobre"><span class="glyphicon glyphicon-pencil"></span>  Sobre</a>
                      <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile" ref_sys="cadastrar_equipe"><span class="glyphicon glyphicon-plus-sign"></span>  Cadastrar Equipe</a>
                      <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages"ref_sys="lista_equipe"><span class="glyphicon glyphicon-list-alt" ></span>  Lista Equipe<span class="badge badge-primary badge-pill">4</span></a>
                    </div>
                </div>

                <div class="col-md-9">
                        <?php
                            if (isset($_POST['editar_sobre'])) {
                                $sobre1 = $_POST['sobre'];
                                $pdo->exec("DELETE FROM `tb_sobre`");
                                $sql = $pdo->prepare("INSERT INTO `tb_sobre` VALUES (null,?)");
                                $sql->execute(array($sobre1));
                                 echo "<div class='alert alert-success' role='alert'>O código HTML <b>Sobre</b> foi editado com sucessso!</div>";
                                 $sobre1 = $pdo->prepare("SELECT * FROM `tb_sobre`");
                                 $sobre1->execute();
                                 $sobre1 = $sobre1->fetch()['sobre'];
                              }  
                        ?>
                    <div id="sobre_section" class="panel panel-default">
                        <div class="panel-heading cor-padrao">
                            <h3 class="panel-title">Sobre</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="email">Código Html:</label>
                                    <textarea name="sobre"style="width:100%;height: 120px;resize: vertical;" class="form-control"><?php echo $sobre['sobre'];?></textarea>
                                </div>
                            <input type="hidden" name="editar_sobre" />
                            <button type="submit" class="btn btn-default">Editar sobre</button>
                            </form>
                        </div>
                    </div><!----panel---->
                    <?php
                        if (isset($_POST['adicionar_membro'])) {
                            $nome_membro = $_POST['nome_membro'];
                            $descricao_membro = $_POST['descricao_membro'];
                            $membro = $pdo->prepare("INSERT INTO `tb_equipe` VALUES (null,?,?)");
                            $membro->execute(array($nome_membro,$descricao_membro));
                            echo "<div class='alert alert-success' role='alert'>O membro <b>".$nome_membro."</b> foi adicionado com sucessso!</div>";
                        }
                    ?>
                    <div id="cadastrar_equipe_section" class="panel panel-default">
                        <div class="panel-heading cor-padrao">
                            <h3 class="panel-title">Cadastrar Equipe:</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="email">Nome do Membro:</label>
                                    <input type="text" name="nome_membro" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="email">Descrição do Membro:</label>
                                    <textarea name="descricao_membro" style="height: 120px;resize: vertical;" class="form-control"></textarea>
                                </div>
                                <input type="hidden" name="adicionar_membro">
                                <button type="submit" class="btn btn-default">Adicionar</button>
                            </form>
                            
                        </div><!----panel-body----->
                    </div><!----panel---->

                    <div id="lista_equipe_section"class="panel panel-default">
                        <div class="panel-heading cor-padrao">
                            <h3 class="panel-title">Membros da Equipe</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">ID</th>
                                  <th scope="col">Nome do membro:</th>
                                  <th>#</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                    $sql = $pdo->prepare("SELECT `id`,`nome` FROM `tb_equipe`");
                                    $sql->execute();
                                    $equipe = $sql->fetchAll();
                                    foreach ($equipe as $key => $value) {
                                ?>
                                <tr>
                                  <td><?php echo $value['id'];?></td>
                                  <td><?php echo $value['nome'];?></td>
                                  <td><button id_membro="<?php echo $value['id']; ?>"type="button" class="deletar-membro btn btn-danger"><span class=" glyphicon glyphicon-trash"></span> Excluir</button></td>
                                </tr>

                                <?php } ?>
                              </tbody>
                            </table>
                        </div><!---panel-body--->
                    </div><!----panel---->
                </div><!----col-md-9---->
            </div><!----row------>
        </div><!-----container----->
    </section>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript">
      $(function(){

        cliqueMenu();
        scrollItem();
        function cliqueMenu(){
            $('#menu-principal a, .list-group a').click(function(){
                $('.list-group a').removeClass('active').removeClass('cor-padrao');
                $('#menu-principal a').parent().removeClass('active').removeClass('cor-padrao');
                $('#menu-principal a[ref_sys='+$(this).attr('ref_sys')+']').parent().addClass('active');
                $('.list-group a[ref_sys='+$(this).attr('ref_sys')+']').addClass('active').addClass('cor-padrao');
                return false;
            })
        }

        function scrollItem(){
            $('#menu-principal a, .list-group a').click(function(){
                var ref = '#'+$(this).attr('ref_sys')+'_section';
                var offset = $(ref).offset().top;
                $('html,body').animate({'scrollTop':offset-75});
                if($(window)[0].innerWidth <= 768){
                $('.icon-bar').click();
                }
            });
        }


        $('button.deletar-membro').click(function(){
            var id_membro = $(this).attr('id_membro');
            var el = $(this).parent().parent();
            $.ajax({
                method:'post',
                data:{'id_membro':id_membro},
                url:'deletar.php'
            }).done(function(){
                el.fadeOut(function(){
                    el.remove();
                });

            })

        })

      })
  </script>
</body>
</html>