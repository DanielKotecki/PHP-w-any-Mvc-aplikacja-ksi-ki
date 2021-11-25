<?php

declare(strict_types=1);

namespace App\Controller\Book;

use App\Controller\AbstractController;

require_once('./src/Controller/User/sessionhelper.php');
class BookController extends AbstractController
{

    public function createAction()
    {

        if (!isLoging()) {
            header('Location:/?action=login');
        }

        if ($this->request->hasPost()) {

            $validation = $this->validCreate($this->request->postData(), $this->request->getFile('picture'));

            if ($validation['status'] == true) {
                //stworzenie nazwy nowej dla pilku userName+id+time+date
                $usernameUserSession = $_SESSION['username'];
                $idUserSession = $_SESSION['id'];
                $title = $this->request->postParam('title');
                $namePicture = 'user_name_' . $usernameUserSession . '_id_user_' . $idUserSession . '_title_book' . $title . '.' . $this->getExstensionfile($this->request->getFile('picture'));
                $namePicture = str_replace(' ', '', $namePicture);
                $plik = $this->request->getFile('picture');
                move_uploaded_file($plik['tmp_name'], 'picture/' . $namePicture);
                $this->book_model->addBook($this->request->postData(), $namePicture, (int)$idUserSession);
            }
        }

        $this->view->renderer('create', ['categories' => $this->categories_model->getCategories(), 'errorsEmpty' => $validation ?? []]);
    }
    public function listAction()
    {
        if (!isLoging()) {
            header('Location:/?action=login');
        }
        $books = $this->book_model->allbook((int)$_SESSION['id']);
        $this->view->renderer('list', ['books' => $books]);
    }
    public function deleteAction()
    {
        if (!isLoging()) {
            header('Location:/?action=login');
        }

        if ($this->request->isPost()) {
            $this->book_model->delete((int)$this->request->postParam('id_delete'), (int)$_SESSION['id']);
            header('Location:/?before=deleted');
        }
    }
    public function showAction()
    {
        if (!isLoging()) {
            header('Location:/?action=login');
        }

        $book_id = (int)$this->request->getParam('id');
        if (!$book_id) {
            header("Location:/?error=missingId");
        }
        $book = $this->book_model->book($book_id, (int)$_SESSION['id']);
        $this->view->renderer('show', [$book]);
    }
    public function statusAction()
    {
        if (!isLoging()) {
            header('Location:/?action=login');
        }
        if ($this->request->isGet()) {
            dump('jest GET');
            $id_book = (int)$this->request->getParam('id');
            $is_read = (bool)$this->request->getParam('is_read');
            $id_user = (int)$_SESSION['id'];
            $this->book_model->is_read($id_book, $id_user, $is_read);
            header("Location:/?action=show&id={$id_book}");
        }
    }

    private function validCreate(array $postData, $file_input): array
    {
        foreach ($postData as $key => $input) {
            if (empty($input)) {
                switch ($key) {
                    case 'title':
                        $titleError = 'Pole tytuł jest wymagane';
                        break;
                    case 'description':
                        $descriptionError = 'Pole opis jest wymagane';
                        break;
                    case 'categories':
                        $categoriesError = 'Pole kategori jest wymagane';
                        break;
                    case 'author':
                        $authorError = 'Pole autora jest wymagane';
                        break;
                    case 'page':
                        $pageError = 'Pole jest wymagane';
                        break;
                }
            }

            if (!empty($input)) {
                switch ($key) {
                    case 'title':
                        //sprawdzić czy użytkownik posiada już tą ksiązkę
                        if ($this->book_model->checkBook($input, (int)$_SESSION['id'])) {
                            $titleError = 'Ksiązka o podanym tytule istnieje już.';
                            break;
                        }
                        break;
                }
            }
        }
        if (empty($file_input['name'])) {
            $file_emptyError = 'Pole zdjęcia jest wymagane';
        }
        $allowedpicture = ['jpg', 'png', 'jpeg'];
        if (!in_array($this->getExstensionfile($file_input), $allowedpicture)) {
            $file_ext_Error = "Złe rozszerzenie pliku";
        }

        if (
            isset($titleError) ||
            isset($descriptionError) ||
            isset($categoriesError) ||
            isset($authorError) ||
            isset($pageError) ||
            isset($file_emptyError) ||
            isset($file_ext_Error)
        ) {
            $status = false;
        }


        return [
            'status' => $status ?? true,
            'titleError' => $titleError ?? '',
            'descriptionError' => $descriptionError ?? '',
            'categoriesError' => $categoriesError ?? '',
            'authorError' => $authorError ?? '',
            'pageError' => $pageError ?? '',
            'fileEmptyError' => $file_emptyError ?? '',
            'file_ext_Error' => $file_ext_Error ?? ''
        ];
    }
    private function getExstensionfile(array $fileInput): string
    {
        $fileExt = explode('.', $fileInput['name']);
        $fileActualExt = strtolower(end($fileExt));
        return $fileActualExt;
    }
}
