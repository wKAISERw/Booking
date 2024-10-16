<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    public function up()
    {
        // Встановлюємо роль адміна для fortayngames@gmail.com
        User::where('email', 'fortayngames@gmail.com')->update(['role' => 'admin']);

        // Встановлюємо роль користувача для qwe20236@gmail.com
        User::where('email', 'qwe20236@gmail.com')->update(['role' => 'user']);
    }

    public function down()
    {
        // Повертаємо обох користувачів до ролі за замовчуванням
        User::whereIn('email', ['fortayngames@gmail.com', 'qwe20236@gmail.com'])
            ->update(['role' => 'user']);
    }
};
