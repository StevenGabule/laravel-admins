<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Order
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereEmail($value)
 * @method static Builder|Order whereFirstName($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order whereLastName($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Collection|OrderItem[] $orderItems
 * @property-read int|null $order_items_count
 * @property-read mixed $name
 * @property-read mixed $total
 */
class Order extends Model
{
    protected $guarded = ['id'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getTotalAttribute()
    {
        return $this->orderItems->sum(function(OrderItem $item) {
            return $item->price * $item->quantity;
        });
    }

    public function getNameAttribute()
    {
        return $this->first_name  . ' ' . $this->last_name;
    }
}
