<?php declare(strict_types = 1);

namespace Infrastructure\Content\Service\Translator;

use Nette\Database\Row;
use Nette\Utils\Arrays;
use Nette\Utils\Html;

class DatabaseResultTranslator
{
    public function translateSql(string $sql) : string
    {
        $code = Html::el('code')
            ->addAttributes(['class' => 'language-sql'])
            ->addText($sql);

        $pre = Html::el('pre')
            ->addHtml($code);

        return Html::el('div')
            ->addHtml($pre)
            ->toHtml();
    }

    public function translateResult(array $rows) : string
    {
        $table = Html::el('table');

        $tableHeader = $this->createTableHeader((array) Arrays::first($rows));
        $tableBody = $this->createTableBody($rows);

        $table->addHtml($tableHeader);
        $table->addHtml($tableBody);

        return Html::el('div')
            ->addHtml($table)
            ->toHtml();
    }

    private function createTableHeader(array $row) : Html
    {
        $tableHeader = Html::el('thead');

        $tableRow = Html::el('tr');
        $tableRow->addHtml(
            Html::el('th')->addText('rowNumber')
        );

        foreach ($row as $key => $value) {
            $column = Html::el('th')->addText($key);

            $tableRow->addHtml($column);
        }

        $tableHeader->addHtml($tableRow);

        return $tableHeader;
    }

    private function createTableBody(array $rows) : Html
    {
        $tableBody = Html::el('tbody');

        foreach ($rows as $number => $row) {
            $tableRow = Html::el('tr');

            $tableRow->addHtml(
                Html::el('td')->addText($number)
            );

            foreach ($row as $value) {
                $column = Html::el('td')->addText($value);

                $tableRow->addHtml($column);
            }

            $tableBody->addHtml($tableRow);
        }

        return $tableBody;
    }
}