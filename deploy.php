<?php
namespace Deployer;

require 'recipe/yii2-app-advanced.php';

// Configuration

set('ssh_type', 'native');
set('ssh_multiplexing', true);

set('default_stage', 'production');

set('repository', 'https://github.com/yatye/yatye.git');
set('git_tty', true); // [Optional] Allocate tty for git on first deployment
add('shared_files', [
'.htaccess',
]);
add('shared_dirs', [
    'backend/web/assets',
    'frontend/web/assets',
    'frontend/web/files',
    'api/web/assets',
]);
add('writable_dirs', [
    'backend/runtime',
    'backend/web/assets',
    'frontend/runtime',
    'frontend/web/assets',
    'frontend/web/files',
    'api/runtime',
    'api/web/assets',
]);


// Hosts

host('35.163.111.18')
    ->user('ec2-user')
    ->pemFile('~/Documents/ssh/RwandaGuideDev.pem')
    ->stage('production')
    ->set('deploy_path', '/var/www/html');



// Tasks

task('deploy:change_permission', function () {
    run('chmod 777 -R runtime');
    run('chmod 777 -R web');
})->desc('Change Permission');

//desc('Restart PHP-FPM service');
//task('php-fpm:restart', function () {
//    // The user must have rights for restart service
//    // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
//    run('sudo systemctl restart php-fpm.service');
//});
//after('deploy:symlink', 'php-fpm:restart');
//
//// [Optional] if deploy fails automatically unlock.
//after('deploy:failed', 'deploy:unlock');

//  dep deploy production -vvv