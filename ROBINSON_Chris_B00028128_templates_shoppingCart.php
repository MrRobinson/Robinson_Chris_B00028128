<div class="column_container">
    <section class="aside">
        <h1>Shopping Cart</h1>
        <table>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Sub Total</th>
                <th>(Remove From Cart)</th>
            </tr>
            <?php
            $total = 0;
            $discount = 0;
            foreach($shoppingCart as $YarnId=>$quantity):
                $product = \Itb\Yarn::getOneById($YarnId);
                $subTotal = $product->getYarnPrice() * $quantity;
                $discount = number_format($subTotal) / 10;
                $total += $subTotal - $discount;
                ?>
                <tr>
                    <td><?= $product->getYarnName() ?></td>
                    <td>&euro; <?= $product->getYarnPrice() ?></td>
                    <td><?= $quantity ?></td>
                    <td><?= $subTotal?></td>
                    <td><a href="/index.php?action=removeFromCart&id=<?= $product->getYarnId() ?>">(Remove From Cart)</a></td>
                </tr>
                <?php
            endforeach;
            ?>
            <tr>
                <td colspan="3">10% Discount: </td>
                <?php if ($discount == 0 ){?>
                    <td>&euro; <?= $discount ?></td>
                    <?php
                } else { ?>
                    <td>- &euro; <?= $discount ?></td>
                    <?php
                }?>
                <td></td>
            </tr>
            <tr>
                <td colspan="3">Total:</td>
                <td>&euro; <?= $total ?></td>
                <td></td>
            </tr>
        </table>
    </section>
</div>
