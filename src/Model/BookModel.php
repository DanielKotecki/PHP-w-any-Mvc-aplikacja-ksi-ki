<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\AbstractModel;
use PDO;

class BookModel extends AbstractModel
{
    public function addBook(array $dataBook, string $fileName, int $idUser): void
    {
        $statment = $this->connection->prepare("INSERT INTO book (title,description,categories,author,page,file_name,is_read,user_id) VALUES(:title,:description,:categories,:author,:page,:file_name,:is_read,:user_id)");
        $statment->execute([
            'title' => $dataBook['title'],
            'description' => $dataBook['description'],
            'categories' => (int)$dataBook['categories'],
            'author' => $dataBook['author'],
            'page' => (int)$dataBook['page'],
            'file_name' => $fileName,
            'is_read' => 0,
            'user_id' => $idUser
        ]);
    }
    public function allbook(int $id_user): array
    {
        $querySelect = "SELECT book.id,book.title,c.name_categories,book.is_read,book.user_id FROM book join categories as c on book.categories=c.id  WHERE book.user_id={$id_user}";
        $result = $this->connection->query($querySelect);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function delete(int $book_id, int $user_id)
    {
        $query_delete = "DELETE FROM book WHERE id={$book_id} AND user_id={$user_id}";
        $this->connection->exec($query_delete);
    }

    public function book(int $id_book, int $id_user): array
    {
        try {
            $queryBookSelect = "SELECT book.id,book.title,book.description,book.categories,book.author,book.page,book.file_name,book.is_read,book.user_id,c.name_categories From book  join categories as c on book.categories=c.id 
         WHERE book.id={$id_book} AND book.user_id={$id_user} LIMIT 1";
            $result = $this->connection->query($queryBookSelect);
            $result = $result->fetch(PDO::FETCH_ASSOC);

            return $result;
        } catch (\Throwable $th) {
            dump($th->getMessage());
        }
    }
    public function is_read(int $id_book, int $id_user, bool $read): void
    {

        if ($read) {
            $read = 0;
        } else {
            $read = true;
        }
        $queryRead = "UPDATE book SET is_read={$read} WHERE id={$id_book} AND user_id={$id_user}";
        dump($queryRead);

        $this->connection->exec($queryRead);
    }
    public function checkBook(string $title, int $id_user): bool
    {
        $queryCheck = "SELECT * from book Where title='{$title}'AND user_id={$id_user} ";
        $result = $this->connection->query($queryCheck);
        $result = $result->fetch(PDO::FETCH_ASSOC);

        if ($result == null) {
            return false;
        }
        return true;
    }
}
