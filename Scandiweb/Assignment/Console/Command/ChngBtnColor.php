<?php
declare(strict_types=1);

namespace Scandiweb\Assignment\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Scandiweb\Assignment\Model\ButtonUpdate;
use Magento\Framework\App\State;

class ChngBtnColor extends Command
{

    private const YOUR_COLOR = 'color';
    private const YOUR_STORE = 'store_id';
    /**
     * State Area Code
     *
     * @var \Magento\Framework\App\State $state
     */
    protected $state;
    /**
     * Button Update
     * @var \Scandiweb\Assignment\Model\ButtonUpdate $blockButtonUpdate
     *
     */
    protected $blockButtonUpdate;

    /**
     * @param \Scandiweb\Assignment\Model\ButtonUpdate $blockButtonUpdate
     * @param \Magento\Framework\App\State $state
     * @return void
     */
    public function __construct(ButtonUpdate $blockButtonUpdate, State $state)
    {
        $this->blockButtonUpdate = $blockButtonUpdate;
        $this->state = $state;
        parent::__construct();
    }
    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_ADMINHTML);
        $hexcolor   = $input->getOption(self::YOUR_COLOR);
         $storeid    =  $input->getOption(self::YOUR_STORE);
        
         $response = $this->blockButtonUpdate->saveBtnColor($hexcolor, $storeid);
           $output->writeln($response);
    }
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName("scandiweb_assignment:chngbtncolor");
        $this->setDescription("Change Button Color For the Specified Store");
        $this->addOption(
            self::YOUR_COLOR,
            null,
            InputOption::VALUE_REQUIRED,
            'Color Code of the  Button'
        );
    
        $this->addOption(
            self::YOUR_STORE,
            null,
            InputOption::VALUE_REQUIRED,
            'Store View Id'
        );
      
           parent::configure();
    }
}
