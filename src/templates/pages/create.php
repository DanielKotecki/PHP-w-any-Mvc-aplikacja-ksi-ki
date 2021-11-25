<div>
    <h4 class="display-4">Dodawanie ksiązki</h4>
</div>
<div>
    <form action="/?action=create" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Tytuł</label>
            <input type="text" class="form-control" name="title">
        </div>
        <div class="form-group">
            <label>Opis ksiązki</label>
            <textarea class="form-control" rows="3" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Kategoria</label>
            <select class="form-control" id="exampleFormControlSelect1" name="categories">
                <?php foreach ($params['categories'] as $cat) : ?>
                    <option value="<?php echo $cat['id'] ?>"><?php echo $cat['name_categories'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="Author">Autor ksiązki</label>
            <input id="Author" class="form-control" type="text" name="author">
        </div>
        <div class="form-group">
            <label for="Pages">Ilość stron</label>
            <input id="Pages" class="form-control" type="number" name="page" value="0" min="0">
        </div>
        <div class="form-group">
            <label for="Picture">Obrazek</label>
            <input id="Picture" class="form-control" type="file" name="picture">
        </div>
        <div class="form-group">
            <input id="submit" class="btn btn-primary" type="submit" name="" value="Dodaj">
        </div>
    </form>
</div>