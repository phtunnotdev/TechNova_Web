<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use App\Models\OrderHistory;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $productVariants = ProductVariant::all();
        $users = User::where('role', 3)->get();
        for ($i = 0; $i < 10000; $i++) {
            $paymentMethod = $faker->randomElement(['cod', 'online']);
            $status = $faker->randomElement(['cxn', 'dxn', 'dgh', 'ghtc', 'ghtb', 'dh', 'dndh', 'dndh', 'dndh', 'dndh', 'dndh', 'dndh', 'dndh', 'dndh', 'dndh', 'dndh', 'dndh', 'dndh', 'dndh', 'dndh']);
            $paymentStatus = $paymentMethod === 'online' || $status === 'ghtc' || $status === 'dndh' ? 'dtt' : 'ctt';
            $randomUser = $users->random();
            $randomDateTime = $faker->dateTimeBetween('2015-01-01', '2024-12-31');
            $orderCode = "OR-".Str::random(5);
            while(Order::where('order_code', $orderCode)->exists()){
                $orderCode = "OR-".Str::random(5);
            }
            $order = Order::create([
                'order_code' => $orderCode,
                'status' => $status,
                'payment_method' => $paymentMethod,
                'payment_status' => $paymentStatus,
                'total_price' => $faker->numberBetween(1000, 5000),
                'user_name' => $randomUser->name,
                'user_phone' => $randomUser->phone,
                'user_address' => $randomUser->address,
                'user_id' => $randomUser->id,
                'created_at' => $randomDateTime,
                'updated_at' => $randomDateTime
            ]);

            switch($order->status){
                case "cxn":
                    break;
                case "dxn":
                    OrderHistory::create([
                        'from_status' => "cxn",
                        'to_status' => "dxn",
                        'note' => "Đã xác nhận",
                        'by_user' => 1,
                        'order_id' => $order->id,
                        'created_at' => $randomDateTime->modify('+1 hour'),
                        'updated_at' => $randomDateTime
                    ]);
                    break;
                case "dgh":
                    OrderHistory::create([
                        'from_status' => "cxn",
                        'to_status' => "dxn",
                        'note' => "Đã xác nhận",
                        'by_user' => 1,
                        'order_id' => $order->id,
                        'created_at' => $randomDateTime->modify('+1 hour'),
                        'updated_at' => $randomDateTime
                    ]);
                    OrderHistory::create([
                        'from_status' => "dxn",
                        'to_status' => "dgh",
                        'note' => "Đang giao hàng",
                        'by_user' => 1,
                        'order_id' => $order->id,
                        'created_at' => $randomDateTime->modify('+1 day'),
                        'updated_at' => $randomDateTime
                    ]);
                    break;
                case "ghtc":
                    OrderHistory::create([
                        'from_status' => "cxn",
                        'to_status' => "dxn",
                        'note' => "Đã xác nhận",
                        'by_user' => 1,
                        'order_id' => $order->id,
                        'created_at' => $randomDateTime->modify('+1 hour'),
                        'updated_at' => $randomDateTime
                    ]);
                    OrderHistory::create([
                        'from_status' => "dxn",
                        'to_status' => "dgh",
                        'note' => "Đang giao hàng",
                        'by_user' => 1,
                        'order_id' => $order->id,
                        'created_at' => $randomDateTime->modify('+1 day'),
                        'updated_at' => $randomDateTime
                    ]);
                    OrderHistory::create([
                        'from_status' => "dgh",
                        'to_status' => "ghtc",
                        'note' => "Giao hàng thành công",
                        'by_user' => 1,
                        'order_id' => $order->id,
                        'created_at' => $randomDateTime->modify('+2 days'),
                        'updated_at' => $randomDateTime
                    ]);
                    break;
                case "ghtb":
                    OrderHistory::create([
                        'from_status' => "cxn",
                        'to_status' => "dxn",
                        'note' => "Đã xác nhận",
                        'by_user' => 1,
                        'order_id' => $order->id,
                        'created_at' => $randomDateTime->modify('+1 hour'),
                        'updated_at' => $randomDateTime
                    ]);
                    OrderHistory::create([
                        'from_status' => "dxn",
                        'to_status' => "dgh",
                        'note' => "Đang giao hàng",
                        'by_user' => 1,
                        'order_id' => $order->id,
                        'created_at' => $randomDateTime->modify('+1 day'),
                        'updated_at' => $randomDateTime
                    ]);
                    OrderHistory::create([
                        'from_status' => "dgh",
                        'to_status' => "ghtb",
                        'note' => "Giao hàng thất bại",
                        'by_user' => 1,
                        'order_id' => $order->id,
                        'created_at' => $randomDateTime->modify('+2 days'),
                        'updated_at' => $randomDateTime
                    ]);
                    break;
                case "dndh":
                    OrderHistory::create([
                        'from_status' => "cxn",
                        'to_status' => "dxn",
                        'note' => "Đã xác nhận",
                        'by_user' => 1,
                        'order_id' => $order->id,
                        'created_at' => $randomDateTime->modify('+1 hour'),
                        'updated_at' => $randomDateTime
                    ]);
                    OrderHistory::create([
                        'from_status' => "dxn",
                        'to_status' => "dgh",
                        'note' => "Đang giao hàng",
                        'by_user' => 1,
                        'order_id' => $order->id,
                        'created_at' => $randomDateTime->modify('+1 day'),
                        'updated_at' => $randomDateTime
                    ]);
                    OrderHistory::create([
                        'from_status' => "dgh",
                        'to_status' => "ghtc",
                        'note' => "Giao hàng thành công",
                        'by_user' => 1,
                        'order_id' => $order->id,
                        'created_at' => $randomDateTime->modify('+2 days'),
                        'updated_at' => $randomDateTime
                    ]);
                    OrderHistory::create([
                        'from_status' => "ghtc",
                        'to_status' => "dndh",
                        'note' => "Đã nhận được hàng",
                        'by_user' => $randomUser->id,
                        'order_id' => $order->id,
                        'created_at' => $randomDateTime->modify('+1 day'),
                        'updated_at' => $randomDateTime
                    ]);
                    break;
                default:
                    OrderHistory::create([
                        'from_status' => "cxn",
                        'to_status' => "dh",
                        'note' => "Đã hủy",
                        'by_user' => $randomUser->id,
                        'order_id' => $order->id,
                        'created_at' => $randomDateTime->modify('+15 minutes'),
                        'updated_at' => $randomDateTime->modify('+15 minutes')
                    ]);
            }

            $totalPrice = 0;
            $orderDetailCount = rand(1, 6);
            $selectedVariants = [];
            for ($j = 0; $j < $orderDetailCount; $j++) {
                $randomProductVariant = $productVariants->random();
                while (in_array($randomProductVariant->id, $selectedVariants)) {
                    $randomProductVariant = $productVariants->random();
                }
                $selectedVariants[] = $randomProductVariant->id;
                $price = $randomProductVariant->price;
                $quantity = $faker->numberBetween(1, 6);
                $lineTotal = $price * $quantity;
                $totalPrice += $lineTotal;
                $imagePath = 'uploads/orders/order_'.$order->id."/".basename($randomProductVariant->image);
                Storage::disk('public')->copy($randomProductVariant->image, $imagePath);
                OrderDetail::create([
                    'product_name' => $randomProductVariant->product->name,
                    'product_variant_image' => $randomProductVariant->image,
                    'color_name' => $randomProductVariant->color->name,
                    'ssd_name' => $randomProductVariant->ssd->name,
                    'import_price' => $randomProductVariant->import_price,
                    'listed_price' => $randomProductVariant->listed_price,
                    'price' => $randomProductVariant->price,
                    'quantity' => $quantity,
                    'product_id' => $randomProductVariant->product->id,
                    'order_id' => $order->id
                ]);
            }
            $order->total_price = $totalPrice;
            $order->save();
        }
    }
}