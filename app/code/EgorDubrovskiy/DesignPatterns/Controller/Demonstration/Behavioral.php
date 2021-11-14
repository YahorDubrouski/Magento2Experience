<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Controller\Demonstration;

use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\PizzaInterfaceFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\ChainOfResponsibility\EmergencyServiceManager;
use EgorDubrovskiy\DesignPatterns\Model\Data\Command\PizzaCook;
use EgorDubrovskiy\DesignPatterns\Model\Data\Command\PizzaCookFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Interpreter\PizzaRecipeInterpreter;
use EgorDubrovskiy\DesignPatterns\Model\Data\Iterator\BookFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Iterator\BookList;
use EgorDubrovskiy\DesignPatterns\Model\Data\Mediator\Concierge;
use EgorDubrovskiy\DesignPatterns\Model\Data\Memento\TextArea;
use EgorDubrovskiy\DesignPatterns\Model\Data\Memento\TextAreaFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Memento\TextAreaMementoManagerFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Observer\StormFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Observer\StormNotifier;
use EgorDubrovskiy\DesignPatterns\Model\Data\Observer\StormObserver\RoadServiceObserverFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Observer\StormObserver\SchoolObserverFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\State\Oven;
use EgorDubrovskiy\DesignPatterns\Model\Data\Strategy\IntegerList;
use EgorDubrovskiy\DesignPatterns\Model\Data\TemplateMethod\CurrentDateToFileWriter;
use EgorDubrovskiy\DesignPatterns\Model\Data\TemplateMethod\CurrentTimeToFileWriter;
use EgorDubrovskiy\DesignPatterns\Model\Data\TemplateMethod\FileWriter;
use EgorDubrovskiy\DesignPatterns\Model\Service\Builder\PizzaByRequestBuilder;
use Exception;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Raw as ResultRaw;
use Magento\Framework\Controller\Result\RawFactory as ResultRawFactory;
use Magento\Framework\Exception\LocalizedException;

class Behavioral implements HttpGetActionInterface
{
    public const REQUEST_PARAM_NAME_PATTERN = 'pattern';
    public const PATTERN_NAME_CHAIN_OF_RESPONSIBILITY = 'chain_of_responsibility';
    public const PATTERN_NAME_COMMAND = 'command';
    public const PATTERN_NAME_INTERPRETER = 'interpreter';
    public const PATTERN_NAME_ITERATOR = 'iterator';
    public const PATTERN_NAME_MEDIATOR = 'mediator';
    public const PATTERN_NAME_MEMENTO = 'memento';
    public const PATTERN_NAME_VISITOR = 'visitor';
    public const PATTERN_NAME_STATE = 'state';
    public const PATTERN_NAME_OBSERVER = 'observer';
    public const PATTERN_NAME_STRATEGY = 'strategy';
    public const PATTERN_NAME_TEMPLATE_METHOD = 'template_method';

    public const REQUEST_PARAM_NAME_USER_REQUEST_TO_EMERGENCY_SERVICE = 'user_request_to_emergency_service';
    public const REQUEST_PARAM_PIZZA_INGREDIENTS = 'pizza_ingredients';
    public const REQUEST_PARAM_MAKE_PIZZA_EXPRESSION = 'make_pizza_expression';
    public const REQUEST_PARAM_OVEN_STATE = 'oven_state';
    public const REQUEST_PARAM_THREAD_LEVEL = 'thread_level';

    private RequestInterface $request;

    private ResultRawFactory $resultRawFactory;

    private EmergencyServiceManager $emergencyServiceManager;

    private TextAreaFactory $textAreaFactory;

    private TextAreaMementoManagerFactory $textAreaMementoManagerFactory;

    private Concierge $concierge;

    private BookFactory $bookFactory;

    private BookList $bookList;

    private PizzaCook $pizzaCook;

    private PizzaRecipeInterpreter $pizzaRecipeInterpreter;

    private PizzaByRequestBuilder $pizzaByRequestBuilder;

    private IntegerList $integerList;

    private StormNotifier $stormNotifier;

    private StormFactory $stormFactory;

    private RoadServiceObserverFactory $roadServiceObserverFactory;

    private SchoolObserverFactory $schoolObserverFactory;

    private Oven $oven;

    private CurrentDateToFileWriter $currentDateToFileWriter;

    private CurrentTimeToFileWriter $currentTimeToFileWriter;

