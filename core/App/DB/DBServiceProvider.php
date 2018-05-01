<? namespace Chicane\Database;

   use Chicane\Base\ServiceProvider;


class DBServiceProvider extends ServiceProvider {

    public function register() {
        
        $this->app['db'] = $this->app->share(function(){
           
            $paths = array(__DIR__.'/../app/entities');
            $isDevMode = false;
        
            // the connection configuration
            $dbParams = array(
                'driver'   => 'pdo_mysql',
                'user'     => 'root',
                'password' => '1234567890',
                'dbname'   => 'chicane',
            );
        
            $config = Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
            $entityManager = Doctrine\ORM\EntityManager::create($dbParams, $config);
            return $entityManager;
        });
    }

}