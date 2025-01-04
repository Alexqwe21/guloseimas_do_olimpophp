<form action="<?php echo BASE_URL . 'produtos/atualizar'; ?>" method="POST">
    <input type="hidden" name="id_produto" value="<?php echo $produto['id_produto']; ?>">
    <label for="status">Status:</label>
    <select name="status" id="status">
        <option value="Ativo" <?php echo $produto['status_produto'] === 'Ativo' ? 'selected' : ''; ?>>Ativo</option>
        <option value="Inativo" <?php echo $produto['status_produto'] === 'Inativo' ? 'selected' : ''; ?>>Inativo</option>
    </select>
    <button type="submit">Salvar</button>
</form>