    public function __construct(
        RequestInterface $request,
        ResultRawFactory $resultRawFactory,
        EmergencyServiceManager $emergencyServiceManager,
        TextAreaFactory $textAreaFactory,
        TextAreaMementoManagerFactory $textAreaMementoManagerFactory,
        Concierge $concierge,
        PizzaCookFactory $pizzaCookFactory,
        PizzaInterfaceFactory $pizzaFactory,
        PizzaRecipeInterpreter $pizzaRecipeInterpreter,
        BookFactory $bookFactory,
        BookList $bookList,
        PizzaByRequestBuilder $pizzaByRequestBuilder,
        IntegerList $integerList,
        StormNotifier $stormNotifier,
        StormFactory $stormFactory,
        RoadServiceObserverFactory $roadServiceObserverFactory,
        SchoolObserverFactory $schoolObserverFactory,
        Oven $oven,
        CurrentDateToFileWriter $currentDateToFileWriter,
        CurrentTimeToFileWriter $currentTimeToFileWriter
    ) {
        $this->request = $request;
        $this->resultRawFactory = $resultRawFactory;
        $this->emergencyServiceManager = $emergencyServiceManager;
        $this->textAreaFactory = $textAreaFactory;
        $this->textAreaMementoManagerFactory = $textAreaMementoManagerFactory;
        $this->concierge = $concierge;
        $this->pizzaCook = $pizzaCookFactory->create(['pizza' => $pizzaFactory->create()]);
        $this->pizzaRecipeInterpreter = $pizzaRecipeInterpreter;
        $this->bookFactory = $bookFactory;
        $this->bookList = $bookList;
        $this->integerList = $integerList;
        $this->oven = $oven;
        $this->stormNotifier = $stormNotifier;
        $this->stormFactory = $stormFactory;
        $this->roadServiceObserverFactory = $roadServiceObserverFactory;
        $this->schoolObserverFactory = $schoolObserverFactory;
        $this->currentDateToFileWriter = $currentDateToFileWriter;
        $this->currentTimeToFileWriter = $currentTimeToFileWriter;
        $this->pizzaByRequestBuilder = $pizzaByRequestBuilder;
    }

    /**
     * @return ResultRaw
     * @throws Exception
     */
    public function execute()
    {
        $patternName = $this->request->getParam(self::REQUEST_PARAM_NAME_PATTERN);

        if ($patternName === self::PATTERN_NAME_CHAIN_OF_RESPONSIBILITY) {
            return $this->demonstrateChainOfResponsibility();
        } elseif ($patternName === self::PATTERN_NAME_ITERATOR) {
            return $this->demonstrateIterator();
        } elseif ($patternName === self::PATTERN_NAME_COMMAND) {
            return $this->demonstrateCommand();
        } elseif ($patternName === self::PATTERN_NAME_INTERPRETER) {
            return $this->demonstrateInterpreter();
        } elseif ($patternName === self::PATTERN_NAME_MEDIATOR) {
            return $this->demonstrateMediator();
        } elseif ($patternName === self::PATTERN_NAME_MEMENTO) {
            return $this->demonstrateMemento();
        } elseif ($patternName === self::PATTERN_NAME_STRATEGY) {
            return $this->demonstrateStrategy();
        } elseif ($patternName === self::PATTERN_NAME_OBSERVER) {
            return $this->demonstrateObserver();
        } elseif ($patternName === self::PATTERN_NAME_STATE) {
            return $this->demonstrateState();
        } elseif ($patternName === self::PATTERN_NAME_TEMPLATE_METHOD) {
            return $this->demonstrateTemplateMethod();
        } elseif ($patternName === self::PATTERN_NAME_VISITOR) {
            return $this->demonstrateVisitor();
        }

        return $this->resultRawFactory->create();
    }

    private function demonstrateChainOfResponsibility(): ResultRaw
    {
        $userRequest = $this->request->getParam(self::REQUEST_PARAM_NAME_USER_REQUEST_TO_EMERGENCY_SERVICE, '');
        $this->emergencyServiceManager->callByUserRequest($userRequest);

        return $this->resultRawFactory->create();
    }

    /**
     * @return ResultRaw
     * @throws Exception
     */
    private function demonstrateMemento(): ResultRaw
    {
        $textArea = $this->textAreaFactory->create();
        $mementoManager = $this->textAreaMementoManagerFactory->create(['textArea' => $textArea]);

        $textArea->setColor(TextArea::COLOR_READ)
            ->setText('Version 1');
        $mementoManager->saveCurrentMemento();
        $textArea->setColor(TextArea::COLOR_BLACK)
            ->setText('Version 2');
        $mementoManager->saveCurrentMemento();
        $mementoManager->restoreMementoByIndex(0);

        $resultContent = '<div><b>Memento</b></div>';
        $resultContent .= '<pre>Text Area Memento: ' . var_export($textArea->createMemento(), true) . '</pre>';
        return $this->resultRawFactory->create()->setContents($resultContent);
    }

    /**
     * @return ResultRaw
     * @throws LocalizedException
     */
    private function demonstrateMediator(): ResultRaw
    {
        $this->concierge->executeServiceByName(Concierge::SERVICE_TAXI);
        $this->concierge->executeServiceByName(Concierge::SERVICE_FLOWER_DELIVERY);
        $this->concierge->executeServiceByName(Concierge::SERVICE_CALL_MASTER);

        return $this->resultRawFactory->create();
    }

