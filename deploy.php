<?php

namespace Deployer;

require 'recipe/symfony4.php';

set('writable_mode', 'acl'); // chmod, chown, chgrp or acl.
set('writable_use_sudo', true);

// Project name
set('application', 'symfony');

// Project repository
set('repository', 'git@github.com:rabehasy/madatsara.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);

// Shared files/dirs between deploys
set('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts

//host('madatsara')
localhost()
    ->set('deploy_path', '~/madatsara/{{branch}}');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

before('deploy:cache:clear', 'chown:web');

task('chown:web', function () {
    run('cd {{release_path}} && sudo chown -R web.web {{release_path}}/var');
});

after('deploy:cache:clear', 'copy:build');

after('cleanup', 'chown:clearcache:apps');
task('chown:clearcache:apps', function () {
    // Yarn build
    $task = run('cd ~/madatsara/{{branch}} && yarn install && yarn encore production');
    writeln('task results (yarn): '.$task);
});
