<?php
/**
 * This file is part of PHPWord - A pure PHP library for reading and writing
 * word processing documents.
 *
 * PHPWord is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPWord/contributors.
 *
 * @see         https://github.com/PHPOffice/PHPWord
 * @copyright   2010-2018 PHPWord contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

namespace PhpOffice\PhpWord\Writer\RTF;

use PhpOffice\PhpWord\Element\Footer;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\RTF;
use PHPUnit\Framework\TestCase;

/**
 * Test class for PhpOffice\PhpWord\Writer\RTF\Element subnamespace
 */
class SectionTest extends TestCase
{
    public function testSectTagCount()
    {
        $phpWord = new PhpWord();
        $parentWriter = new RTF($phpWord);
        $section1 = $phpWord->addSection();
        $section1->addText('This is section 1');
        $section2 = $phpWord->addSection();
        $section2->addText('This is section 2');
        $section3 = $phpWord->addSection();
        $section3->addText('This is section 3');
        $section4 = $phpWord->addSection();
        $section4->addText('This is section 4');
        $section5 = $phpWord->addSection();
        $section5->addText('This is section 5');
        $contents = $parentWriter->getWriterPart('Document')->write();
        // Tag written before all sections but first.
        self::assertSame(4, preg_match_all('/\\\\sect\\b/', $contents), 'Sect count should be number of sections minus 1');
        self::assertSame(1, preg_match('/\\\\par\\r?\\n$/', $contents), 'Doc should end with par tag, not sect tag');
        $pos = (int) strpos($contents, 'This is section 1');
        self::assertNotEquals(0, $pos);
        self::assertSame(0, preg_match('/\\\\sect\\b/', substr($contents, 0, $pos)), 'No sect tag before section 1');
    }
}
