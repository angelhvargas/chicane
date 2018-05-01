<?php 
namespace Chicane\Repositories\Storage\User;
use Illuminate\Support\ServiceProvider;
 
class UserServiceProvider extends ServiceProvider {
 
  public function register()
  {
    $this->app->bind
    (
      'Chicane\Repositories\Storage\User\UserRepository',
      'Chicane\Repositories\Storage\User\Eloquent\EloquentUserRepository'
    );
  }
}