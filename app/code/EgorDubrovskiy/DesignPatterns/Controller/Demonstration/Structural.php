<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Controller\Demonstration;

use EgorDubrovskiy\DesignPatterns\Api\Data\Adapter\UserAdapterInterface;
use EgorDubrovskiy\DesignPatterns\Model\Data\Bridge\Dish\FirstDishFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Bridge\Dish\SecondDishFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Bridge\Food\EnglishFood;
use EgorDubrovskiy\DesignPatterns\Model\Data\Bridge\Food\JapaneseFood;
use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Food\DoughFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Composite\Branch;
use EgorDubrovskiy\DesignPatterns\Model\Data\Composite\BranchFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Composite\LeafFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Decorator\BaconPizzaDecoratorFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Decorator\CheesePizzaDecoratorFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Decorator\PizzaDecoratorFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Flyweight\ArmyFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Flyweight\Solder\CavalryFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Flyweight\Solder\TankFactory;
use EgorDubrovskiy\DesignPatterns\Model\Service\Facade\Calculator\CalculatorInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Raw as ResultRaw;
use Magento\Framework\Controller\Result\RawFactory as ResultRawFactory;

class Structural implements HttpGetActionInterface
{
    public const REQUEST_PARAM_NAME_PATTERN = 'pattern';
    public const PATTERN_NAME_ADAPTER = 'adapter';
    public const PATTERN_NAME_BRIDGE = 'bridge';
    public const PATTERN_NAME_COMPOSITE = 'composite';
    public const PATTERN_NAME_FACADE = 'facade';
    public const PATTERN_NAME_DECORATOR = 'decorator';
    public const PATTERN_NAME_FLYWEIGHT = 'flyweight';

    public const REQUEST_PARAM_MULTIPLY_ARGUMENTS = 'multiply_arguments';
    public const REQUEST_PARAM_NAME_CHEESE = 'cheese';
    public const REQUEST_PARAM_NAME_BACON = 'bacon';

    private RequestInterface $request;

    private ResultRawFactory $resultRawFactory;

    private UserAdapterInterface $userAdapter;

    private EnglishFood $englishFood;

    private JapaneseFood $japaneseFood;

    private FirstDishFactory $firstDishFactory;

    private SecondDishFactory $secondDishFactory;

    private BranchFactory $branchFactory;

    private LeafFactory $leafFactory;

    private PizzaDecoratorFactory $pizzaDecoratorFactory;

    private BaconPizzaDecoratorFactory $baconPizzaDecoratorFactory;

    private CheesePizzaDecoratorFactory $cheesePizzaDecoratorFactory;

    private DoughFactory $doughFactory;

    private CalculatorInterface $calculator;

    private ArmyFactory $armyFactory;

    private TankFactory $tankFactory;

    private CavalryFactory $cavalryFactory;

    public function __construct(
        RequestInterface $request,
        ResultRawFactory $resultRawFactory,
        UserAdapterInterface $userAdapter,
        EnglishFood $englishFood,
        JapaneseFood $japaneseFood,
        FirstDishFactory $firstDishFactory,
        SecondDishFactory $secondDishFactory,
        BranchFactory $branchFactory,
        LeafFactory $leafFactory,
        CalculatorInterface $calculator,
        PizzaDecoratorFactory $pizzaDecoratorFactory,
        BaconPizzaDecoratorFactory $baconPizzaDecoratorFactory,
        CheesePizzaDecoratorFactory $cheesePizzaDecoratorFactory,
        DoughFactory $doughFactory,
        ArmyFactory $armyFactory,
        TankFactory $tankFactory,
        CavalryFactory $cavalryFactory
    ) {
        $this->request = $request;
        $this->resultRawFactory = $resultRawFactory;
        $this->userAdapter = $userAdapter;
        $this->englishFood = $englishFood;
        $this->japaneseFood = $japaneseFood;
        $this->firstDishFactory = $firstDishFactory;
        $this->secondDishFactory = $secondDishFactory;
        $this->branchFactory = $branchFactory;
        $this->leafFactory = $leafFactory;
        $this->pizzaDecoratorFactory = $pizzaDecoratorFactory;
        $this->baconPizzaDecoratorFactory = $baconPizzaDecoratorFactory;
        $this->cheesePizzaDecoratorFactory = $cheesePizzaDecoratorFactory;
        $this->doughFactory = $doughFactory;
        $this->calculator = $calculator;
        $this->armyFactory = $armyFactory;
        $this->tankFactory = $tankFactory;
        $this->cavalryFactory = $cavalryFactory;
    }

    public function execute()
    {
        $patternName = $this->request->getParam(self::REQUEST_PARAM_NAME_PATTERN);

        if ($patternName === self::PATTERN_NAME_ADAPTER) {
            return $this->demonstrateAdapter();
        } elseif ($patternName === self::PATTERN_NAME_BRIDGE) {
            return $this->demonstrateBridge();
        } elseif ($patternName === self::PATTERN_NAME_COMPOSITE) {
            return $this->demonstrateComposite();
        } elseif ($patternName === self::PATTERN_NAME_FACADE) {
            return $this->demonstrateFacade();
        } elseif ($patternName === self::PATTERN_NAME_DECORATOR) {
            return $this->demonstrateDecorator();
        } elseif ($patternName === self::PATTERN_NAME_FLYWEIGHT) {
            return $this->demonstrateFlyweight();
        }

        return $this->resultRawFactory->create();
    }

