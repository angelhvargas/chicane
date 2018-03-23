<?php 
namespace Sil\Repositories\Storage\User;
use Illuminate\Support\ServiceProvider;
 
class UserServiceProvider extends ServiceProvider {
 
  public function register()
  {
    $this->app->bind
    (
      'Sil\Repositories\Storage\User\UserRepository',
      'Sil\Repositories\Storage\User\Eloquent\EloquentUserRepository'
    );
  }
}