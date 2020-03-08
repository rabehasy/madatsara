<?php

use EasyCorp\Bundle\EasyDeployBundle\Deployer\DefaultDeployer;

return new class extends DefaultDeployer
{
    public function configure()
    {
        return $this->getConfigBuilder()
            // SSH connection string to connect to the remote server (format: user@host-or-IP:port-number)
            ->server('madatsara')
            // the absolute path of the remote server directory where the project is deployed
            ->deployDir('/home/web/madatsara/dev')
            // the URL of the Git repository where the project code is hosted
            ->repositoryUrl('git@gitlab.com:devmr/madatsarasf5.git')
            // the repository branch to deploy
            ->repositoryBranch('master')
            // avoid error: Script @auto-scripts was called via post-install-cmd
            ->composerInstallFlags('--prefer-dist --no-interaction --no-dev')
            // avoid PHP Fatal error:  Uncaught Symfony\Component\Dotenv\Exception\PathException: Unable to read the
            ->sharedFilesAndDirs(['.env', '.env.local'])
            // Releases folder to keep
            ->keepReleases(1)
            ;
    }

    public function beforePublishing()
    {
        $this->log('<h1>chown -R web: /releases</>');
        $this->runRemote('sudo chown -R web: {{ deploy_dir }}/releases');
    }
    // run some local or remote commands after the deployment is finished
    public function beforeFinishingDeploy()
    {
        $this->log('<h1>chown -R www-data: /current/var</>');
        $this->runRemote('sudo chown -R www-data: {{ deploy_dir }}/current/var');
        $this->log('<h1>yarn install + yarn encore production</>');
        $this->runRemote('cd {{ deploy_dir }}/current && yarn install');
        $this->runRemote('cd {{ deploy_dir }}/current && yarn encore production');
    }
};