    private function demonstrateAdapter(): ResultRaw
    {
        $resultContent = '<div><b>Adapter</b></div>';
        $resultContent .= 'User Name: ' . $this->userAdapter->getName() . '<br>';

        /** @var ResultRaw $result */
        $result = $this->resultRawFactory->create();
        return $result->setContents($resultContent);
    }

    private function demonstrateBridge(): ResultRaw
    {
        $resultContent = '<div><b>Bridge</b></div>';

        $englishFirstDish = $this->englishFood->cookDish($this->firstDishFactory->create());
        $resultContent .= '<pre>English First Dish: ' . var_export($englishFirstDish, true) . '</pre>';
        $englishSecondDish = $this->englishFood->cookDish($this->secondDishFactory->create());
        $resultContent .= '<pre>English Second Dish: ' . var_export($englishSecondDish, true) . '</pre>';

        $japaneseFirstDish = $this->japaneseFood->cookDish($this->firstDishFactory->create());
        $resultContent .= '<pre>Japanese First Dish: ' . var_export($japaneseFirstDish, true) . '</pre>';
        $japaneseSecondDish = $this->englishFood->cookDish($this->secondDishFactory->create());
        $resultContent .= '<pre>Japanese Second Dish: ' . var_export($japaneseSecondDish, true) . '</pre>';

        /** @var ResultRaw $result */
        $result = $this->resultRawFactory->create();
        return $result->setContents($resultContent);
    }

    private function demonstrateComposite(): ResultRaw
    {
        $resultContent = '<div><b>Composite</b></div>';

        $rootBranch = $this->createRootBranchForComposite();
        $resultContent .= '<pre>Start Tree: ' . var_export($rootBranch, true) . '</pre>';
        $rootBranch->incrementNumberOfInsects();
        $resultContent .= '<pre>With incremented number of insects: ' . var_export($rootBranch, true) . '</pre>';
        $rootBranch->decrementNumberOfInsects();
        $resultContent .= '<pre>With decremented number of insects: ' . var_export($rootBranch, true) . '</pre>';

        $result = $this->resultRawFactory->create();
        return $result->setContents($resultContent);
    }

    private function createRootBranchForComposite(): Branch
    {
        $rootBranch = $this->branchFactory->create();

        $childBranch = $this->branchFactory->create();
        $childBranch->addChildElement($this->leafFactory->create());
        $childBranch->addChildElement($this->leafFactory->create());

        $rootBranch->addChildElement($childBranch);

        return $rootBranch;
    }

    private function demonstrateDecorator(): ResultRaw
    {
        $pizzaDecorator = $this->pizzaDecoratorFactory->create();
        if ($this->request->getParam(self::REQUEST_PARAM_NAME_CHEESE)) {
            $pizzaDecorator = $this->cheesePizzaDecoratorFactory->create(['pizza' => $pizzaDecorator]);
        }
        if ($this->request->getParam(self::REQUEST_PARAM_NAME_BACON)) {
            $pizzaDecorator = $this->baconPizzaDecoratorFactory->create(['pizza' => $pizzaDecorator]);
        }
        $pizzaDecorator->addIngredients([$this->doughFactory->create()]);

        $resultContent = '<div><b>Decorator</b></div>';
        $ingredients = $pizzaDecorator->getIngredients();
        $resultContent .= '<pre>Pizza Ingredients: ' . var_export($ingredients, true) . '</pre>';
        $result = $this->resultRawFactory->create();
        return $result->setContents($resultContent);
    }

    private function demonstrateFlyweight(): ResultRaw
    {
        $army = $this->armyFactory->create();
        $tank = $this->tankFactory->create();
        $cavalry = $this->cavalryFactory->create();
        $army->addSolder($tank);
        $army->addSolder($cavalry);
        $x = rand(-100, 100);
        $y = rand(-100, 100);
        $army->moveToCoordinates($x, $y);

        $resultContent = '<div><b>Flyweight</b></div>';
        $resultContent .= "<div>X: $x, Y: $y</div>";
        $resultContent .= '<pre>Army: ' . var_export($army, true) . '</pre>';
        $result = $this->resultRawFactory->create();
        return $result->setContents($resultContent);
    }

    private function demonstrateFacade(): ResultRaw
    {
        $multiplyArguments = (array) $this->request->getParam(self::REQUEST_PARAM_MULTIPLY_ARGUMENTS, []);
        $multiplyResult = $this->calculator->multiplyArguments($multiplyArguments);

        $resultContent = '<div><b>Facade</b></div>';
        $resultContent .= 'Multiplication Result: ' . $multiplyResult;
        return $this->resultRawFactory->create()->setContents($resultContent);
    }
}
