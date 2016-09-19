<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\MinkContext;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Behat\Symfony2Extension\Context\KernelAwareContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext, KernelAwareContext
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var KernelAwareContext
     */
    private $kernel;

    protected function createDataBase()
    {
        // Read the entities mapping information in order to transform it into a schema
        /** @var EntityManagerInterface $em */
        $em = $this->container->get('doctrine.orm.entity_manager');
        $metadata = $em->getMetadataFactory()->getAllMetadata();
        $tool = new \Doctrine\ORM\Tools\SchemaTool($em);
        $tool->dropDatabase();
        $tool->createSchema($metadata);
    }

    /**
     * @BeforeScenario
     */
    public function loadFixtures()
    {
        $this->createDataBase();
    }

    /**
     * Sets Kernel instance.
     *
     * @param \Symfony\Component\HttpKernel\KernelInterface $kernel
     */
    public function setKernel(\Symfony\Component\HttpKernel\KernelInterface $kernel)
    {
        $this->kernel = $kernel;
        $this->container = $kernel->getContainer();
    }
}
