<?php

namespace app\commands;

use opus\payment\helpers\InstallHelper;
use yii\console\Controller;

/**
 * Initialization controller
 *
 * @author Ivo Kund <ivo@opus.ee>
 * @package app\commands
 */
class InitController extends Controller
{
    /**
     * @var array
     */
    private $sqlMap = [
        '01-schema.sql',
        '02-testdata.sql',
    ];

    public function actionIndex()
    {
        $this->actionConfig();
    }

    public function actionConfig()
    {
        $configPath = \Yii::getAlias('@app/config/db-local.php');

        if (!file_exists($configPath) && $this->confirm('Write database parameters now?', true)) {
            $database = $this->prompt('Name of the **existing** database?', ['required' => true]);
            $hostname = $this->prompt('Hostname?', ['required' => true, 'default' => 'localhost']);
            $username = $this->prompt('Username?', ['required' => true, 'default' => 'root']);
            $password = $this->prompt('Password?');

            $config = <<<"CONF"
<?php

return [
	'class' => 'yii\db\Connection',
	'dsn' => 'mysql:host={$hostname};dbname={$database}',
	'username' => '{$username}',
	'password' => '{$password}',
	'charset' => 'utf8',
];

CONF;
            if (file_put_contents($configPath, $config)) {
                \Yii::$app->set('db', require $configPath);
                $this->stdout("Wrote data to: {$configPath}" . \PHP_EOL);
                $this->actionDatabase();
            }
        }

        $configPath = \Yii::getAlias('@app/config/banks-default.php');
        if (!file_exists($configPath) && $this->confirm('Write default bank config now?', true)) {

            InstallHelper::ensureConfigFile($configPath, InstallHelper::CONF_DEFAULT);
            $this->stdout("Wrote data to: {$configPath}" . \PHP_EOL);
        }

        $configPath = \Yii::getAlias('@app/config/banks-local.php');
        if (!file_exists($configPath) && $this->confirm('Write default localized bank config now?', true)) {

            InstallHelper::ensureConfigFile($configPath, InstallHelper::CONF_LOCAL);
            $this->stdout("Wrote data to: {$configPath}" . \PHP_EOL);
        }
    }

    public function actionDatabase()
    {
        if ($this->confirm('Import database dumps now?', true)) {
            $db = \Yii::$app->db;
            $db->open();
            $db->pdo->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, 1);

            $db->createCommand('SET FOREIGN_KEY_CHECKS = 0;')->execute();
            foreach ($this->sqlMap as $sqlFile) {
                $path = \Yii::getAlias('@app/schema/' . $sqlFile);
                echo sprintf('Loading "%s"%s', $sqlFile, PHP_EOL);

                $sql = implode("\n", file($path));

                $res = \Yii::$app->db->pdo->prepare($sql)->execute();

                if ($res) {
                    echo sprintf('Success' . \PHP_EOL);
                } else {
                    echo sprintf('Failure' . \PHP_EOL);
                }
            }
            $db->createCommand('SET FOREIGN_KEY_CHECKS = 1;')->execute();

            $this->stdout("Done\n");
        }
    }
}