    private function demonstrateIterator(): ResultRaw
    {
        $this->initializeBookList();

        $resultContent = '<div><b>Interpreter</b></div>';
        $resultContent .= '<pre>Books Sorted By Name:</pre>';
        foreach ($this->bookList->getBooksSortedByName() as $book) {
            $resultContent .= '<pre>Book: ' . var_export($book, true) . '</pre>';
        }
        $resultContent .= '<pre>Books Sorted By Author Name:</pre>';
        foreach ($this->bookList->getBooksSortedByAuthorName() as $book) {
            $resultContent .= '<pre>Book: ' . var_export($book, true) . '</pre>';
        }
        return $this->resultRawFactory->create()->setContents($resultContent);
    }

    private function initializeBookList(): void
    {
        $book1 = $this->bookFactory->create();
        $book1->setName('Book C')
            ->setNameOfAuthor('Author B');
        $this->bookList->addBook($book1);
        $book2 = $this->bookFactory->create();
        $book2->setName('Book A')
            ->setNameOfAuthor('Author C');
        $this->bookList->addBook($book2);
        $book3 = $this->bookFactory->create();
        $book3->setName('Book B')
            ->setNameOfAuthor('Author A');
        $this->bookList->addBook($book3);
    }

    private function demonstrateCommand(): ResultRaw
    {
        $ingredientNames = (array) $this->request->getParam(self::REQUEST_PARAM_PIZZA_INGREDIENTS, []);

        foreach ($ingredientNames as $ingredientName) {
            $this->pizzaCook->addIngredientToRecipeByName($ingredientName);
        }
        $pizza = $this->pizzaCook->makePizza();

        $resultContent = '<div><b>Command</b></div>';
        $resultContent .= '<pre>Pizza: ' . var_export($pizza, true) . '</pre>';
        return $this->resultRawFactory->create()->setContents($resultContent);
    }

    /**
     * @return ResultRaw
     * @throws Exception
     */
    private function demonstrateInterpreter(): ResultRaw
    {
        $makePizzaExpression = (string) $this->request->getParam(self::REQUEST_PARAM_MAKE_PIZZA_EXPRESSION, '');
        $pizza = $this->pizzaRecipeInterpreter->makePizzaByStringExpression($makePizzaExpression);

        $resultContent = '<div><b>Interpreter</b></div>';
        $resultContent .= '<pre>Pizza: ' . var_export($pizza, true) . '</pre>';
        return $this->resultRawFactory->create()->setContents($resultContent);
    }

    private function demonstrateVisitor(): ResultRaw
    {
        $pizza = $this->pizzaByRequestBuilder->build();
        foreach ($pizza->getIngredients() as $ingredient) {
            $ingredient->addStandardOfPaperInGrams();
        }

        $resultContent = '<div><b>Visitor</b></div>';
        $resultContent .= '<pre>' . var_export($pizza, true) . '</pre>';

        return $this->resultRawFactory->create()->setContents($resultContent);
    }

    /**
     * @return ResultRaw
     * @throws Exception
     */
    private function demonstrateTemplateMethod(): ResultRaw
    {
        $resultContent = '<div><b>Template Method</b></div>';
        $this->currentDateToFileWriter->writeDataToFile();
        $resultContent .= '<pre>Current Date: ' . file_get_contents(FileWriter::FILE_PATH) . '</pre>';
        $this->currentTimeToFileWriter->writeDataToFile();
        $resultContent .= '<pre>Current Time: ' . file_get_contents(FileWriter::FILE_PATH) . '</pre>';

        return $this->resultRawFactory->create()->setContents($resultContent);
    }

    private function demonstrateStrategy(): ResultRaw
    {
        $smallArray = range(0, IntegerList::AMOUNT_OF_ITEMS_FOR_BUBBLE_SORT);
        shuffle($smallArray);
        $sortedSmallArray = $this->integerList->getSortedList($smallArray);
        $bigArray = range(0, IntegerList::AMOUNT_OF_ITEMS_FOR_QUICK_SORT);
        shuffle($bigArray);
        $sortedBigArray = $this->integerList->getSortedList($bigArray);

        $resultContent = '<div><b>Strategy</b></div>';
        $resultContent .= '<pre>Sorted Small Array: ' . var_export($sortedSmallArray, true) . '</pre>';
        $resultContent .= '<pre>Sorted Big Array: ' . var_export($sortedBigArray, true) . '</pre>';
        return $this->resultRawFactory->create()->setContents($resultContent);
    }

    /**
     * @return ResultRaw
     * @throws LocalizedException
     */
    private function demonstrateState(): ResultRaw
    {
        $state = (string) $this->request->getParam(self::REQUEST_PARAM_OVEN_STATE, '');
        $this->oven->setStateByKey($state)
            ->bake();

        return $this->resultRawFactory->create();
    }

    private function demonstrateObserver(): ResultRaw
    {
        $threadLevel = (string) $this->request->getParam(self::REQUEST_PARAM_THREAD_LEVEL);
        $storm = $this->stormFactory->create();
        $storm->setThreadLevel($threadLevel);
        $this->stormNotifier->addObserver($this->roadServiceObserverFactory->create())
            ->addObserver($this->schoolObserverFactory->create());

        $this->stormNotifier->notifyAboutStorm($storm);

        return $this->resultRawFactory->create();
    }
}
