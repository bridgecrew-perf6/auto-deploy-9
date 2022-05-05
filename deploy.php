<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'auto-deploy');

// Project repository
set('repository', 'git@github.com:pizsd/auto-deploy.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
set('shared_files', ['.env']);
set('shared_dirs', ['runtime']);

// Writable dirs by web server 
set('writable_dirs', []);


// Hosts

host('qq')
    ->set('hostname', '42.193.96.240')
    ->set('remote_user', 'root')
    ->set('deploy_path', '/opt/www/{{application}}');
    

// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
