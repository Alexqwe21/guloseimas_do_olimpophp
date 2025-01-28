<style>
    #lado_a_lado {
        display: flex;
        justify-content: space-between;
    }

    #cancelar {

        background-color: red;
        border: black;
    }



    .lado {
        display: flex;
    }

    div img {
        margin-right: 10px;
    }

    button {
        margin-right: 10px;
    }
</style>


<form action="http://localhost/guloseimas_do_olimpophp/public/produtos/adicionar" method="POST" enctype="multipart/form-data">

    <div class="lado">

        <!-- Seção de Imagem -->
        <div class="col-md-3 text-center">
            <img id="preview-img" src="http://localhost/kioficina/public/uploads/sem_foto.png" alt="imagem do Serviço"
                style="width: 100%; cursor:pointer;" title="Clique na imagem para selecionar uma foto do serviço">
            <input type="file" name="foto_produto" id="foto_produto" style="display: none;">
        </div>

        <div class="container">
            <!-- Nome do Serviço -->
            <div class="mb-3">
                <label for="nome_produto" class="form-label">Nome do serviço</label>
                <input type="text" class="form-control" name="nome_produto" id="nome_produto" placeholder="Nome Produto">
            </div>

            <!-- Descrição do Serviço
            <div class="mb-3">
                <label for="descricao_servico" class="form-label">Descrição do serviço</label>
                <textarea class="form-control" name="descricao_servico" id="descricao_servico" rows="3" placeholder="Descrição detalhada do serviço"></textarea>
            </div> -->

            <!-- Preço, Tempo Estimado e Status -->
            <div class="mb-3" id="lado_a_lado">
                <div>
                    <label for="preco_produto" class="form-label">Preço base</label>
                    <input type="text" class="form-control" name="preco_produto" id="preco_produto" placeholder="Preço base do produto">
                </div>
                <!-- <div>
                    <label for="tempo_estimado_servico" class="form-label">Tempo Estimado</label>
                    <input type="time" class="form-control" name="tempo_estimado_servico" id="tempo_estimado_servico" placeholder="Tempo estimado para o serviço">
                </div> -->
                <div>
                    <label for="status_pedido" class="form-label">Status do produto</label>
                    <select name="status_pedido" id="status_pedido" class="form-select">
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                    </select>
                </div>
                <div>
                    <label for="id_categoria" class="form-label">Categoria Existente</label>
                    <select class="form-select" name="id_categoria" id="id_categoria" aria-label="Seleção de categoria">
                        <option selected disabled>--Selecione--</option>
                        <?php foreach ($Todascategorias as $categorias): ?>
                            <option value="<?php echo $categorias['id_categoria']; ?>"><?php echo $categorias['nome_categoria']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Caso a especialidade não exista -->
            <div class="mb-3">
                <label for="nova_categoria" class="form-label">Se não existir a especialidade desejada, informe no campo abaixo:</label>
                <input type="text" class="form-control" name="nova_categoria" id="nova_categoria" placeholder="Informe a nova categoria">
            </div>

            <!-- Botões -->
            <button type="submit" class="btn btn-primary">Salvar</button>
            <button type="reset" class="btn btn-secondary" id="cancelar">Cancelar</button>
        </div>
    </div>

</form>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        const visualizarimg = document.getElementById('preview-img');
        const arquivo = document.getElementById('foto_produto');


        visualizarimg.addEventListener('click', function() {
            arquivo.click()
        })

        arquivo.addEventListener('change', function() {
            if (arquivo.files && arquivo.files[0]) {
                let render = new FileReader();
                render.onload = function(e) {
                    visualizarimg.src = e.target.result
                }

                render.readAsDataURL(arquivo.files[0]);
            }
        })

    })
</script>