<?php require_once 'templates/header.php'; ?>
<h1><?php echo isset($data['title']) ? $data['title'] : 'Título por Defecto'; ?></h1>
<p><?php echo isset($data['content']) ? $data['content'] : 'Contenido por Defecto'; ?></p>
<?php require_once 'templates/footer.php'; ?>
