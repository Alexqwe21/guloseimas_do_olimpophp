<form action="<?php echo BASE_URL . 'produtos/atualizarStatus'; ?>" method="POST">
    <input type="hidden" name="id_produto" value="<?php echo $produto['id_produto']; ?>">
    <label for="status_pedido">Status:</label>
    <select name="status_pedido" id="status_pedido">
        <option value="Ativo" <?php echo $produto['status_pedido'] === 'Ativo' ? 'selected' : ''; ?>>Ativo</option>
        <option value="Inativo" <?php echo $produto['status_pedido'] === 'Inativo' ? 'selected' : ''; ?>>Inativo</option>
    </select>
    <button type="submit">Salvar</button>
</form>