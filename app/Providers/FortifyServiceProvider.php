<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LogoutResponse;

/* O Fortify é um conjunto de funcionalidades que trata da autenticação.
Por exemplo: Login, Registo, Logout, Recuperar password, Alterar password, Middleware auth.
Tudo isso já fica preparado pelo Fortify. */

/* Sem Fortify teriamos de criar: LoginController, RegisterController, LogoutController,
validar passwords, comparar hashes, criar sessões, proteger rotas... Tudo manualmente. */

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Define para onde o utilizador será redirecionado
        // após terminar a sessão (logout).
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {

        public function toResponse($request)
        {
            return redirect('/home');
        }

    });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('passkeys', function (Request $request) {
            $credentialId = $request->input('credential.id');

            return Limit::perMinute(10)->by(
                ($credentialId ?: $request->session()->getId()).'|'.$request->ip()
            );
        });

        // Define qual view será aberta quando o utilizador
        // aceder à página de login.
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // Define qual view será aberta quando o utilizador
        // aceder à página de registo.
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // Define qual view será aberta quando o utilizador
        // clicar em "Esqueci-me da password".
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });

        // Define qual view será aberta quando o utilizador
        // receber o link de recuperação e precisar
        // de escolher uma nova password.
        Fortify::resetPasswordView(function (Request $request) {

        // Envia o objeto Request para a view.
        // O Request contém informações importantes,
        // como o token enviado no link de recuperação.
        return view('auth.reset-password', ['request' => $request
    ]);
});


    }
}
