<?php

namespace Bavix\Wallet\Test\Models;

use Bavix\Wallet\Interfaces\Customer;
use Bavix\Wallet\Interfaces\Product;
use Bavix\Wallet\Traits\HasWallet;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 *
 * @package Bavix\Wallet\Test\Models
 * @property string $name
 * @property int $quantity
 * @property int $price
 */
class Item extends Model implements Product
{

    use HasWallet;

    /**
     * @var array
     */
    protected $fillable = ['name', 'quantity', 'price'];

    /**
     * @param Customer $customer
     *
     * @return bool
     */
    public function canBuy(Customer $customer): bool
    {
        return $this->quantity > 0 && !$customer->paid($this);
    }

    /**
     * @return int
     */
    public function getAmountProduct(): int
    {
        return $this->price;
    }

    /**
     * @return array|null
     */
    public function getMetaProduct(): ?array
    {
        return null;
    }

}
