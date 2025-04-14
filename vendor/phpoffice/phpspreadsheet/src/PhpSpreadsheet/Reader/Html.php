<?php

namespace PhpOffice\PhpSpreadsheet\Reader;

use DOMDocument;
use DOMElement;
use DOMNode;
use DOMText;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Document\Properties;
use PhpOffice\PhpSpreadsheet\Helper\Dimension as CssDimension;
use PhpOffice\PhpSpreadsheet\Reader\Security\XmlScanner;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Throwable;

class Html extends BaseReader
{
    /**
     * Sample size to read to determine if it's HTML or not.
     */
    const TEST_SAMPLE_SIZE = 2048;

    /**
     * Input encoding.
     *
     * @var string
     */
    protected $inputEncoding = 'ANSI';

    /**
     * Sheet index to read.
     *
     * @var int
     */
    protected $sheetIndex = 0;

    /**
     * Formats.
     *
     * @var array
     */
    protected $formats = [
        'h1' => [
            'font' => [
                'bold' => true,
                'size' => 24,
            ],
        ], //    Bold, 24pt
        'h2' => [
            'font' => [
                'bold' => true,
                'size' => 18,
            ],
        ], //    Bold, 18pt
        'h3' => [
            'font' => [
                'bold' => true,
                'size' => 13.5,
            ],
        ], //    Bold, 13.5pt
        'h4' => [
            'font' => [
                'bold' => true,
                'size' => 12,
            ],
        ], //    Bold, 12pt
        'h5' => [
            'font' => [
                'bold' => true,
                'size' => 10,
            ],
        ], //    Bold, 10pt
        'h6' => [
            'font' => [
                'bold' => true,
                'size' => 7.5,
            ],
        ], //    Bold, 7.5pt
        'a' => [
            'font' => [
                'underline' => true,
                'color' => [
                    'argb' => Color::COLOR_BLUE,
                ],
            ],
        ], //    Blue underlined
        'hr' => [
            'borders' => [
                'bottom' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => [
                        Color::COLOR_BLACK,
                    ],
                ],
            ],
        ], //    Bottom border
        'strong' => [
            'font' => [
                'bold' => true,
            ],
        ], //    Bold
        'b' => [
            'font' => [
                'bold' => true,
            ],
        ], //    Bold
        'i' => [
            'font' => [
                'italic' => true,
            ],
        ], //    Italic
        'em' => [
            'font' => [
                'italic' => true,
            ],
        ], //    Italic
    ];

    /** @var array */
    protected $rowspan = [];

    /**
     * Create a new HTML Reader instance.
     */
    public function __construct()
    {
        parent::__construct();
        $this->securityScanner = XmlScanner::getInstance($this);
    }

    /**
     * Validate that the current file is an HTML file.
     */
    public function canRead(string $filename): bool
    {
        // Check if file exists
        try {
            $this->openFile($filename);
        } catch (Exception $e) {
            return false;
        }

        $beginning = $this->readBeginning();
        $startWithTag = self::startsWithTag($beginning);
        $containsTags = self::containsTags($beginning);
        $endsWithTag = self::endsWithTag($this->readEnding());

        fclose($this->fileHandle);

        return $startWithTag && $containsTags && $endsWithTag;
    }

    private function readBeginning(): string
    {
        fseek($this->fileHandle, 0);

        return (string) fread($this->fileHandle, self::TEST_SAMPLE_SIZE);
    }

    private function readEnding(): string
    {
        $meta = stream_get_meta_data($this->fileHandle);
        $filename = $meta['uri'];

        $size = (int) filesize($filename);
        if ($size === 0) {
            return '';
        }

        $blockSize = self::TEST_SAMPLE_SIZE;
        if ($size < $blockSize) {
            $blockSize = $size;
        }

        fseek($this->fileHandle, $size - $blockSize);

        return (string) fread($this->fileHandle, $blockSize);
    }

    private static function startsWithTag(string $data): bool
    {
        return '<' === substr(trim($data), 0, 1);
    }

    private static function endsWithTag(string $data): bool
    {
        return '>' === substr(trim($data), -1, 1);
    }

    private static function containsTags(string $data): bool
    {
        return strlen($data) !== strlen(strip_tags($data));
    }

    /**
     * Loads Spreadsheet from file.
     */
    public function loadSpreadsheetFromFile(string $filename): Spreadsheet
    {
        // Create new Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Load into this instance
        return $this->loadIntoExisting($filename, $spreadsheet);
    }

    /**
     * Set input encoding.
     *
     * @param string $inputEncoding Input encoding, eg: 'ANSI'
     *
     * @return $this
     *
     * @codeCoverageIgnore
     *
     * @deprecated no use is made of this property
     */
    public function setInputEncoding($inputEncoding)
    {
        $this->inputEncoding = $inputEncoding;

        return $this;
    }

    /**
     * Get input encoding.
     *
     * @return string
     *
     * @codeCoverageIgnore
     *
     * @deprecated no use is made of this property
     */
    public function getInputEncoding()
    {
        return $this->inputEncoding;
    }

    //    Data Array used for testing only, should write to Spreadsheet object on completion of tests

    /** @var array */
    protected $dataArray = [];

    /** @var int */
    protected $tableLevel = 0;

    /** @var array */
    protected $nestedColumn = ['A'];

    protected function setTableStartColumn(string $column): string
    {
        if ($this->tableLevel == 0) {
            $column = 'A';
        }
        ++$this->tableLevel;
        $this->nestedColumn[$this->tableLevel] = $column;

        return $this->nestedColumn[$this->tableLevel];
    }

    protected function getTableStartColumn(): string
    {
        return $this->nestedColumn[$this->tableLevel];
    }

    protected function releaseTableStartColumn(): string
    {
        --$this->tableLevel;

        return array_pop($this->nestedColumn);
    }

    /**
     * Flush cell.
     *
     * @param string $column
     * @param int|string $row
     * @param mixed $cellContent
     */
    protected function flushCell(Worksheet $sheet, $column, $row, &$cellContent, array $attributeArray): void
    {
        if (is_string($cellContent)) {
            //    Simple String content
            if (trim($cellContent) > '') {
                //    Only actually write it if there's content in the string
                //    Write to worksheet to be done here...
                //    ... we return the cell, so we can mess about with styles more easily

                // Set cell value explicitly if there is data-type attribute
                if (isset($attributeArray['data-type'])) {
                    $datatype = $attributeArray['data-type'];
                    if (in_array($datatype, [DataType::TYPE_STRING, DataType::TYPE_STRING2, DataType::TYPE_INLINE])) {
                        //Prevent to Excel treat string with beginning equal sign or convert big numbers to scientific number
                        if (substr($cellContent, 0, 1) === '=') {
                            $sheet->getCell($column . $row)
                                ->getStyle()
                                ->setQuotePrefix(true);
                        }
                    }
                    //catching the Exception and ignoring the invalid data types
                    try {
                        $sheet->setCellValueExplicit($column . $row, $cellContent, $attributeArray['data-type']);
                    } catch (\PhpOffice\PhpSpreadsheet\Exception $exception) {
                        $sheet->setCellValue($column . $row, $cellContent);
                    }
                } else {
                    $sheet->setCellValue($column . $row, $cellContent);
                }
                $this->dataArray[$row][$column] = $cellContent;
            }
        } else {
            //    We have a Rich Text run
            //    TODO
            $this->dataArray[$row][$column] = 'RICH TEXT: ' . $cellContent;
        }
        $cellContent = (string) '';
    }

    private function processDomElementBody(Worksheet $sheet, int &$row, string &$column, string &$cellContent, DOMElement $child): void
    {
        $attributeArray = [];
        foreach ($child->attributes as $attribute) {
            $attributeArray[$attribute->name] = $attribute->value;
        }

        if ($child->nodeName === 'body') {
            $row = 1;
            $column = 'A';
            $cellContent = '';
            $this->tableLevel = 0;
            $this->processDomElement($child, $sheet, $row, $column, $cellContent);
        } else {
            $this->processDomElementTitle($sheet, $row, $column, $cellContent, $child, $attributeArray);
        }
    }

    private function processDomElementTitle(Worksheet $sheet, int &$row, string &$column, string &$cellContent, DOMElement $child, array &$attributeArray): void
    {
        if ($child->nodeName === 'title') {
            $this->processDomElement($child, $sheet, $row, $column, $cellContent);
            $sheet->setTitle($cellContent, true, true);
            $cellContent = '';
        } else {
            $this->processDomElementSpanEtc($sheet, $row, $column, $cellContent, $child, $attributeArray);
        }
    }

    private const SPAN_ETC = ['span', 'div', 'font', 'i', 'em', 'strong', 'b'];

    private function processDomElementSpanEtc(Worksheet $sheet, int &$row, string &$column, string &$cellContent, DOMElement $child, array &$attributeArray): void
    {
        if (in_array((string) $child->nodeName, self::SPAN_ETC, true)) {
            if (isset($attributeArray['class']) && $attributeArray['class'] === 'comment') {
                $sheet->getComment($column . $row)
                    ->getText()
                    ->createTextRun($child->textContent);
            } else {
                $this->processDomElement($child, $sheet, $row, $column, $cellContent);
            }

            if (isset($this->formats[$child->nodeName])) {
                $sheet->getStyle($column . $row)->applyFromArray($this->formats[$child->nodeName]);
            }
        } else {
            $this->processDomElementHr($sheet, $row, $column, $cellContent, $child, $attributeArray);
        }
    }

    private function processDomElementHr(Worksheet $sheet, int &$row, string &$column, string &$cellContent, DOMElement $child, array &$attributeArray): void
    {
        if ($child->nodeName === 'hr') {
            $this->flushCell($sheet, $column, $row, $cellContent, $attributeArray);
            ++$row;
            if (isset($this->formats[$child->nodeName])) {
                $sheet->getStyle($column . $row)->applyFromArray($this->formats[$child->nodeName]);
            }
            ++$row;
        }
        // fall through to br
        $this->processDomElementBr($sheet, $row, $column, $cellContent, $child, $attributeArray);
    }

    private function processDomElementBr(Worksheet $sheet, int &$row, string &$column, string &$cellContent, DOMElement $child, array &$attributeArray): void
    {
        if ($child->nodeName === 'br' || $child->nodeName === 'hr') {
            if ($this->tableLevel > 0) {
                //    If we're inside a table, replace with a \n and set the cell to wrap
                $cellContent .= "\n";
                $sheet->getStyle($column . $row)->getAlignment()->setWrapText(true);
            } else {
                //    Otherwise flush our existing content and move the row cursor on
                $this->flushCell($sheet, $column, $row, $cellContent, $attributeArray);
                ++$row;
            }
        } else {
            $this->processDomElementA($sheet, $row, $column, $cellContent, $child, $attributeArray);
        }
    }

    private function processDomElementA(Worksheet $sheet, int &$row, string &$column, string &$cellContent, DOMElement $child, array &$attributeArray): void
    {
        if ($child->nodeName === 'a') {
            foreach ($attributeArray as $attributeName => $attributeValue) {
                switch ($attributeName) {
                    case 'href':
                        $sheet->getCell($column . $row)->getHyperlink()->setUrl($attributeValue);
                        if (isset($this->formats[$child->nodeName])) {
                            $sheet->getStyle($column . $row)->applyFromArray($this->formats[$child->nodeName]);
                        }

                        break;
                    case 'class':
                        if ($attributeValue === 'comment-indicator') {
                            break; // Ignore - it's just a red square.
                        }
                }
            }
            // no idea why this should be needed
            //$cellContent .= ' ';
            $this->processDomElement($child, $sheet, $row, $column, $cellContent);
        } else {
            $this->processDomElementH1Etc($sheet, $row, $column, $cellContent, $child, $attributeArray);
        }
    }

    private const H1_ETC = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'ol', 'ul', 'p'];

    private function processDomElementH1Etc(Worksheet $sheet, int &$row, string &$column, string &$cellContent, DOMElement $child, array &$attributeArray): void
    {
        if (in_array((string) $child->nodeName, self::H1_ETC, true)) {
            if ($this->tableLevel > 0) {
                //    If we're inside a table, replace with a \n
                $cellContent .= $cellContent ? "\n" : '';
                $sheet->getStyle($column . $row)->getAlignment()->setWrapText(true);
                $this->processDomElement($child, $sheet, $row, $column, $cellContent);
            } else {
                if ($cellContent > '') {
                    $this->flushCell($sheet, $column, $row, $cellContent, $attributeArray);
                    ++$row;
                }
                $this->processDomElement($child, $sheet, $row, $column, $cellContent);
                $this->flushCell($sheet, $column, $row, $cellContent, $attributeArray);

                if (isset($this->formats[$child->nodeName])) {
                    $sheet->getStyle($column . $row)->applyFromArray($this->formats[$child->nodeName]);
                }

                ++$row;
                $column = 'A';
            }
        } else {
            $this->processDomElementLi($sheet, $row, $column, $cellContent, $child, $attributeArray);
        }
    }

    private function processDomElementLi(Worksheet $sheet, int &$row, string &$column, string &$cellContent, DOMElement $child, array &$attributeArray): void
    {
        if ($child->nodeName === 'li') {
            if ($this->tableLevel > 0) {
                //    If we're inside a table, replace with a \n
                $cellContent .= $cellContent ? "\n" : '';
                $this->processDomElement($child, $sheet, $row, $column, $cellContent);
            } else {
                if ($cellContent > '') {
                    $this->flushCell($sheet, $column, $row, $cellContent, $attributeArray);
                }
                ++$row;
                $this->processDomElement($child, $sheet, $row, $column, $cellContent);
                $this->flushCell($sheet, $column, $row, $cellContent, $attributeArray);
                $column = 'A';
            }
        } else {
            $this->processDomElementImg($sheet, $row, $column, $cellContent, $child, $attributeArray);
        }
    }

    private function processDomElementImg(Worksheet $sheet, int &$row, string &$column, string &$cellContent, DOMElement $child, array &$attributeArray): void
    {
        if ($child->nodeName === 'img') {
            $this->insertImage($sheet, $column, $row, $attributeArray);
        } else {
            $this->processDomElementTable($sheet, $row, $column, $cellContent, $child, $attributeArray);
        }
    }

    private string $currentColumn = 'A';

    private function processDomElementTable(Worksheet $sheet, int &$row, string &$column, string &$cellContent, DOMElement $child, array &$attributeArray): void
    {
        if ($child->nodeName === 'table') {
            $this->currentColumn = 'A';
            $this->flushCell($sheet, $column, $row, $cellContent, $attributeArray);
            $column = $this->setTableStartColumn($column);
            if ($this->tableLevel > 1 && $row > 1) {
                --$row;
            }
            $this->processDomElement($child, $sheet, $row, $column, $cellContent);
            $column = $this->releaseTableStartColumn();
            if ($this->tableLevel > 1) {
                ++$column;
            } else {
                ++$row;
            }
        } else {
            $this->processDomElementTr($sheet, $row, $column, $cellContent, $child, $attributeArray);
        }
    }

    private function processDomElementTr(Worksheet $sheet, int &$row, string &$column, string &$cellContent, DOMElement $child, array &$attributeArray): void
    {
        if ($child->nodeName === 'col') {
            $this->applyInlineStyle($sheet, -1, $this->currentColumn, $attributeArray);
            ++$this->currentColumn;
        } elseif ($child->nodeName === 'tr') {
            $column = $this->getTableStartColumn();
            $cellContent = '';
            $this->processDomElement($child, $sheet, $row, $column, $cellContent);

            if (isset($attributeArray['height'])) {
                $sheet->getRowDimension($row)->setRowHeight($attributeArray['height']);
            }

            ++$row;
        } else {
            $this->processDomElementThTdOther($sheet, $row, $column, $cellContent, $child, $attributeArray);
        }
    }

    private function processDomElementThTdOther(Worksheet $sheet, int &$row, string &$column, string &$cellContent, DOMElement $child, array &$attributeArray): void
    {
        if ($child->nodeName !== 'td' && $child->nodeName !== 'th') {
            $this->processDomElement($child, $sheet, $row, $column, $cellContent);
        } else {
            $this->processDomElementThTd($sheet, $row, $column, $cellContent, $child, $attributeArray);
        }
    }

    private function processDomElementBgcolor(Worksheet $sheet, int $row, string $column, array $attributeArray): void
    {
        if (isset($attributeArray['bgcolor'])) {
            $sheet->getStyle("$column$row")->applyFromArray(
                [
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => $this->getStyleColor($attributeArray['bgcolor'])],
                    ],
                ]
            );
        }
    }

    private function processDomElementWidth(Worksheet $sheet, string $column, array $attributeArray): void
    {
        if (isset($attributeArray['width'])) {
            $sheet->getColumnDimension($column)->setWidth((new CssDimension($attributeArray['width']))->width());
        }
    }

    private function processDomElementHeight(Worksheet $sheet, int $row, array $attributeArray): void
    {
        if (isset($attributeArray['height'])) {
            $sheet->getRowDimension($row)->setRowHeight((new CssDimension($attributeArray['height']))->height());
        }
    }

    private function processDomElementAlign(Worksheet $sheet, int $row, string $column, array $attributeArray): void
    {
        if (isset($attributeArray['align'])) {
            $sheet->getStyle($column . $row)->getAlignment()->setHorizontal($attributeArray['align']);
        }
    }

    private function processDomElementVAlign(Worksheet $sheet, int $row, string $column, array $attributeArray): void
    {
        if (isset($attributeArray['valign'])) {
            $sheet->getStyle($column . $row)->getAlignment()->setVertical($attributeArray['valign']);
        }
    }

    private function processDomElementDataFormat(Worksheet $sheet, int $row, string $column, array $attributeArray): void
    {
        if (isset($attributeArray['data-format'])) {
            $sheet->getStyle($column . $row)->getNumberFormat()->setFormatCode($attributeArray['data-format']);
        }
    }

    private function processDomElementThTd(Worksheet $sheet, int &$row, string &$column, string &$cellContent, DOMElement $child, array &$attributeArray): void
    {
        while (isset($this->rowspan[$column . $row])) {
            ++$column;
        }
        $this->processDomElement($child, $sheet, $row, $column, $cellContent);

        // apply inline style
        $this->applyInlineStyle($sheet, $row, $column, $attributeArray);

        $this->flushCell($sheet, $column, $row, $cellContent, $attributeArray);

        $this->processDomElementBgcolor($sheet, $row, $column, $attributeArray);
        $this->processDomElementWidth($sheet, $column, $attributeArray);
        $this->processDomElementHeight($sheet, $row, $attributeArray);
        $this->processDomElementAlign($sheet, $row, $column, $attributeArray);
        $this->processDomElementVAlign($sheet, $row, $column, $attributeArray);
        $this->processDomElementDataFormat($sheet, $row, $column, $attributeArray);

        if (isset($attributeArray['rowspan'], $attributeArray['colspan'])) {
            //create merging rowspan and colspan
            $columnTo = $column;
            for ($i = 0; $i < (int) $attributeArray['colspan'] - 1; ++$i) {
                ++$columnTo;
            }
            $range = $column . $row . ':' . $columnTo . ($row + (int) $attributeArray['rowspan'] - 1);
            foreach (Coordinate::extractAllCellReferencesInRange($range) as $value) {
                $this->rowspan[$value] = true;
            }
            $sheet->mergeCells($range);
            $column = $columnTo;
        } elseif (isset($attributeArray['rowspan'])) {
            //create merging rowspan
            $range = $column . $row . ':' . $column . ($row + (int) $attributeArray['rowspan'] - 1);
            foreach (Coordinate::extractAllCellReferencesInRange($range) as $value) {
                $this->rowspan[$value] = true;
            }
            $sheet->mergeCells($range);
        } elseif (isset($attributeArray['colspan'])) {
            //create merging colspan
            $columnTo = $column;
            for ($i = 0; $i < (int) $attributeArray['colspan'] - 1; ++$i) {
                ++$columnTo;
            }
            $sheet->mergeCells($column . $row . ':' . $columnTo . $row);
            $column = $columnTo;
        }

        ++$column;
    }

    protected function processDomElement(DOMNode $element, Worksheet $sheet, int &$row, string &$column, string &$cellContent): void
    {
        foreach ($element->childNodes as $child) {
            if ($child instanceof DOMText) {
                $domText = (string) preg_replace('/\s+/u', ' ', trim($child->nodeValue ?? ''));
                if (is_string($cellContent)) {
                    //    simply append the text if the cell content is a plain text string
                    $cellContent .= $domText;
                }
                //    but if we have a rich text run instead, we need to append it correctly
                    //    TODO
            } elseif ($child instanceof DOMElement) {
                $this->processDomElementBody($sheet, $row, $column, $cellContent, $child);
            }
        }
    }

    /**
     * Loads PhpSpreadsheet from file into PhpSpreadsheet instance.
     *
     * @param string $filename
     *
     * @return Spreadsheet
     */
    public function loadIntoExisting($filename, Spreadsheet $spreadsheet)
    {
        // Validate
        if (!$this->canRead($filename)) {
            throw new Exception($filename . ' is an Invalid HTML file.');
        }

        // Create a new DOM object
        $dom = new DOMDocument();
        // Set error handling options to suppress warnings
        $previousValue = libxml_use_internal_errors(true);
        
        // Reload the HTML file into the DOM object
        try {
            $content = $this->getSecurityScannerOrThrow()->scanFile($filename);