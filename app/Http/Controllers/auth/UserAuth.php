<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Livewire\Forms\LoginForm;
use App\Models\Imagem;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

class UserAuth extends Controller
{
    public function login(Request $request)
    {
        dd($request);
        // Valida os dados recebidos (você pode personalizar regras conforme necessário)
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Autentica o usuário com os dados fornecidos
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => __('As credenciais informadas estão incorretas.'),
            ]);
        }

        // Regenera a sessão para evitar fixação
        Session::regenerate();

        // Redireciona para o destino pretendido ou dashboard
        return  redirect()->route('dashboard.home');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $image = new Imagem;
        $image->caminho = "https://ui-avatars.com/api/?name={$user->name}";
        $image->user_id = $user->id;
        $image->save();

        return redirect()->route('dashboard.home');
    }
    public function logout()
    {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();
         return redirect()->route('login');
    }

}
