<?php

namespace Claroline\CoreBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\ArrayInput;

/**
 * Installs the platform, optionaly with plugins and data fixtures.
 */
class PlatformInstallCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        parent::configure();
        $this->setName('claroline:install')
            ->setDescription('Installs the platform according to the config.');
        $this->addOption(
            'with-plugins',
            'wp',
            InputOption::VALUE_NONE,
            'When set to true, available plugins will be installed'
        );
        $this->addOption(
            'with-fixtures',
            'wf',
            InputOption::VALUE_NONE,
            'When set to true, data fixtures will be loaded'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Installing the platform...');
        $manager = $this->getContainer()->get('claroline.install.core_installer');
        $manager->install();

        $aclCommand = $this->getApplication()->find('init:acl');
        $aclCommand->run(new ArrayInput(array('command' => 'init:acl')), $output);

        if ($input->getOption('with-fixtures')) {
            $kernel = $this->getApplication()->getKernel();
            $environment = $kernel->getEnvironment();

            if ($environment === 'prod' || $environment === 'dev' || $environment == 'test') {
                $coreBundleDirectory = $kernel->getRootDir()
                    . '/../src/core/Claroline/CoreBundle';
                $fixturesPath = $environment === 'test'
                    ? $coreBundleDirectory.'/Tests/DataFixtures/Required'
                    : $coreBundleDirectory.'/DataFixtures';
                $output->writeln("Loading {$environment} fixtures...");
                $fixtureCommand = $this->getApplication()->find('doctrine:fixture:load');
                $fixtureInput = new ArrayInput(array(
                    'command' => 'doctrine:fixtures:load',
                    '--fixtures' => $fixturesPath,
                    '--append' => true
                ));
                $fixtureCommand->run($fixtureInput, $output);
            }
        }

        if ($input->getOption('with-plugins')) {
            $pluginCommand = $this->getApplication()->find('claroline:plugin:install_all');
            $pluginCommand->run(new ArrayInput(array('command' => 'claroline:plugin:install_all')), $output);
        }

        $assetCommand = $this->getApplication()->find('assets:install');
        $assetInput = new ArrayInput(array(
            'command' => 'assets:install',
            'target' => realpath(__DIR__ . '/../../../../../web'),
            '--symlink' => true
        ));
        $assetCommand->run($assetInput, $output);

        $asseticCommand = $this->getApplication()->find('assetic:dump');
        $asseticInput = new ArrayInput(array('command' => 'assetic:dump'));
        $asseticCommand->run($asseticInput, $output);

        $output->writeln('Done');
    }
}