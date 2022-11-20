<?php
declare(strict_types=1);

namespace GhostUnicorns\UpdateCategoryMerchandiser\Console\Command;

use GhostUnicorns\UpdateCategoryMerchandiser\Model\SetAreaCode;
use GhostUnicorns\UpdateCategoryMerchandiser\Model\UpdateCategoryMerchandiserProcess;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateCategoryMerchandiserCommand extends Command
{
    /**
     * @var UpdateCategoryMerchandiserProcess
     */
    private $categoryMerchandiserProcess;

    /**
     * @var SetAreaCode
     */
    private $setAreaCode;

    /**
     * @param UpdateCategoryMerchandiserProcess $categoryMerchandiserProcess
     * @param SetAreaCode $setAreaCode
     * @param string $name
     */
    public function __construct(
        UpdateCategoryMerchandiserProcess $categoryMerchandiserProcess,
        SetAreaCode                       $setAreaCode,
        string                            $name
    ) {
        $this->categoryMerchandiserProcess = $categoryMerchandiserProcess;
        $this->setAreaCode = $setAreaCode;
        parent::__construct($name);
    }

    /**
     * @inheirtDoc
     */
    protected function configure()
    {
        $this->setName('category:merchandiser:update');
        $this->setDescription('Update merchandiser data for dynamic categories');
        parent::configure();
    }

    /**
     * @inheirtDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->setAreaCode->execute('adminhtml');
        $this->categoryMerchandiserProcess->execute();
    }
}
