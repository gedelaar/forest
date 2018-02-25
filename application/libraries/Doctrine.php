<?php

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\ClassLoader;
use Doctrine\Common\EventManager;
use Doctrine\DBAL\Event\Listeners\MysqlSessionInit;
use Doctrine\DBAL\Logging\EchoSQLLogger;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\SchemaTool;
use Gedmo\Sluggable\SluggableListener;
use Gedmo\Timestampable\TimestampableListener;
use Gedmo\Tree\TreeListener;

class Doctrine {

    public $em = null;
    public $tool = null;

    public function __construct() {

// Is the config file in the environment folder?
        if (!defined('ENVIRONMENT') OR ! file_exists($file_path = APPPATH . 'config/' . ENVIRONMENT . '/database.php')) {
            $file_path = APPPATH . 'config/database.php';
        }
// load database configuration from CodeIgniter
        require $file_path;


// Set up class loading. You could use different autoloaders, provided by your favorite framework,
// if you want to.
        require_once APPPATH . 'vendor/doctrine/common/lib/Doctrine/Common/ClassLoader.php';

        $doctrineClassLoader = new ClassLoader('Doctrine', APPPATH . 'libraries');
        $doctrineClassLoader->register();
        $entitiesClassLoader = new ClassLoader('models', rtrim(APPPATH, "/"));
        $entitiesClassLoader->register();
        $proxiesClassLoader = new ClassLoader('Proxies', APPPATH . 'proxies');
        $proxiesClassLoader->register();


        foreach (glob(APPPATH . 'modules/*', GLOB_ONLYDIR) as $m) {
            $module = str_replace(APPPATH . 'modules/', '', $m);
            $loader = new ClassLoader($module, APPPATH . 'modules');
            $loader->register();
        }


        $evm = new EventManager;
// timestampable
        $evm->addEventSubscriber(new TimestampableListener);
// sluggable
        $evm->addEventSubscriber(new SluggableListener);
// tree
        $evm->addEventSubscriber(new TreeListener);


// Set up caches
        $config = new Configuration;
        $cache = new ArrayCache;
        $config->setMetadataCacheImpl($cache);
        $driverImpl = $config->newDefaultAnnotationDriver(array(APPPATH . 'models/Entities'));
        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCacheImpl($cache);

        $config->setQueryCacheImpl($cache);

// Proxy configuration
        $config->setProxyDir(APPPATH . '/proxies'); //must be set to 777
        $config->setProxyNamespace('Proxies');

// Set up logger
        $logger = new EchoSQLLogger;
        $config->setSQLLogger($logger);


        if (ENVIRONMENT == "development") {
            $config->setAutoGenerateProxyClasses(true);
        } else {
            $config->setAutoGenerateProxyClasses(false);
        }


// Database connection information
        $connectionOptions = array(
            'driver' => 'pdo_mysql',
            'user' => $db[$active_group]['username'],
            'password' => $db[$active_group]['password'],
            'host' => $db[$active_group]['hostname'],
            'dbname' => $db[$active_group]['database']
        );

// Create EntityManager
        $this->em = EntityManager::create($connectionOptions, $config);


// Force UTF-8
        $this->em->getEventManager()->addEventSubscriber(new MysqlSessionInit('utf8', 'utf8_unicode_ci'));

// Schema Tool
        $this->tool = new SchemaTool($this->em);
    }

    /**
     * generate entity objects automatically from mysql db tables
     * @return none
     */
    function generate_classes() {

        $this->em->getConfiguration()
                ->setMetadataDriverImpl(
                        new DatabaseDriver(
                        $this->em->getConnection()->getSchemaManager()
                        )
        );

        $cmf = new DisconnectedClassMetadataFactory();
        $cmf->setEntityManager($this->em);
        $metadata = $cmf->getAllMetadata();
        $generator = new EntityGenerator();

        $generator->setUpdateEntityIfExists(true);
        $generator->setGenerateStubMethods(true);
        $generator->setGenerateAnnotations(true);
        $generator->generate($metadata, APPPATH . "models/Entities");
    }

}
