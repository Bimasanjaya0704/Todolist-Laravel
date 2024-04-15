<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $todo = new Todo();
        $todo->id = "1";
        $todo->todo = "bimas";
        $todo->status = "unfinished"; // Menambahkan status 'unfinished'
        $todo->save();
    
        $todo = new Todo();
        $todo->id = "2";
        $todo->todo = "sanjaya";
        $todo->status = "unfinished"; // Menambahkan status 'unfinished'
        $todo->save();
    }
    
}
