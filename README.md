# SororidApp-Back

# Para iniciar el proyecto hacer: composer install
#
# Luego, modificar el archivo vendor/filament/filament/src/FilamentManager.php para modificar la funcion getUserName y que quede así:
#
#    public function getUserName(Model | Authenticatable $user): string
#    {
#        if ($user->profile && $user->profile->name) {
#            return $user->profile->name;
#        }
#        return $user->getAttributeValue('name') ?? $user->getFilamentName();
#    }
#
# Para continuar hay que modificar el archivo vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/ValidateCsrftToken.php y modificar la clase que ha ahí, para que quede así:
#
# class ValidateCsrfToken extends VerifyCsrfToken
# {
#    protected $except = [
#        'api/*', 
#    ];
# }
#
# Ahora haz el siguiente comando: cp .env.example .env y modifica los valores del .env.
#
# Posteriormente hacer php artisan migrate --seed 