<?php class cart
{
    function __construct()
    {
    }

    function add($id, $quantity)
    {

        $prod = new products();
        $pros = $prod->getProductById($id);
        $img = $pros['pro_image'];
        $name = $pros['name'];
        $oldQuantity = $pros['quantity'];
        if ($pros['promotion'] == 0) {
            $unit_price = $pros['price'];
        } else {
            $unit_price = $pros['promotion'];
        }

        $total = $quantity * $unit_price;
        $item = array(
            'id' => $id,
            'img' => $img,
            'name' => $name,
            'quantity' => $quantity,
            'unit_price' => $unit_price,
            'total' => $total
        );
        if ($oldQuantity >= $quantity) {
            $flag = 0;
            foreach ($_SESSION['cart'] as $key => $element) {
                if ($element['id'] == $item['id']) {
                    $flag = 1;
                    $element['quantity'] += $item['quantity'];
                    $this->update($key, $element['quantity'], $id);
                    break;
                }
            }

            if ($flag == 0) {
                $_SESSION['cart'][] = $item;
            }
        } else {
            echo "<script>alert('Số lượng mua tối đa là $oldQuantity')</script>";
        }
    }

    function update($key, $quantity, $id)
    {
        if ($quantity <= 0) {
            $this->delete($key);
        } else {
            $pr = new products();
            $result = $pr->getProductById($id);
            $oldQuantity = $result['quantity'];
            if ($oldQuantity >= $quantity) {
                $_SESSION['cart'][$key]['quantity'] = $quantity;
                $new_total = $_SESSION['cart'][$key]['quantity'] * $_SESSION['cart'][$key]['unit_price'];
                $_SESSION['cart'][$key]['total'] = $new_total;
            } else {
                echo "<script>alert('Số lượng mua tối đa là $oldQuantity')</script>";
            }
        }
    }

    function delete($key)
    {
        unset($_SESSION['cart'][$key]);
    }
    function sum_total()
    {
        $subtotal = 0;
        foreach ($_SESSION['cart'] as $item) {
            $subtotal += $item['total'];
        }
        return number_format($subtotal, 2);
    }

    public function countCart()
    {

        if (isset($_SESSION['cart'])) {
            $count = count($_SESSION['cart']);
        } else {
            $count = 0;
        }

        return $count;
    }
}
