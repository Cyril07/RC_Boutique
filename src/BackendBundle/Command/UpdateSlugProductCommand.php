<?php
// src/BackendBundle/Command/UpdateSlugProductCommand.php
namespace BackendBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;


class UpdateSlugProductCommand extends Command
{
    protected function configure()
    {
        $this
        // the name of the command (the part after "bin/console")
        ->setName('slug:product:update')

        // the short description shown while running "php bin/console list"
        ->setDescription('Update the slug in products entity in the database')

        // the full command description shown when running the command with
        // the "--help" option
        ->setHelp("You don't need help")
    ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
		
		
	    $container = $this->getApplication()->getKernel()->getContainer();
	    $em = $container->get('doctrine')->getEntityManager();

	    $products = $em->getRepository('BackendBundle:Product')->findAll();

	    // create a new progress bar (50 units)
		$progress = new ProgressBar($output, count($products));
		// start and displays the progress bar		
		$progress->start();

	    foreach ($products as $product){
	    	$product->setSlug(null);
	    	$em->persist($product);
	    	$em->flush();

	    	// advance the progress bar 1 unit
    		$progress->advance();

	    }
	    // ensure that the progress bar is at 100%
		$progress->finish();
    }
}