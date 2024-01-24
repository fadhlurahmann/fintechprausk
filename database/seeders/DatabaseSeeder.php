<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Role;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'bank'
        ]);

        Role::create([
            'name' => 'kantin'
        ]);

        Role::create([
            'name' => 'siswa'
        ]);
        User::create([
            'name' => 'bank',
            'username' => 'bank',
            'password' => Hash::make('bank'), 
            'role_id' => 2
        ]);
        User::create([
            'name' => 'kantin',
            'username' => 'kantin',
            'password' => Hash::make('kantin'),
            'role_id' => 3
        ]);
        User::create([
            'name' => 'siswa',
            'username' => 'siswa',
            'password' => Hash::make('siswa'),
            'role_id' => 4
        ]);
        Student::create([
            'user_id' => 3,
            'nis' => 12332,
            'classroom' => 'XII RPL'
        ]);

        Category::create([
            'name' => 'Minuman'
        ]);
        Category::create([
            'name' => 'Makanan'
        ]);
        Category::create([
            'name' => 'Snack'
        ]);

        Product::create([
            'name' => 'air mineral',
            'price' => 3000,
            'stock' => 50,
            'photo' =>'https://ecs7.tokopedia.net/img/cache/700/product-1/2018/4/28/2642564/2642564_8fff405b-851f-4196-b943-acae3d697e63_800_800.jpg',
            'desc' => 'asli dari gunungnya',
            'category_id' => 1,
        ]);
        Product::create([
            'name' => 'bakso',
            'price' => 10000,
            'stock' => 50,
            'photo' =>'https://tse1.mm.bing.net/th?id=OIP.5Yy287VlwQXK2TZuWXpYfwHaFj&pid=Api&P=0&h=220',
            'desc' => 'Bakso Daging',
            'category_id' => 2,
        ]);
        Product::create([
            'name' => 'soto ayam',
            'price' => 15000,
            'stock' => 50,
            'photo' =>'https://tse2.mm.bing.net/th?id=OIP.bzsE2MBgAZOqBc8Fu9qXTwHaHx&pid=Api&P=0&h=220',
            'desc' => 'lamongan',
            'category_id' => 3,
        ]);

        Wallet::create([
            'user_id' => 3,
            'credit' => 100000,
            'debit' => null,
            'description' => 'pembukaan tabungan'
        ]);
        Wallet::create([
            'user_id' => 3,
            'credit' => null,
            'debit' => 15000,
            'description' => 'peembelian produk'
        ]);
        Wallet::create([
            'user_id' => 3,
            'credit' => null,
            'debit' => 15000,
            'description' => 'peembelian produk'
        ]);
        Transaction::create([
            'user_id' => 3,
            'product_id' => 1,
            'status' => 'dikeranjang',
            'order_code' => 'INV_12345',
            'price' => 5000,
            'quantity' => 1
        ]);

        Transaction::create([
            'user_id' => 3,
            'product_id' => 2,
            'status' => 'dikeranjang',
            'order_code' => 'INV_12345',
            'price' => 5000,
            'quantity' => 1
        ]);
        Transaction::create([
            'user_id' => 3,
            'product_id' => 3,
            'status' => 'dikeranjang',
            'order_code' => 'INV_12345',
            'price' => 5000,
            'quantity' => 1
        ]);

        
        $total_debit = 0;
        
        $transactions = Transaction::where('order_code'==
        'INV_12345');
        foreach($transactions as $transaction)
        {
            $total_price = $transaction->price * $transaction->quantity;

            $total_debit += $total_price;
        }
        Wallet::create([
            'user_id' => 3,
            'debit' => $total_debit,
            'description' => 'peembelian produk'
        ]);
        foreach($transactions as $transaction)
        {
            Transaction::find($transaction->id)->update([
                'status' => 'dibayar'
            ]);
        }
        foreach($transactions as $transaction)
        {
            Transaction::find($transaction->id)->update([
                'status' => 'diambil'
            ]);
        }
    }
}