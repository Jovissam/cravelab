<?php
require_once("connection.php");
class Product extends Database
{
    private function query($stmt)
    {
        $result = $this->getconnection()->query($stmt);
        return $result;
    }

    public function all() // view all products
    {
        $stmt = "SELECT  products.id, products.name, categories.name AS category, products.description, products.price, products.image
                 FROM products JOIN categories ON products.categoryId = categories.id";
        return $this->query($stmt);
    }

    public function view($id) // view 1 product
    {
        $stmt = "SELECT  products.id, products.name, categories.name AS category, products.description, products.price, products.image
                 FROM products JOIN categories ON products.categoryId = categories.id WHERE products.id= $id";
        return $this->query($stmt);
    }

    public function add($name, $description, $price, $image, $category)  //insert products
    {
        $stmt = "INSERT INTO products (name, description, price, image, categoryId)";
        $stmt .= "VALUES('$name', '$description', '$price', '$image', '$category')";
        return $this->query($stmt);
    }

    public function updateProductDetails($id, $name, $description, $price, $category) // update product details
    {
        $stmt = "UPDATE products SET name = '$name', description = '$description', price = $price, categoryId = $category
                 WHERE id = $id";
        return $this->query($stmt);
    }

    public function updateProductImage($id, $image) // update product image
    {
        $stmt = "UPDATE products SET image = '$image' WHERE id = $id";
        return $this->query($stmt);
    }

    public function delete($id)
    {
        $stmt = "DELETE FROM products WHERE id = $id";
        return $this->query($stmt);
    }

    public function getPrice($values)
    {
        $statement = "SELECT SUM(price) AS total FROM products WHERE id IN $values ";
        return $this->query($statement);
    }
}

class category extends Database
{
    private function query($stmt)
    {
        $result = $this->getconnection()->query($stmt);
        return $result;
    }
    public function all()
    {
        $stmt = "SELECT * FROM categories";
        return $this->query($stmt);
    }
}
