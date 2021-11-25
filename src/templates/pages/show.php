<div>
    <h4 class="display-4">Szczegóły</h4>
</div>
<br>
<div class="row">
    <div class="col-4">
        <div class="container">
            <img src="picture/<?php echo $params[0]['file_name'] ?>" width="450" height="640" alt="" srcset="">
        </div>



    </div>

    <div class="col">
        <h4><b>Status czytania:</b></h4>
        <?php if ($params[0]['is_read'] == true) : ?>
            <h5>Przeczytana: <a href="/?action=status&id=<?php echo $params[0]['id'] ?>&is_read=<?php echo $params[0]['is_read'] ?>"><button class=" btn btn-sm btn-primary">Zmień status</button></a></h5>

        <?php else : ?>
            <h5>Nie przeczytana: <a href="/?action=status&id=<?php echo $params[0]['id'] ?>&is_read=<?php echo $params[0]['is_read'] ?>"><button class=" btn btn-sm btn-primary">Zmień status</button></a></h5>
        <?php endif; ?>
        <hr>
        <h4><b>Tytuł:</b></h4>
        <h5><?php echo $params[0]['title'] ?></h5>
        <hr>

        <h4><b>Autor:</b></h4>
        <h5><?php echo $params[0]['author'] ?></h5>
        <hr>
        <h4><b>Kategoria:</b></h4>
        <h5><?php echo $params[0]['name_categories'] ?></h5>
        <hr>
        <h4><b>Ilość stron:</b></h4>
        <h5><?php echo $params[0]['page'] ?></h5>
        <hr>
        <h4><b>Opis:</b></h4>
        <h5><?php echo $params[0]['description'] ?></h5>
        <hr>
    </div>
</div>